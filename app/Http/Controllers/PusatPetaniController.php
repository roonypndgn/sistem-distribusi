<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PusatPetaniController extends Controller
{
    /**
     * Menampilkan form input harga pembelian
     */
    public function dataPetani()
    {
        return view('pusat.data-petani');
    }
    
}
