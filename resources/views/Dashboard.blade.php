@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@push('styles')
<style>
.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-2px);
}

.bg-primary-dark {
    background-color: #0b5ed7 !important;
}

.bg-success-dark {
    background-color: #157347 !important;
}

.bg-warning-dark {
    background-color: #ffca2c !important;
}

.card-title {
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.badge {
    font-size: 0.8em;
}
</style>
@endpush
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mt-1">Dashboard Monitoring SLA</h1>
            
            <div class="row">
              
                <div class="col-md-4 mb-4">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-hospital fa-2x"></i>
                                </div>
                                <div>
                                    <h6 class="card-title text-white-50">Jumlah FKRTL</h6>
                                    <h2 class="mb-0">{{ $jumlah_rs }}</h2>
                                    <small>Total Rumah Sakit & Faskes</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-primary-dark d-flex justify-content-between">
                            <small>Update: {{ now()->format('d M Y') }}</small>
                            <a href="{{ route('fkrtl.index') }}" class="text-white">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-file-medical fa-2x"></i>
                                </div>
                                <div>
                                    <h6 class="card-title text-white-50">Jumlah Pengajuan</h6>
                                    <h2 class="mb-0">{{ $jumlah_pengajuan }}</h2>
                                    <small>Total Pengajuan Pelayanan</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-success-dark d-flex justify-content-between">
                            <small>Update: {{ now()->format('d M Y') }}</small>
                            <a href="{{ route('pelayanan.index') }}" class="text-white">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card bg-warning text-dark h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-users-cog fa-2x"></i>
                                </div>
                                <div>
                                    <h6 class="card-title text-dark-50">Jumlah Admin</h6>
                                    <h2 class="mb-0">{{ $jumlah_admin }}</h2>
                                    <small>Total Administrator Sistem</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-warning-dark d-flex justify-content-between">
                            <small>Update: {{ now()->format('d M Y') }}</small>
                            <a href="#" class="text-dark">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

         
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Pengajuan Terbaru</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>FKRTL</th>
                                            <th>Bulan</th>
                                            <th>Jenis Pelayanan</th>
                                            <th>Jumlah Kasus</th>
                                            <th>Biaya</th>
                                            <th>Tanggal Input</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recent_pengajuan as $pengajuan)
                                        <tr>
                                            <td>{{ $pengajuan->nama_fkrtl }}</td>
                                            <td>{{ date('M Y', strtotime($pengajuan->bulan_pelayanan)) }}</td>
                                            <td>
                                                <span class="badge bg-info">{{ $pengajuan->jenis_pelayanan }}</span>
                                            </td>
                                            <td>{{ $pengajuan->jumlah_kasus }}</td>
                                            <td>Rp {{ number_format($pengajuan->biaya, 0, ',', '.') }}</td>
                                            <td>{{ date('d M Y', strtotime($pengajuan->created_at)) }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Belum ada pengajuan</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

