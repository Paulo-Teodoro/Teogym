@extends('app._theme')
@section('content')
<section class="section-alunos">
    <div class="row">
        <div class="col-6">
            <h2>Rotinas</h2>
        </div>
        @if (!auth()->user()->is_aluno())
        <div class="col-6 align-buttons">
            <a href="{{ route("rotinas.create") }}" class="btn btn-info"><i class="fas fa-plus"></i> Add rotina</a>
        </div>
        @endif
    </div>
    <div class="row search">
        <form action="{{ route('rotinas.search') }}" method="post" class="form d-flex">
            @csrf
            <input type="text" name="filter" placeholder="Nome" class="form-control me-2" value="{{ $filters['filter'] ?? '' }}">
            <button type="submit" class="btn btn-outline-info">Filtrar</button>
        </form>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Responsável</th>
            <th scope="col">Aluno</th>
            <th scope="col">Operações</th>
        </tr>
        </thead>
        <tbody>
        @if($rotinas)
            @foreach($rotinas as $rotina)              
                <tr>
                    <td>{{ $rotina->responsavel()->first()->name }}</td>
                    <td>{{ $rotina->aluno()->first()->name }}</td>
                    <td>
                        <a href="{{ route('treinos.index', $rotina->id) }}" class="btn edit"><i class="fas fa-dumbbell"></i></a>
                        <button type="button" class="btn delete" data-bs-toggle="modal" data-bs-target="#Modal{{ $rotina->id }}"><i class="fas fa-trash-alt"></i></button>
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
    @if (isset($filters))
        {!! $rotinas->appends($filters)->links() !!}      
    @else
        {!! $rotinas->links() !!}
    @endif
</section>
@endsection