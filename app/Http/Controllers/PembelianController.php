<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Menampilkan form input harga pembelian
     */
    public function hargaPembelian()
    {
        return view('manajer.harga-pembelian');
    }
    
}
