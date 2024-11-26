@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $productDetails['title'] }}</h1>

        <div class="row">
            <div class="col-md-4">
                <img src="{{ $productDetails['image'] }}" class="img-fluid" alt="{{ $productDetails['title'] }}">
            </div>

            <div class="col-md-8">
                <h3>Descrição:</h3>
                <p>{{ $productDetails['description'] }}</p>

                <h3>Preço:</h3>
                <p><strong>${{ number_format($productDetails['price'], 2) }}</strong></p>

                <h3>Categoria:</h3>
                <p>{{ $productDetails['category'] }}</p>

                <h3>Avaliação:</h3>
                <p>{{ $productDetails['rating']['rate'] }} / 5 ({{ $productDetails['rating']['count'] }} avaliações)</p>
            </div>
        </div>

        <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Voltar para a Pesquisa</a>
    </div>
@endsection
