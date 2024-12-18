<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // Menampilkan semua transaksi
    public function index()
    {
        $transaksi = Transaksi::all();
        return response()->json($transaksi);
    }

    // Menambahkan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'kode_transaksi' => 'required|unique:transaksis',
            'nama_barang' => 'required',
            'jumlah' => 'required|integer',
            'harga' => 'required|numeric',
        ]);

        // Menghitung total harga
        $total = $request->jumlah * $request->harga;

        $transaksi = Transaksi::create([
            'kode_transaksi' => $request->kode_transaksi,
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'total' => $total,
        ]);

        return response()->json($transaksi, 201);
    }

    // Menampilkan transaksi berdasarkan ID
    public function show($id)
    {
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        return response()->json($transaksi);
    }

    // Mengupdate transaksi berdasarkan ID
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'jumlah' => 'required|integer',
            'harga' => 'required|numeric',
        ]);

        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        // Mengupdate data transaksi
        $transaksi->nama_barang = $request->nama_barang;
        $transaksi->jumlah = $request->jumlah;
        $transaksi->harga = $request->harga;
        $transaksi->total = $request->jumlah * $request->harga;

        $transaksi->save();

        return response()->json($transaksi);
    }

    // Menghapus transaksi berdasarkan ID
    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        $transaksi->delete();

        return response()->json(['message' => 'Transaksi berhasil dihapus']);
    }
}
