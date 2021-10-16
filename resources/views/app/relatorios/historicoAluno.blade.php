@extends('app.relatorios._theme')
@section('title')
    Historico do Aluno
@endsection
@section('content')
<table class="table">
    <thead class="thead-light">
    <tr>
        <th>
            Peso
        </th>  
        <th>
            Altura
        </th>       
        <th>
            IMC
        </th>
        <th>
            Data
        </th>
    </tr>  
    </thead>
    <tbody>
    @foreach ($historicos as $historico)
        <tr>
            <td>{{ $historico->peso }}</td>
            <td>{{ $historico->altura }}</td>
            <td>{{ $historico->imc }}</td>
            <td>{{ $historico->created_at }}</td>
        </tr>         
    @endforeach  
    </tbody>
</table> 
@endsection