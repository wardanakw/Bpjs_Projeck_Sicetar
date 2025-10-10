<?php

namespace App\Http\Controllers;

use App\Models\Pelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KoreksiSlaController extends Controller
{

    public function index(Request $request)
    {
        
        $query = Pelayanan::query();
        $query->whereNotNull('koreksi')
              ->where('koreksi', '>', 0);

      
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        
        if (in_array($sortBy, ['max_tgl_bakb', 'max_tgl_bahv', 'tgl_jt', 'tgl_bayar', 'tgl_reg_boa'])) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderBy('created_at', $sortOrder);
        }
        
        $pelayanan = $query->get();

        foreach ($pelayanan as $item) {
            $item->tgl_bast_formatted = $item->tgl_bast ? date('d-m-Y', strtotime($item->tgl_bast)) : null;
            $item->tgl_bakb_formatted = $item->tgl_bakb ? date('d-m-Y', strtotime($item->tgl_bakb)) : null;
            $item->tgl_bahv_formatted = $item->tgl_bahv ? date('d-m-Y', strtotime($item->tgl_bahv)) : null;
            $item->max_tgl_bakb_formatted = $item->max_tgl_bakb ? date('d-m-Y', strtotime($item->max_tgl_bakb)) : null;
            $item->max_tgl_bahv_formatted = $item->max_tgl_bahv ? date('d-m-Y', strtotime($item->max_tgl_bahv)) : null;
            $item->tgl_jt_formatted = $item->tgl_jt ? date('d-m-Y', strtotime($item->tgl_jt)) : null;
        }

        return view('koreksi.index', compact('pelayanan', 'sortBy', 'sortOrder'));
    }

    
    public function edit($id)
{
       if (!in_array(Auth::user()->role, ['admin', 'keuangan', 'finance'])) {
        return redirect()->route('koreksi.index')
            ->with('error', 'Anda tidak memiliki akses untuk edit penuh.');
    }

    $pelayanan = Pelayanan::findOrFail($id);

    $pelayanan->tgl_reg_boa_formatted = $pelayanan->tgl_reg_boa ? date('Y-m-d', strtotime($pelayanan->tgl_reg_boa)) : null;
    $pelayanan->tgl_bayar_formatted = $pelayanan->tgl_bayar ? date('Y-m-d', strtotime($pelayanan->tgl_bayar)) : null;

    return view('koreksi.edit', compact('pelayanan'));
}


    
    public function update(Request $request, $id)
    {

        if (!in_array(Auth::user()->role, ['admin', 'keuangan', 'finance'])) {
            return redirect()->route('koreksi.index')
                ->with('error', 'Anda tidak memiliki akses untuk update penuh.');
        }

        $request->validate([
            'koreksi' => 'required|numeric|min:0',
            'tgl_reg_boa' => 'nullable|date',
            'tgl_bayar' => 'nullable|date',
            'memorial' => 'nullable|string|max:255',
            'voucher' => 'nullable|string|max:255',
        ]);

        $pelayanan = Pelayanan::findOrFail($id);
                
        $pelayanan->update([
            'koreksi' => $request->koreksi,
            'tgl_reg_boa' => $request->tgl_reg_boa,
            'tgl_bayar' => $request->tgl_bayar,
            'memorial' => $request->memorial,
            'voucher' => $request->voucher,
        ]);

        return redirect()->route('koreksi.index')
            ->with('success', 'Data koreksi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

         if (auth()->user()->role !== 'admin') {
        abort(403, 'Akses ditolak. Hanya admin yang boleh menghapus data.');
    }

    $pelayanan = Pelayanan::findOrFail($id);
    $pelayanan->delete();
        
        $pelayanan->update([
            'koreksi' => 0,
            'tgl_reg_boa' => null,
            'tgl_bayar' => null,
        ]);

        return redirect()->route('koreksi.index')
            ->with('success', 'Data berhasil dikembalikan ke monitoring SLA.');
    }

    
    // public function tambahBayar($id)
    // {
     
    //     if (!in_array(Auth::user()->role, ['admin', 'finance'])) {
    //         return redirect()->route('koreksi-sla.index')
    //             ->with('error', 'Anda tidak memiliki akses untuk menambah tanggal bayar.');
    //     }

    //     $pelayanan = Pelayanan::findOrFail($id);
    //     return view('koreksi-sla.tambah-bayar', compact('pelayanan'));
    // }

    // public function simpanBayar(Request $request, $id)
    // {
    //     // Hanya finance yang bisa simpan tanggal bayar
    //     if (!in_array(Auth::user()->role, ['admin', 'finance'])) {
    //         return redirect()->route('koreksi-sla.index')
    //             ->with('error', 'Anda tidak memiliki akses untuk menyimpan tanggal bayar.');
    //     }

    //     $request->validate([
    //         'tgl_bayar' => 'required|date',
    //     ]);

    //     $pelayanan = Pelayanan::findOrFail($id);
    //     $pelayanan->update([
    //         'tgl_bayar' => $request->tgl_bayar,
    //     ]);

    //     return redirect()->route('koreksi-sla.index')
    //         ->with('success', 'Tanggal bayar berhasil ditambahkan.');
    // }

}