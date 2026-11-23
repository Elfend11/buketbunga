@extends('layouts.admin')
@section('content')
<h1>Pengaturan</h1>
<form class="form-grid" method="POST" action="{{ route('admin.settings.update') }}">
@csrf @method('PUT')
<label>Nama<input name="name" value="{{ old('name', $admin->name) }}" required></label>
<label>Kata sandi saat ini<input type="password" name="current_password"></label>
<label>Kata sandi baru<input type="password" name="new_password"></label>
<label>Konfirmasi kata sandi baru<input type="password" name="new_password_confirmation"></label>
<label>Nomor WhatsApp resmi<input name="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number']) }}" placeholder="Kosongkan jika nomor belum dikonfirmasi"></label>
<label>Alamat toko<textarea name="shop_address">{{ old('shop_address', $settings['shop_address']) }}</textarea></label>
<label>Jam operasional<input name="operational_hours" value="{{ old('operational_hours', $settings['operational_hours']) }}"></label>
<button class="button" type="submit">Simpan Pengaturan</button>
</form>
@endsection
