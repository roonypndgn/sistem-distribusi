<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PusatMonitoringController extends Controller
{
    /**
     * Menampilkan form input harga pembelian
     */
    public function dataMonitoring()
    {
        return view('pusat.monitoring-distribusi');
    }
    
}
