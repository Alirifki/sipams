@extends('layouts.app')
@section('title','Data Pelanggan')

@section('content')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        Pelanggan
    </li>
@endsection

<div class="d-flex justify-content-between mb-3">
    <h5>Data Pelanggan</h5>
    <a href="{{ route('pelanggan.create') }}" class="btn btn-primary btn-sm">
        + Tambah
    </a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
<table class="table table-bordered table-sm align-middle">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>No Sambungan</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Status</th>
            <th width="130">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pelanggan as $p)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{ $p->no_sambungan }}</td>
            <td>{{ $p->nama_kk }}</td>
            <td>{{ $p->alamat }} RT {{$p->rt}} RW {{$p->rw}}</td>
            <td>{{ $p->status }}</td>
            <td>
                <a href="{{ route('pelanggan.edit',$p->id) }}"
                   class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('pelanggan.destroy',$p->id) }}"
                      method="POST" class="d-inline"
                      onsubmit="return confirm('Hapus data ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center text-muted">
                Belum ada data
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>

@endsection
