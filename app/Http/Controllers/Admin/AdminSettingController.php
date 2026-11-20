<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminSettingController extends Controller
{
    /**
     * Halaman Pengaturan Profil Admin & Konfigurasi Toko
     * Task ID: ARC-006 / UX-039
     */
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.settings.index', compact('admin'));
    }

    /**
     * Memperbarui Kata Sandi & Nama Profil Admin
     */
    public function update(Request $request)
    {
        $admin = Admin::findOrFail(Auth::guard('admin')->id());

        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'current_password' => ['nullable', 'required_with:new_password', 'string'],
            'new_password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $admin->name = $request->name;

        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $admin->password)) {
                return back()->withErrors(['current_password' => 'Kata sandi saat ini tidak cocok.']);
            }
            $admin->password = Hash::make($request->new_password);
        }

        $admin->save();

        return back()->with('success', 'Pengaturan profil admin berhasil diperbarui!');
    }
}

