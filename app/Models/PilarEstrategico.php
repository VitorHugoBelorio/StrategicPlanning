<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PilarEstrategico extends Model
{
    use HasFactory;

    protected $table = 'pilares_estrategicos';

    protected $fillable = [
        'plano_estrategico_id',
        'nome',
        'objetivo',
        'meta',
        'indicador',
        'data_inicio',
        'data_fim'
    ];

    protected $casts = [
        'data_inicio' => 'datetime',
        'data_fim' => 'datetime'
    ];

    public function plano()
    {
        return $this->belongsTo(PlanoEstrategico::class, 'plano_estrategico_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Método para calcular o progresso considerando os pesos
    public function getProgressoAttribute()
    {
        $tasks = $this->tasks;
        
        if ($tasks->isEmpty()) return 0;
        
        $pesoTotal = $tasks->sum('peso');
        if ($pesoTotal === 0) return 0;
        
        $progresso = $tasks
            ->where('status', 'concluida')
            ->sum('peso');
            
        return ($progresso / $pesoTotal) * 100;
    }
}
