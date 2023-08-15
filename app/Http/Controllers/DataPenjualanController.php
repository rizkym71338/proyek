<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Persediaan;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DataPenjualanController extends Controller
{
    public function index()
    {
        $this->authorize("data-penjualan");
        return view(
            "data_penjualan",
            [
                "title" => "Data Penjualan",
                "penjualans" => Penjualan::latest()->get(),
                "stok_produk" => Produk::where('nama', "Telur")->first()->stok,
            ],
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_kwitansi' => 'required',
            'pembeli' => 'required',
            'produk_keluar' => 'required',
            'satuan' => 'required',
        ]);

        try {
            $produk = Produk::where("nama", "Telur")->first();
            $currentDate = Carbon::now()->format('Y-m-d');
            $persediaan = Persediaan::where("tanggal", $currentDate)->first();
            $produkKeluar = $validated["produk_keluar"];
            if ($produkKeluar > $produk->stok) return redirect('/data-penjualan')->with("error", "Stok Produk Tidak Cukup Untuk Melakukan Penjualan!");
            if ($persediaan) {
                $persediaan->update(["produk_keluar" => $persediaan->produk_keluar + $produkKeluar, "stok_produk" => $produk->stok - $produkKeluar]);
            } else {
                $dataPost = [
                    'produk_masuk' => 0,
                    'produk_keluar' => $produkKeluar,
                    "stok_produk" => $produk->stok - $produkKeluar
                ];
                $persediaan = Persediaan::create($dataPost);
            }
            $validated["persediaan_id"] = $persediaan->id;
            $produk->update(["stok" => $produk->stok - $produkKeluar]);
            Penjualan::create($validated);
            return redirect('/data-penjualan')->with("success", "Berhasil Menambahkan Data penjualan!");
        } catch (\Throwable $th) {
            return redirect('/data-penjualan')->with("error", "Gagal Menambahkan Data penjualan!");
        }
    }


    public function update(Request $request, Penjualan $penjualan)
    {
        $validated = $request->validate([
            'tanggal' => 'required',
            'no_kwitansi' => 'required',
            'pembeli' => 'required',
            'produk_keluar' => 'required',
            'satuan' => 'required',
        ]);
        $validated["tanggal"] = Carbon::parse($validated["tanggal"])->format('Y-m-d');

        try {
            $produk = Produk::where("nama", "Telur")->first();
            $produkKeluar = $validated["produk_keluar"];
            $persediaan = Persediaan::where("id", $penjualan->persediaan_id)->first();
            if ($produkKeluar > $produk->stok) return redirect('/data-penjualan')->with("error", "Stok Produk Tidak Cukup Untuk Melakukan Pembaruan Penjualan!");
            if ($validated["tanggal"] == $penjualan->tanggal) {
                $persediaan->update(["produk_keluar" => $persediaan->produk_keluar + ($produkKeluar - $penjualan->produk_keluar), "stok_produk" => $produk->stok - ($produkKeluar - $penjualan->produk_keluar)]);
            } else {
                $persediaan->update(["produk_keluar" => $persediaan->produk_keluar - $penjualan->produk_keluar, "stok_produk" => $produk->stok - ($produkKeluar - $penjualan->produk_keluar)]);
                if (Persediaan::where("tanggal", $validated["tanggal"])->first()) {
                    $persediaan = Persediaan::where("tanggal", $validated["tanggal"])->first();
                    $persediaan->update(["produk_keluar" => $persediaan->produk_keluar + $produkKeluar, "stok_produk" => $produk->stok - ($produkKeluar - $penjualan->produk_keluar)]);
                } else {
                    $dataPost = [
                        "tanggal" => $validated["tanggal"],
                        'produk_masuk' => 0,
                        'produk_keluar' => $produkKeluar,
                        "stok_produk" => $produk->stok - $produkKeluar
                    ];
                    $persediaan = Persediaan::create($dataPost);
                }
            }
            $validated["persediaan_id"] = $persediaan->id;
            $produk->update(["stok" => $produk->stok - ($produkKeluar - $penjualan->produk_keluar)]);
            Penjualan::where('id', $penjualan->id)->update($validated);
            return redirect('/data-penjualan')->with("success", "Berhasil Mengubah Data penjualan!");
        } catch (\Throwable $th) {
            return redirect('/data-penjualan')->with("error", "Gagal Mengubah Data penjualan!");
        }
    }

    public function destroy(Penjualan $penjualan)
    {
        try {
            $produk = Produk::where("nama", "Telur")->first();
            $persediaan = Persediaan::where("id", $penjualan->persediaan_id)->first();
            $produk->update(["stok" => $produk->stok + $penjualan->produk_keluar]);
            $persediaan->update(["produk_keluar" => $persediaan->produk_keluar - $penjualan->produk_keluar, "stok_produk" => $produk->stok + $penjualan->produk_keluar]);
            Penjualan::destroy($penjualan->id);
            return redirect('/data-penjualan')->with("success", "Berhasil Menghapus Data penjualan!");
        } catch (\Throwable $th) {
            return redirect('/data-penjualan')->with("error", "Gagal Menghapus Data penjualan!");
        }
    }
}
