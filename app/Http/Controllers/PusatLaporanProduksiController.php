<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PusatLaporanProduksiController extends Controller
{
    /**
     * Menampilkan form input harga pembelian
     */
    public function dataProduksi()
    {
        return view('pusat.laporan-produksi');
    }
    
}
