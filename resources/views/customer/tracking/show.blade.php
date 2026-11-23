@extends('layouts.app')
@section('content')
<section class="container" style="padding-top:32px"><h1>Ringkasan Pesanan</h1><p>Kode: {{ $order->order_code }}</p>@if($waLink)<a class="button" href="{{ $waLink }}">Hubungi via WhatsApp</a>@endif</section>
@endsection
