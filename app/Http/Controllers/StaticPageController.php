<?php

namespace App\Http\Controllers;

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
        return view('customer.static.contact');
    }
}

