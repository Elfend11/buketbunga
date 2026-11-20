<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\FileUploadSanitizerService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    protected FileUploadSanitizerService $fileService;

    public function __construct(FileUploadSanitizerService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * Tabel Master Produk Buket
     * Task ID: ARC-006 / UX-027
     */
    public function index(Request $request)
    {
        $query = Product::with('category')->latest();

        if ($request->filled('kategori')) {
            $query->where('category_id', $request->kategori);
        }

        if ($request->filled('q')) {
            $query->where('name', 'LIKE', '%' . $request->q . '%');
        }

        $products = $query->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        $imagePath = $this->fileService->storeImage($request->file('image'), 'products');

        Product::create([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']) . '-' . Str::random(4),
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image_path' => $imagePath,
            'is_available' => $request->boolean('is_available', true),
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk buket bunga baru berhasil ditambahkan!');
    }

    public function edit(int $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, int $id)
    {
        $product = Product::findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            $this->fileService->deleteImage($product->image_path);
            $product->image_path = $this->fileService->storeImage($request->file('image'), 'products');
        }

        $product->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'is_available' => $request->boolean('is_available', true),
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Data produk buket bunga berhasil diperbarui!');
    }

    /**
     * Mengubah Status Stok Ketersediaan Instan (Tersedia / Habis)
     */
    public function toggleStatus(int $id)
    {
        $product = Product::findOrFail($id);
        $product->is_available = !$product->is_available;
        $product->save();

        $statusLabel = $product->is_available ? 'Tersedia' : 'Habis';
        return back()->with('success', "Status produk [{$product->name}] diubah menjadi {$statusLabel}.");
    }

    /**
     * Menghapus Produk (Dibatasi jika ada riwayat pesanan)
     */
    public function destroy(int $id)
    {
        $product = Product::withCount('orderDetails')->findOrFail($id);

        if ($product->order_details_count > 0) {
            return back()->with('error', 'Produk ini tidak dapat dihapus karena memiliki riwayat transaksi pemesanan. Anda dapat mengubah statusnya menjadi Habis.');
        }

        $this->fileService->deleteImage($product->image_path);
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk buket bunga berhasil dihapus.');
    }
}

