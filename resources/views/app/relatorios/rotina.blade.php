@extends('app.relatorios._theme')
@section('title')
    Plano de Treinos
@endsection
@section('content')
    @foreach ($treinos as $treino)
            <h6>Treino {{$treino->dia}}<h6>
            <table class="table">
                <thead class="thead-light">
                  <tr>
                    <th>
                        Exercicio
                    </th>  
                    <th>
                        Repetições
                    </th>       
                    <th>
                        Series
                    </th>
                  </tr>  
                </thead>
                <tbody>
                    @foreach ($treino->exercicios()->orderBy('sequencia')->get() as $exercicio)
                        <tr>
                            <td>{{ $exercicio->name }}</td>
                            <td>{{ $exercicio->pivot->repeticoes }}</td>
                            <td>{{ $exercicio->pivot->series }}</td>
                        </tr>
                    @endforeach  
                </tbody>
            </table>    
    @endforeach   
@endsection