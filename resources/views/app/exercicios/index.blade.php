@extends('app._theme')
@section('content')
<section class="section-alunos">
    <div class="row">
        <div class="col-md-9">
            <h2>Exercicios</h2>
        </div>
            <div class="col-md-3 align-buttons">
                <a href="{{ route('exercicios.create') }}" class="btn btn-info"><i class="fas fa-user-plus"></i> Add Exercicio</a>
            </div>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Foco</th>
            <th scope="col">Operações</th>
        </tr>
        </thead>
        <tbody>
        @if($exercicios)
            @foreach($exercicios as $exercicio) 
                <tr>
                    <td>{{ $exercicio->name }}</td>
                    <td>{{ $exercicio->foco }}</td>
                    <td>
                        <a href="{{ route('exercicios.edit', $exercicio->id) }}" class="btn edit"><i class="fas fa-user-edit"></i></a>
                        <button type="button" class="btn delete" data-bs-toggle="modal" data-bs-target="#Modal{{ $exercicio->id }}"><i class="fas fa-user-times"></i></button>
                        <div class="modal fade" id="Modal{{ $exercicio->id }}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Excluir Exercicio</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Você tem certeza que deseja excluir o exercício {{ $exercicio->nome }}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form action="{{ route('exercicios.destroy', $exercicio->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')    
                                        <button type="submit" class="btn btn-danger">Excluir</a>
                                        </form>    
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