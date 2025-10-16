<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticoEstrategico extends Model
{
    use HasFactory;

    protected $table = 'diagnosticos_estrategicos';

    protected $fillable = [
        'plano_estrategico_id',
        'pontos_fortes',
        'pontos_fracos',
        'oportunidades',
        'ameacas',
    ];

    public function plano()
    {
        return $this->belongsTo(PlanoEstrategico::class, 'plano_estrategico_id');
    }
}
