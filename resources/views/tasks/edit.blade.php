@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning text-dark">Editar Task</div>

                <div class="card-body">
                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" 
                                   class="form-control @error('titulo') is-invalid @enderror" 
                                   id="titulo" 
                                   name="titulo" 
                                   value="{{ old('titulo', $task->titulo) }}" 
                                   required>
                            @error('titulo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição</label>
                            <textarea class="form-control @error('descricao') is-invalid @enderror" 
                                      id="descricao" 
                                      name="descricao" 
                                      rows="3">{{ old('descricao', $task->descricao) }}</textarea>
                            @error('descricao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="data_inicio" class="form-label">Data Início</label>
                                <input type="date" 
                                       class="form-control @error('data_inicio') is-invalid @enderror" 
                                       id="data_inicio" 
                                       name="data_inicio" 
                                       value="{{ old('data_inicio', $task->data_inicio->format('Y-m-d')) }}" 
                                       required>
                                @error('data_inicio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="data_fim" class="form-label">Data Fim</label>
                                <input type="date" 
                                       class="form-control @error('data_fim') is-invalid @enderror" 
                                       id="data_fim" 
                                       name="data_fim" 
                                       value="{{ old('data_fim', $task->data_fim->format('Y-m-d')) }}" 
                                       required>
                                @error('data_fim')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="prioridade" class="form-label">Prioridade</label>
                                <select class="form-select @error('prioridade') is-invalid @enderror" 
                                        id="prioridade" 
                                        name="prioridade" 
                                        required>
                                    <option value="baixa" {{ old('prioridade', $task->prioridade) === 'baixa' ? 'selected' : '' }}>
                                        Baixa (Peso 1)
                                    </option>
                                    <option value="media" {{ old('prioridade', $task->prioridade) === 'media' ? 'selected' : '' }}>
                                        Média (Peso 2)
                                    </option>
                                    <option value="alta" {{ old('prioridade', $task->prioridade) === 'alta' ? 'selected' : '' }}>
                                        Alta (Peso 3)
                                    </option>
                                </select>
                                @error('prioridade')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="responsavel_id" class="form-label">Responsável</label>
                                <select class="form-select @error('responsavel_id') is-invalid @enderror" 
                                        id="responsavel_id" 
                                        name="responsavel_id" 
                                        required>
                                    <option value="">Selecione...</option>
                                    @foreach($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}" 
                                                {{ old('responsavel_id', $task->responsavel_id) == $usuario->id ? 'selected' : '' }}>
                                            {{ $usuario->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('responsavel_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('pilares.show', $task->pilar_estrategico_id) }}" 
                               class="btn btn-outline-secondary">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-warning">
                                Atualizar Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection