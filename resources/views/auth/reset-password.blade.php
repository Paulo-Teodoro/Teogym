@extends('auth._theme')
@section('content')
    <section class="forget-one">
        <img src="{{ asset('img/reset.jpg') }}" class="img-fluid img-reset"/>
    </section>
    <section class="forget-two">
        <h1>Crie uma nova senha</h1>
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form class="forget-form" method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <label>Email:</label>
            <input class="form-control" type="email" name="email" value="{{ old('email', $request->email) }}" required>

            <label>Nova senha:</label>
            <input class="form-control" type="password" name="password" placeholder="Nova senha:">
            <label>Repita a senha:</label>
            <input class="form-control" type="password" name="password_confirmation" placeholder="Repita a senha:">
            <button type="submit" class="btn btn-block btn-primary">Criar nova senha</button>
        </form>
    </section>
@endsection


