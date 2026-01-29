<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'role' => 'required|in:pusat,manajer,karyawan,petani',
        ]);

        // Cek apakah user ada dengan email
        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak ditemukan.',
            ])->withInput($request->only('email', 'role'));
        }

        // Cek apakah role sesuai
        if ($user->role !== $request->role) {
            return back()->withErrors([
                'role' => 'Peran tidak sesuai dengan akun ini.',
            ])->withInput($request->only('email', 'role'));
        }

        // Coba login
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $request->boolean('remember'))) {
            
            $request->session()->regenerate();
            
            // Redirect berdasarkan role
            return $this->redirectBasedOnRole($user->role);
        }

        // Jika password salah
        return back()->withErrors([
            'password' => 'Password salah.',
        ])->withInput($request->only('email', 'role', 'remember'));
    }

    /**
     * Redirect berdasarkan role user
     */
    private function redirectBasedOnRole($role)
    {
        switch ($role) {
            case 'pusat':
                return redirect()->route('dashboard.pusat');
            case 'manajer':
                return redirect()->route('dashboard.manajer');
            case 'karyawan':
                return redirect()->route('dashboard.karyawan');
            case 'petani':
                return redirect()->route('dashboard.petani');
            default:
                return redirect('/home');
        }
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}