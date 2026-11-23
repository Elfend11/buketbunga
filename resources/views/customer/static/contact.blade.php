@extends('layouts.app')
@section('content')
<section class="page-header"><div class="container"><h1>Kontak</h1></div></section>
<section class="container" style="padding-top:32px">
    @if($contact['address'])<p><strong>Alamat:</strong> {{ $contact['address'] }}</p>@endif
    @if($contact['hours'])<p><strong>Jam operasional:</strong> {{ $contact['hours'] }}</p>@endif
    @if(!$contact['address'] && !$contact['hours'])<p>Informasi kontak resmi belum dikonfigurasi.</p>@endif
</section>
@endsection
