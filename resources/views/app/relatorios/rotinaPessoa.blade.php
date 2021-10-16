@extends('app.relatorios._theme')
@section('title')
    Rotinas por personal
@endsection
@section('content')
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th>
                Nome Personal
            </th>  
            <th>
                Rotinas feitas
            </th>       
        </tr>  
        </thead>
        <tbody>
        @foreach ($pessoas as $pessoa)
            <tr>
                <td>{{ $pessoa->name }}</td>
                <td>{{ $pessoa->qtd }}</td>
            </tr>         
        @endforeach  
        </tbody>
    </table> 
@endsection