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

            <form action="{{ route('koreksi.update', $pelayanan->id) }}" method="POST" id="editKoreksiForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
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
                                <input type="text" class="form-control" id="no_bast_prefix" name="no_bast_prefix"
                                       maxlength="4" style="max-width:70px;"
                                       value="{{ old('no_bast_prefix', substr($pelayanan->no_bast, 0, 4)) }}"
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
                                <input type="text" class="form-control" id="no_bakb_prefix" name="no_bakb_prefix"
                                       maxlength="4" style="max-width:70px;"
                                       value="{{ old('no_bakb_prefix', substr($pelayanan->no_bakb, 0, 4)) }}"
                                       pattern="\d{4}" title="Masukkan 4 angka">
                                <span class="input-group-text" id="no_bakb_suffix"></span>
                            </div>
                            <input type="hidden" id="no_bakb" name="no_bakb" value="{{ old('no_bakb', $pelayanan->no_bakb) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
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
                                <input type="text" class="form-control" id="no_bahv_prefix" name="no_bahv_prefix"
                                       maxlength="4" style="max-width:70px;"
                                       value="{{ old('no_bahv_prefix', substr($pelayanan->no_bahv, 0, 4)) }}"
                                       pattern="\d{4}" title="Masukkan 4 angka">
                                <span class="input-group-text" id="no_bahv_suffix">/BA/V-11/0925</span>
                            </div>
                            <input type="hidden" id="no_bahv" name="no_bahv" value="{{ old('no_bast', $pelayanan->no_bahv) }}">
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
                            <label for="Koreksi" class="form-label">Koreksi (Rp)</label>
                            <input type="number" class="form-control" id="koreksi" name="koreksi"
                                   value="{{ old('koreksi', $pelayanan->koreksi) }}" required>
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
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        {{-- Voucher (PDF Upload) --}}
                        <div class="mb-3">
                            <label for="voucher_pdf" class="form-label">File Voucher (PDF)</label>
                            <div class="upload-container">
                                <input type="file" class="form-control" id="voucher_pdf" name="voucher_pdf" accept=".pdf" 
                                       style="display: none;">
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="document.getElementById('voucher_pdf').click()">
                                        Pilih File PDF
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" id="uploadVoucherBtn" disabled>
                                        Upload
                                    </button>
                                </div>
                                <small class="form-text text-muted">Maksimal 5MB, format PDF</small>
                                
                                <div id="voucherFileInfo" class="mt-2" style="display: none;">
                                    <div class="alert alert-info p-2">
                                        <span id="voucherFileName"></span>
                                        <button type="button" class="btn btn-sm btn-danger float-end" id="cancelVoucherBtn">
                                            Batal
                                        </button>
                                    </div>
                                </div>
                                
                                <div id="voucherFileStatus" class="mt-2">
                                    @if($pelayanan->voucher_pdf)
                                        <div class="alert alert-success p-2">
                                            File terupload: 
                                            <a href="{{ route('upload.download.voucher', $pelayanan->id) }}" target="_blank" class="btn btn-sm btn-info">
                                                📥 Download
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteVoucherFile({{ $pelayanan->id }})">
                                                🗑️ Hapus
                                            </button>
                                        </div>
                                    @endif
                                </div>
                                
                                <div id="voucherUploadProgress" class="progress mt-2" style="display: none; height: 20px;">
                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{-- Memorial (PDF Upload) --}}
                        <div class="mb-3">
                            <label for="memorial_pdf" class="form-label">File Memorial (PDF)</label>
                            <div class="upload-container">
                                <input type="file" class="form-control" id="memorial_pdf" name="memorial_pdf" accept=".pdf" 
                                       style="display: none;">
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="document.getElementById('memorial_pdf').click()">
                                        Pilih File PDF
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" id="uploadMemorialBtn" disabled>
                                        Upload
                                    </button>
                                </div>
                                <small class="form-text text-muted">Maksimal 5MB, format PDF</small>
                                
                                <div id="memorialFileInfo" class="mt-2" style="display: none;">
                                    <div class="alert alert-info p-2">
                                        <span id="memorialFileName"></span>
                                        <button type="button" class="btn btn-sm btn-danger float-end" id="cancelMemorialBtn">
                                            Batal
                                        </button>
                                    </div>
                                </div>
                                
                                <div id="memorialFileStatus" class="mt-2">
                                    @if($pelayanan->memorial_pdf)
                                        <div class="alert alert-success p-2">
                                            File terupload: 
                                            <a href="{{ route('upload.download.memorial', $pelayanan->id) }}" target="_blank" class="btn btn-sm btn-info">
                                                📥 Download
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteMemorialFile({{ $pelayanan->id }})">
                                                🗑️ Hapus
                                            </button>
                                        </div>
                                    @endif
                                </div>
                                
                                <div id="memorialUploadProgress" class="progress mt-2" style="display: none; height: 20px;">
                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalKonfirmasi">Selesai</button>
                        <a href="{{ route('koreksi.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
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

<div class="modal fade" id="modalNotifikasiUpload" tabindex="-1" aria-labelledby="modalNotifikasiUploadLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content custom-modal">
      <div class="modal-header">
        <h5 class="modal-title" id="modalNotifikasiUploadLabel">Upload Berhasil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body" id="modalNotifikasiUploadBody">
        File berhasil diupload!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const jenisPelayananSelect = document.getElementById('jenis_pelayanan');


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
    
 
    document.getElementById('btnModalSimpan').addEventListener('click', function() {
        document.getElementById('editKoreksiForm').submit();
    });

    let selectedVoucherFile = null;
    let selectedMemorialFile = null;


    const voucherPdfInput = document.getElementById('voucher_pdf');
    if (voucherPdfInput) {
        voucherPdfInput.addEventListener('change', function(e) {
            if (this.files.length > 0) {
                const file = this.files[0];
            
                if (file.type !== 'application/pdf') {
                    alert('Hanya file PDF yang diizinkan.');
                    this.value = '';
                    return;
                }
                
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file tidak boleh lebih dari 5MB.');
                    this.value = '';
                    return;
                }
                
                selectedVoucherFile = file;
                document.getElementById('voucherFileName').textContent = file.name;
                document.getElementById('voucherFileInfo').style.display = 'block';
                document.getElementById('uploadVoucherBtn').disabled = false;
            }
        });
    }

    const memorialPdfInput = document.getElementById('memorial_pdf');
    if (memorialPdfInput) {
        memorialPdfInput.addEventListener('change', function(e) {
            if (this.files.length > 0) {
                const file = this.files[0];
                
     
                if (file.type !== 'application/pdf') {
                    alert('Hanya file PDF yang diizinkan.');
                    this.value = '';
                    return;
                }
                
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file tidak boleh lebih dari 5MB.');
                    this.value = '';
                    return;
                }
                
                selectedMemorialFile = file;
                document.getElementById('memorialFileName').textContent = file.name;
                document.getElementById('memorialFileInfo').style.display = 'block';
                document.getElementById('uploadMemorialBtn').disabled = false;
            }
        });
    }

    const uploadVoucherBtn = document.getElementById('uploadVoucherBtn');
    if (uploadVoucherBtn) {
        uploadVoucherBtn.addEventListener('click', function() {
            if (!selectedVoucherFile) return;
            
            uploadFile(selectedVoucherFile, 'voucher', {{ $pelayanan->id }});
        });
    }

    const uploadMemorialBtn = document.getElementById('uploadMemorialBtn');
    if (uploadMemorialBtn) {
        uploadMemorialBtn.addEventListener('click', function() {
            if (!selectedMemorialFile) return;
            
            uploadFile(selectedMemorialFile, 'memorial', {{ $pelayanan->id }});
        });
    }


    const cancelVoucherBtn = document.getElementById('cancelVoucherBtn');
    if (cancelVoucherBtn) {
        cancelVoucherBtn.addEventListener('click', function() {
            resetVoucherUpload();
        });
    }

    const cancelMemorialBtn = document.getElementById('cancelMemorialBtn');
    if (cancelMemorialBtn) {
        cancelMemorialBtn.addEventListener('click', function() {
            resetMemorialUpload();
        });
    }

   
    function uploadFile(file, type, id) {
        const formData = new FormData();
        formData.append(type + '_pdf', file);
        
        const progressBar = document.getElementById(type + 'UploadProgress');
        const progressBarInner = progressBar.querySelector('.progress-bar');
        
        progressBar.style.display = 'block';
        
        let progress = 0;
        const progressInterval = setInterval(() => {
            progress += 5;
            if (progress > 90) clearInterval(progressInterval);
            progressBarInner.style.width = progress + '%';
            progressBarInner.textContent = progress + '%';
        }, 100);
        
        fetch('/upload/' + type + '/' + id, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            clearInterval(progressInterval);
            progressBarInner.style.width = '100%';
            progressBarInner.textContent = '100%';
            
            setTimeout(() => {
                if (data.success) {
                    showUploadModal('File berhasil diupload!');
                } else {
                    showUploadModal('Error: ' + (data.message || 'Terjadi kesalahan'));
                }
            }, 500);
        })
        .catch(error => {
            clearInterval(progressInterval);
            console.error('Error:', error);
            alert('Terjadi kesalahan saat upload file. Pastikan koneksi internet stabil.');
        });
    }

  
    function resetVoucherUpload() {
        const voucherPdfInput = document.getElementById('voucher_pdf');
        if (voucherPdfInput) {
            voucherPdfInput.value = '';
        }
        document.getElementById('voucherFileInfo').style.display = 'none';
        document.getElementById('uploadVoucherBtn').disabled = true;
        selectedVoucherFile = null;
    }

    function resetMemorialUpload() {
        const memorialPdfInput = document.getElementById('memorial_pdf');
        if (memorialPdfInput) {
            memorialPdfInput.value = '';
        }
        document.getElementById('memorialFileInfo').style.display = 'none';
        document.getElementById('uploadMemorialBtn').disabled = true;
        selectedMemorialFile = null;
    }
});

function deleteVoucherFile(id) {
    if (confirm('Hapus file voucher?')) {
        fetch('/upload/delete-voucher/' + id, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showUploadModal('File berhasil dihapus!');
            } else {
                showUploadModal('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus file.');
        });
    }
}

function deleteMemorialFile(id) {
    if (confirm('Hapus file memorial?')) {
        fetch('/upload/delete-memorial/' + id, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showUploadModal('File berhasil dihapus!');
            } else {
                showUploadModal('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus file.');
        });
    }
}

function showUploadModal(message) {
    document.getElementById('modalNotifikasiUploadBody').textContent = message;
    const modal = new bootstrap.Modal(document.getElementById('modalNotifikasiUpload'));
    modal.show();
    document.getElementById('modalNotifikasiUpload').addEventListener('hidden.bs.modal', function handler() {
        location.reload();
        document.getElementById('modalNotifikasiUpload').removeEventListener('hidden.bs.modal', handler);
    });
}
</script>

<style>
.upload-container {
    border: 1px solid #ddd;
    padding: 15px;
    border-radius: 5px;
    background-color: #f9f9f9;
}
.progress {
    margin-top: 10px;
}
</style>
@endsection
