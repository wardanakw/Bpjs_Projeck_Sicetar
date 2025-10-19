@extends('layouts.app')

@section('title', 'Tambah FKRTL')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm" style="max-width: 700px; margin: 0 auto;">
        <div class="card-header bg-primary text-white py-2">
            <h5 class="mb-0 text-center">Tambah Data FKRTL</h5>
        </div>
        <div class="card-body p-3">
            <form action="{{ route('fkrtl.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label class="form-label small fw-semibold">ID FKRTL</label>
                        <input type="text" name="id_fkrtl" class="form-control form-control-sm" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label small fw-semibold">Kode Rumah Sakit</label>
                        <input type="text" name="kode_rumah_sakit" placeholder="Masukan Kode RS034 dan seterusnya" class="form-control form-control-sm" required>
                    </div>
                </div>
                <div class="mb-2">
                    <label class="form-label small fw-semibold">Nama Rumah Sakit</label>
                    <input type="text" name="nama_rumah_sakit" class="form-control form-control-sm" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Jenis</label>
                    <select name="jenis" class="form-select form-select-sm" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="RUMAH_SAKIT">RUMAH SAKIT</option>
                        <option value="KLINIK_UTAMA">KLINIK UTAMA</option>
                        <option value="APOTEK">APOTEK</option>
                        <option value="OPTIK">OPTIK</option>
                        <option value="INSTALASI_FARMASI">INSTALASI FARMASI</option>
                    </select>
                </div>
                <div class="d-flex gap-2 justify-content-end">
                    <a href="{{ route('fkrtl.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 10px;
        border: none;
    }
    
    .card-header {
        border-radius: 10px 10px 0 0 !important;
        background: #e9f2ff !important;
        color: #222 !important;
        font-weight: 600;
    }
    
    .form-control-sm, .form-select-sm {
        padding: 0.4rem 0.6rem;
        font-size: 0.875rem;
        border-radius: 6px;
    }
    
    .btn-sm {
        padding: 0.4rem 0.8rem;
        font-size: 0.875rem;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }
    
    .form-label {
        margin-bottom: 0.3rem;
    }
</style>
@endsection