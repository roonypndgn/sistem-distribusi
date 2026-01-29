<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetaniController extends Controller
{
    /**
     * Menampilkan form input harga pembelian
     */
    public function dataPetani()
    {
        return view('manajer.data-petani');
    }
    
}
