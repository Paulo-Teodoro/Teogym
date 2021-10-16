@extends('auth._theme')
@section('content')
<section class="forget-one">
    <img src="{{ asset('img/think.jpg') }}" class="img-fluid"/>
</section>
<section class="forget-two">
    <div class="ajax_response"></div>
    <h1>Esqueceu a senha?</h1>
    <h5>Fique tranquilo! Informe seu e-mail para continuar.</h5>
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <form class="forget-form" method="POST" action="{{ route('password.email') }}">
        @csrf

        <input class="form-control" type="email" name="email" :value="old('email')" placeholder="e-mail" required>
        <button type="submit" class="btn btn-block btn-primary">Enviar</button>
    </form>
</section>
@endsection