@extends('layouts.app')

@section('title', 'Tambah Data Pelayanan')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4 text-center">Tambah Data Pelayanan</h3>

    {{-- Validasi error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada kesalahan pada input data:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form tambah data --}}
    <div class="d-flex justify-content-center">
        <div class="card shadow col-md-8 col-lg-6">
            <div class="card-body">
                <form action="{{ route('pelayanan.store') }}" method="POST" enctype="multipart/form-data">
                     @csrf

                    {{-- Info FKRTL Terpilih (jika datang dari menu FKRTL) --}}
                    @if(isset($selectedFkrtl) && $selectedFkrtl)
                        <div class="alert alert-info mb-4">
                            <strong>FKRTL Terpilih:</strong><br>
                            <strong>Nama:</strong> {{ $selectedFkrtl->nama_rumah_sakit }}<br>
                            <strong>Kode RS:</strong> {{ $selectedFkrtl->kode_rumah_sakit }}<br>
                            <strong>ID FKRTL:</strong> {{ $selectedFkrtl->id_fkrtl }}<br>
                            <strong>Jenis:</strong> {{ $selectedFkrtl->jenis }}
                        </div>
                        
                        {{-- Hidden field untuk menyimpan data FKRTL --}}
                        <input type="hidden" name="nama_fkrtl" value="{{ $selectedFkrtl->nama_rumah_sakit }}">
                        <input type="hidden" name="kode_rumah_sakit" value="{{ $selectedFkrtl->kode_rumah_sakit }}">
                        <input type="hidden" name="id_fkrtl" value="{{ $selectedFkrtl->id_fkrtl }}">
                        
                    @else
                        {{-- Nama FKRTL (jika manual input) --}}
                        <div class="mb-3">
                            <label for="nama_fkrtl" class="form-label">Pilih FKRTL</label>
                            <select name="nama_fkrtl" id="nama_fkrtl" class="form-select" required>
                                <option value="">-- Pilih Faskes --</option>
                                @foreach($fkrtlList as $fkrtl)
                                    <option value="{{ $fkrtl->nama_rumah_sakit }}" 
                                        data-kode="{{ $fkrtl->kode_rumah_sakit }}"
                                        data-idfkrtl="{{ $fkrtl->id_fkrtl }}">
                                        {{ $fkrtl->nama_rumah_sakit }} ({{ $fkrtl->kode_rumah_sakit }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        {{-- Hidden fields untuk kode rumah sakit dan ID FKRTL --}}
                        <input type="hidden" name="kode_rumah_sakit" id="kode_rumah_sakit">
                        <input type="hidden" name="id_fkrtl" id="id_fkrtl">
                    @endif

                    {{-- Bulan Pelayanan --}}
                    <div class="mb-3">
                        <label for="bulan_pelayanan" class="form-label">Bulan Pelayanan</label>
                        <input type="month" name="bulan_pelayanan" id="bulan_pelayanan" class="form-control" required>
                    </div>

                    {{-- Jenis Pelayanan dengan Sub-menu Alat Kesehatan --}}
                    <div class="mb-3">
                        <label for="jenis_pelayanan" class="form-label">Jenis Pelayanan</label>
                        <select class="form-select" id="jenis_pelayanan" name="jenis_pelayanan" required onchange="toggleAlatKesehatan()">
                            <option value="">-- Pilih Jenis Pelayanan --</option>
                            <option value="RJTL">RJTL (Rawat Jalan Tingkat Lanjutan)</option>
                            <option value="RITL">RITL (Rawat Inap Tingkat Lanjutan)</option>
                            <option value="Obat RJTL">Obat RJTL</option>
                            <option value="Obat RITL">Obat RITL</option>
                            <option value="Alat Kesehatan">Alat Kesehatan</option>
                        </select>
                    </div>

                    {{-- Sub-menu Alat Kesehatan (Awalnya Disembunyikan) --}}
                    <div id="alatKesehatanSection" class="mb-3" style="display: none;">
                        <label for="alat_kesehatan" class="form-label">Pilih Jenis Alat Kesehatan</label>
                        <select class="form-select" id="alat_kesehatan" name="alat_kesehatan">
                            <option value="">-- Pilih Alat Kesehatan --</option>
                            <option value="Ambulans">Ambulans</option>
                            <option value="Korset">Korset</option>
                            <option value="Collar neck">Collar neck</option>
                            <option value="Kantong darah">Kantong darah</option>
                            <option value="Kruk">Kruk</option>
                            <option value="Protesa Gigi">Protesa Gigi</option>
                            <option value="Imunohistokimia darah">Imunohistokimia darah</option>
                            <option value="CAPD">CAPD</option>
                            <option value="Transfer Set">Transfer Set</option>
                            <option value="Kaki Palsu">Kaki Palsu</option>
                            <option value="Tangan Palsu">Tangan Palsu</option>
                            <option value="Kacamata">Kacamata</option>
                            <option value="Alteplase">Alteplase</option>
                            <option value="Alat Bantu Dengar">Alat Bantu Dengar</option>
                            <option value="EGFR">EGFR</option>
                        </select>
                    </div>

                    {{-- Jumlah Kasus --}}
                    <div class="mb-3">
                        <label for="jumlah_kasus" class="form-label">Jumlah Kasus</label>
                        <input type="number" name="jumlah_kasus" id="jumlah_kasus" class="form-control" required min="0">
                    </div>

                    {{-- Biaya --}}
                    <div class="mb-3">
                        <label for="biaya" class="form-label">Biaya</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="biaya" id="biaya" class="form-control" required min="0">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success"> Simpan</button>
                    <a href="{{ route('pelayanan.index') }}" class="btn btn-secondary"> Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function toggleAlatKesehatan() {
    const jenisPelayanan = document.getElementById('jenis_pelayanan').value;
    const alatKesehatanSection = document.getElementById('alatKesehatanSection');
    
    if (jenisPelayanan === 'Alat Kesehatan') {
        alatKesehatanSection.style.display = 'block';
  
        document.getElementById('jumlah_kasus').value = 0;
    } else {
        alatKesehatanSection.style.display = 'none';
        document.getElementById('alat_kesehatan').value = '';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    toggleAlatKesehatan();
});


</script>



@endsection