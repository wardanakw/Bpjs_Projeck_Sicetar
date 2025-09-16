@extends('layouts.app')

@section('title', 'Rekap Buku Register Klaim')

@section('content')


<style>
.badge {
    font-size: 0.85em;
}
.table th {
    background-color: #2e4a7d;
    color: white;
    font-weight: 600;
}
.table thead th{
    position : sticky;
    top: 0;
    background-color: #2e4a7d;
    color: white;
    z-index: 2;
    
}
.card {
    border: none;
    border-radius: 10px;
}
.card-header {
    border-radius: 10px 10px 0 0;
}
.table-responsive {
    max-height: 400px; 
    overflow-y: auto;
    positition: relative;
}
.table-responsive table{
    margin-bottom: 0;
}
</style>
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Rekap Buku Register Klaim</h3>
                
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12 col-lg-4">
            <div class="card shadow h-100">
                <div class="card-header bg-primary text-white rounded-top">
                    <h6 class="mb-0">Filter Data</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('rekap.index') }}" method="GET">
                        <div class="row g-2">
                            <div class="col-12">
                                <label for="bulan" class="form-label">Bulan</label>
                                <select class="form-select" id="bulan" name="bulan">
                                    <option value="">Semua Bulan</option>
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                            {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="tahun" class="form-label">Tahun</label>
                                {{-- Dropdown Tahun --}}
<select class="form-select" id="tahun" name="tahun">
    <option value="">Semua Tahun</option>
    @for($i = date('Y'); $i >= 2023; $i--)
        <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>
            {{ $i }}
        </option>
    @endfor
</select>
                            </div>
                            <div class="col-12">
                                <label for="no_bo" class="form-label">Reg BoA</label>
                                <input type="text" class="form-control" id="no_bo" name="no_bo" 
                                       value="{{ request('no_bo') }}" placeholder="Cari Tanggal BoA...">
                            </div>
                            <div class="col-12">
                                <label for="tgl_reg_boa" class="form-label">Tanggal BoA</label>
                                <input type="date" class="form-control" id="tgl_reg_boa" name="tgl_reg_boa"
                                       value="{{ request('tgl_reg_boa') }}" placeholder="Pilih Tanggal BoA...">
                            </div>
                            <div class="col-12">
                                <label for="sort_by" class="form-label">Urutkan Berdasarkan</label>
                                <select class="form-select" id="sort_by" name="sort_by">
                                    <option value="bulan_pelayanan" {{ request('sort_by') == 'bulan_pelayanan' ? 'selected' : '' }}>Bulan Pelayanan</option>
                                    <option value="tgl_reg_boa" {{ request('sort_by') == 'tgl_reg_boa' ? 'selected' : '' }}>Tanggal Reg BoA</option>
                                    <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Tanggal Input</option>
                                    <option value="nama_fkrtl" {{ request('sort_by') == 'nama_fkrtl' ? 'selected' : '' }}>Nama FKRTL</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex gap-2 mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-filter"></i> Terapkan Filter
                            </button>
                            <a href="{{ route('rekap.index') }}" class="btn btn-secondary">
                                <i class="fas fa-sync"></i> Reset Filter
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
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
                            <th>UMK</th>
                            <th>Koreksi</th>
                            <th>Tanggal Jatuh Tempo</th>
                            <th>Status</th>
                            <th>Memorial</th>
                            <th>Voucher</th>
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
                                <td>Rp. {{ number_format($data->umk, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($data->koreksi, 0, ',', '.') }}</td>
                                    <td>{{ $data->tgl_jt_formatted }}</td>
                                    <td>
                                        @if($data->tgl_reg_boa)
                                            <span class="badge bg-success">Selesai</span>
                                        @else
                                            <span class="badge bg-warning">Proses</span>
                                        @endif
                                    </td>
                                       <td>{{ $data->memorial }}</td>
                                <td>{{ $data->voucher }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="11" class="text-center">Tidak ada data yang ditemukan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($rekapData->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $rekapData->appends(request()->query())->links() }}
                    </div>
                    @endif
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-4">
                    <div class="card bg-light h-100">
                        <div class="card-body text-center">
                            <h6 class="mb-2">Total Data</h6>
                            <h3 class="mb-0">{{ $rekapData->total() }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body text-center">
                            <h6 class="mb-2">Selesai</h6>
                            <h3 class="mb-0">{{ $rekapData->where('tgl_reg_boa', '!=', null)->count() }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-warning h-100">
                        <div class="card-body text-center">
                            <h6 class="mb-2">Dalam Proses</h6>
                            <h3 class="mb-0">{{ $rekapData->where('tgl_reg_boa', null)->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function exportRekap() {
    const params = new URLSearchParams(window.location.search);
    window.location.href = '{{ route("rekap.export") }}?' + params.toString();
}
</script>
@endpush

