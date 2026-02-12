<!DOCTYPE html>
<html>
<head>
    <title>Struk Pembayaran</title>
    <style>
        body {
            font-family: monospace;
            width: 300px;
            margin: auto;
        }
        hr {
            border: 1px dashed black;
        }
    </style>
</head>
<body onload="window.print()">

<center>
    <h3>SIPAMDes</h3>
    <small>Sistem Air Desa</small>
</center>

<hr>

<p>No Transaksi : {{ $noTransaksi }}</p>
<p>Tanggal      : {{ \Carbon\Carbon::parse($tagihan->tanggal_bayar)->format('d-m-Y') }}</p>

<hr>

<p>Nama         : {{ $tagihan->pelanggan->nama_kk }}</p>
<p>No Sambungan : {{ $tagihan->pelanggan->no_sambungan }}</p>

<p>
Periode :
{{ \Carbon\Carbon::create()->month($tagihan->bulan)->translatedFormat('F') }}
{{ $tagihan->tahun }}
</p>

<hr>

<p>Meter Awal   : {{ $tagihan->meter->meter_awal }}</p>
<p>Meter Akhir  : {{ $tagihan->meter->meter_akhir }}</p>
<p>Pemakaian    : {{ $tagihan->total_pemakaian }} m³</p>

<hr>

<p>Total Bayar  : Rp {{ number_format($tagihan->total_tagihan) }}</p>

<hr>

<center>
    <strong style="font-size:18px;">LUNAS</strong>
    <br><br>
    Terima Kasih 🙏
</center>

</body>
</html>
