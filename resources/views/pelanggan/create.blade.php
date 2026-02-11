@extends('layouts.app')
@section('title','Tambah Pelanggan')

@section('content')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('pelanggan.index') }}">Pelanggan</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        Tambah Pelanggan
    </li>
@endsection

<h5 class="mb-3">Tambah Pelanggan</h5>

<form method="POST" action="{{ route('pelanggan.store') }}">
@csrf

<input name="no_sambungan" placeholder="No Sambungan" class="form-control mb-2" required>

<input name="nama_kk" placeholder="Nama KK" class="form-control mb-2" required>

<textarea name="alamat" class="form-control mb-2" placeholder="Alamat" required></textarea>

<div class="row">
    <div class="col">
        <input name="rt" placeholder="RT" class="form-control" required>
    </div>
    <div class="col">
        <input name="rw" placeholder="RW" class="form-control" required>
    </div>
</div>

<select name="status" class="form-control mt-2" required>
    <option value="aktif">Aktif</option>
    <option value="nonaktif">Non Aktif</option>
</select>

<button type="submit" class="btn btn-primary mt-3">Simpan</button>
</form>


@endsection
