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

        $jumlah_pengajuan = \App\Models\Pelayanan::whereNull('tgl_reg_boa')
            ->where(function($q) {
                $q->whereNull('koreksi')
                  ->orWhere('koreksi', 0);
            })
            ->count();
            
        $jumlah_admin = User::count();
        $recent_pengajuan = Pelayanan::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('Dashboard', compact(
            'jumlah_rs',
            'jumlah_pengajuan',
            'jumlah_admin',
            'recent_pengajuan'
        ));
    }
}