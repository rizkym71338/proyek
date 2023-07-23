<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanPenjualanController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if (!$startDate || !$endDate) {
            $data = Penjualan::latest()->get();
        } else {
            $data = Penjualan::latest()->whereBetween('tanggal', [$startDate, $endDate])->get();
        }

        $this->authorize("laporan-penjualan");
        return view("laporan_penjualan", [
            "title" => "Laporan penjualan",
            "penjualans" => $data,
            "start_date" => $startDate,
            "end_date" => $endDate
        ]);
    }

    public function cetak_pdf(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        if (!$startDate || !$endDate) {
            $data = Penjualan::latest()->get();
        } else {
            $data = Penjualan::latest()->whereBetween('tanggal', [$startDate, $endDate])->get();
        }

        $pdf = Pdf::loadView(
            'penjualan_pdf',
            [
                "title" => "Laporan Penjualan",
                "penjualans" => $data,
                "start_date" => $startDate,
                "end_date" => $endDate
            ]
        );
        return $pdf->download('laporan_penjualan_' . Carbon::now() . '.pdf');
    }
}
