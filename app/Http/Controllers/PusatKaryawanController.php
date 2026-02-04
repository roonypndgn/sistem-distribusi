<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PusatKaryawanController extends Controller
{
    /**
     * Menampilkan form input harga pembelian
     */
    public function dataKaryawan()
    {
        return view('pusat.data-karyawan');
    }
    
}
