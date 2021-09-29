@extends('app._theme')
@section('content')
<section class="section-alunos">
    <div class="row">
        <div class="col-md-9">
            <h2>Alunos</h2>
        </div>
        <div class="col-md-3">
            <a href="{{ route('alunos.create') }}" class="btn btn-info"><i class="fas fa-user-plus"></i> Add Aluno</a>
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">IMC</th>
            <th scope="col">Operação</th>
        </tr>
        </thead>
        <tbody>
            @if ($alunos)
            @foreach($alunos as $aluno)
        <tr>
            <th scope="row">{{ $aluno->id }}</th>
            <td>{{ $aluno->name }}</td>
            <td>{{ $aluno->email }}</td>
            <td>{{ $aluno->imc }}</td>
            <td>
                <a href="{{ route('alunos.edit', $aluno->id) }}" class="btn edit"><i class="fas fa-user-edit"></i></a>
                <button type="button" class="btn delete" data-bs-toggle="modal" data-bs-target="#Modal{{ $aluno->id }}"><i class="fas fa-user-times"></i></button>
                <div class="modal fade" id="Modal{{ $aluno->id }}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Excluir Pessoa</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Você tem certeza que deseja excluir o usuário {{ $aluno->nome }}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <form action="{{ route('alunos.destroy', $aluno->id) }}" method="POST">
                                @csrf    
                                @method('DELETE')
                                    <button type='submit' class="btn btn-danger">Excluir</a>
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