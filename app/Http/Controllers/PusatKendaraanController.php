<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PusatKendaraanController extends Controller
{
    /**
     * Menampilkan form input harga pembelian
     */
    public function dataKendaraan()
    {
        return view('pusat.data-kendaraan');
    }
    
}
