@extends('app._theme')
@section('content')
<section class="section-alunos">
    <div class="row">
        <div class="col-md-9">
            <h2>Personais</h2>
        </div>
        <div class="col-md-3 align-buttons">
            <a href="{{ route('personais.create') }}" class="btn btn-info"><i class="fas fa-user-plus"></i> Add Personal</a>
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col" class="d-none d-sm-block">Email</th>
            <th scope="col">Operação</th>
        </tr>
        </thead>
        <tbody>
            @if ($personais)
            @foreach($personais as $personal)
        <tr>
            <td>{{ $personal->name }}</td>
            <td class="d-none d-sm-block">{{ $personal->email }}</td>
            <td>
                <a href="{{ route('personais.edit', $personal->id) }}" class="btn edit"><i class="fas fa-user-edit"></i></a>
                <button type="button" class="btn delete" data-bs-toggle="modal" data-bs-target="#Modal{{ $personal->id }}"><i class="fas fa-user-times"></i></button>
                <div class="modal fade" id="Modal{{ $personal->id }}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Excluir Pessoa</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Você tem certeza que deseja excluir o usuário {{ $personal->nome }}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <form action="{{ route('personais.destroy', $personal->id) }}" method="POST">
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