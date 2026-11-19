<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Leitor extends Model
{
    use HasFactory;

    protected $table = 'leitores';

    protected $fillable = [
        'nome',
        'cpf',
        'email',
        'telefone',
    ];

    public function emprestimos(): HasMany
    {
        return $this->hasMany(Emprestimo::class);
    }
}