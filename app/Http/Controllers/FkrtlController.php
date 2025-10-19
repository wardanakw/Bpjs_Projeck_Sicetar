<?php

namespace App\Http\Controllers;

use App\Models\Fkrtl;
use Illuminate\Http\Request;

class FkrtlController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->input('search');
        
        $fkrtl = Fkrtl::when($search, function ($query, $search) {
            return $query->where('nama_rumah_sakit', 'like', "%{$search}%")
                        ->orWhere('kode_rumah_sakit', 'like', "%{$search}%")
                        ->orWhere('id_fkrtl', 'like', "%{$search}%");
        })->orderBy('nama_rumah_sakit')->get();

        return view('menu_fkrtl', compact('fkrtl', 'search'));
    }
    public function create()
    {
        return view('fkrtl.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_fkrtl' => 'required|unique:fkrtl,id_fkrtl',
            'kode_rumah_sakit' => 'required',
            'nama_rumah_sakit' => 'required',
            'jenis' => 'required',
        ]);

        Fkrtl::create($request->only([
            'id_fkrtl',
            'kode_rumah_sakit',
            'nama_rumah_sakit',
            'jenis'
        ]));

        return redirect()->route('fkrtl.index')->with('success', 'Data FKRTL berhasil ditambahkan.');
    }

    public function edit($id_fkrtl)
    {
        $fkrtl = Fkrtl::findOrFail($id_fkrtl);
        return view('fkrtl.edit', compact('fkrtl'));
    }


    public function update(Request $request, $id_fkrtl)
    {
        $fkrtl = Fkrtl::findOrFail($id_fkrtl);

        $request->validate([
            'kode_rumah_sakit' => 'required',
            'nama_rumah_sakit' => 'required',
            'jenis' => 'required',
        ]);

        $fkrtl->update($request->only([
            'kode_rumah_sakit',
            'nama_rumah_sakit',
            'jenis'
        ]));

        return redirect()->route('fkrtl.index')->with('success', 'Data FKRTL berhasil diperbarui.');
    }

  public function destroy($id_fkrtl)
{
    try {
        $fkrtl = Fkrtl::where('id_fkrtl', $id_fkrtl)->first();

        if (!$fkrtl) {
            return redirect()->route('fkrtl.index')
                ->with('error', 'Data FKRTL tidak ditemukan');
        }

        $fkrtl->delete();

        return redirect()->route('fkrtl.index')
            ->with('success', 'Data FKRTL berhasil dihapus');
            
    } catch (\Exception $e) {
        return redirect()->route('fkrtl.index')
            ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}


}