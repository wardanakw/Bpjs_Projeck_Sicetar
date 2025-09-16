<?php

namespace App\Http\Controllers;

use App\Models\Pelayanan;
use Illuminate\Http\Request;
use App\Exports\PelayananExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function index()
    {
        return view('export.index');
    }

    public function export(Request $request)
    {
        $bulan = $request->get('bulan');
        $tahun = $request->get('tahun');
        $hanya_reg_boa = $request->get('hanya_reg_boa', false);
        $filename = $request->get('filename');

        if (!$filename || trim($filename) === '') {
            $filename = 'pelayanan_export';
            if ($hanya_reg_boa) {
                $filename .= '_reg_boa';
            }
            if ($bulan && $tahun) {
                $filename .= '_' . $bulan . '_' . $tahun;
            }
        }

        $filename .= '.xlsx';

        return Excel::download(new PelayananExport($bulan, $tahun, $hanya_reg_boa), $filename);
    }
}