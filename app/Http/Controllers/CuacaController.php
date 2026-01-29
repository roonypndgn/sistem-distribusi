<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CuacaController extends Controller
{
    /**
     * Menampilkan form input harga pembelian
     */
    public function dataCuaca()
    {
        return view('manajer.laporan-cuaca');
    }
    
}
