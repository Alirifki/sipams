@extends('layouts.app')
@section('title','Edit Pelanggan')

@section('content')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('pelanggan.index') }}">Pelanggan</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        Edit
    </li>
@endsection

<h5 class="mb-3">Edit Pelanggan</h5>

<form method="POST" action="{{ route('pelanggan.update', $pelanggan->id) }}">
@csrf
@method('PUT')

<div class="mb-3">
    <label>No Sambungan</label>
    <input type="text" name="no_sambungan" class="form-control"
           value="{{ old('no_sambungan', $pelanggan->no_sambungan) }}" required>
</div>

<div class="mb-3">
    <label>Nama KK</label>
    <input type="text" name="nama_kk" class="form-control"
           value="{{ old('nama_kk', $pelanggan->nama_kk) }}" required>
</div>

<div class="mb-3">
    <label>Alamat</label>
    <textarea name="alamat" class="form-control" required>{{ old('alamat', $pelanggan->alamat) }}</textarea>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label>RT</label>
        <input type="text" name="rt" class="form-control"
               value="{{ old('rt', $pelanggan->rt) }}" required>
    </div>

    <div class="col-md-6 mb-3">
        <label>RW</label>
        <input type="text" name="rw" class="form-control"
               value="{{ old('rw', $pelanggan->rw) }}" required>
    </div>
</div>

<div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control" required>
        <option value="aktif" {{ old('status', $pelanggan->status)=='aktif' ? 'selected' : '' }}>
            Aktif
        </option>
        <option value="nonaktif" {{ old('status', $pelanggan->status)=='nonaktif' ? 'selected' : '' }}>
            Non Aktif
        </option>
    </select>
</div>

<button type="submit" class="btn btn-primary btn-sm">Update</button>
<a href="{{ route('pelanggan.index') }}" class="btn btn-secondary btn-sm">Kembali</a>

</form>

@endsection
