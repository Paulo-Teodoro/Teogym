@extends('app._theme')
@section('content')
<section class="section-alunos">
    <div class="row">
        <div class="col-6">
            <h2>Administradores</h2>
        </div>
        <div class="col-6 align-buttons">
            <a href="{{ route('admins.create') }}" class="btn btn-info"><i class="fas fa-user-plus"></i> Add</a>
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
            @if ($admins)
            @foreach($admins as $admin)
        <tr>
            <td>{{ $admin->name }}</td>
            <td class="d-none d-sm-block">{{ $admin->email }}</td>
            <td>
                <a href="{{ route('admins.edit', $admin->id) }}" class="btn edit"><i class="fas fa-user-edit"></i></a>
                <button type="button" class="btn delete" data-bs-toggle="modal" data-bs-target="#Modal{{ $admin->id }}"><i class="fas fa-user-times"></i></button>
                <div class="modal fade" id="Modal{{ $admin->id }}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Excluir Pessoa</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Você tem certeza que deseja excluir o usuário {{ $admin->nome }}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <form action="{{ route('admins.destroy', $admin->id) }}" method="POST">
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
    @if (isset($filters))
        {!! $admins->appends($filters)->links() !!}      
    @else
        {!! $admins->links() !!}
    @endif
</section>

@endsection