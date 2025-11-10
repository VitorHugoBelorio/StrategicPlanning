<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'pilar_estrategico_id',
        'titulo',
        'descricao',
        'status',
        'prioridade',
        'data_inicio',
        'data_fim',
        'responsavel_id'
    ];

    protected $casts = [
        'data_inicio' => 'datetime',
        'data_fim' => 'datetime'
    ];

    // Método para obter o peso baseado na prioridade
    public function getPesoAttribute()
    {
        return match($this->prioridade) {
            'baixa' => 1,
            'media' => 2,
            'alta' => 3,
            default => 1
        };
    }

    // Relacionamento com o Pilar Estratégico
    public function pilarEstrategico()
    {
        return $this->belongsTo(PilarEstrategico::class);
    }

    // Relacionamento com o Responsável
    public function responsavel()
    {
        return $this->belongsTo(User::class, 'responsavel_id');
    }
}
