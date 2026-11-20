<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    /**
     * Menampilkan Formulir Login Admin (Nabila Febriyani)
     * Task ID: ARC-006 / UX-025
     */
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    /**
     * Otentikasi Kredensial Admin dengan Bcrypt & Regenerasi Sesi Aman
     * Task ID: ARC-006 / BE-014
     */
    public function login(AdminLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            // Regenerasi ID sesi untuk mencegah Session Fixation (SEC-001)
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Selamat datang kembali, Kak Nabila!');
        }

        return back()->withErrors([
            'email' => 'Kombinasi email dan kata sandi tidak cocok dengan data terdaftar.',
        ])->onlyInput('email');
    }

    /**
     * Logout Admin & Invalidation Sesi
     * Task ID: ARC-006 / BE-016
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('info', 'Anda telah berhasil keluar dari sesi admin.');
    }
}

