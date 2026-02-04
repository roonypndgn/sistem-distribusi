<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PusatAnalitikHargaController extends Controller
{
    /**
     * Menampilkan form input harga pembelian
     */
    public function dataAnalitikHarga()
    {
        return view('pusat.analitik-harga');
    }
    
}
