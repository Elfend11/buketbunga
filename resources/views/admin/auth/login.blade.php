@extends('layouts.app')
@section('content')
<section class="container" style="max-width:480px;padding-top:48px">
    <h1>Login Admin</h1>
    @if($errors->any())
        <div class="alert alert-error">{{ $errors->first() }}</div>
    @endif
    <form class="form-grid" method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <label>Email
            <input type="email" name="email" value="{{ old('email') }}" required>
        </label>
        <label>Password
            <input type="password" name="password" required>
        </label>
        <label><input type="checkbox" name="remember" value="1"> Ingat saya</label>
        <button class="button" type="submit">Masuk</button>
    </form>
</section>
@endsection
