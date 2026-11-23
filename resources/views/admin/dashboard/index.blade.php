@extends('layouts.admin')
@section('content')
<h1>Dashboard</h1>
<div class="grid">
    <article class="card"><h2>{{ $newOrdersTodayCount }}</h2><p>Pesanan hari ini</p></article>
    <article class="card"><h2>{{ $pendingVerificationCount }}</h2><p>Menunggu verifikasi</p></article>
    <article class="card"><h2>{{ $customNeedsPricingCount }}</h2><p>Perlu penentuan harga</p></article>
    <article class="card"><h2>Rp {{ number_format((float) $monthlyRevenue, 0, ',', '.') }}</h2><p>Pendapatan bulan ini</p></article>
</div>
@endsection
