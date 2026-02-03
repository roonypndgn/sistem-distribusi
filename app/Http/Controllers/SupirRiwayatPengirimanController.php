<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupirRiwayatPengirimanController extends Controller
{
    /**
     * Menampilkan form input harga pembelian
     */
    public function daftarRiwayat()
    {
        return view('supir.riwayat-pengiriman');
    }
    
}
