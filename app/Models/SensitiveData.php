<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensitiveData extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'encrypted_data', 'hashed_data'];
}
