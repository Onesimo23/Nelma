<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class ProductObserver
{
    public function created(Product $product)
    {
        Log::create([
            'model' => Product::class,
            'model_id' => $product->id,
            'action' => 'create',
            'changes' => $product->toArray(),
            'user_id' => Auth::id(), // Adiciona o usuário responsável pela criação
            'query' => null, // Não há uma consulta de pesquisa associada aqui
        ]);
    }

    public function updated(Product $product)
    {
        $changes = $product->getChanges();
        Log::create([
            'model' => Product::class,
            'model_id' => $product->id,
            'action' => 'update',
            'changes' => $changes,
            'user_id' => Auth::id(), // Adiciona o usuário responsável pela atualização
            'query' => null, // Não há uma consulta de pesquisa associada aqui
        ]);
    }

    public function deleted(Product $product)
    {
        Log::create([
            'model' => Product::class,
            'model_id' => $product->id,
            'action' => 'delete',
            'changes' => null,
            'user_id' => Auth::id(), // Adiciona o usuário responsável pela exclusão
            'query' => null, // Não há uma consulta de pesquisa associada aqui
        ]);
    }

    // Para capturar as pesquisas feitas no modelo Product
    public static function trackSearch($query)
    {
        Log::create([
            'model' => Product::class,
            'model_id' => null,
            'action' => 'search',
            'changes' => null,
            'user_id' => Auth::id(), // Adiciona o usuário responsável pela pesquisa
            'query' => $query, // Armazena o termo pesquisado
        ]);
    }
}
