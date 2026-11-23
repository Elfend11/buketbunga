@extends('layouts.admin')
@section('content')
<h1>Kategori</h1>
<form class="form-grid" method="POST" action="{{ route('admin.categories.store') }}">
    @csrf
    <label>Nama<input name="name" value="{{ old('name') }}" required></label>
    <label>Deskripsi<textarea name="description">{{ old('description') }}</textarea></label>
    <button class="button" type="submit">Tambah kategori</button>
</form>
<div class="table-wrap" style="margin-top:24px">
<table><thead><tr><th>Nama</th><th>Produk</th><th>Aksi</th></tr></thead>
<tbody>
@foreach($categories as $category)
<tr>
    <td>{{ $category->name }}</td><td>{{ $category->products_count }}</td>
    <td>
        <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" onsubmit="return confirm('Hapus kategori?')">
            @csrf @method('DELETE')<button class="button button-secondary" type="submit">Hapus</button>
        </form>
    </td>
</tr>
@endforeach
</tbody></table></div>
@endsection
