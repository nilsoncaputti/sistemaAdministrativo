<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimentos_financeiro extends Model
{
    protected $table = 'movimentos_financeiros';

    protected $primaryKey = 'id';

    protected $fillable = ['descricao', 'valor', 'data', 'tipo', 'empresa_id'];

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa');
    }

    public static function buscaPorIntervalo(string $inicio, string $fim, int $quantidade = 20)
    {
        return self::whereBetween('data', [$inicio, $fim])->paginate($quantidade);
    }
}
