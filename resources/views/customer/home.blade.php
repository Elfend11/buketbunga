@extends('layouts.app')

@section('content')
<section class="hero">
    <div class="container">
        <h1>BLOOMÉ — Flowers & Stories</h1>
        <p>Katalog buket dan personalisasi untuk momen istimewa.</p>
        <a class="button" href="{{ route('catalog.index') }}">Lihat Katalog</a>
    </div>
</section>
<section class="container" style="padding-top:32px">
    <h2>Kategori</h2>
    <div class="grid">
        @forelse($categories as $category)
            <article class="card">
                <h3>{{ $category->name }}</h3>
                <p>{{ $category->description }}</p>
            </article>
        @empty
            <p>Belum ada kategori yang terdaftar.</p>
        @endforelse
    </div>
</section>
<section class="container" style="padding-top:32px">
    <h2>Buket Unggulan</h2>
    <div class="grid">
        @forelse($featuredProducts as $product)
            <article class="card">
                <h3>{{ $product->name }}</h3>
                <p>Rp {{ number_format((float) $product->price, 0, ',', '.') }}</p>
                <a href="{{ route('catalog.show', $product->slug) }}">Lihat detail</a>
            </article>
        @empty
            <p>Belum ada produk yang tersedia.</p>
        @endforelse
    </div>
</section>
@endsection
