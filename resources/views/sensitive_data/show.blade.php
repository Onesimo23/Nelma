@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes do Dado</h1>
    <p><strong>Nome:</strong> {{ $data->name }}</p>
    <p><strong>Dado Criptografado:</strong> {{ $data->encrypted_data }}</p>
    <p><strong>Dado Descriptografado:</strong> {{ $data->decrypted }}</p>
    <p><strong>Dado Hashed:</strong> {{ $data->hashed_data }}</p>
    <a href="{{ route('sensitive_data.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
