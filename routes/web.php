<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PanenController;
use App\Http\Controllers\PengemasanController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\StatusDistribusiController;
use App\Http\Controllers\CuacaController;
use App\Http\Controllers\PetaniController;
use App\Http\Controllers\LadangController;
use App\Http\Controllers\KaryawanAbsensiController;
use App\Http\Controllers\KaryawanRiwayatController;
use App\Http\Controllers\KaryawanSlipGajiController;
use App\Http\Controllers\SupirDaftarPengirimanController;
use App\Http\Controllers\SupirRiwayatPengirimanController;
use App\Http\Controllers\PusatLadangController;
use App\Http\Controllers\PusatPetaniController;
use App\Http\Controllers\PusatKendaraanController;
use App\Http\Controllers\PusatKaryawanController;
use App\Http\Controllers\PusatMonitoringController;
use App\Http\Controllers\PusatManajemenUserController;


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
Route::middleware(['auth'])->group(function () {
    Route::prefix('manajer')->group(function () {
        Route::get('/harga-pembelian', [PembelianController::class, 'hargaPembelian'])->name('manajer.harga-pembelian');
        Route::post('/harga-pembelian', [PembelianController::class, 'simpanHargaPembelian'])->name('manajer.simpan-harga-pembelian');
        Route::get('/data-panen',[PanenController::class, 'dataPanen'])->name('manajer.data-panen');
        Route::get('/data-pengemasan',[PengemasanController::class, 'dataPengemasan'])->name('manajer.data-pengemasan');
        Route::get('/data-pengiriman',[PengirimanController::class, 'dataPengiriman'])->name('manajer.data-pengiriman');
        Route::get('/status-distribusi',[StatusDistribusiController::class, 'dataStatus'])->name('manajer.status-distribusi');
        Route::get('/laporan-cuaca',[CuacaController::class, 'dataCuaca'])->name('manajer.laporan-cuaca');
        Route::get('/data-petani',[PetaniController::class, 'dataPetani'])->name('manajer.data-petani');
        Route::get('/data-ladang',[LadangController::class, 'dataLadang'])->name('manajer.data-ladang');
        
    });
});
//Karyawan
Route::middleware(['auth'])->group(function () {
    Route::prefix('karyawan')->group(function () {
        Route::get('/data-absensi', [KaryawanAbsensiController::class, 'dataAbsensi'])->name('karyawan.data-absensi');
        Route::get('/riwayat-kerja', [KaryawanRiwayatController::class, 'dataRiwayat'])->name('karyawan.riwayat-kerja');
        Route::get('/slip-gaji', [KaryawanSlipGajiController::class, 'dataGaji'])->name('karyawan.slip-gaji');
    });
});
//Supir
Route::middleware(['auth'])->group(function () {
    Route::prefix('supir')->group(function () {
        Route::get('/daftar-pengiriman', [SupirDaftarPengirimanController::class, 'daftarPengiriman'])->name('supir.daftar-pengiriman');
        Route::get('/riwayat-pengiriman', [SupirRiwayatPengirimanController::class, 'daftarRiwayat'])->name('supir.riwayat-pengiriman');
    
    });
});
//Pusat
Route::middleware(['auth'])->group(function () {
    Route::prefix('pusat')->group(function () {
        Route::get('/data-petani', [PusatPetaniController::class, 'dataPetani'])->name('pusat.data-petani');
        Route::get('/data-ladang', [PusatLadangController::class, 'dataLadang'])->name('pusat.data-ladang');
        Route::get('/data-kendaraan', [PusatKendaraanController::class, 'dataKendaraan'])->name('pusat.data-kendaraan');
        Route::get('/data-karyawan', [PusatKaryawanController::class, 'dataKaryawan'])->name('pusat.data-karyawan');
        Route::get('/monitoring-distribusi', [PusatMonitoringController::class, 'dataMonitoring'])->name('pusat.monitoring-distribusi');
        Route::get('/manajemen-pengguna', [PusatManajemenUserController::class, 'dataUser'])->name('pusat.manajemen-pengguna');
    
    });
});


// Forgot password (opsional)
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

// Home fallback
Route::get('/home', function () {
    return 'Home Page';
});