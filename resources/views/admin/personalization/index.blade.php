@extends('layouts.admin')
@section('content')
<h1>Personalisasi</h1>
<form class="form-grid" method="POST" action="{{ route('admin.personalization.store') }}">
@csrf
<label>Nama opsi<input name="name" required></label>
<label>Tipe<select name="type"><option value="select">Select</option><option value="radio">Radio</option><option value="color_swatch">Color swatch</option></select></label>
<label><input type="checkbox" name="is_required" value="1"> Wajib</label>
<fieldset><legend>Produk terkait</legend>@foreach($products as $product)<label><input type="checkbox" name="product_ids[]" value="{{ $product->id }}"> {{ $product->name }}</label>@endforeach</fieldset>
<button class="button" type="submit">Tambah Opsi</button>
</form>
@foreach($options as $option)
<article class="card" style="margin-top:24px">
<h2>{{ $option->name }}</h2>
<form class="form-grid" method="POST" action="{{ route('admin.personalization.values.store', $option->id) }}">
@csrf
<label>Nama nilai<input name="value_name" required></label>
<label>Harga tambahan<input type="number" name="additional_price" min="0" value="0" required></label>
<label>Kode warna (opsional)<input name="color_hex" placeholder="#E99AAF"></label>
<label><input type="checkbox" name="is_available" value="1" checked>Tersedia</label>
<button class="button" type="submit">Tambah Nilai</button>
</form>
<form method="POST" action="{{ route('admin.personalization.destroy', $option->id) }}">@csrf @method('DELETE')<button class="button button-secondary" type="submit">Hapus Opsi</button></form>
</article>
@endforeach
@endsection
