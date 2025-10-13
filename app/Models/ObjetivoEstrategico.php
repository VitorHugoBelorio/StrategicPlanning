<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjetivoEstrategico extends Model
{
    use HasFactory;

    protected $fillable = [
        'plano_estrategico_id',
        'descricao',
        'especifico',
        'mensuravel',
        'atingivel',
        'relevante',
        'tempo_definido',
    ];

    public function plano()
    {
        return $this->belongsTo(PlanoEstrategico::class, 'plano_estrategico_id');
    }
}
