@extends('layouts.app')
@section('content')
<section class="page-header"><div class="container"><h1>{{ $product->name }}</h1></div></section>
<section class="container" style="padding-top:32px"><p>Checkout internal bersifat legacy dan tidak menjadi alur WhatsApp utama. Lihat detail produk untuk estimasi dan konsultasi.</p><a class="button" href="{{ route('catalog.show', $product->slug) }}">Lihat Personalisasi</a></section>
@endsection
