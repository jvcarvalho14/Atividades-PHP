<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Livro extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'autor',
        'editora',
        'ano_publicacao',
        'isbn',
        'quantidade',
    ];

    protected $casts = [
        'ano_publicacao' => 'integer',
        'quantidade' => 'integer',
    ];

    public function emprestimos(): HasMany
    {
        return $this->hasMany(Emprestimo::class);
    }

    public function temExemplarDisponivel(): bool
    {
        return $this->quantidade > 0;
    }
}