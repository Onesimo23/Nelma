@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Pesquisar Produtos</h1>

        <!-- Formulário de Pesquisa -->
        <form action="{{ route('products.index') }}" method="GET">
            <div class="form-group">
                <input type="text" name="query" class="form-control" placeholder="Pesquise um produto..." value="{{ request()->query('query') }}" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Pesquisar</button>
        </form>

        <!-- Exibição dos Produtos em Destaque -->
        <h2 class="mt-4">Produtos em Destaque</h2>
        <div class="row">
            @foreach($featuredProducts as $product)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ $product['image'] }}" class="card-img-top" alt="{{ $product['title'] }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product['title'] }}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($product['description'], 100) }}</p>
                            <p class="card-text"><strong>Preço:</strong> ${{ number_format($product['price'], 2) }}</p>
                            <a href="{{ route('products.show', $product['id']) }}" class="btn btn-primary">Ver Detalhes</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Exibição dos Resultados da Pesquisa -->
        @if(isset($products) && count($products) > 0)
            <h2 class="mt-4">Resultados</h2>
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="{{ $product['image'] }}" class="card-img-top" alt="{{ $product['title'] }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product['title'] }}</h5>
                                <p class="card-text">{{ \Illuminate\Support\Str::limit($product['description'], 100) }}</p>
                                <p class="card-text"><strong>Preço:</strong> ${{ number_format($product['price'], 2) }}</p>
                                <a href="{{ route('products.show', $product['id']) }}" class="btn btn-primary">Ver Detalhes</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif(request()->has('query') && count($products) === 0)
            <p class="mt-4">Nenhum produto encontrado para "{{ request()->query('query') }}".</p>
        @endif
    </div>
@endsection
