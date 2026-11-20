<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan Landing Page Butik BLOOMÉ
     * Task ID: ARC-006 / UX-014
     */
    public function index()
    {
        // 6 produk buket unggulan yang sedang aktif
        $featuredProducts = Product::available()
            ->with('category')
            ->latest()
            ->take(6)
            ->get();

        // Kategori buket untuk showcase
        $categories = Category::withCount('products')->get();

        return view('customer.home', compact('featuredProducts', 'categories'));
    }
}

