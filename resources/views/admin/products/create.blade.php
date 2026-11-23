@extends('layouts.admin')
@section('content')
<h1>Tambah Produk</h1>
<form class="form-grid" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
@csrf
<label>Kategori<select name="category_id" required>@foreach($categories as $category)<option value="{{ $category->id }}">{{ $category->name }}</option>@endforeach</select></label>
<label>Nama<input name="name" value="{{ old('name') }}" required></label>
<label>Harga Dasar<input type="number" name="price" value="{{ old('price') }}" min="1000" required></label>
<label>Deskripsi<textarea name="description" required>{{ old('description') }}</textarea></label>
<label>Foto Utama<input type="file" name="image" accept="image/jpeg,image/png,image/webp" required></label>
<label><input type="checkbox" name="is_available" value="1" checked>Tersedia</label>
<button class="button" type="submit">Simpan</button>
</form>
@endsection
