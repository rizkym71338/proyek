<?php

namespace App\Http\Controllers;

use App\Models\Persediaan;
use Illuminate\Http\Request;

class DataPersediaanController extends Controller
{
    public function index()
    {
        $this->authorize("data-persediaan");
        return view(
            "data_persediaan",
            [
                "title" => "Data Persediaan",
                "persediaans" => Persediaan::latest()->get(),
            ],
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'produk_masuk' => 'required',
            'produk_keluar' => 'required',
            'stok_produk' => 'required',
        ]);

        try {
            Persediaan::create($validated);
            return redirect('/data-persediaan')->with("success", "Berhasil Menambahkan Data Persediaan!");
        } catch (\Throwable $th) {
            return redirect('/data-persediaan')->with("error", "Gagal Menambahkan Data Persediaan!");
        }
    }

    public function update(Request $request, Persediaan $persediaan)
    {
        $validated = $request->validate([
            'tanggal' => 'required',
            'produk_masuk' => 'required',
            'produk_keluar' => 'required',
            'stok_produk' => 'required',
        ]);
        try {
            Persediaan::where('id', $persediaan->id)->update($validated);
            return redirect('/data-persediaan')->with("success", "Berhasil Mengubah Data Persediaan!");
        } catch (\Throwable $th) {
            return redirect('/data-persediaan')->with("error", "Gagal Mengubah Data Persediaan!");
        }
    }

    public function destroy(Persediaan $persediaan)
    {
        try {
            Persediaan::destroy($persediaan->id);
            return redirect('/data-persediaan')->with("success", "Berhasil Menghapus Data Persediaan!");
        } catch (\Throwable $th) {
            return redirect('/data-persediaan')->with("error", "Gagal Menghapus Data Persediaan!");
        }
    }
}
