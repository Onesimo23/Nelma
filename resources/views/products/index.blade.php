@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Pesquisar Produtos</h1>

        <!-- Formulário de Pesquisa -->
        <form action="{{ route('products.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="query" class="form-control" placeholder="Pesquise um produto..." value="{{ request()->query('query') }}" required>
                <button type="submit" class="btn btn-primary">Pesquisar</button>
            </div>
        </form>

        <!-- Exibição dos Resultados da Pesquisa -->
        @if(isset($products) && count($products) > 0)
            <h2 class="mb-4">Resultados da Pesquisa</h2>
            <div class="row g-4">
                @foreach($products as $product)
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ $product['image'] }}" class="card-img-top img-fluid" alt="{{ $product['title'] }}" style="height: 200px; object-fit: contain;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-truncate">{{ $product['title'] }}</h5>
                                <p class="card-text text-muted small">{{ \Illuminate\Support\Str::limit($product['description'], 100) }}</p>
                                <p class="card-text"><strong>Preço:</strong> {{ number_format($product['price'], 2) }} MZN</p>
                                <a href="{{ route('products.show', $product['id']) }}" class="btn btn-primary mt-auto">Ver Detalhes</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif(request()->has('query') && count($products) === 0)
            <p class="mt-4 text-center">Nenhum produto encontrado para "{{ request()->query('query') }}".</p>
        @endif

        <!-- Separador -->
        <hr class="my-5">

        <!-- Exibição dos Produtos em Destaque -->
        <h2 class="mb-4">Produtos em Destaque</h2>
        <div class="row g-4">
            @foreach($featuredProducts as $product)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $product['image'] }}" class="card-img-top img-fluid" alt="{{ $product['title'] }}" style="height: 200px; object-fit: contain;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-truncate">{{ $product['title'] }}</h5>
                            <p class="card-text text-muted small">{{ \Illuminate\Support\Str::limit($product['description'], 100) }}</p>
                            <p class="card-text"><strong>Preço:</strong> {{ number_format($product['price'], 2) }} MZN</p>
                            <a href="{{ route('products.show', $product['id']) }}" class="btn btn-primary mt-auto">Ver Detalhes</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
