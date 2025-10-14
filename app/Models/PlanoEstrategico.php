<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanoEstrategico extends Model
{
    use HasFactory;

    protected $table = 'planos_estrategicos'; 
    protected $fillable = [
        'user_id',
        'area_interesse',
        'objetivo_geral',
        'prazo_meses',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function diagnostico()
    {
        return $this->hasOne(DiagnosticoEstrategico::class);
    }

    public function objetivos()
    {
        return $this->hasMany(ObjetivoEstrategico::class);
    }

    public function pilares()
    {
        return $this->hasMany(PilarEstrategico::class);
    }

    public function acoes()
    {
        return $this->hasMany(AcaoEstrategica::class);
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
