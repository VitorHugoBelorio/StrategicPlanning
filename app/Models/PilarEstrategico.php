<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PilarEstrategico extends Model
{
    use HasFactory;

    protected $fillable = [
        'plano_estrategico_id',
        'nome',
    ];

    public function plano()
    {
        return $this->belongsTo(PlanoEstrategico::class, 'plano_estrategico_id');
    }

    public function acoes()
    {
        return $this->hasMany(AcaoEstrategica::class);
    }
}
