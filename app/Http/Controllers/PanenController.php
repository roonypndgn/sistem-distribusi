<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanenController extends Controller
{
    /**
     * Menampilkan form input harga pembelian
     */
    public function dataPanen()
    {
        return view('manajer.data-panen');
    }
    
}
