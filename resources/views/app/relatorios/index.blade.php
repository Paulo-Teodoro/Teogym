@extends('app._theme')
@section('content')
<section class="section-alunos">
    <div class="row">
        <div class="col-md-9">
            <h2>Relatórios</h2>
        </div>
    </div>    
    <div class="row">
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Ultimos Alunos</h5>
              <p class="card-text">Veja os alunos que se matricularam este mês</p>
              <a href="{{ route('relatorios.alunos') }}" target="_blank" class="btn btn-primary">Ver</a>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Quantidade rotinas</h5>
              <p class="card-text">Veja quantas rotinas cada personal fez</p>
              <a href="{{ route('relatorios.rotinaPessoa') }}" target="_blank" class="btn btn-primary">Ver</a>
            </div>
          </div>
        </div>
    </div>
</section>    
@endsection