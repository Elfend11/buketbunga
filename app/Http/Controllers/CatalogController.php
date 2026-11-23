<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\PriceEstimatorService;
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
        $product = Product::with([
            'category',
            'images',
            'personalizationOptions.values' => function ($query) {
                $query->where('is_available', true);
            },
            'addOns' => function ($query) {
                $query->where('is_available', true);
            },
        ])->where('slug', $slug)->firstOrFail();

        // 3 rekomendasi buket serupa dari kategori yang sama
        $relatedProducts = Product::available()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(3)
            ->get();

        return view('customer.catalog.show', compact('product', 'relatedProducts'));
    }

    public function estimate(
        Request $request,
        PriceEstimatorService $estimator,
        string $slug
    ) {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'option_value_ids' => ['nullable', 'array'],
            'option_value_ids.*' => ['integer'],
            'add_on_ids' => ['nullable', 'array'],
            'add_on_ids.*' => ['integer'],
        ]);

        $estimation = $estimator->estimate(
            $product,
            $validated['option_value_ids'] ?? [],
            $validated['add_on_ids'] ?? []
        );

        return response()->json($estimation);
    }
}

