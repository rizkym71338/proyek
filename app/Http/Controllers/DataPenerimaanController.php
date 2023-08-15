<?php

namespace App\Http\Controllers;

use App\Models\Penerimaan;
use App\Models\Persediaan;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DataPenerimaanController extends Controller
{
    public function index()
    {
        $this->authorize("data-penerimaan");
        return view("data_penerimaan", ["title" => "Data Penerimaan", "penerimaans" => Penerimaan::latest()->get()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'penerima' => 'required',
            'pengirim' => 'required',
            'produk_masuk' => 'required',
            'satuan' => 'required',
        ]);

        try {
            $produk = Produk::where("nama", "Telur")->first();
            $currentDate = Carbon::now()->format('Y-m-d');
            $persediaan = Persediaan::where("tanggal", $currentDate)->first();
            $produkMasuk = $validated["produk_masuk"];
            if ($persediaan) {
                $persediaan->update(["produk_masuk" => $persediaan->produk_masuk + $produkMasuk, "stok_produk" => $produk->stok + $produkMasuk]);
            } else {
                $dataPost = [
                    'produk_masuk' => $produkMasuk,
                    'produk_keluar' => 0,
                    "stok_produk" => $produk->stok + $produkMasuk,
                ];
                $persediaan = Persediaan::create($dataPost);
            }
            $validated["persediaan_id"] = $persediaan->id;
            $produk->update(["stok" => $produk->stok + $produkMasuk]);
            Penerimaan::create($validated);
            return redirect('/data-penerimaan')->with("success", "Berhasil Menambahkan Data Penerimaan!");
        } catch (\Throwable $th) {
            dd($th);
            return redirect('/data-penerimaan')->with("error", "Gagal Menambahkan Data Penerimaan!");
        }
    }


    public function update(Request $request, Penerimaan $penerimaan)
    {
        $validated = $request->validate([
            'tanggal' => 'required',
            'penerima' => 'required',
            'pengirim' => 'required',
            'produk_masuk' => 'required',
            'satuan' => 'required',
        ]);
        $validated["tanggal"] = Carbon::parse($validated["tanggal"])->format('Y-m-d');

        try {
            $produk = Produk::where("nama", "Telur")->first();
            $produkMasuk = $validated["produk_masuk"];
            $persediaan = Persediaan::where("id", $penerimaan->persediaan_id)->first();
            if ($validated["tanggal"] == $penerimaan->tanggal) {
                $persediaan->update(["produk_masuk" => $persediaan->produk_masuk + ($produkMasuk - $penerimaan->produk_masuk), "stok_produk" => $produk->stok + ($produkMasuk - $penerimaan->produk_masuk)]);
            } else {
                $persediaan->update(["produk_masuk" => $persediaan->produk_masuk - $penerimaan->produk_masuk, "stok_produk" => $produk->stok + ($produkMasuk - $penerimaan->produk_masuk)]);
                if (Persediaan::where("tanggal", $validated["tanggal"])->first()) {
                    $persediaan = Persediaan::where("tanggal", $validated["tanggal"])->first();
                    $persediaan->update(["produk_masuk" => $persediaan->produk_masuk + $produkMasuk, "stok_produk" => $produk->stok + ($produkMasuk - $penerimaan->produk_masuk)]);
                } else {
                    $dataPost = [
                        "tanggal" => $validated["tanggal"],
                        'produk_masuk' => $produkMasuk,
                        'produk_keluar' => 0,
                        "stok_produk" => $produk->stok + $produkMasuk,
                    ];
                    $persediaan = Persediaan::create($dataPost);
                }
            }
            $validated["persediaan_id"] = $persediaan->id;
            $produk->update(["stok" => $produk->stok + ($produkMasuk - $penerimaan->produk_masuk)]);
            Penerimaan::where('id', $penerimaan->id)->update($validated);
            return redirect('/data-penerimaan')->with("success", "Berhasil Mengubah Data Penerimaan!");
        } catch (\Throwable $th) {
            return redirect('/data-penerimaan')->with("error", "Gagal Mengubah Data Penerimaan!");
        }
    }

    public function destroy(Penerimaan $penerimaan)
    {
        try {
            $produk = Produk::where("nama", "Telur")->first();
            $persediaan = Persediaan::where("id", $penerimaan->persediaan_id)->first();
            $produk->update(["stok" => $produk->stok - $penerimaan->produk_masuk]);
            $persediaan->update(["produk_masuk" => $persediaan->produk_masuk - $penerimaan->produk_masuk, "stok_produk" => $produk->stok - $penerimaan->produk_masuk]);
            Penerimaan::destroy($penerimaan->id);
            return redirect('/data-penerimaan')->with("success", "Berhasil Menghapus Data Penerimaan!");
        } catch (\Throwable $th) {
            return redirect('/data-penerimaan')->with("error", "Gagal Menghapus Data Penerimaan!");
        }
    }
}
