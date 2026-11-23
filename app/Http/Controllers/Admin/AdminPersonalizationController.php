<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersonalizationOption;
use App\Models\PersonalizationValue;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminPersonalizationController extends Controller
{
    public function index()
    {
        $options = PersonalizationOption::with(['values', 'products'])->latest()->get();
        $products = Product::orderBy('name')->get();
        return view('admin.personalization.index', compact('options', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'type' => ['required', 'in:select,radio,color_swatch'],
            'is_required' => ['nullable', 'boolean'],
            'product_ids' => ['nullable', 'array'],
            'product_ids.*' => ['integer', 'exists:products,id'],
        ]);

        $option = PersonalizationOption::create([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'is_required' => $request->boolean('is_required'),
        ]);

        $option->products()->sync($validated['product_ids'] ?? []);
        return back()->with('success', 'Opsi personalisasi berhasil ditambahkan.');
    }

    public function storeValue(Request $request, int $optionId)
    {
        $option = PersonalizationOption::findOrFail($optionId);
        $validated = $request->validate([
            'value_name' => ['required', 'string', 'max:100'],
            'additional_price' => ['required', 'numeric', 'min:0'],
            'color_hex' => ['nullable', 'string', 'max:20'],
            'is_available' => ['nullable', 'boolean'],
        ]);

        PersonalizationValue::create([
            'option_id' => $option->id,
            'value_name' => $validated['value_name'],
            'additional_price' => $validated['additional_price'],
            'color_hex' => $validated['color_hex'] ?? null,
            'is_available' => $request->boolean('is_available'),
        ]);

        return back()->with('success', 'Nilai personalisasi berhasil ditambahkan.');
    }

    public function destroy(int $optionId)
    {
        PersonalizationOption::findOrFail($optionId)->delete();
        return back()->with('success', 'Opsi personalisasi berhasil dihapus.');
    }
}
