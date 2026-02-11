@extends('layouts.app')

@section('title','Dashboard')

@section('content')

<h4 class="mb-4">Dashboard</h4>

    <div class="row g-3">

        <div class="col-6 col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Pelanggan</small>
                    <h4 class="fw-bold">{{ $totalPelanggan }}</h4>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Belum Bayar</small>
                    <h4 class="fw-bold text-warning">{{ $belumBayar }}</h4>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card shadow-sm bg-primary text-white">
                <div class="card-body">
                    <small>Saldo Kas</small>
                    <h4 class="fw-bold">
                        Rp {{ number_format($saldoSekarang) }}
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <h5>Grafik Pemasukan Tahun {{ date('Y') }}</h5>
            <canvas id="grafikKas"></canvas>
        </div>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <h5>5 Transaksi Terakhir</h5>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Masuk</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksiTerakhir as $t)
                    <tr>
                        <td>{{ date('d-m-Y', strtotime($t->tanggal)) }}</td>
                        <td>{{ $t->keterangan }}</td>
                        <td class="text-success">
                            Rp {{ number_format($t->masuk) }}
                        </td>
                        <td>
                            Rp {{ number_format($t->saldo) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const ctx = document.getElementById('grafikKas');

    if (ctx) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($bulan),
                datasets: [{
                    label: 'Pemasukan',
                    data: @json($total),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

});
</script>
@endsection
