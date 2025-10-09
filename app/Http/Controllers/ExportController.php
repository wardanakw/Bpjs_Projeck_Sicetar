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

        $request->validate([
            'bulan' => 'required|integer|between:1,12',
            'tahun' => 'required|integer|min:2020|max:' . (date('Y') + 5),
        ]);

        if (!$filename || trim($filename) === '') {
            $nama_bulan = [
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
            ];
            
            $filename = 'Data_Pelayanan_BAST_' . $nama_bulan[$bulan] . '_' . $tahun;
            
            if ($hanya_reg_boa) {
                $filename .= '_Sudah_Reg_BOA';
            }
        }

        $filename .= '.xlsx';

        return Excel::download(new PelayananExport($bulan, $tahun, $hanya_reg_boa), $filename);
    }

    public function dataInfo(Request $request)
{
    $bulan = $request->get('bulan');
    $tahun = $request->get('tahun');
    
    $nama_bulan = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];

    $startDate = Carbon::create($tahun, $bulan, 1)->startOfMonth();
    $endDate = Carbon::create($tahun, $bulan, 1)->endOfMonth();
    
    $totalData = Pelayanan::whereBetween('tgl_bast', [$startDate, $endDate])->count();
    $dataRegBoa = Pelayanan::whereBetween('tgl_bast', [$startDate, $endDate])
                          ->whereNotNull('tgl_reg_boa')->count();

    return response()->json([
        'nama_bulan' => $nama_bulan[$bulan],
        'total_data' => $totalData,
        'data_reg_boa' => $dataRegBoa
    ]);
}
}