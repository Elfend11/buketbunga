@extends('layouts.admin')
@section('content')
<div style="display:flex;justify-content:space-between;align-items:center">
    <h1>Produk</h1><a class="button" href="{{ route('admin.products.create') }}">Tambah Produk</a>
</div>
<div class="table-wrap">
<table><thead><tr><th>Nama</th><th>Kategori</th><th>Harga</th><th>Ketersediaan</th><th>Aksi</th></tr></thead>
<tbody>
@foreach($products as $product)
<tr>
    <td>{{ $product->name }}</td><td>{{ $product->category->name }}</td>
    <td>Rp {{ number_format((float) $product->price, 0, ',', '.') }}</td>
    <td>{{ $product->is_available ? 'Tersedia' : 'Habis' }}</td>
    <td>
        <a href="{{ route('admin.products.edit', $product->id) }}">Edit</a>
        <form method="POST" action="{{ route('admin.products.toggle', $product->id) }}" style="display:inline">@csrf @method('PATCH')<button type="submit">Toggle</button></form>
    </td>
</tr>
@endforeach
</tbody></table></div>
{{ $products->links() }}
@endsection
