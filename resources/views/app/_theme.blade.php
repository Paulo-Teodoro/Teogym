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
        <div class="sidebar d-block d-sm-none">
            <nav class="navbar navbar-light bg-light shadow">
                <div class="container-fluid">
                <span class="navbar-brand mb-0 h1 sidebar-title"><a href="{{ route('app.home') }}"><img class="img-fluid logo-small" src="{{ asset('img/logo.png') }}"> Teogym</a></span>
                <button class="navbar-toggler" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <span class="navbar-toggler-icon"></span>
                </button>
                </div>
            </nav>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title sidebar-title" id="exampleModalLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="navbar-nav">
                            @if (auth()->user()->is_aluno())
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{ route('alunos.edit', auth()->user()->id) }}">Perfil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('rotinas.index') }}" tabindex="-1" aria-disabled="true">Rotina</a>
                                </li>
                            @endif
                            @if (auth()->user()->is_personal())
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{ route('alunos.index') }}">Alunos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('exercicios.index') }}">Exercicios</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('rotinas.index') }}" tabindex="-1" aria-disabled="true">Rotinas</a>
                                </li>
                            @endif
                            @if (auth()->user()->is_admin())
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{ route('alunos.index') }}">Alunos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{ route('personais.index') }}">Personais</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{ route('admins.index') }}">Administradores</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('exercicios.index') }}">Exercicios</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('rotinas.index') }}" tabindex="-1" aria-disabled="true">Rotinas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{ route('relatorios.index') }}">Relatórios</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="nav-link" tabindex="-1" aria-disabled="true">Sair</button>
                                </form>
                            </li>
                        </ul>  
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 d-none d-md-block">
                    <nav class="navbar flex-column nav-app box-app">
                    <a class="navbar-brand" href="{{ route('app.home') }}"><img class="img-fluid" src="{{ asset('img/logo.png') }}"></a>
                        <ul class="navbar-nav">
                            @if (auth()->user()->is_aluno())
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{ route('alunos.edit', auth()->user()->id) }}">Perfil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('rotinas.index') }}" tabindex="-1" aria-disabled="true">Rotina</a>
                                </li>
                            @endif
                            @if (auth()->user()->is_personal())
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{ route('alunos.index') }}">Alunos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('exercicios.index') }}">Exercicios</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('rotinas.index') }}" tabindex="-1" aria-disabled="true">Rotinas</a>
                                </li>
                            @endif
                            @if (auth()->user()->is_admin())
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{ route('alunos.index') }}">Alunos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{ route('personais.index') }}">Personais</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{ route('admins.index') }}">Administradores</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('exercicios.index') }}">Exercicios</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('rotinas.index') }}" tabindex="-1" aria-disabled="true">Rotinas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{ route('relatorios.index') }}">Relatórios</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="nav-link" tabindex="-1" aria-disabled="true">Sair</button>
                                </form>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-9">
                    <div class="box-app">
                        @include('includes.alerts')
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>   
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>   
    @yield('scripts')
</body>
</html>
