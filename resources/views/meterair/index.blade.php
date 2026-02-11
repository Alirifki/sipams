@extends('layouts.app')

@section('content')
<h5>Input Meter Air</h5>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form method="POST" action="{{ route('meter.store') }}" class="card p-3 mb-4">
    @csrf

    <div class="row">
        <div class="col-md-4 mb-3">
            <label>Pelanggan</label>
            <select name="pelanggan_id" class="form-control" required>
                <option value="">- Pilih Pelanggan -</option>
                @foreach($pelanggan as $p)
                    <option value="{{ $p->id }}">{{ $p->nama_kk }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <label>Meter Akhir</label>
            <input type="number" name="meter_akhir" class="form-control" required>
        </div>
    </div>

    <button class="btn btn-primary">Simpan</button>
</form>

<h5>Data Meter Air</h5>

<table class="table table-bordered bg-white shadow-sm">
    <thead>
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Bulan</th>
            <th>Tahun</th>
            <th>Meter Awal</th>
            <th>Meter Akhir</th>
            <th>Pemakaian</th>
        </tr>
    </thead>
    <tbody>
        @foreach($meter as $m)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $m->pelanggan->nama_kk }}</td>
            <td>{{ \Carbon\Carbon::create()->month($m->bulan)->translatedFormat('F') }}</td>
            <td>{{ $m->tahun }}</td>
            <td>{{ $m->meter_awal }}</td>
            <td>{{ $m->meter_akhir }}</td>
            <td>{{ $m->pemakaian }} m³</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
