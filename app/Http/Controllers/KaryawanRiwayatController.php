<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KaryawanRiwayatController extends Controller
{
    /**
     * Menampilkan form input harga pembelian
     */
    public function dataRiwayat()
    {
        return view('karyawan.riwayat-kerja');
    }
    
}
