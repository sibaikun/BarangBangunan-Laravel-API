<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class RiwayatTransaksiController extends Controller
{
    // Menampilkan semua transaksi
    public function index()
    {
        $transaksi = Transaksi::orderBy('created_at', 'desc')->get();

        // Jika tidak ada data transaksi
        if ($transaksi->isEmpty()) {
            return response()->json(['message' => 'Tidak ada transaksi yang ditemukan'], 404);
        }

        // Kembalikan data dalam bentuk JSON
        return response()->json($transaksi, 200);
    }

    // Menampilkan transaksi berdasarkan ID
    public function show($id)
    {
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        return response()->json($transaksi, 200);
    }
}
