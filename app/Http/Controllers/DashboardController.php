<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fkrtl;
use App\Models\Pelayanan;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
  
        $jumlah_rs = Fkrtl::count();
        $jumlah_pengajuan = Pelayanan::count();
        $jumlah_admin = User::count();
        $recent_pengajuan = Pelayanan::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('dashboard', [
        'jumlah_rs' => $jumlah_rs,
        'jumlah_pengajuan' => $jumlah_pengajuan,
        'jumlah_admin' => $jumlah_admin,
        'recent_pengajuan' => $recent_pengajuan,
    ]);
    }
}