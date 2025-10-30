@extends('layouts.app')

@section('title', 'Rekap Buku Register Klaim')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<style>
.badge { font-size: 0.85em; }

.card {
    border: none;
    border-radius: 15px;
    padding: 1rem;
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
}


.table-container {
    max-height: 500px;        
    overflow-y: auto;
    overflow-x: auto;
    position: relative;
}


.table {
    width: 100%;
    margin-bottom: 0;
    table-layout: auto;
}


.table thead th {
    position: sticky;
    top: 0;
    z-index: 20;
    background-color: #2e4a7d !important;
    color: #fff;
    font-weight: 600;
    box-shadow: 0 2px 2px -1px rgba(0,0,0,0.4);
}
</style>

<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3 class="mb-0">Rekap Buku Register Klaim</h3>
        </div>
        <div class="col-md-6 text-end">
            <input type="text" id="customSearch" class="form-control w-50 d-inline-block" placeholder="Cari data...">
        </div>
    </div>

      <div class="row g-4">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle" id="rekapTable">
                            <thead class="table-primary">
                                <tr>
                                    <th>Reg BoA</th>
                                    <th>Bulan Pelayanan</th>
                                    <th>Nama FKRTL</th>
                                    <th>Jenis Pelayanan</th>
                                    <th>Jumlah Kasus</th>
                                    <th>Biaya</th>
                                    <th>Tanggal BAST</th>
                                    <th>No. BAST</th>
                                    <th>Tanggal BAKB</th>
                                    <th>No. BAKB</th>
                                    <th>Tanggal BAHV</th>
                                    <th>No. BAHV</th>
                                    <th>Kasus HV</th>
                                    <th>Biaya HV</th>
                                    <th>Kasus Pending</th>
                                    <th>Biaya Pending</th>
                                    <th>Kasus TL</th>
                                    <th>Biaya TL</th>
                                    <th>Kasus Dispute</th>
                                    <th>Biaya Dispute</th>
                                    <th>UMK</th>
                                    <th>Koreksi</th>
                                    <th>Total Bayar</th>
                                    <th>Tanggal Jatuh Tempo</th>
                                    <th>No reg BoA</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Status</th>
                                    <th>Memorial</th>
                                    <th>Voucher</th>
                                    <th style="width: 60px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($rekapData as $data)
                                <tr>
                                    <td>
                                        @if($data->tgl_reg_boa)
                                            <span class="badge bg-info">{{ $data->tgl_reg_boa_formatted }}</span>
                                        @else
                                            <span class="badge bg-warning">Belum Input</span>
                                        @endif
                                    </td>
                                    <td>{{ $data->bulan_pelayanan_formatted }}</td>
                                    <td>{{ $data->nama_fkrtl }}</td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $data->jenis_pelayanan }}</span>
                                    </td>
                                    <td class="text-center">{{ $data->jumlah_kasus }}</td>
                                    <td class="text-end">Rp {{ number_format($data->biaya, 0, ',', '.') }}</td>
                                    <td>{{ $data->tgl_bast_formatted }}</td>
                                    <td>{{ $data->no_bast }}</td>
                                    <td>{{ $data->tgl_bakb_formatted }}</td>
                                    <td>{{ $data->no_bakb }}</td>
                                    <td>{{ $data->tgl_bahv_formatted }}</td>
                                    <td>{{ $data->no_bahv }}</td>
                                    <td>{{ $data->kasus_hv }}</td>
                                    <td>Rp. {{ number_format($data->biaya_hv, 0, ',', '.') }}</td>
                                    <td>{{ $data->kasus_pending }}</td>
                                    <td>Rp. {{ number_format($data->biaya_pending, 0, ',', '.') }}</td>
                                    <td>{{ $data->kasus_tidak_layak }}</td>
                                    <td>Rp. {{ number_format($data->biaya_tidak_layak, 0, ',', '.') }}</td>
                                    <td>{{ $data->kasus_dispute }}</td>
                                    <td>Rp. {{ number_format($data->biaya_dispute, 0, ',', '.') }}</td>
                                    <td>Rp. {{ number_format($data->umk, 0, ',', '.') }}</td>
                                    <td>Rp. {{ number_format($data->koreksi, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($data->total_pembayaran, 0, ',', '.') }}</td>
                                    <td>{{ $data->tgl_jt_formatted }}</td>
                                    <td>{{ $data->no_reg_boa ?? '-' }}</td>
                                    <td>
                                    {{ $data->tgl_bayar ? date('d-m-Y', strtotime($data->tgl_bayar)) : '-' }}
                                </td>
                                    <td>
                                        @if($data->tgl_reg_boa)
                                            <span class="badge bg-success">Selesai</span>
                                        @else
                                            <span class="badge bg-warning">Proses</span>
                                        @endif
                                    </td>
                                       <td>{{ $data->memorial }}</td>
                                <td>{{ $data->voucher }}</td>
                                <td>
                                    <a href="{{ route('rekap.edit', $data->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </td>
                                </tr>
                               @empty
                                    <tr class="text-center table-light">
                                        @for ($i = 0; $i < 20; $i++)
                                            <td class="{{ $i === 0 ? '' : 'd-none' }}" colspan="{{ $i === 0 ? 20 : '' }}">
                                                @if ($i === 0)
                                                    <div class="py-3 text-muted fw-semibold">
                                                        Tidak ada data yang ditemukan
                                                    </div>
                                                @endif
                                            </td>
                                        @endfor
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-light text-center p-3">
                <h6>Total Data</h6>
                <h3>{{ $rekapData->count() }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white text-center p-3">
                <h6>Selesai</h6>
                <h3>{{ $rekapData->where('tgl_reg_boa','!=',null)->count() }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-center p-3">
                <h6>Dalam Proses</h6>
                <h3>{{ $rekapData->where('tgl_reg_boa',null)->count() }}</h3>
            </div>
        </div>
    </div>
</div>

<script>
    $.fn.dataTable.ext.errMode = 'none';

$(document).ready(function () {
    const table = $('#rekapTable').DataTable({
    paging: true,
    lengthChange: true,   
    pageLength: 10,       
    searching: true,
    ordering: true,
    info: true,
    autoWidth: false,
    responsive: true,
    dom: 'lftip',        
    language: {
        emptyTable: "Tidak ada data yang ditemukan",
        zeroRecords: "Tidak ada data yang cocok",
        search: "Cari:",
        lengthMenu: "Tampilkan _MENU_ data per halaman",
        info: "Menampilkan _START_–_END_ dari _TOTAL_ data",
        infoEmpty: "Menampilkan 0 dari 0 data",
        paginate: {
            first: "Pertama", last: "Terakhir", next: "Selanjutnya", previous: "Sebelumnya"
        }
    }
});


    $('#customSearch').on('keyup', function () {
        table.search(this.value).draw();
    });
});
$('#rekapTable').on('draw.dt', function () {
    let table = $('#rekapTable').DataTable();
    if (table.data().count() === 0) {
        $('#rekapTable tbody').html(`
            <tr>
                <td colspan="20" class="text-center">Tidak ada data yang ditemukan</td>
            </tr>
        `);
    }
});

</script>
@endsection