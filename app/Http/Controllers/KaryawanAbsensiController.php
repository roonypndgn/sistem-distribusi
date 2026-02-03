<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KaryawanAbsensiController extends Controller
{
    /**
     * Menampilkan form input harga pembelian
     */
    public function dataAbsensi()
    {
        return view('karyawan.data-absensi');
    }
    
}
