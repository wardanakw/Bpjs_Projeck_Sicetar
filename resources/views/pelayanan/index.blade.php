@extends('layouts.app')

@section('title', 'Monitoring SLA')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Monitoring SLA</h3>
                <div class="d-flex gap-2">
                  
                    <!-- <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-sort"></i> Urutkan
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort_by' => 'max_tgl_bakb', 'sort_order' => 'asc']) }}">Tanggal Max BAKB (A-Z)</a></li>
                            <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort_by' => 'max_tgl_bahv', 'sort_order' => 'asc']) }}">Tanggal Max BAHV (A-Z)</a></li>
                            <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort_by' => 'tgl_jt', 'sort_order' => 'asc']) }}">Tanggal JT (A-Z)</a></li>
                        </ul>
                    </div> -->

                 
                    <!-- <a href="{{ request()->fullUrlWithQuery(['hide_completed' => request('hide_completed') == '1' ? '0' : '1']) }}" 
                       class="btn btn-{{ request('hide_completed') == '1' ? 'success' : 'outline-success' }}">
                        <i class="fas fa-{{ request('hide_completed') == '1' ? 'eye' : 'eye-slash' }}"></i>
                        {{ request('hide_completed') == '1' ? 'Tampilkan Semua' : 'Sembunyikan Selesai' }}
                    </a> -->

                </div>
            </div>
        </div>
    </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="slaTable">
                    <thead class="table-primary">
                        <tr>
                            <th>Nama FKRTL</th>
                            <th>Bulan Pelayanan</th>
                            <th>Jenis Pelayanan</th>
                            <th>Jumlah Kasus</th>
                            <th>Biaya</th>
                            <th>Tanggal BAST</th>
                            <th>No. BAST</th>
                            <th>Max Tanggal BAKB</th>
                            <th>Tanggal BAKB</th>
                            <th>No. BAKB</th>
                            <th>Max Tanggal BAHV</th>
                            <th>Tanggal BAHV</th>
                            <th>No. BAHV</th>
                            <th>Kasus HV</th>
                            <th>Biaya HV</th>
                            <th>UMK</th>
                            <th>Koreksi</th>
                            <th>Tanggal Reg BoA</th>
                            <th>Tanggal Jatuh Tempo</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pelayanan as $data)
                            <tr class="{{ $data->tgl_reg_boa ? 'table-success' : '' }}">
                                <td>{{ $data->nama_fkrtl }}</td>
                                <td>{{ $data->bulan_pelayanan ? date('M Y', strtotime($data->bulan_pelayanan)) : '' }}</td>
                                <td>{{ $data->jenis_pelayanan }}</td>
                                <td>{{ $data->jumlah_kasus }}</td>
                                <td>Rp. {{ number_format($data->biaya, 0, ',', '.') }}</td>
                                <td>{{ $data->tgl_bast_formatted }}</td>
                                <td>{{ $data->no_bast }}</td>
                                <td>{{ $data->max_tgl_bakb_formatted ?? '' }}</td>
                                <td>{{ $data->tgl_bakb_formatted }}</td>
                                <td>{{ $data->no_bakb }}</td>
                                <td>{{ $data->max_tgl_bahv_formatted ?? '' }}</td>
                                <td>{{ $data->tgl_bahv_formatted ?? '' }}</td>
                                <td>{{ $data->no_bahv }}</td>
                                <td>{{ $data->kasus_hv }}</td>
                                <td>Rp. {{ number_format($data->biaya_hv, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($data->umk, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($data->koreksi, 0, ',', '.') }}</td>
                                <td>
                                    @if($data->tgl_reg_boa)
                                        <span class="badge bg-success">{{ date('d-m-Y', strtotime($data->tgl_reg_boa)) }}</span>
                                    @else
                                        <span class="badge bg-warning">Belum Input</span>
                                    @endif
                                </td>
                                <td>{{ $data->tgl_jt_formatted ?? '' }}</td>
                                <td>
                                    @if(auth()->user()->role === 'admin')
                                    <div class="btn-group">
                                        <a href="{{ route('pelayanan.edit', $data->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                       <form action="{{ route('pelayanan.destroy', $data->id) }}" method="POST" class="d-inline form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger btn-delete">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </form>

                                    </div>
                                    @endif
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
</div>


<script>
    $(document).ready(function() {
        $('#slaTable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "emptyTable": "Tidak ada data yang ditemukan",
                "zeroRecords": "Tidak ada data yang ditemukan",
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ entri",
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                "infoEmpty": "Menampilkan 0 hingga 0 dari 0 entri",
                "infoFiltered": "(disaring dari _MAX_ total entri)",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });
    });
$('#slaTable').on('draw.dt', function () {
    let table = $('#slaTable').DataTable();
    if (table.data().count() === 0) {
        $('#slaTable tbody').html(`
            <tr>
                <td colspan="20" class="text-center">Tidak ada data yang ditemukan</td>
            </tr>
        `);
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const deleteForms = document.querySelectorAll('.form-delete');

    deleteForms.forEach(form => {
        form.querySelector('.btn-delete').addEventListener('click', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: "{{ session('success') }}",
            timer: 2000,
            showConfirmButton: false
        });
    @endif
});

</script>
@endsection