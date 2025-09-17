@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0" style="margin-top:8px;">Edit Data</h2>
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

            <form action="{{ route('koreksi.update', $pelayanan->id) }}" method="POST" id="editKoreksiForm">
                @csrf

                <div class="form-col">
                    
                    <div class="mb-6">
                        <label for="nama_fkrtl" class="form-label">Nama FKRTL</label>
                        <input type="text" class="form-control" id="nama_fkrtl" name="nama_fkrtl"
                               value="{{ old('nama_fkrtl', $pelayanan->nama_fkrtl) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="bulan_pelayanan" class="form-label">Bulan Pelayanan</label>
                        <input type="month" class="form-control" id="bulan_pelayanan"
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
                        <input type="date" class="form-control" id="tgl_bast" name="tgl_bast"
                               value="{{ old('tgl_bast', $pelayanan->tgl_bast) }}">
                    </div>

                    {{-- Field nomor untuk edit --}}
                    <div class="mb-3">
                        <label for="no_bast" class="form-label">No. BAST</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="no_bast_prefix" name="no_bast_prefix"
                                   maxlength="4" style="max-width:70px;"
                                   value="{{ old('no_bast_prefix', substr($pelayanan->no_bast, 0, 4)) }}"
                                   pattern="\d{4}" title="Masukkan 4 angka">
                            <span class="input-group-text" id="no_bast_suffix"></span>
                        </div>
                        <input type="hidden" id="no_bast" name="no_bast" value="{{ old('no_bast', $pelayanan->no_bast) }}">
                        <small class="form-text text-muted">
                            RJTL/RITL: 4angka /1010/BPK/0925 &nbsp; | &nbsp; Obat/Alkes: 4angka/BA/V-11/0925
                        </small>
                    </div>
                </div>

                <div class="form-col">
                    {{-- Tanggal BAKB --}}
                    <div class="mb-3">
                        <label for="tgl_bakb" class="form-label">Tanggal BAKB</label>
                        <input type="date" class="form-control" id="tgl_bakb" name="tgl_bakb"
                               value="{{ old('tgl_bakb', $pelayanan->tgl_bakb) }}">
                    </div>

                    {{-- No BAKB --}}
                    <div class="mb-3">
                        <label for="no_bakb" class="form-label">No. BAKB</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="no_bakb_prefix" name="no_bakb_prefix"
                                   maxlength="4" style="max-width:70px;"
                                   value="{{ old('no_bakb_prefix', substr($pelayanan->no_bakb, 0, 4)) }}"
                                   pattern="\d{4}" title="Masukkan 4 angka">
                            <span class="input-group-text" id="no_bakb_suffix"></span>
                        </div>
                        <input type="hidden" id="no_bakb" name="no_bakb" value="{{ old('no_bakb', $pelayanan->no_bakb) }}">
                        <small class="form-text text-muted">Isi 4 angka di depan, format otomatis untuk Obat/Alkes: BA/V-11/0925</small>
                    </div>

                    {{-- Tanggal BAHV --}}
                    <div class="mb-3">
                        <label for="tgl_bahv" class="form-label">Tanggal BAHV</label>
                        <input type="date" class="form-control" id="tgl_bahv" name="tgl_bahv"
                               value="{{ old('tgl_bahv', $pelayanan->tgl_bahv) }}">
                    </div>

                    {{-- No BAHV --}}
                    <div class="mb-3">
                        <label for="no_bahv" class="form-label">No. BAHV</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="no_bahv_prefix" name="no_bahv_prefix"
                                   maxlength="4" style="max-width:70px;"
                                   value="{{ old('no_bahv_prefix', substr($pelayanan->no_bahv, 0, 4)) }}"
                                   pattern="\d{4}" title="Masukkan 4 angka">
                            <span class="input-group-text" id="no_bahv_suffix">/BA/V-11/0925</span>
                        </div>
                        <input type="hidden" id="no_bahv" name="no_bahv" value="{{ old('no_bast', $pelayanan->no_bahv) }}">
                        <small class="form-text text-muted">Isi 4 angka di depan, format otomatis untuk Obat/Alkes: BA/V-11/0925</small>
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
                        <input type="date" class="form-control" id="tgl_reg_boa" name="tgl_reg_boa"
                               value="{{ old('tgl_reg_boa', $pelayanan->tgl_reg_boa) }}">
                    </div>

                    {{-- Tgl JT --}}
                     <div class="mb-3">
                        <label for="tgl_jt" class="form-label">Tanggal Jatuh Tempo</label>
                        <input type="date" class="form-control" id="tgl_jt" name="tgl_jt"
                               value="{{ old('tgl_jt', $pelayanan->tgl_jt) }}">
                    </div>

                       <div class="mb-3">
                        <label for="tgl_bayar" class="form-label">Tanggal Bayar</label>
                        <input type="date" class="form-control" id="tgl_bayar" name="tgl_bayar"
                               value="{{ old('tgl_bayar', $pelayanan->tgl_bayar) }}">
                    </div>



                    {{-- Memorial --}}
                    <div class="mb-3">
                        <label for="memorial" class="form-label">Memorial</label>
                        <input type="text" class="form-control" id="memorial" name="memorial"
                               value="{{ old('memorial', $pelayanan->memorial) }}">
                    </div>

                    {{-- Voucher --}}
                    <div class="mb-3">
                        <label for="voucher" class="form-label">Voucher</label>
                        <input type="text" class="form-control" id="voucher" name="voucher"
                               value="{{ old('voucher', $pelayanan->voucher) }}">
                    </div>
                </div>

                <div style="width:100%;margin-top:24px;">
                    <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalKonfirmasi">Selesai</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modalKonfirmasi" tabindex="-1" aria-labelledby="modalKonfirmasiLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content custom-modal">
      <div class="modal-header">
        <h5 class="modal-title" id="modalKonfirmasiLabel">Konfirmasi Simpan Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda sudah yakin dengan data yang dimasukkan?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-success" id="btnModalSimpan">Simpan</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const jenisPelayananSelect = document.getElementById('jenis_pelayanan');

    // --- BAST ---
    const tglBastInput = document.getElementById('tgl_bast');
    const noBastPrefix = document.getElementById('no_bast_prefix');
    const noBastSuffix = document.getElementById('no_bast_suffix');
    const noBastInput = document.getElementById('no_bast');

    function updateNoBast() {
        let prefix = noBastPrefix.value.padStart(4, '0');
        let suffix = '';

        if (tglBastInput.value) {
            const [tahun, bulan] = tglBastInput.value.split('-');
            const kodeBulanTahun = bulan + tahun.slice(-2);

            if (
                jenisPelayananSelect.value === 'Obat RJTL' ||
                jenisPelayananSelect.value === 'Obat RITL' ||
                jenisPelayananSelect.value === 'Alat Kesehatan'
            ) {
                suffix = '/BA/V-11/' + kodeBulanTahun;
            } else {
                suffix = '/1010/BPK/' + kodeBulanTahun;
            }
        }

        noBastSuffix.textContent = suffix;
        noBastInput.value = prefix + suffix;
    }

    noBastPrefix.addEventListener('input', updateNoBast);
    jenisPelayananSelect.addEventListener('change', updateNoBast);
    tglBastInput.addEventListener('change', updateNoBast);
    updateNoBast();

    // --- BAKB ---
    const tglBakbInput = document.getElementById('tgl_bakb');
    const noBakbPrefix = document.getElementById('no_bakb_prefix');
    const noBakbSuffix = document.getElementById('no_bakb_suffix');
    const noBakbInput = document.getElementById('no_bakb');

    function updateNoBakb() {
        let prefix = noBakbPrefix.value.padStart(4, '0');
        let suffix = '';

        if (tglBakbInput.value) {
            const [tahun, bulan] = tglBakbInput.value.split('-');
            const kodeBulanTahun = bulan + tahun.slice(-2);
            suffix = '/BA/V-11/' + kodeBulanTahun;
        }

        noBakbSuffix.textContent = suffix;
        noBakbInput.value = prefix + suffix;
    }

    noBakbPrefix.addEventListener('input', updateNoBakb);
    tglBakbInput.addEventListener('change', updateNoBakb);
    updateNoBakb();

    // --- BAHV ---
    const tglBahvInput = document.getElementById('tgl_bahv');
    const noBahvPrefix = document.getElementById('no_bahv_prefix');
    const noBahvSuffix = document.getElementById('no_bahv_suffix');
    const noBahvInput = document.getElementById('no_bahv');

    function updateNoBahv() {
        let prefix = noBahvPrefix.value.padStart(4, '0');
        let suffix = '';

        if (tglBahvInput.value) {
            const [tahun, bulan] = tglBahvInput.value.split('-');
            const kodeBulanTahun = bulan + tahun.slice(-2);
            suffix = '/BA/V-11/' + kodeBulanTahun;
        }

        noBahvSuffix.textContent = suffix;
        noBahvInput.value = prefix + suffix;
    }

    noBahvPrefix.addEventListener('input', updateNoBahv);
    tglBahvInput.addEventListener('change', updateNoBahv);
    updateNoBahv();

    // --- Alat Kesehatan toggle ---
    function toggleAlatKesehatan() {
        const alatSection = document.getElementById('alatKesehatanSection');
        const selected = jenisPelayananSelect.value;
        const alkesList = [
            'Ambulans', 'Korset', 'Collar neck', 'Kantong darah', 'Kruk',
            'Protesa Gigi', 'Imunohistokimia darah', 'CAPD', 'Transfer Set',
            'Kaki Palsu', 'Tangan Palsu', 'Kacamata', 'Alteplase',
            'Alat Bantu Dengar', 'EGFR'
        ];
        if (alkesList.includes(selected)) {
            alatSection.style.display = '';
        } else {
            alatSection.style.display = 'none';
        }
    }

    toggleAlatKesehatan();
    jenisPelayananSelect.addEventListener('change', toggleAlatKesehatan);
});
</script>
@endsection
