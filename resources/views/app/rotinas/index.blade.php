@extends('app._theme')
@section('content')
<section class="section-alunos">
    <div class="row">
        <div class="col-md-9">
            <h2>rotinas</h2>
        </div>
        <div class="col-md-3">
            <a href="{{ route("rotinas.create") }}" class="btn btn-info"><i class="fas fa-user-plus"></i> Add rotina</a>
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Responsável</th>
            <th scope="col">Aluno</th>
            <th scope="col">Operações</th>
        </tr>
        </thead>
        <tbody>
        @if($rotinas)
            @foreach($rotinas as $rotina)              
                <tr>
                    <th scope="row">{{ $rotina->id }}</th>
                    <td>{{ $rotina->responsavel()->first()->name }}</td>
                    <td>{{ $rotina->aluno()->first()->name }}</td>
                    <td>
                        <a href="{{ route('treinos.index', $rotina->id) }}" class="btn edit"><i class="fas fa-user-edit"></i></a>
                        <button type="button" class="btn delete" data-bs-toggle="modal" data-bs-target="#Modal{{ $rotina->id }}"><i class="fas fa-user-times"></i></button>
                        <div class="modal fade" id="Modal{{ $rotina->id }}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Excluir rotina</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Você tem certeza que deseja excluir a rotina {{ $rotina->nome }}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form action="{{ route('rotinas.destroy', $rotina->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')    
                                            <button type="submit" class="btn btn-danger">Excluir</a>
                                        </form    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
        @endforeach
        @endif
        </tbody>
    </table>
</section>
@endsection