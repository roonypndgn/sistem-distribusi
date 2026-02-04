<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PusatManajemenUserController extends Controller
{
    /**
     * Menampilkan form input harga pembelian
     */
    public function dataUser()
    {
        return view('pusat.manajemen-pengguna');
    }
    
}
