@extends('layouts.app')

@section('title', 'Export SLA')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Export Data Pelayanan</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('export.process') }}" method="GET">
                @csrf
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="bulan" class="form-label">Bulan Beban</label>
                        <select class="form-select" id="bulan" name="bulan" required>
                            <option value="">Pilih Bulan</option>
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ old('bulan') == $i ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="tahun" class="form-label">Tahun Beban</label>
                        <select class="form-select" id="tahun" name="tahun" required>
                            <option value="">Pilih Tahun</option>
                            @php
                                $currentYear = date('Y');
                                $startYear = $currentYear - 5; 
                            @endphp

                            @for($i = $startYear; $i <= $currentYear; $i++)
                                <option value="{{ $i }}" {{ old('tahun') == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="jt_dari" class="form-label">Jatuh Tempo Dari</label>
                        <input type="date" class="form-control" id="jt_dari" name="jt_dari" value="{{ old('jt_dari') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="jt_sampai" class="form-label">Jatuh Tempo Sampai</label>
                        <input type="date" class="form-control" id="jt_sampai" name="jt_sampai" value="{{ old('jt_sampai') }}">
                    </div>
                </div>
        
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="hanya_reg_boa" name="hanya_reg_boa" value="1">
                        <label class="form-check-label" for="hanya_reg_boa">
                            Hanya data yang sudah Reg BOA
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="filename" class="form-label">Nama File (opsional)</label>
                    <input type="text" class="form-control" id="filename" name="filename" 
                           placeholder="Masukan Nama File">
                    <small class="form-text text-muted">Biarkan kosong untuk nama file otomatis</small>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-download"></i> Export Excel
                </button>
            </form>

            {{-- Tempat tampilkan info data --}}
            <div id="data-info" class="mt-4 text-secondary"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const bulanSelect = document.getElementById('bulan');
    const tahunSelect = document.getElementById('tahun');
    const dataInfo = document.getElementById('data-info');

    function updateDataInfo() {
        const bulan = bulanSelect.value;
        const tahun = tahunSelect.value;

        if (bulan && tahun) {
            fetch(`/export/data-info?bulan=${bulan}&tahun=${tahun}`)
                .then(response => response.json())
                .then(data => {
                    dataInfo.innerHTML = `
                        <p><strong>Bulan BAST:</strong> ${data.nama_bulan} ${tahun}</p>
                        <p><strong>Total Data:</strong> ${data.total_data} records</p>
                        <p><strong>Data dengan Reg BOA:</strong> ${data.data_reg_boa} records</p>
                        <p><strong>Data tanpa Reg BOA:</strong> ${data.total_data - data.data_reg_boa} records</p>
                    `;
                });
        } else {
            dataInfo.innerHTML = '<p class="text-muted">Pilih bulan dan tahun untuk melihat informasi data</p>';
        }
    }

    bulanSelect.addEventListener('change', updateDataInfo);
    tahunSelect.addEventListener('change', updateDataInfo);
});
</script>
@endsection
