<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cronograma extends Model
{
    use HasFactory;

    protected $fillable = [
        'plano_estrategico_id',
        'mes',
        'descricao',
    ];

    public function plano()
    {
        return $this->belongsTo(PlanoEstrategico::class, 'plano_estrategico_id');
    }
}
