@extends('layouts.app')

@section('content')
<div class="container">

    <h4 class="mb-3">💰 Kas Desa</h4>

    {{-- SALDO --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h6>Saldo Saat Ini</h6>
            <h3 class="text-success fw-bold">
                Rp {{ number_format($saldoSekarang) }}
            </h3>
        </div>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORM TAMBAH KAS --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="mb-3">Tambah Transaksi</h5>

            <form action="{{ route('kas.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control"
                               value="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Jenis</label>
                        <select name="jenis" class="form-control" required>
                            <option value="masuk">Kas Masuk</option>
                            <option value="keluar">Kas Keluar</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Jumlah</label>
                        <input type="number" name="jumlah"
                               class="form-control" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan"
                               class="form-control">
                    </div>
                </div>

                <button class="btn btn-primary">
                    Simpan
                </button>
            </form>
        </div>
    </div>

    {{-- TABEL RIWAYAT --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Riwayat Kas</h5>

            <div class="table-responsive">
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <form method="GET" action="{{ route('kas.index') }}">
                            <div class="row">

                                <div class="col-md-3">
                                    <label>Bulan</label>
                                    <select name="bulan" class="form-control">
                                        <option value="">Semua</option>
                                        @for($i=1;$i<=12;$i++)
                                            <option value="{{ $i }}"
                                                {{ request('bulan') == $i ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label>Tahun</label>
                                    <select name="tahun" class="form-control">
                                        <option value="">Semua</option>
                                        @for($y=date('Y');$y>=2023;$y--)
                                            <option value="{{ $y }}"
                                                {{ request('tahun') == $y ? 'selected' : '' }}>
                                                {{ $y }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-md-3 d-flex align-items-end">
                                    <button class="btn btn-primary me-2">Filter</button>
                                    <a href="{{ route('kas.index') }}" class="btn btn-secondary me-2">Reset</a>
                                    <a href="{{ route('kas.export', request()->query()) }}"
                                        class="btn btn-success">
                                        Export PDF
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Masuk</th>
                            <th>Keluar</th>
                            <th>Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kas as $k)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ date('d-m-Y', strtotime($k->tanggal)) }}</td>
                            <td>{{ $k->keterangan }}</td>
                            <td class="text-success">
                                {{ $k->masuk ? 'Rp '.number_format($k->masuk) : '-' }}
                            </td>
                            <td class="text-danger">
                                {{ $k->keluar ? 'Rp '.number_format($k->keluar) : '-' }}
                            </td>
                            <td>
                                Rp {{ number_format($k->saldo) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection
