<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengemasanController extends Controller
{
    /**
     * Menampilkan form input harga pembelian
     */
    public function dataPengemasan()
    {
        return view('manajer.data-pengemasan');
    }
    
}
