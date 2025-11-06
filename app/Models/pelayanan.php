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
        'total_pembayaran', 
        'no_reg_boa',       
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
        'tgl_bayar',
        'memorial_pdf',
        'voucher_pdf',
        'detail_pelyanan',
        'kasus_pending',
        'biaya_pending',
        'kasus_tidak_layak', 
        'biaya_tidak_layak',
        'kasus_dispute',
        'biaya_dispute',
    ];

   
    public function getTotalPembayaranAttribute()
    {
        $biayaHv = $this->biaya_hv ?? $this->biaya ?? 0;
        $pending = $this->biaya_pending ?? 0;
        $tdkLayak = $this->biaya_tidak_layak ?? 0;
        $dispute = $this->biaya_dispute ?? 0;
        $umk = $this->umk ?? 0;
        $koreksi = $this->koreksi ?? 0;

        return $biayaHv - ($pending + $tdkLayak + $dispute + $umk + $koreksi);
    }
}
