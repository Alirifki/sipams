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

    <button class="btn btn-warning"
            data-bs-toggle="modal"
            data-bs-target="#modalManual">
        Input Manual
    </button>


<h5>Data Meter Air</h5>
<form method="GET" class="card p-3 mb-3">
    <div class="row">
        <div class="col-md-3">
            <label>Bulan</label>
            <select name="bulan" class="form-control">
                @for($i=1;$i<=12;$i++)
                    <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                    </option>
                @endfor
            </select>
        </div>

        <div class="col-md-3">
            <label>Tahun</label>
            <select name="tahun" class="form-control">
                @for($t=date('Y')-2;$t<=date('Y')+1;$t++)
                    <option value="{{ $t }}" {{ $tahun == $t ? 'selected' : '' }}>
                        {{ $t }}
                    </option>
                @endfor
            </select>
        </div>

        <div class="col-md-3 d-flex align-items-end">
            <button class="btn btn-primary">Filter</button>
        </div>
    </div>
</form>


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

<!-- Modal Input Manual -->
<div class="modal fade" id="modalManual" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header bg-warning">
        <h5 class="modal-title">Input Meter Manual</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <form method="POST" action="{{ route('meter.manual') }}">
            @csrf

            <div class="mb-3">
                <label>Pelanggan</label>
                <select name="pelanggan_id" class="form-control" required>
                    <option value="">- Pilih Pelanggan -</option>
                    @foreach($pelanggan as $p)
                        <option value="{{ $p->id }}">
                            {{ $p->nama_kk }} ({{ $p->no_sambungan }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Bulan</label>
                    <select name="bulan" class="form-control" required>
                        @for($i=1;$i<=12;$i++)
                            <option value="{{ $i }}">
                                {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Tahun</label>
                    <input type="number"
                           name="tahun"
                           value="{{ date('Y') }}"
                           class="form-control"
                           required>
                </div>
            </div>

            <div class="mb-3">
                <label>Meter Awal</label>
                <input type="number" name="meter_awal" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Meter Akhir</label>
                <input type="number" name="meter_akhir" class="form-control" required>
            </div>

            <div class="text-end">
                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Batal
                </button>
                <button class="btn btn-success">
                    Simpan
                </button>
            </div>

        </form>

      </div>
    </div>
  </div>
</div>



@endsection
