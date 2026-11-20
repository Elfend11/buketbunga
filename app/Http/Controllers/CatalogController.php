<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Menampilkan Seluruh Etalase Katalog Produk dengan Filter Kategori & Pengurutan
     * Task ID: ARC-006 / UX-015
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Product::with('category');

        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        // Pengurutan harga / terbaru
        $sort = $request->get('sort', 'terbaru');
        match ($sort) {
            'termurah' => $query->orderBy('price', 'asc'),
            'termahal' => $query->orderBy('price', 'desc'),
            default => $query->latest(),
        };

        $products = $query->paginate(9)->withQueryString();

        return view('customer.catalog.index', compact('products', 'categories'));
    }

    /**
     * Menampilkan Detail Spesifikasi Bunga, Harga, dan Ketersediaan
     * Task ID: ARC-006 / UX-016
     */
    public function show(string $slug)
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();

        // 3 rekomendasi buket serupa dari kategori yang sama
        $relatedProducts = Product::available()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(3)
            ->get();

        return view('customer.catalog.show', compact('product', 'relatedProducts'));
    }
}

