@extends('layouts.admin')
@section('content')
<h1>Add-on</h1>
<form class="form-grid" method="POST" action="{{ route('admin.addons.store') }}">
@csrf
<label>Nama<input name="name" required></label>
<label>Harga<input type="number" name="price" min="0" required></label>
<label>Deskripsi<textarea name="description"></textarea></label>
<label><input type="checkbox" name="is_available" value="1" checked>Tersedia</label>
<fieldset><legend>Produk terkait</legend>@foreach($products as $product)<label><input type="checkbox" name="product_ids[]" value="{{ $product->id }}"> {{ $product->name }}</label>@endforeach</fieldset>
<button class="button" type="submit">Tambah Add-on</button>
</form>
<div class="grid" style="margin-top:24px">
@foreach($addOns as $addOn)
<article class="card"><h2>{{ $addOn->name }}</h2><p>Rp {{ number_format((float) $addOn->price, 0, ',', '.') }}</p><form method="POST" action="{{ route('admin.addons.destroy', $addOn->id) }}">@csrf @method('DELETE')<button class="button button-secondary" type="submit">Hapus</button></form></article>
@endforeach
</div>
@endsection
