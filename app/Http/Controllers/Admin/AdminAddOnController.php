<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AddOn;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminAddOnController extends Controller
{
    public function index()
    {
        $addOns = AddOn::with('products')->latest()->get();
        $products = Product::orderBy('name')->get();
        return view('admin.addons.index', compact('addOns', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string', 'max:500'],
            'is_available' => ['nullable', 'boolean'],
            'product_ids' => ['nullable', 'array'],
            'product_ids.*' => ['integer', 'exists:products,id'],
        ]);

        $addOn = AddOn::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'] ?? null,
            'is_available' => $request->boolean('is_available'),
        ]);

        $addOn->products()->sync($validated['product_ids'] ?? []);
        return back()->with('success', 'Add-on berhasil ditambahkan.');
    }

    public function destroy(int $id)
    {
        AddOn::findOrFail($id)->delete();
        return back()->with('success', 'Add-on berhasil dihapus.');
    }
}
