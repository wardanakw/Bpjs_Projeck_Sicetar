<?php

namespace App\Http\Controllers;

use App\Models\Pelayanan;
use Illuminate\Http\Request;
use App\Exports\RekapExport;
use Maatwebsite\Excel\Facades\Excel;

class RekapController extends Controller
{
    public function index(Request $request)
{    

        $query = Pelayanan::query();
        
        if ($request->has('bulan') && $request->bulan != '') {
            $query->whereRaw('EXTRACT(MONTH FROM bulan_pelayanan::date) = ?', [$request->bulan]);
        }
        
        if ($request->has('tahun') && $request->tahun != '') {
            $query->whereRaw('EXTRACT(YEAR FROM bulan_pelayanan::date) = ?', [$request->tahun]);
        }
        
        if ($request->has('tgl_reg_boa') && $request->tgl_reg_boa != '') {
            $query->whereDate('tgl_reg_boa', $request->tgl_reg_boa);
        }
        
        $sortBy = $request->get('sort_by', 'bulan_pelayanan');
        $sortOrder = $request->get('sort_order', 'desc');
        
        $query->orderBy($sortBy, $sortOrder);
        
        $rekapData = $query->get();

        foreach ($rekapData as $item) {
            $item->bulan_pelayanan_formatted = $item->bulan_pelayanan ? date('F Y', strtotime($item->bulan_pelayanan)) : '';
            $item->tgl_bast_formatted = $item->tgl_bast ? date('d-m-Y', strtotime($item->tgl_bast)) : '';
            $item->tgl_bakb_formatted = $item->tgl_bakb ? date('d-m-Y', strtotime($item->tgl_bakb)) : '';
            $item->tgl_bahv_formatted = $item->tgl_bahv ? date('d-m-Y', strtotime($item->tgl_bahv)) : '';
            $item->tgl_reg_boa_formatted = $item->tgl_reg_boa ? date('d-m-Y', strtotime($item->tgl_reg_boa)) : '';
            $item->tgl_jt_formatted = $item->tgl_jt ? date('d-m-Y', strtotime($item->tgl_jt)) : '';
        }
        
        return view('rekap.index', compact('rekapData', 'request'));
    }
    
    public function export(Request $request)
    {
        $query = Pelayanan::query();

        if ($request->has('bulan') && $request->bulan != '') {
            $query->whereRaw('EXTRACT(MONTH FROM bulan_pelayanan::date) = ?', [$request->bulan]);
        }

        if ($request->has('tahun') && $request->tahun != '') {
            $query->whereRaw('EXTRACT(YEAR FROM bulan_pelayanan::date) = ?', [$request->tahun]);
        }

        if ($request->has('tgl_reg_boa') && $request->tgl_reg_boa != '') {
            $query->whereDate('tgl_reg_boa', $request->tgl_reg_boa);
        }

        $bulan = $request->get('bulan');
        $tahun = $request->get('tahun');
        $tgl_reg_boa = $request->get('tgl_reg_boa');
        
        $filename = $request->get('filename', 'rekap_register_klaim');
        $filename .= '.xlsx';

        return Excel::download(new RekapExport($bulan, $tahun, $tgl_reg_boa), $filename);
    }
 
public function edit($id)
{
  
    $pelayanan = Pelayanan::findOrFail($id);

   
    return view('rekap.edit', compact('pelayanan'));
}

public function update(Request $request, $id)
{
    $pelayanan = Pelayanan::findOrFail($id);


    if (auth()->user()->role === 'finance') {
        $rules = [
            'tgl_bayar' => 'required|date',
        ];
    } else {
        $rules = [
            'tgl_bayar' => 'nullable|date',
            'memorial' => 'nullable|string|max:255',
            'voucher'  => 'nullable|string|max:255',
        ];
    }

    $validated = $request->validate($rules);

    if ($request->has('tgl_bayar')) {
        $pelayanan->tgl_bayar = $request->tgl_bayar;
    }
    if ($request->has('memorial')) {
        $pelayanan->memorial = $validated['memorial'] ?? null;
    }
    if ($request->has('voucher')) {
        $pelayanan->voucher = $validated['voucher'] ?? null;
    }

    $pelayanan->save();

    return redirect()->route('rekap.index')->with('success', 'Data berhasil diperbarui.');
}
}
