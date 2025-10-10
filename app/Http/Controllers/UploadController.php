<?php

namespace App\Http\Controllers;

use App\Models\Pelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{

  public function uploadMemorial(Request $request, $id)
{
    try {
        $request->validate([
            'memorial_pdf' => 'required|file|mimes:pdf|max:5120',
        ]);

        $pelayanan = Pelayanan::findOrFail($id);

    
        if ($pelayanan->memorial_pdf && Storage::disk('public')->exists($pelayanan->memorial_pdf)) {
            Storage::disk('public')->delete($pelayanan->memorial_pdf);
        }

        $memorialPath = $request->file('memorial_pdf')->store('memorial', 'public');
        $pelayanan->memorial_pdf = $memorialPath;
        $pelayanan->save();

        return response()->json([
            'success' => true,
            'message' => 'File memorial berhasil diupload.',
            'file_path' => Storage::url($memorialPath),
            'file_name' => basename($memorialPath)
        ]);
    } catch (\Exception $e) {

        \Log::error('Upload memorial gagal: '.$e->getMessage(), [
            'trace' => $e->getTraceAsString()
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Upload gagal: '.$e->getMessage()
        ], 500);
    }
}

    public function uploadVoucher(Request $request, $id)
    {
        $request->validate([
            'voucher_pdf' => 'required|file|mimes:pdf|max:5120',
        ]);

        $pelayanan = Pelayanan::findOrFail($id);
        
        if ($pelayanan->voucher_pdf && Storage::disk('public')->exists($pelayanan->voucher_pdf)) {
            Storage::disk('public')->delete($pelayanan->voucher_pdf);
        }
        
        $voucherPath = $request->file('voucher_pdf')->store('voucher', 'public');
        $pelayanan->voucher_pdf = $voucherPath;
        $pelayanan->save();

        return response()->json([
            'success' => true,
            'message' => 'File voucher berhasil diupload.',
            'file_path' => Storage::url($voucherPath),
            'file_name' => basename($voucherPath)
        ]);
    }


    public function downloadMemorial($id)
    {
        $pelayanan = Pelayanan::findOrFail($id);
        
        if (!$pelayanan->memorial_pdf || !Storage::disk('public')->exists($pelayanan->memorial_pdf)) {
            return redirect()->back()->with('error', 'File memorial tidak ditemukan.');
        }
        
        return Storage::disk('public')->download($pelayanan->memorial_pdf, 'memorial_' . $pelayanan->id . '.pdf');
    }


    public function downloadVoucher($id)
    {
        $pelayanan = Pelayanan::findOrFail($id);
        
        if (!$pelayanan->voucher_pdf || !Storage::disk('public')->exists($pelayanan->voucher_pdf)) {
            return redirect()->back()->with('error', 'File voucher tidak ditemukan.');
        }
        
        return Storage::disk('public')->download($pelayanan->voucher_pdf, 'voucher_' . $pelayanan->id . '.pdf');
    }

    public function deleteMemorial($id)
    {
        $pelayanan = Pelayanan::findOrFail($id);
        
        if ($pelayanan->memorial_pdf && Storage::disk('public')->exists($pelayanan->memorial_pdf)) {
            Storage::disk('public')->delete($pelayanan->memorial_pdf);
            $pelayanan->memorial_pdf = null;
            $pelayanan->save();
            
            return response()->json([
                'success' => true,
                'message' => 'File memorial berhasil dihapus.'
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'File memorial tidak ditemukan.'
        ], 404);
    }

    public function deleteVoucher($id)
    {
        $pelayanan = Pelayanan::findOrFail($id);
        
        if ($pelayanan->voucher_pdf && Storage::disk('public')->exists($pelayanan->voucher_pdf)) {
            Storage::disk('public')->delete($pelayanan->voucher_pdf);
            $pelayanan->voucher_pdf = null;
            $pelayanan->save();
            
            return response()->json([
                'success' => true,
                'message' => 'File voucher berhasil dihapus.'
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'File voucher tidak ditemukan.'
        ], 404);
    }

    public function getFileStatus($id)
    {
        $pelayanan = Pelayanan::findOrFail($id);
        
        return response()->json([
            'memorial_pdf' => $pelayanan->memorial_pdf ? [
                'exists' => Storage::disk('public')->exists($pelayanan->memorial_pdf),
                'url' => Storage::url($pelayanan->memorial_pdf),
                'name' => basename($pelayanan->memorial_pdf)
            ] : null,
            'voucher_pdf' => $pelayanan->voucher_pdf ? [
                'exists' => Storage::disk('public')->exists($pelayanan->voucher_pdf),
                'url' => Storage::url($pelayanan->voucher_pdf),
                'name' => basename($pelayanan->voucher_pdf)
            ] : null
        ]);
    }
}