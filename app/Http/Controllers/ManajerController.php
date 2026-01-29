<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManajerController extends Controller
{
    /**
     * Menampilkan form input harga pembelian
     */
    public function hargaPembelian()
    {
        // Jika tidak ada database, tampilkan form kosong
        return view('manajer.harga-pembelian');
    }
    
    /**
     * Menyimpan data harga pembelian (simpan ke localStorage di frontend)
     * Ini hanya contoh, karena tidak pakai database
     */
    public function simpanHargaPembelian(Request $request)
    {
        // Jika menggunakan database, ini tempat menyimpan data
        // Tapi karena tidak pakai database, kita hanya tampilkan pesan
        
        $validated = $request->validate([
            'tanggal_beli' => 'required|date',
            'nama_petani' => 'required|string|max:255',
            'alamat_petani' => 'required|string',
            'nama_ladang' => 'required|string|max:255',
            'harga_per_kg' => 'required|numeric|min:1000|max:50000',
            'jumlah_kg' => 'required|numeric|min:0.1|max:10000',
            'kualitas' => 'required|in:A,B,C',
            'jenis_jeruk' => 'required|string',
            'catatan' => 'nullable|string'
        ]);
        
        // Jika ada upload file
        if ($request->hasFile('bukti_foto')) {
            // Proses upload file di sini
        }
        
        // Redirect dengan pesan sukses
        return redirect()->route('manajer.harga-pembelian')
            ->with('success', 'Data pembelian berhasil disimpan!');
    }
}