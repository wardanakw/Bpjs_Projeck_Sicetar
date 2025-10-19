@extends('layouts.app')

@section('title', 'Pilih FKRTL')

@section('content')

    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        :root {
            --card-max-width: 1100px;
            --gap: 24px;
            --pad: 0.6rem;
            --font-sm: 0.9rem;
            --font-xs: 0.82rem;
            --muted: rgba(0,0,0,0.6);
        }

        .card.fkrtl-card {
            max-width: var(--card-max-width);
            margin: 20px auto;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(44,62,80,0.06);
            padding: 0;
            overflow: hidden;
        }

        .table-responsive-custom {
            width: 100%;
            overflow-x: auto;
            border-radius: 8px;
        }

        #fkrtlTable {
            width: 100%;
            margin: 0;
            border-collapse: collapse;
            table-layout: auto;
            font-size: var(--font-sm);
            min-width: 800px;
        }

        #fkrtlTable th,
        #fkrtlTable td {
            padding: 0.5rem 0.6rem !important;
            vertical-align: middle;
            text-align: left;
            color: #222;
            word-break: break-word;
            white-space: normal;
            line-height: 1.15;
        }

        #fkrtlTable thead th {
            font-weight: 600;
            text-align: left;
            background: #e9f2ff;
            border-bottom: 2px solid #dee2e6;
        }

        @media (min-width: 992px) {
            #fkrtlTable th:nth-child(1),
            #fkrtlTable td:nth-child(1) { width: 8%; }  
            #fkrtlTable th:nth-child(2),
            #fkrtlTable td:nth-child(2) { width: 50%; } 
            #fkrtlTable th:nth-child(3),
            #fkrtlTable td:nth-child(3) { width: 15%; }  
            #fkrtlTable th:nth-child(4),
            #fkrtlTable td:nth-child(4) { width: 12%; } 
        }

    
        .btn-sm {
            padding: 0.32rem 0.6rem;
            font-size: var(--font-xs);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
            border-radius: 6px;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        @media (min-width: 768px) {
            .action-buttons {
                flex-direction: row;
                flex-wrap: wrap;
            }
        }

        .dataTables_filter input[type="search"] {
            width: 220px !important;
            font-size: var(--font-sm);
            padding: 6px 8px;
            border-radius: 6px;
            border: 1px solid #ced4da;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem 1.35rem;
        }

        .toolbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        @media (max-width: 991px) {
            .card.fkrtl-card { 
                margin: 12px; 
                border-radius: 10px; 
            }
            #fkrtlTable { 
                min-width: 750px; 
                font-size: var(--font-xs); 
            }
            .dataTables_filter input[type="search"] { 
                width: 160px !important; 
            }
            .toolbar-container {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 576px) {
            #fkrtlTable thead { display: none; }
            #fkrtlTable, #fkrtlTable tbody, #fkrtlTable tr, #fkrtlTable td { 
                display: block; 
                width: 100%; 
            }
            #fkrtlTable tr { 
                margin-bottom: 12px; 
                border: 1px solid rgba(0,0,0,0.06); 
                border-radius: 8px; 
                padding: 8px; 
            }
            #fkrtlTable td { 
                text-align: left; 
                padding: 8px; 
                border: none; 
            }
            #fkrtlTable td:nth-child(1)::before { 
                content: "ID: "; 
                font-weight:600; 
                color:var(--muted); 
            }
            #fkrtlTable td:nth-child(2)::before { 
                content: "Nama RS: "; 
                font-weight:600; 
                color:var(--muted); 
            }
            #fkrtlTable td:nth-child(3)::before { 
                content: "Jenis: "; 
                font-weight:600; 
                color:var(--muted); 
            }
            #fkrtlTable td:nth-child(4)::before { 
                content: "Aksi: "; 
                font-weight:600; 
                color:var(--muted); 
            }
            .btn-sm { 
                width: 100%; 
                justify-content: center; 
                margin-bottom: 6px; 
            }
        }

        #fkrtlTable tbody tr:hover { 
            background: rgba(0,116,217,0.03); 
        }
     
        #fkrtlTable tbody tr {
            transition: all 0.2s ease;
        }
        
        .modal-content {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .modal-header {
            border-bottom: 1px solid #e9ecef;
            padding: 1rem 1.5rem;
        }
        
        .modal-footer {
            border-top: 1px solid #e9ecef;
            padding: 1rem 1.5rem;
        }
    </style>
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
    <div class="card fkrtl-card">
        <div class="card-header">
            <h3 class="mb-0 text-center">Pilih Nama FKRTL</h3>
        </div>
        <div class="card-body">
            <div class="toolbar-container mb-4">
                <div id="fkrtl-toolbar" class="d-flex gap-2 align-items-center flex-wrap">
                    <a href="{{ route('fkrtl.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Buat Baru
                    </a>
                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteSelectModal">
                        <i class="fas fa-trash"></i> Hapus Data FKRTL
                    </a>
                </div>
            </div>

            <div class="table-responsive-custom">
                <table id="fkrtlTable" class="table table-bordered table-striped table-sm mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Nama RS</th>
                            <th>Jenis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($fkrtl as $item)
                            <tr>
                                <td>{{ $item->id_fkrtl }}</td>
                                <td>{{ $item->nama_rumah_sakit }}</td>
                                <td>{{ $item->jenis }}</td>
                                <td>
                                    <a href="{{ route('pelayanan.create', ['fkrtl_id' => $item->id_fkrtl]) }}"
                                       class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus"></i> Buat
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-3">Tidak ada data FKRTL yang ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="deleteSelectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteSelectForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">Pilih FKRTL untuk Dihapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="fkrtl_id" class="form-label">Pilih Rumah Sakit</label>
                        <select id="fkrtl_id" class="form-select" required>
                            <option value="">-- Pilih FKRTL --</option>
                            @foreach ($fkrtl as $item)
                                <option value="{{ $item->id_fkrtl }}">
                                    {{ $item->id_fkrtl }} - {{ $item->nama_rumah_sakit }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
       $(document).ready(function() {
    var table = $('#fkrtlTable').DataTable({
        paging: false,
        ordering: false,
        info: false,
        searching: true,
        language: {
            search: "Cari FKRTL atau Rumah Sakit:",
            zeroRecords: "Tidak ada data ditemukan",
            infoEmpty: "Tidak ada data",
            infoFiltered: "(difilter dari _MAX_ total data)"
        },
        dom: '<"top"f>rt<"clear">'
    });

    var selectedId = null;
    $('#fkrtlTable tbody').on('click', 'tr', function () {
        $('#fkrtlTable tbody tr').removeClass('table-active');
        $(this).addClass('table-active');
        selectedId = $(this).find('td').first().text().trim();
    });

    const form = document.getElementById('deleteSelectForm');
    const select = document.getElementById('fkrtl_id');

    select.addEventListener('change', function() {
        const id = this.value;
        if (id) {
            form.action = `/fkrtl/${id}`;
            console.log('Form action set to:', form.action);
        }
    });

    form.addEventListener('submit', function(event) {
        const id = select.value;
        if (!id) {
            event.preventDefault();
            alert('Silakan pilih FKRTL yang akan dihapus!');
            return;
        }

        const selectedText = select.options[select.selectedIndex].text;
        if (!confirm(`Apakah Anda yakin ingin menghapus data: ${selectedText}?`)) {
            event.preventDefault();
        }
    });

    document.getElementById('deleteSelectModal').addEventListener('hidden.bs.modal', function () {
        select.value = '';
        form.action = '';
    });
});

    </script>
@endpush