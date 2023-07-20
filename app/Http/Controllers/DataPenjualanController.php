<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Persediaan;
use Illuminate\Http\Request;

class DataPenjualanController extends Controller
{
    public function index()
    {
        $this->authorize("penjualan");
        return view("data_penjualan", ["title" => "Data Penjualan", "penjualans" => Penjualan::latest()->get()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_kwitansi' => 'required',
            'pembeli' => 'required',
            'produk_keluar' => 'required',
        ]);

        try {
            $latestPersediaan = Persediaan::latest('tanggal')->first();
            $stokAwal = $latestPersediaan ? $latestPersediaan->stok_akhir : 0;
            $stokAkhir = $stokAwal - $validated['produk_keluar'];
            if ($stokAkhir < 0) return redirect('/data-penjualan')->with("error", "Stok persediaan tidak cukup untuk melakukan penjualan !");
            $validated['stok_awal'] = $stokAwal;
            $validated['stok_akhir'] = $stokAkhir;
            $validated['produk_masuk'] = 0;
            Penjualan::create($validated);
            Persediaan::create($validated);
            return redirect('/data-penjualan')->with("success", "Berhasil Menambahkan Data penjualan !");
        } catch (\Throwable $th) {
            return redirect('/data-penjualan')->with("error", "Gagal Menambahkan Data penjualan !");
        }
    }


    public function update(Request $request, Penjualan $penjualan)
    {
        $validated = $request->validate([
            'tanggal' => 'required',
            'no_kwitansi' => 'required',
            'pembeli' => 'required',
            'produk_keluar' => 'required',
        ]);
        try {
            Penjualan::where('id', $penjualan->id)->update($validated);
            return redirect('/data-penjualan')->with("success", "Berhasil Mengubah Data penjualan !");
        } catch (\Throwable $th) {
            return redirect('/data-penjualan')->with("error", "Gagal Mengubah Data penjualan !");
        }
    }

    public function destroy(Penjualan $penjualan)
    {
        try {
            Penjualan::destroy($penjualan->id);
            return redirect('/data-penjualan')->with("success", "Berhasil Menghapus Data penjualan !");
        } catch (\Throwable $th) {
            return redirect('/data-penjualan')->with("error", "Gagal Menghapus Data penjualan !");
        }
    }
}
