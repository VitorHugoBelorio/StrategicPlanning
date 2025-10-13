<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicadorDesempenho extends Model
{
    use HasFactory;

    protected $fillable = [
        'plano_estrategico_id',
        'nome',
        'meta',
        'valor_atual',
        'unidade',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function plano()
    {
        return $this->belongsTo(PlanoEstrategico::class, 'plano_estrategico_id');
    }
}
