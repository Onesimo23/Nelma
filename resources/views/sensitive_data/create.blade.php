@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Adicionar Dado Sensível</h1>
    <form action="{{ route('sensitive_data.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="sensitive_data" class="form-label">Dado Sensível</label>
            <input type="text" class="form-control" id="sensitive_data" name="sensitive_data" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
