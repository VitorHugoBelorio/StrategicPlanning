<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcaoEstrategica extends Model
{
    use HasFactory;

    protected $table = 'acoes_estrategicas'; // ✅ Corrigido

    protected $fillable = [
        'pilar_estrategico_id',
        'descricao',
        'responsavel',
        'prazo',
    ];

    public function pilar()
    {
        return $this->belongsTo(PilarEstrategico::class, 'pilar_estrategico_id');
    }

    public function cronogramas()
    {
        return $this->hasMany(Cronograma::class);
    }

    public function indicadores()
    {
        return $this->hasMany(IndicadorDesempenho::class);
    }

    public function riscos()
    {
        return $this->hasMany(Risco::class);
    }
}
