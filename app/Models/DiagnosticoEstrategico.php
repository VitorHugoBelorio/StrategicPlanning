<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticoEstrategico extends Model
{
    use HasFactory;

    protected $fillable = [
        'plano_estrategico_id',
        'missao',
        'visao',
        'forcas',
        'fraquezas',
        'oportunidades',
        'ameacas',
    ];

    protected $casts = [
        'forcas' => 'array',
        'fraquezas' => 'array',
        'oportunidades' => 'array',
        'ameacas' => 'array',
    ];

    public function plano()
    {
        return $this->belongsTo(PlanoEstrategico::class, 'plano_estrategico_id');
    }
}
