<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
      public function index()
    {
        $pelanggan = Pelanggan::latest()->get();
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        
        return view('pelanggan.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'no_sambungan' => 'required|unique:pelanggan,no_sambungan',
        'nama_kk'      => 'required|string|max:100',
        'alamat'       => 'required|string',
        'rt'           => 'required|numeric',
        'rw'           => 'required|numeric',
        'status'       => 'required|in:aktif,nonaktif',
    ]);

    Pelanggan::create([
        'no_sambungan' => $request->no_sambungan,
        'nama_kk'      => $request->nama_kk,
        'alamat'       => $request->alamat,
        'rt'           => $request->rt,
        'rw'           => $request->rw,
        'status'       => $request->status,
    ]);

    return redirect()->route('pelanggan.index')
        ->with('success', 'Pelanggan berhasil ditambahkan');
    }

    public function edit(Pelanggan $pelanggan)
{
    return view('pelanggan.edit', compact('pelanggan'));
}

public function update(Request $request, Pelanggan $pelanggan)
{
    $request->validate([
        'no_sambungan' => 'required|unique:pelanggan,no_sambungan,' . $pelanggan->id,
        'nama_kk'      => 'required|string|max:100',
        'alamat'       => 'required|string',
        'rt'           => 'required',
        'rw'           => 'required',
        'status'       => 'required',
    ]);

    $pelanggan->update([
        'no_sambungan' => $request->no_sambungan,
        'nama_kk'      => $request->nama_kk,
        'alamat'       => $request->alamat,
        'rt'           => $request->rt,
        'rw'           => $request->rw,
        'status'       => $request->status,
    ]);

    return redirect()->route('pelanggan.index')
        ->with('success', 'Data pelanggan berhasil diperbarui');
    }

   
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return back()->with('success','Pelanggan dihapus');
    }
}
