@extends('layouts.app')
@section('content')
<section class="container" style="padding-top:32px"><h1>Ringkasan</h1><p>Kode: {{ $order->order_code }}</p>@if($waLink)<a class="button" href="{{ $waLink }}">Lanjutkan ke WhatsApp</a>@else<p>Tautan WhatsApp belum dikonfigurasi oleh admin.</p>@endif</section>
@endsection
