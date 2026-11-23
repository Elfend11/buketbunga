<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\BusinessSetting;
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
        $settings = [
            'whatsapp_number' => BusinessSetting::get('whatsapp_number'),
            'shop_address' => BusinessSetting::get('shop_address'),
            'operational_hours' => BusinessSetting::get('operational_hours'),
        ];
        return view('admin.settings.index', compact('admin', 'settings'));
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
            'whatsapp_number' => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\s-]+$/'],
            'shop_address' => ['nullable', 'string', 'max:500'],
            'operational_hours' => ['nullable', 'string', 'max:255'],
        ]);

        $admin->name = $request->name;

        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $admin->password)) {
                return back()->withErrors(['current_password' => 'Kata sandi saat ini tidak cocok.']);
            }
            $admin->password = Hash::make($request->new_password);
        }

        $admin->save();

        BusinessSetting::set(
            'whatsapp_number',
            $request->filled('whatsapp_number') ? $request->whatsapp_number : null,
            'contact'
        );
        BusinessSetting::set(
            'shop_address',
            $request->filled('shop_address') ? $request->shop_address : null,
            'contact'
        );
        BusinessSetting::set(
            'operational_hours',
            $request->filled('operational_hours') ? $request->operational_hours : null,
            'general'
        );

        return back()->with('success', 'Pengaturan profil admin berhasil diperbarui!');
    }
}

