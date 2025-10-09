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
}