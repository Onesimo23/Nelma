<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'model_id',
        'action',
        'changes',
        'user_id',
    ];

    protected $casts = [
        'changes' => 'array', // Converte as alterações em um array
    ];

    // Relacionamento com o usuário (se necessário)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
