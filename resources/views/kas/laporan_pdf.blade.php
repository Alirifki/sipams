<!DOCTYPE html>
<html>
<head>
    <title>Laporan Kas Desa</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width:100%; border-collapse: collapse; }
        th, td { border:1px solid #000; padding:6px; }
        th { background:#f2f2f2; }
    </style>
</head>
<body>

<h3>Laporan Kas Desa</h3>

<p>
Periode:
{{ $bulan ? \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') : 'Semua Bulan' }}
{{ $tahun ?? '' }}
</p>

<table>
    <thead>
        <tr>
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
            <td>{{ date('d-m-Y', strtotime($k->tanggal)) }}</td>
            <td>{{ $k->keterangan }}</td>
            <td>{{ $k->masuk }}</td>
            <td>{{ $k->keluar }}</td>
            <td>{{ $k->saldo }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<br>

<strong>Total Masuk:</strong> Rp {{ number_format($totalMasuk) }} <br>
<strong>Total Keluar:</strong> Rp {{ number_format($totalKeluar) }} <br>
<strong>Saldo Akhir:</strong> Rp {{ number_format($saldoAkhir) }}

</body>
</html>
