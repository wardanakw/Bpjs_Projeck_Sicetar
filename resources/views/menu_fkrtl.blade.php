@extends('layouts.app')

@section('title', 'Pilih FKRTL')

@section('content')

    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        .card.fkrtl-card {
            max-width: 800px;   
            margin: 24px auto;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(44,62,80,0.08);
        }
        #fkrtlTable {
            width: 100%;
            margin: 0;
            table-layout: fixed;   
            border-collapse: collapse;
        }
        #fkrtlTable th,
        #fkrtlTable td {
            padding: 0.5rem !important;
            font-size: 0.9rem;
            text-align: center;
            vertical-align: middle;
            white-space: normal;       
            word-wrap: break-word;     
            overflow-wrap: break-word; 
        }
        #fkrtlTable th {
            font-weight: 600;
        }

      
        #fkrtlTable th:nth-child(1),
        #fkrtlTable td:nth-child(1) { width: 20%; }   
        #fkrtlTable th:nth-child(2),
        #fkrtlTable td:nth-child(2) { width: 50%; }   
        #fkrtlTable th:nth-child(3),
        #fkrtlTable td:nth-child(3) { width: 20%; }   
        #fkrtlTable th:nth-child(4),
        #fkrtlTable td:nth-child(4) { width: 20%; }  

        .dataTables_filter input[type="search"] {
            width: 180px !important;
            font-size: 0.9rem;
        }
        .btn-sm {
            padding: 0.25rem 0.6rem;
            font-size: 0.85rem;
        }

        @media (max-width: 768px) {
            .card.fkrtl-card {
                max-width: 100%;
                margin: 16px;
            }
            #fkrtlTable th,
            #fkrtlTable td {
                font-size: 0.8rem;
            }
        }
    </style>

    <div class="card fkrtl-card">
        <div class="card-body">
            <h3 class="mb-3 text-center">Pilih Nama FKRTL</h3>

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
                            <td colspan="4" class="text-center">Tidak ada data FKRTL yang ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#fkrtlTable').DataTable({
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
        });
    </script>
@endpush
