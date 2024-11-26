@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Armazenamento Seguro de Dados Sensíveis</h1>
    <p class="text-center">Proteja e armazene de forma criptografada informações como senhas, dados bancários e outros dados críticos. Visualize os dados apenas quando necessário, garantindo máxima segurança.</p>

    <!-- Botão para adicionar novo dado -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
        Adicionar Novo Dado Seguro
    </button>

    <!-- Tabela de Dados -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nome do Dado</th>
                    <th>Dado Criptografado</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        {{ Str::limit($item->encrypted_data, 50, '...') }}
                    </td>
                    <td>
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{ $item->id }}">
                            Ver Detalhes
                        </button>
                        <form action="{{ route('sensitive_data.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal de Visualização -->
                <div class="modal fade" id="viewModal{{ $item->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewModalLabel{{ $item->id }}">Detalhes do Dado Seguro</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Nome do Dado:</strong> {{ $item->name }}</p>
                                <p><strong>Dado Criptografado:</strong> {{ $item->encrypted_data }}</p>
                                <p><strong>Dado Hashed:</strong> {{ $item->hashed_data }}</p>
                                <p><strong>Dado Original (Descriptografado):</strong> {{ Crypt::decryptString($item->encrypted_data) }}</p>
                                <p class="text-muted">
                                    * Mantenha seus dados seguros. Apenas visualize informações críticas quando absolutamente necessário.
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal de Criação -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('sensitive_data.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Adicionar Novo Dado Seguro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Identificador do Dado</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Ex: Senha Bancária, Token de API" required>
                    </div>
                    <div class="mb-3">
                        <label for="sensitive_data" class="form-label">Dado Sensível</label>
                        <input type="text" class="form-control" id="sensitive_data" name="sensitive_data" placeholder="Digite aqui o dado a ser armazenado" required>
                    </div>
                    <p class="text-muted">* Seus dados serão criptografados automaticamente e armazenados de forma segura.</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
