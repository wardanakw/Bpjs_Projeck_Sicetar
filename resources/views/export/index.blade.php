@extends('layouts.app')

@section('title', 'Export SLA')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Export Data SLA</h3>
                <a href="{{ route('pelayanan.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Monitoring
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Export Semua Data -->
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Export Semua Data</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('export.process') }}" method="GET">
                        <input type="hidden" name="hanya_reg_boa" value="0">
                        
                        <div class="mb-3">
                            <label for="filename" class="form-label">Nama File Export</label>
                            <input type="text" class="form-control" id="filename" name="filename" placeholder="Masukan Nama File">
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <label for="tahun" class="form-label">Tahun</label>
                                <select class="form-select" id="tahun" name="tahun">
                                    <option value="">Semua Tahun</option>
                                    @for($i = date('Y'); $i >= 2025; $i--)
                                        <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100 mt-3">
                            <i class="fas fa-download"></i> Export Semua Data
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Export Data Selesai -->
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Export Data Selesai (Sudah Reg BoA)</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('export.process') }}" method="GET">
                        <input type="hidden" name="hanya_reg_boa" value="1">

                        <div class="mb-3">
                            <label for="filename_selesai" class="form-label">Nama File Export</label>
                            <input type="text" class="form-control" id="filename_selesai" name="filename" placeholder="Masukan Nama File">
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="bulan_selesai" class="form-label">Bulan</label>
                                <select class="form-select" id="bulan_selesai" name="bulan">
                                    <option value="">Semua Bulan</option>
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                            {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="tahun_selesai" class="form-label">Tahun</label>
                                <select class="form-select" id="tahun_selesai" name="tahun">
                                    <option value="">Semua Tahun</option>
                                    @for($i = date('Y'); $i >= 2025; $i--)
                                        <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100 mt-3">
                            <i class="fas fa-download"></i> Export Data Selesai
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Preview Data -->
    @if(isset($previewData) && $previewData->count() > 0)
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Preview Data yang Akan Diexport</h5>
                    <small>Menampilkan {{ $previewData->count() }} data</small>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Nama FKRTL</th>
                                    <th>Bulan</th>
                                    <th>Jenis</th>
                                    <th>Kasus</th>
                                    <th>Biaya</th>
                                    <th>Reg BoA</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($previewData as $data)
                                <tr>
                                    <td>{{ $data->nama_fkrtl }}</td>
                                    <td>{{ date('M Y', strtotime($data->bulan_pelayanan)) }}</td>
                                    <td>{{ $data->jenis_pelayanan }}</td>
                                    <td>{{ $data->jumlah_kasus }}</td>
                                    <td>Rp {{ number_format($data->biaya, 0, ',', '.') }}</td>
                                    <td>
                                        @if($data->tgl_reg_boa)
                                            <span class="badge bg-success">{{ date('d-m-Y', strtotime($data->tgl_reg_boa)) }}</span>
                                        @else
                                            <span class="badge bg-warning">Belum</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $data->tgl_reg_boa ? 'success' : 'warning' }}">
                                            {{ $data->tgl_reg_boa ? 'SELESAI' : 'PROSES' }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection