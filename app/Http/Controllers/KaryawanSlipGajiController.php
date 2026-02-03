<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KaryawanSlipGajiController extends Controller
{
    /**
     * Menampilkan form input harga pembelian
     */
    public function dataGaji()
    {
        return view('karyawan.slip-gaji');
    }
    
}
