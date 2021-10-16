@extends('app.relatorios._theme')
@section('title')
    Ultimos Alunos
@endsection
@section('content')
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th>
                Nome
            </th>  
            <th>
                IMC
            </th>       
            <th>
                Data Mat
            </th>
        </tr>  
        </thead>
        <tbody>
        @foreach ($alunos as $aluno)
            <tr>
                <td>{{ $aluno->name }}</td>
                <td>{{ $aluno->imc }}</td>
                <td>{{ $aluno->created_at }}</td>
            </tr>         
        @endforeach  
        </tbody>
    </table> 
@endsection