<?php

namespace App\Http\Controllers;

use App\Models\Penerimaan;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanPenerimaanController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if (!$startDate || !$endDate) {
            $data = Penerimaan::latest()->get();
        } else {
            $data = Penerimaan::latest()->whereBetween('tanggal', [$startDate, $endDate])->get();
        }

        $this->authorize("laporan-penerimaan");
        return view("laporan_penerimaan", [
            "title" => "Laporan Penerimaan",
            "penerimaans" => $data,
            "start_date" => $startDate,
            "end_date" => $endDate
        ]);
    }

    public function cetak_pdf(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        if (!$startDate || !$endDate) {
            $data = Penerimaan::latest()->get();
        } else {
            $data = Penerimaan::latest()->whereBetween('tanggal', [$startDate, $endDate])->get();
        }

        $pdf = Pdf::loadView(
            'penerimaan_pdf',
            [
                "title" => "Laporan Penerimaan",
                "penerimaans" => $data,
                "start_date" => $startDate,
                "end_date" => $endDate
            ]
        );
        return $pdf->download('laporan_penerimaan_' . Carbon::now() . '.pdf');
    }
}
