<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupirDaftarPengirimanController extends Controller
{
    /**
     * Menampilkan form input harga pembelian
     */
    public function daftarPengiriman()
    {
        return view('supir.daftar-pengiriman');
    }
    
}
