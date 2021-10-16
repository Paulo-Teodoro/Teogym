@extends('auth._theme')
@section('content')

<section class="login-left">
    <article class="conteudo">
        <img class="img-fluid" src="{{ asset('img/logo.png') }}">
        <h1>
            Bem Vindo
        </h1>
        <h2>
            se prepare para o novo nível
        </h2>
    </article>
</section>
<section class="login-right">
    <article class="conteudo">
        <h3>Login</h3>
        <h5>Insira abaixo o seu email e senha</h5>
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <input id="user" class="form-control" type="email" name="email" :value="old('email')" Placeholder="Email" required autofocus />


            <input id="password" class="form-control" type="password" name="password" Placeholder="senha" aria-describedby="passwordHelpBlock" required />

            <button type="submit" class="btn">Logar-se</button>
            
            @if (Route::has('password.request'))
                <a class="btn btn-forget" href="{{ route('password.request') }}">
                    Esqueceu a senha?
                </a>
            @endif
        </form>
    </article>
</section>

@endsection
