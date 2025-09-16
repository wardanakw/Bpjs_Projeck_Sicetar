@extends('layouts.app')

@section('title', 'Pilih FKRTL')

@section('content')
    <div class="card shadow">
        <div class="card-body">
            <h3 class="mt-4">Pilih Nama FKRTL</h3>
            
            <form method="GET" action="{{ route('fkrtl.index') }}" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama rumah sakit,atau ID FKRTL..." value="{{ $search }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th>ID FKRTL</th>
                            <th>Nama Rumah Sakit</th>
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
                                        <i class="fas fa-plus"></i> Buat Pelayanan
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data FKRTL yang ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection