<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        
        $jumlah_rs = 132;
        $jumlah_pengajuan = 2234;
        $jumlah_admin = 1;

        return view('Dashboard', compact('jumlah_rs', 'jumlah_pengajuan', 'jumlah_admin'));
    }
}
