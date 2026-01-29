<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatusDistribusiController extends Controller
{
    /**
     * Menampilkan form input harga pembelian
     */
    public function dataStatus()
    {
        return view('manajer.status-distribusi');
    }
    
}
