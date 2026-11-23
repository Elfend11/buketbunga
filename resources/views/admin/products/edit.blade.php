@extends('layouts.admin')
@section('content')
<h1>Edit Produk</h1>
<form class="form-grid" method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
@csrf @method('PUT')
<label>Kategori<select name="category_id" required>@foreach($categories as $category)<option value="{{ $category->id }}" @selected($product->category_id == $category->id)>{{ $category->name }}</option>@endforeach</select></label>
<label>Nama<input name="name" value="{{ old('name', $product->name) }}" required></label>
<label>Harga Dasar<input type="number" name="price" value="{{ old('price', $product->price) }}" min="1000" required></label>
<label>Deskripsi<textarea name="description" required>{{ old('description', $product->description) }}</textarea></label>
<label>Foto Baru (opsional)<input type="file" name="image" accept="image/jpeg,image/png,image/webp"></label>
<label><input type="checkbox" name="is_available" value="1" @checked($product->is_available)>Tersedia</label>
<button class="button" type="submit">Simpan Perubahan</button>
</form>
@endsection
