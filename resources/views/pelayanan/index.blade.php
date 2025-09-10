
@extends('layouts.app')

@section('title', 'Monitoring SLA')

@section('content')
    <h3 class="mt-5">Monitoring SLA</h3>

    {{-- Pesan sukses --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
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
                            <th>Memorial</th>
                            <th>Voucher</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pelayanan as $data)
                            <tr>
                                <td>{{ $data->nama_fkrtl }}</td>
                                <td>{{ $data->bulan_pelayanan }}</td>
                                <td>{{ $data->jenis_pelayanan }}</td>
                                <td>{{ $data->jumlah_kasus }}</td>
                                <td>Rp. {{ number_format($data->biaya, 0, ',', '.') }}</td>
                                <td>{{ $data->tgl_bast_formatted }}</td>
                                <td>{{ $data->no_bast }}</td>
                                <td>{{ $data->max_tgl_bakb }}</td>
                                <td>{{ $data->tgl_bakb_formatted }}</td>
                                <td>{{ $data->no_bakb }}</td>
                                <td>{{ $data->max_tgl_bahv }}</td>
                                <td>{{ $data->tgl_bahv }}</td>
                                <td>{{ $data->no_bahv }}</td>
                                <td>{{ $data->kasus_hv }}</td>
                                <td>Rp. {{ number_format($data->biaya_hv, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($data->umk, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($data->koreksi, 0, ',', '.') }}</td>
                                <td>{{ $data->tgl_reg_boa }}</td>
                                <td>{{ $data->tgl_jt }}</td>
                                <td>{{ $data->memorial }}</td>
                                <td>{{ $data->voucher }}</td>
                                <td>
                                    <a href="{{ route('pelayanan.edit', $data->id) }}" class="btn btn-sm btn-warning">
                                        ✏️
                                    </a>
                                    <form action="{{ route('pelayanan.destroy', $data->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')">
                                            🗑️
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="22">Data tidak tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            <!-- </div>
            <a href="{{ route('pelayanan.create') }}" class="btn btn-primary mt-3">+ Tambah Data</a>
        </div> -->
    </div>
@endsection
