@extends('layouts.app')

@section('content')
<h5>Detail Tagihan</h5>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <p><strong>Pelanggan:</strong> {{ $tagihan->pelanggan->nama_kk }}</p>
        <p><strong>No Sambungan:</strong> {{ $tagihan->pelanggan->no_sambungan }}</p>
        <p><strong>Total Pemakaian:</strong> {{ $tagihan->total_pemakaian }} m³</p>
        <p><strong>Total Tagihan:</strong> Rp {{ number_format($tagihan->total_tagihan) }}</p>

        <p><strong>Status:</strong>
            <span class="badge {{ $tagihan->status == 1 ? 'bg-success' : 'bg-warning' }}">
                {{ $tagihan->status_label }}
            </span>
        </p>

        @if($tagihan->status == 1)
            <p><strong>Tanggal Bayar:</strong>
                {{ \Carbon\Carbon::parse($tagihan->tanggal_bayar)->format('d-m-Y') }}
            </p>
        @else
            <form method="POST" action="{{ route('tagihan.verifikasi', $tagihan->id) }}">
                @csrf
                <button class="btn btn-success">
                    ✔ Verifikasi Pembayaran
                </button>
            </form>
        @endif
        <a href="{{ route('tagihan.index') }}" class="btn btn-secondary mt-3">
            ⬅ Kembali
        </a>
    </div>
     
</div>
@endsection
