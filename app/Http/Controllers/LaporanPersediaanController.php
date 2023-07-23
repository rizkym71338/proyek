<?php

namespace App\Http\Controllers;

use App\Models\Persediaan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanPersediaanController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if (!$startDate || !$endDate) {
            $data = Persediaan::latest()->get();
        } else {
            $data = Persediaan::latest()->whereBetween('tanggal', [$startDate, $endDate])->get();
        }

        $this->authorize("laporan-persediaan");
        return view("laporan_persediaan", [
            "title" => "Laporan persediaan",
            "persediaans" => $data,
            "start_date" => $startDate,
            "end_date" => $endDate
        ]);
    }

    public function cetak_pdf(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        if (!$startDate || !$endDate) {
            $data = Persediaan::latest()->get();
        } else {
            $data = Persediaan::latest()->whereBetween('tanggal', [$startDate, $endDate])->get();
        }

        $pdf = Pdf::loadView(
            'persediaan_pdf',
            [
                "title" => "Laporan Persediaan",
                "persediaans" => $data,
                "start_date" => $startDate,
                "end_date" => $endDate
            ]
        );
        return $pdf->download('laporan_persediaan_' . Carbon::now() . '.pdf');
    }
}
