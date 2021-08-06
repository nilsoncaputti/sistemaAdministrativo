<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimentosFinanceiro extends Model
{
    protected $table = 'movimentos_financeiros';

    protected $primaryKey = 'id';

    protected $fillable = ['descricao', 'valor', 'data', 'tipo', 'empresa_id'];

    //Método resposável pela relação com a empresa
    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa');
    }

    //Método que busca moviemntos por intervalode data
    public static function buscaPorIntervalo(string $inicio, string $fim, int $quantidade = 20)
    {
        return self::whereBetween('data', [$inicio, $fim])
            ->with('empresa')
            ->paginate($quantidade);
    }
}
