<?php

namespace App\Exports;

use App\Models\Pelayanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RekapExport implements FromCollection, WithHeadings, WithMapping
{
    protected $bulan;
    protected $tahun;
    protected $no_bo;

    public function __construct($bulan = null, $tahun = null, $no_bo = null)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        $this->no_bo = $no_bo;
    }

    public function collection()
    {
        $query = Pelayanan::query();
        
        if ($this->bulan) {
            $query->whereRaw('EXTRACT(MONTH FROM bulan_pelayanan::date) = ?', [$this->bulan]);
        }
        
        if ($this->tahun) {
            $query->whereRaw('EXTRACT(YEAR FROM bulan_pelayanan::date) = ?', [$this->tahun]);
        }
        
        if ($this->no_bo) {
            $query->where('tgl_reg_boa', 'LIKE', '%' . $this->no_bo . '%');
        }
        
        return $query->orderBy('bulan_pelayanan', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'No. BO / Reg BoA',
            'Bulan Pelayanan',
            'FKRTL',
            'Jenis Pelayanan',
            'Jumlah Kasus',
            'Biaya',
            'Tanggal BAST',
            'Tanggal BAKB',
            'Tanggal BAHV',
            'Tanggal JT',
            'Status'
        ];
    }

    public function map($data): array
    {
        return [
            $data->tgl_reg_boa ? date('d-m-Y', strtotime($data->tgl_reg_boa)) : 'Belum Input',
            $data->bulan_pelayanan ? date('F Y', strtotime($data->bulan_pelayanan)) : '',
            $data->nama_fkrtl,
            $data->jenis_pelayanan,
            $data->jumlah_kasus,
            'Rp ' . number_format($data->biaya, 0, ',', '.'),
            $data->tgl_bast ? date('d-m-Y', strtotime($data->tgl_bast)) : '',
            $data->tgl_bakb ? date('d-m-Y', strtotime($data->tgl_bakb)) : '',
            $data->tgl_bahv ? date('d-m-Y', strtotime($data->tgl_bahv)) : '',
            $data->tgl_jt ? date('d-m-Y', strtotime($data->tgl_jt)) : '',
            $data->tgl_reg_boa ? 'Selesai' : 'Proses'
        ];
    }
}