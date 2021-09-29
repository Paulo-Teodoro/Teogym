<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teo Gym</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a099227fd7.js" crossorigin="anonymous"></script>
    {{ Html::style('css/styles.css'); }}
</head>
<body class="app">
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <nav class="navbar flex-column nav-app box-app">
                    <a class="navbar-brand" href="{{ route('app.home') }}"><img class="img-fluid" src="{{ asset('img/logo.png') }}"></a>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('alunos.index') }}">Alunos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="">Personais</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('exercicios.index') }}">Exercicios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('rotinas.index') }}" tabindex="-1" aria-disabled="true">Rotinas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="" tabindex="-1" aria-disabled="true">Sair</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-9">
                    <div class="box-app">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
