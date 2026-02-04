<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PusatLaporanPengirimanController extends Controller
{
    /**
     * Menampilkan form input harga pembelian
     */
    public function dataPengiriman()
    {
        return view('pusat.laporan-pengiriman');
    }
    
}
