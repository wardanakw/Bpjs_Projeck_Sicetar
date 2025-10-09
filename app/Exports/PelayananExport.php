<?php

namespace App\Exports;

use App\Models\Pelayanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;


class PelayananExport implements FromCollection, WithHeadings, WithMapping
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
        
       
        if ($this->bulan && $this->tahun) {
            $startDate = Carbon::create($this->tahun, $this->bulan, 1)->startOfMonth();
            $endDate = Carbon::create($this->tahun, $this->bulan, 1)->endOfMonth();
            
            $query->whereBetween('tgl_bast', [$startDate, $endDate]);
        }
        
        
        if ($this->hanyaRegBoa) {
            $query->whereNotNull('tgl_reg_boa');
        }
        
        return $query->orderBy('tgl_bast')->get();
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
            'No. BAST',
            'Tanggal BAKB',
            'No. BAKB',
            'Tanggal BAHV',
            'No. BAHV',
            'Kasus HV',
            'Biaya HV',
            'Kasus Pending',
            'Biaya Pending',
            'Kasus Tidak Layak',
            'Biaya Tidak Layak',
            'Kasus Dispute',
            'Biaya Dispute',
            'UMK',
            'Koreksi',
            'Tanggal Reg BoA',
            'Tanggal Bayar',
            'Tanggal Jatuh Tempo',
            'Memorial',
            'Voucher'
        ];
    }

    public function map($pelayanan): array
    {
        return [
            $pelayanan->nama_fkrtl,
            $pelayanan->bulan_pelayanan ? Carbon::parse($pelayanan->bulan_pelayanan)->format('F Y') : '',
            $pelayanan->jenis_pelayanan,
            $pelayanan->jumlah_kasus,
            $pelayanan->biaya,
            $pelayanan->tgl_bast ? Carbon::parse($pelayanan->tgl_bast)->format('d-m-Y') : '',
            $pelayanan->no_bast,
            $pelayanan->tgl_bakb ? Carbon::parse($pelayanan->tgl_bakb)->format('d-m-Y') : '',
            $pelayanan->no_bakb,
            $pelayanan->tgl_bahv ? Carbon::parse($pelayanan->tgl_bahv)->format('d-m-Y') : '',
            $pelayanan->no_bahv,
            $pelayanan->kasus_hv,
            $pelayanan->biaya_hv,
            $pelayanan->kasus_pending,
            $pelayanan->biaya_pending,
            $pelayanan->kasus_tidak_layak,
            $pelayanan->biaya_tidak_layak,
            $pelayanan->kasus_dispute,
            $pelayanan->biaya_dispute,
            $pelayanan->umk,
            $pelayanan->koreksi,
            $pelayanan->tgl_reg_boa ? Carbon::parse($pelayanan->tgl_reg_boa)->format('d-m-Y') : '',
            $pelayanan->tgl_bayar ? Carbon::parse($pelayanan->tgl_bayar)->format('d-m-Y') : '',
            $pelayanan->tgl_jt ? Carbon::parse($pelayanan->tgl_jt)->format('d-m-Y') : '',
            $pelayanan->memorial,
            $pelayanan->voucher,
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