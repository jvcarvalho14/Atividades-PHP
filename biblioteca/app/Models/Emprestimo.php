<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Emprestimo extends Model
{
    use HasFactory;

    public const STATUS_EM_ANDAMENTO = 'Em andamento';
    public const STATUS_DEVOLVIDO = 'Devolvido';

    protected $fillable = [
        'livro_id',
        'leitor_id',
        'data_emprestimo',
        'data_devolucao_prevista',
        'data_devolucao',
        'status',
    ];

    protected $casts = [
        'data_emprestimo' => 'date',
        'data_devolucao_prevista' => 'date',
        'data_devolucao' => 'date',
    ];

    public function livro(): BelongsTo
    {
        return $this->belongsTo(Livro::class);
    }

    public function leitor(): BelongsTo
    {
        return $this->belongsTo(Leitor::class);
    }

    public function estaAtrasado(): bool
    {
        return $this->data_devolucao === null
            && $this->data_devolucao_prevista->lt(today());
    }

    public function estaDevolvido(): bool
    {
        return $this->data_devolucao !== null
            || $this->status === self::STATUS_DEVOLVIDO;
    }
}