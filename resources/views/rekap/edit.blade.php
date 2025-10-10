@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card edit-card mx-auto">
        <div class="card-header">
            <h2 class="mb-0">Edit Data Rekap</h2>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('rekap.update', $pelayanan->id) }}" method="POST" class="form-split">
                @csrf
                @method('PUT')

                <div class="form-col">
                    <div class="mb-3">
                        <label for="nama_fkrtl" class="form-label">Nama FKRTL</label>
                        <input type="text" class="form-control" id="nama_fkrtl" name="nama_fkrtl"
                               value="{{ old('nama_fkrtl', $pelayanan->nama_fkrtl) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="bulan_pelayanan" class="form-label">Bulan Pelayanan</label>
                        <input type="month" class="form-control date-input" id="bulan_pelayanan"
                               value="{{ old('bulan_pelayanan', \Carbon\Carbon::parse($pelayanan->bulan_pelayanan)->format('Y-m')) }}"
                               name="bulan_pelayanan" required>
                    </div>

                    {{-- Jenis Pelayanan --}}
                    <div class="mb-3">
                        <label for="jenis_pelayanan" class="form-label">Jenis Pelayanan</label>
                        <select class="form-select" id="jenis_pelayanan" name="jenis_pelayanan" required onchange="toggleAlatKesehatan()">
                            <option value="">Pilih jenis pelayanan</option>
                            <option value="RJTL" {{ old('jenis_pelayanan', $pelayanan->jenis_pelayanan) == 'RJTL' ? 'selected' : '' }}>RJTL</option>
                            <option value="RITL" {{ old('jenis_pelayanan', $pelayanan->jenis_pelayanan) == 'RITL' ? 'selected' : '' }}>RITL</option>
                            <option value="Obat RJTL" {{ old('jenis_pelayanan', $pelayanan->jenis_pelayanan) == 'Obat RJTL' ? 'selected' : '' }}>Obat RJTL</option>
                            <option value="Obat RITL" {{ old('jenis_pelayanan', $pelayanan->jenis_pelayanan) == 'Obat RITL' ? 'selected' : '' }}>Obat RITL</option>
                            <option value="Alat Kesehatan" 
                                {{ in_array(old('jenis_pelayanan', $pelayanan->jenis_pelayanan), [
                                    'Ambulans', 'Korset', 'Collar neck', 'Kantong darah', 'Kruk', 
                                    'Protesa Gigi', 'Imunohistokimia darah', 'CAPD', 'Transfer Set', 
                                    'Kaki Palsu', 'Tangan Palsu', 'Kacamata', 'Alteplase', 
                                    'Alat Bantu Dengar', 'EGFR'
                                ]) ? 'selected' : '' }}>
                                Alat Kesehatan
                            </option>
                        </select>
                    </div>

                    <div id="alatKesehatanSection" class="mb-3" style="{{ in_array($pelayanan->jenis_pelayanan, [
                        'Ambulans', 'Korset', 'Collar neck', 'Kantong darah', 'Kruk', 
                        'Protesa Gigi', 'Imunohistokimia darah', 'CAPD', 'Transfer Set', 
                        'Kaki Palsu', 'Tangan Palsu', 'Kacamata', 'Alteplase', 
                        'Alat Bantu Dengar', 'EGFR'
                    ]) ? '' : 'display: none;' }}">
                        <label for="alat_kesehatan" class="form-label">Pilih Jenis Alat Kesehatan</label>
                        <select class="form-select" id="alat_kesehatan" name="alat_kesehatan">
                            <option value="">-- Pilih Alat Kesehatan --</option>
                            @foreach(['Ambulans', 'Korset', 'Collar neck', 'Kantong darah', 'Kruk', 'Protesa Gigi', 'Imunohistokimia darah', 'CAPD', 'Transfer Set', 'Kaki Palsu', 'Tangan Palsu', 'Kacamata', 'Alteplase', 'Alat Bantu Dengar', 'EGFR'] as $alat)
                                <option value="{{ $alat }}" {{ old('alat_kesehatan', $pelayanan->jenis_pelayanan) == $alat ? 'selected' : '' }}>
                                    {{ $alat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Jumlah Kasus --}}
                    <div class="mb-3">
                        <label for="jumlah_kasus" class="form-label">Jumlah Kasus</label>
                        <input type="number" class="form-control" id="jumlah_kasus" name="jumlah_kasus"
                               value="{{ old('jumlah_kasus', $pelayanan->jumlah_kasus) }}" required>
                    </div>

                    {{-- Biaya --}}
                    <div class="mb-3">
                        <label for="biaya" class="form-label">Biaya</label>
                        <input type="number" class="form-control" id="biaya" name="biaya"
                               value="{{ old('biaya', $pelayanan->biaya) }}" required>
                    </div>

                    <hr>

                    {{-- Tanggal BAST --}}
                    <div class="mb-3">
                        <label for="tgl_bast" class="form-label">Tanggal BAST</label>
                        <input type="date" class="form-control date-input" id="tgl_bast" name="tgl_bast"
                               value="{{ old('tgl_bast', $pelayanan->tgl_bast) }}">
                    </div>

                    {{-- Field nomor untuk edit --}}
                    <div class="mb-3">
                        <label for="no_bast" class="form-label">No. BAST</label>
                        <div class="input-group">
                            <input type="text" class="form-control no-input" id="no_bast_prefix" name="no_bast_prefix"
                                   maxlength="4" value="{{ old('no_bast_prefix', substr($pelayanan->no_bast, 0, 4)) }}"
                                   pattern="\d{4}" title="Masukkan 4 angka">
                            <span class="input-group-text" id="no_bast_suffix"></span>
                        </div>
                        <input type="hidden" id="no_bast" name="no_bast" value="{{ old('no_bast', $pelayanan->no_bast) }}">
                    </div>

                    {{-- Tanggal BAKB --}}
                    <div class="mb-3">
                        <label for="tgl_bakb" class="form-label">Tanggal BAKB</label>
                        <input type="date" class="form-control date-input" id="tgl_bakb" name="tgl_bakb"
                               value="{{ old('tgl_bakb', $pelayanan->tgl_bakb) }}">
                    </div>

                    {{-- No BAKB --}}
                    <div class="mb-3">
                        <label for="no_bakb" class="form-label">No. BAKB</label>
                        <div class="input-group">
                            <input type="text" class="form-control no-input" id="no_bakb_prefix" name="no_bakb_prefix"
                                   maxlength="4" value="{{ old('no_bakb_prefix', substr($pelayanan->no_bakb, 0, 4)) }}"
                                   pattern="\d{4}" title="Masukkan 4 angka">
                            <span class="input-group-text" id="no_bakb_suffix"></span>
                        </div>
                        <input type="hidden" id="no_bakb" name="no_bakb" value="{{ old('no_bakb', $pelayanan->no_bakb) }}">
                    </div>

                    {{-- Kasus HV --}}
                    <div class="mb-3">
                        <label for="kasus_hv" class="form-label">Kasus HV</label>
                        <input type="text" class="form-control" id="kasus_hv" name="kasus_hv"
                               value="{{ old('kasus_hv', $pelayanan->kasus_hv) }}">
                    </div>

                    {{-- Biaya HV --}}
                    <div class="mb-3">
                        <label for="biaya_hv" class="form-label">Biaya HV</label>
                        <input type="number" class="form-control" id="biaya_hv" name="biaya_hv"
                               value="{{ old('biaya_hv', $pelayanan->biaya_hv) }}">
                    </div>

                    {{-- Kasus Pending --}}
                    <div class="mb-3">
                        <label for="kasus_pending" class="form-label">Kasus Pending</label>
                        <input type="number" class="form-control" id="kasus_pending" name="kasus_pending"
                               value="{{ old('kasus_pending', $pelayanan->kasus_pending) }}">
                    </div>

                    <div class="mb-3">
                        <label for="biaya_pending" class="form-label">Biaya Pending</label>
                        <input type="number" class="form-control" id="biaya_pending" name="biaya_pending"
                               value="{{ old('biaya_pending', $pelayanan->biaya_pending) }}">
                    </div>
                </div>

                <div class="form-col">
                    {{-- Tanggal BAHV --}}
                    <div class="mb-3">
                        <label for="tgl_bahv" class="form-label">Tanggal BAHV</label>
                        <input type="date" class="form-control date-input" id="tgl_bahv" name="tgl_bahv"
                               value="{{ old('tgl_bahv', $pelayanan->tgl_bahv) }}">
                    </div>

                    {{-- No BAHV --}}
                    <div class="mb-3">
                        <label for="no_bahv" class="form-label">No. BAHV</label>
                        <div class="input-group">
                            <input type="text" class="form-control no-input" id="no_bahv_prefix" name="no_bahv_prefix"
                                   maxlength="4" value="{{ old('no_bahv_prefix', substr($pelayanan->no_bahv, 0, 4)) }}"
                                   pattern="\d{4}" title="Masukkan 4 angka">
                            <span class="input-group-text" id="no_bahv_suffix">/BA/V-11/0925</span>
                        </div>
                        <input type="hidden" id="no_bahv" name="no_bahv" value="{{ old('no_bast', $pelayanan->no_bahv) }}">
                    </div>

                    {{-- Kasus Tidak Layak --}}
                    <div class="mb-3">
                        <label for="kasus_tidak_layak" class="form-label">Kasus Tidak Layak</label>
                        <input type="number" class="form-control" id="kasus_tidak_layak" name="kasus_tidak_layak"
                               value="{{ old('kasus_tidak_layak', $pelayanan->kasus_tidak_layak) }}">
                    </div>

                    <div class="mb-3">
                        <label for="biaya_tidak_layak" class="form-label">Biaya Tidak Layak</label>
                        <input type="number" class="form-control" id="biaya_tidak_layak" name="biaya_tidak_layak"
                               value="{{ old('biaya_tidak_layak', $pelayanan->biaya_tidak_layak) }}">
                    </div>

                    {{-- Kasus Dispute --}}
                    <div class="mb-3">
                        <label for="kasus_dispute" class="form-label">Kasus Dispute</label>
                        <input type="number" class="form-control" id="kasus_dispute" name="kasus_dispute"
                               value="{{ old('kasus_dispute', $pelayanan->kasus_dispute) }}">
                    </div>

                    <div class="mb-3">
                        <label for="biaya_dispute" class="form-label">Biaya Dispute</label>
                        <input type="number" class="form-control" id="biaya_dispute" name="biaya_dispute"
                               value="{{ old('biaya_dispute', $pelayanan->biaya_dispute) }}">
                    </div>

                    {{-- UMK --}}
                    <div class="mb-3">
                        <label for="umk" class="form-label">UMK</label>
                        <input type="number" class="form-control" id="umk" name="umk"
                               value="{{ old('umk', $pelayanan->umk) }}">
                    </div>

                    {{-- Koreksi --}}
                    <div class="mb-3">
                        <label for="koreksi" class="form-label">Koreksi</label>
                        <input type="text" class="form-control" id="koreksi" name="koreksi"
                               value="{{ old('koreksi', $pelayanan->koreksi) }}">
                    </div>

                    {{-- Tgl Reg BoA --}}
                    <div class="mb-3">
                        <label for="tgl_reg_boa" class="form-label">Tanggal Reg BoA</label>
                        <input type="date" class="form-control date-input" id="tgl_reg_boa" name="tgl_reg_boa"
                               value="{{ old('tgl_reg_boa', $pelayanan->tgl_reg_boa) }}">
                    </div>

                    {{-- Tgl JT --}}
                    <div class="mb-3">
                        <label for="tgl_jt" class="form-label">Tanggal Jatuh Tempo</label>
                        <input type="date" class="form-control date-input" id="tgl_jt" name="tgl_jt"
                               value="{{ old('tgl_jt', $pelayanan->tgl_jt) }}">
                    </div>

                    <div class="mb-3">
                        <label for="tgl_bayar" class="form-label">Tanggal Bayar</label>
                        <input type="date" class="form-control date-input" id="tgl_bayar" name="tgl_bayar"
                               value="{{ old('tgl_bayar', $pelayanan->tgl_bayar) }}">
                    </div>

                   <div class="mt-3 text-end">
    <button type="submit" class="btn btn-success btn-sm">Selesai</button>
</div>

                </div>
            </form>
        </div>
    </div>
</div>

{{-- Tambahkan style khusus --}}
<style>
    .edit-card {
        max-width: 1000px; 
        margin-top: 32px;
    }
    .form-split {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
    }
    .form-col {
        flex: 1;
        min-width: 400px; 
    }
    .no-input {
        max-width: 70px;
    }
    .date-input {
        max-width: 150px; 
    }
</style>
@endsection