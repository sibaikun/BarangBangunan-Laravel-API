<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function store(Request $request)
    {
        $barang = Barang::create([
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
        ]);

        return response()->json([
            'message' => 'Data barang berhasil disimpan',
            'data' => $barang
        ], 201);
    }

    public function updateJumlah(Request $request, $id)
{
    $request->validate([
        'jumlah' => 'required|integer|min:0',
    ]);

    $barang = Barang::find($id);

    if (!$barang) {
        return response()->json(['message' => 'Barang tidak ditemukan'], 404);
    }

    $barang->jumlah = $request->jumlah;
    $barang->save();

    return response()->json([
        'message' => 'Jumlah barang berhasil diperbarui',
        'data' => $barang,
    ]);
}


}