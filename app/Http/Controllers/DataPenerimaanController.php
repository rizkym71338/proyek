<?php

namespace App\Http\Controllers;

use App\Models\Penerimaan;
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
            Penerimaan::create($validated);
            return redirect('/data-penerimaan')->with("success", "Berhasil Menambahkan Data Penerimaan!");
        } catch (\Throwable $th) {
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
        try {
            Penerimaan::where('id', $penerimaan->id)->update($validated);
            return redirect('/data-penerimaan')->with("success", "Berhasil Mengubah Data Penerimaan!");
        } catch (\Throwable $th) {
            return redirect('/data-penerimaan')->with("error", "Gagal Mengubah Data Penerimaan!");
        }
    }

    public function destroy(Penerimaan $penerimaan)
    {
        try {
            Penerimaan::destroy($penerimaan->id);
            return redirect('/data-penerimaan')->with("success", "Berhasil Menghapus Data Penerimaan!");
        } catch (\Throwable $th) {
            return redirect('/data-penerimaan')->with("error", "Gagal Menghapus Data Penerimaan!");
        }
    }
}
