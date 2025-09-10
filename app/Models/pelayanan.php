<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelayanan extends Model
{
    use HasFactory;

    protected $table = 'pelayanan';

    protected $fillable = [
        'nama_fkrtl',
        'bulan_pelayanan',
        'jenis_pelayanan',
        'jumlah_kasus',
        'biaya',
        'tgl_bast',
        'no_bast',
        'max_tgl_bakb',
        'tgl_bakb',
        'no_bakb',
        'max_tgl_bahv',
        'tgl_bahv',
        'no_bahv',
        'kasus_hv',
        'biaya_hv',
        'umk',
        'koreksi',
        'tgl_reg_boa',
        'tgl_jt',
        'memorial',
        'voucher',
        'detail_pelyanan'
    ];
}
