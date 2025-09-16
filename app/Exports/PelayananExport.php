<?php

namespace App\Exports;

use App\Models\Pelayanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PelayananExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $bulan;
    protected $tahun;
    protected $hanyaRegBoa;

    public function __construct($bulan = null, $tahun = null, $hanyaRegBoa = false)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        $this->hanyaRegBoa = $hanyaRegBoa;
    }

    public function collection()
    {
        $query = Pelayanan::query();
    
        if ($this->hanyaRegBoa) {
            $query->whereNotNull('tgl_reg_boa');
        }
        
        if ($this->bulan && $this->tahun) {
            $query->whereYear('bulan_pelayanan', $this->tahun)
                  ->whereMonth('bulan_pelayanan', $this->bulan);
        }
        
        return $query->orderBy('bulan_pelayanan', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->get();
    }

    public function headings(): array
    {
        return [
            'Nama FKRTL',
            'Bulan Pelayanan',
            'Jenis Pelayanan',
            'Jumlah Kasus',
            'Biaya',
            'Tanggal BAST',
            'No BAST',
            'Max Tanggal BAKB',
            'Tanggal BAKB',
            'No BAKB',
            'Max Tanggal BAHV',
            'Tanggal BAHV',
            'No BAHV',
            'Kasus HV',
            'Biaya HV',
            'UMK',
            'Koreksi',
            'Tanggal Reg BoA',
            'Tanggal Jatuh Tempo',
            'Memorial',
            'Voucher',
            'Status',
            'Tanggal Dibuat'
        ];
    }

    public function map($pelayanan): array
    {
        
        $maxTglBakb = $pelayanan->tgl_bast ? date('d-m-Y', strtotime($pelayanan->tgl_bast . ' +9 days')) : '';
        $maxTglBahv = $pelayanan->tgl_bast ? date('d-m-Y', strtotime($maxTglBakb . ' +9 days')) : '';
        $tglJt = $pelayanan->tgl_bast ? date('d-m-Y', strtotime($maxTglBakb . ' +14 days')) : '';
  
        if ($pelayanan->tgl_bakb) {
            $maxTglBahv = date('d-m-Y', strtotime($pelayanan->tgl_bakb . ' +9 days'));
            $tglJt = date('d-m-Y', strtotime($pelayanan->tgl_bakb . ' +14 days'));
        }
        
        $status = $pelayanan->tgl_reg_boa ? 'SELESAI' : 'PROSES';

        return [
            $pelayanan->nama_fkrtl,
            $pelayanan->bulan_pelayanan ? date('F Y', strtotime($pelayanan->bulan_pelayanan)) : '',
            $pelayanan->jenis_pelayanan,
            $pelayanan->jumlah_kasus,
            'Rp ' . number_format($pelayanan->biaya, 0, ',', '.'),
            $pelayanan->tgl_bast ? date('d-m-Y', strtotime($pelayanan->tgl_bast)) : '',
            $pelayanan->no_bast,
            $maxTglBakb,
            $pelayanan->tgl_bakb ? date('d-m-Y', strtotime($pelayanan->tgl_bakb)) : '',
            $pelayanan->no_bakb,
            $maxTglBahv,
            $pelayanan->tgl_bahv ? date('d-m-Y', strtotime($pelayanan->tgl_bahv)) : '',
            $pelayanan->no_bahv,
            $pelayanan->kasus_hv,
            $pelayanan->biaya_hv ? 'Rp ' . number_format($pelayanan->biaya_hv, 0, ',', '.') : '',
            $pelayanan->umk ? 'Rp ' . number_format($pelayanan->umk, 0, ',', '.') : '',
            $pelayanan->koreksi ? 'Rp ' . number_format($pelayanan->koreksi, 0, ',', '.') : '',
            $pelayanan->tgl_reg_boa ? date('d-m-Y', strtotime($pelayanan->tgl_reg_boa)) : '',
            $pelayanan->tgl_jt ? date('d-m-Y', strtotime($pelayanan->tgl_jt)) : $tglJt,
            $pelayanan->memorial,
            $pelayanan->voucher,
            $status,
            $pelayanan->created_at ? date('d-m-Y H:i', strtotime($pelayanan->created_at)) : ''
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            
            1 => ['font' => ['bold' => true]],
            
            
            'A' => ['width' => 25],  
            'B' => ['width' => 15],  
            'C' => ['width' => 20],  
            'D' => ['width' => 12],  
            'E' => ['width' => 15],  
            'F' => ['width' => 15],  
            'G' => ['width' => 20],  
            'H' => ['width' => 15],  
            'I' => ['width' => 15],  
            'J' => ['width' => 20],  
            'K' => ['width' => 15],  
            'L' => ['width' => 15],  
            'M' => ['width' => 20],  
            'N' => ['width' => 12],  
            'O' => ['width' => 15],  
            'P' => ['width' => 15],  
            'Q' => ['width' => 15],  
            'R' => ['width' => 15],  
            'S' => ['width' => 15],  
            'T' => ['width' => 15],  
            'U' => ['width' => 15],  
            'V' => ['width' => 10],  
            'W' => ['width' => 18],  
        ];
    }
}