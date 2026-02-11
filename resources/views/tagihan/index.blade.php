@extends('layouts.app')

@section('content')
<h5>Data Tagihan Air</h5>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form action="{{ route('tagihan.generate') }}" method="POST" class="mb-3">
    @csrf
    <button class="btn btn-success"
        onclick="return confirm('Generate tagihan bulan ini?')">
        🔄 Generate Tagihan Bulan Ini
    </button>
</form>



<table class="table table-bordered bg-white shadow-sm">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Total Pemakaian</th>
            <th>Total Tagihan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tagihan as $t)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $t->pelanggan->nama_kk ?? '-' }}</td>
            <td>{{ $t->total_pemakaian }} m³</td>
            <td>Rp {{ number_format($t->total_tagihan) }}</td>
            <td>
                 <span class="badge {{ $t->status == 1 ? 'bg-success' : 'bg-warning' }}">
                {{ $t->status_label }}
            </span>
            </td>
            <td>
                <a href="{{ route('tagihan.show', $t->id) }}" class="btn btn-sm btn-info">
                    Detail
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
