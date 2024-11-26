@extends('layouts.app')

@section('title', 'Logs de Rastreamento')

@section('content')
    <div class="container">
        <h1 class="mb-4">Logs de Rastreamento</h1>

        <!-- Tabela com DataTable -->
        <table id="logsTable" class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Modelo</th>
                    <th>ID do Modelo</th>
                    <th>Ação</th>
                    <th>Alterações</th>
                    <th>Usuário</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                    <tr>
                        <td>{{ $log->id }}</td>
                        <td>
                            <span class="badge badge-info">{{ class_basename($log->model) }}</span>
                        </td>
                        <td>{{ $log->model_id }}</td>
                        <td>
                            @if($log->action === 'create')
                                <span class="text-success">Criar</span>
                            @elseif($log->action === 'update')
                                <span class="text-warning">Atualizar</span>
                            @else
                                <span class="text-danger">Excluir</span>
                            @endif
                        </td>
                        <td style="max-width: 300px; word-wrap: break-word;">
                            @if ($log->changes)
                                <pre class="bg-light p-2 rounded">{{ json_encode($log->changes, JSON_PRETTY_PRINT) }}</pre>
                            @else
                                <span class="text-muted">Nenhuma alteração</span>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $log->user ? $log->user->name : 'Desconhecido' }}</strong>
                        </td>
                        <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Nenhum log encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@section('styles')
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Custom styles */
        .badge {
            font-size: 0.9rem;
        }

        .table td, .table th {
            vertical-align: middle;
        }

        .table pre {
            max-width: 300px;
            white-space: normal;
            word-wrap: break-word;
            font-size: 0.9rem;
        }

        /* Melhoria visual para textos */
        .text-success {
            color: #28a745 !important;
            font-weight: bold;
        }

        .text-warning {
            color: #ffc107 !important;
            font-weight: bold;
        }

        .text-danger {
            color: #dc3545 !important;
            font-weight: bold;
        }

        .text-muted {
            color: #6c757d !important;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inicializa o DataTable
            var table = $('#logsTable').DataTable();
        });
    </script>
@endsection
