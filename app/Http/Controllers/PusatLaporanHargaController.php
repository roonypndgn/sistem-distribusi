<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PusatLaporanHargaController extends Controller
{
    /**
     * Menampilkan form input harga pembelian
     */
    public function dataHarga()
    {
        return view('pusat.laporan-harga');
    }
    
}
