<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route untuk guest (belum login)
Route::middleware('guest')->group(function () {
    // GET: Tampilkan form login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    
    // POST: Proses login - nama route adalah 'login' (bukan 'login.post')
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

// Route untuk auth (sudah login)
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    
    // Redirect root berdasarkan role
    Route::get('/', function () {
        $user = auth()->user();
        
        switch($user->role) {
            case 'pusat':
                return redirect()->route('dashboard.pusat');
            case 'manajer':
                return redirect()->route('dashboard.manajer');
            case 'karyawan':
                return redirect()->route('dashboard.karyawan');
            case 'supir':
                return redirect()->route('dashboard.supir');
            default:
                return redirect('/home');
        }
    });
    
    // Dashboard routes
    Route::get('/dashboard/pusat', function () {
        return view('dashboard.pusat');
    })->name('dashboard.pusat')->middleware('checkRole:pusat');
    
    Route::get('/dashboard/manajer', function () {
        return view('dashboard.manajer');
    })->name('dashboard.manajer')->middleware('checkRole:manajer');
    
    Route::get('/dashboard/karyawan', function () {
        return view('dashboard.karyawan');
    })->name('dashboard.karyawan')->middleware('checkRole:karyawan');
    
    Route::get('/dashboard/supir', function () {
        return view('dashboard.supir');
    })->name('dashboard.supir')->middleware('checkRole:supir');
});

// Forgot password (opsional)
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

// Home fallback
Route::get('/home', function () {
    return 'Home Page';
});