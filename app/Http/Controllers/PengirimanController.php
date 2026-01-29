<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    /**
     * Menampilkan form input harga pembelian
     */
    public function dataPengiriman()
    {
        return view('manajer.data-pengiriman');
    }
    
}
