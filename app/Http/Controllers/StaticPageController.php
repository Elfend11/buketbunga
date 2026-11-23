<?php

namespace App\Http\Controllers;

use App\Models\BusinessSetting;

class StaticPageController extends Controller
{
    /**
     * Halaman Profil & Kisah Butik Artisan BLOOMÉ
     * Task ID: ARC-006 / UX-023
     */
    public function about()
    {
        return view('customer.static.about');
    }

    /**
     * Halaman Kontak, Peta Lokasi, Jam Operasional Butik
     * Task ID: ARC-006 / UX-024
     */
    public function contact()
    {
        $contact = [
            'address' => BusinessSetting::get('shop_address'),
            'hours' => BusinessSetting::get('operational_hours'),
            'whatsapp' => BusinessSetting::get('whatsapp_number'),
        ];

        return view('customer.static.contact', compact('contact'));
    }
}

