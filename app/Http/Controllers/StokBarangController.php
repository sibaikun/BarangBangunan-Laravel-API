<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class StokBarangController extends Controller
{
    // Update stok barang
    public function updateStok(Request $request, $kode_barang)
    {
        // Validasi input
        $request->validate([
            'stok' => 'required|integer|min:0',
        ]);

        // Cari barang berdasarkan kode_barang
        $barang = Barang::where('kode_barang', $kode_barang)->first();

        if (!$barang) {
            return response()->json(['message' => 'Barang tidak ditemukan'], 404);
        }

        // Update stok
        $barang->stok = $request->stok;
        $barang->save();

        return response()->json([
            'message' => 'Stok barang berhasil diperbarui',
            'data' => $barang,
        ]);
    }
}
