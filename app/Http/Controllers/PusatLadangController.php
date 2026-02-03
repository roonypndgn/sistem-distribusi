<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PusatLadangController extends Controller
{
    /**
     * Menampilkan form input harga pembelian
     */
    public function dataLadang()
    {
        return view('pusat.data-ladang');
    }
    
}
