<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LadangController extends Controller
{
    /**
     * Menampilkan form input harga pembelian
     */
    public function dataLadang()
    {
        return view('manajer.data-ladang');
    }
    
}
