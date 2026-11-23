@extends('layouts.app')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Katalog Buket</h1>
    </div>
</section>
<section class="container" style="padding-top:32px">
    <form method="GET">
        <label>Kategori
            <select name="kategori">
                <option value="">Semua kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->slug }}" @selected(request('kategori') === $category->slug)>{{ $category->name }}</option>
                @endforeach
            </select>
        </label>
        <button class="button" type="submit">Terapkan</button>
    </form>
    <div class="grid" style="margin-top:20px">
        @forelse($products as $product)
            <article class="card">
                <h2>{{ $product->name }}</h2>
                <p>{{ $product->category->name }}</p>
                <p>Rp {{ number_format((float) $product->price, 0, ',', '.') }}</p>
                <a href="{{ route('catalog.show', $product->slug) }}">Lihat detail</a>
            </article>
        @empty
            <p>Tidak ada produk yang cocok.</p>
        @endforelse
    </div>
    {{ $products->links() }}
</section>
@endsection
