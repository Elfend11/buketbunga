<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin — BLOOMÉ' }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="admin-body">
    <aside class="admin-sidebar">
        <a class="brand" href="{{ route('admin.dashboard') }}">BLOOMÉ</a>
        <nav class="admin-nav" aria-label="Navigasi admin">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.categories.index') }}">Kategori</a>
            <a href="{{ route('admin.products.index') }}">Produk</a>
            <a href="{{ route('admin.personalization.index') }}">Personalisasi</a>
            <a href="{{ route('admin.addons.index') }}">Add-on</a>
            <a href="{{ route('admin.settings.index') }}">Pengaturan</a>
        </nav>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button class="button button-secondary" type="submit">Keluar</button>
        </form>
    </aside>
    <main class="admin-main">
        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        @if(session('error'))<div class="alert alert-error">{{ session('error') }}</div>@endif
        @yield('content')
    </main>
</body>
</html>
