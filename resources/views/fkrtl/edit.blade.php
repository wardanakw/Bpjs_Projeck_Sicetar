@extends('layouts.app')

@section('title', 'Edit FKRTL')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-warning text-dark">Edit Data FKRTL</div>
        <div class="card-body">
            <form action="{{ route('fkrtl.update', $fkrtl->id_fkrtl) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>ID FKRTL</label>
                    <input type="text" name="id_fkrtl" value="{{ $fkrtl->id_fkrtl }}" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label>Kode Rumah Sakit</label>
                    <input type="text" name="kode_rumah_sakit" value="{{ $fkrtl->kode_rumah_sakit }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Nama Rumah Sakit</label>
                    <input type="text" name="nama_rumah_sakit" value="{{ $fkrtl->nama_rumah_sakit }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Jenis</label>
                    <input type="text" name="jenis" value="{{ $fkrtl->jenis }}" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-warning">Update</button>
                <a href="{{ route('fkrtl.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
