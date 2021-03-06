<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimentosFinanceiro extends Model
{
    protected $table = 'movimentos_financeiros';

    protected $primaryKey = 'id';

    protected $fillable = ['descricao', 'valor', 'tipo', 'empresa_id'];

    //Método resposável pela relação com a empresa
    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa');
    }

    //Configura a relação com o histórico do saldo
    public function saldo()
    {
        return $this->MorphOne('App\Models\Saldo', 'movimento');
    }

    //Método que busca moviemntos por intervalode data
    public static function buscaPorIntervalo(
        string $inicio,
        string $fim,
        int $quantidade = 20
    ) {
        return self::whereBetween('created_at', [$inicio, $fim])
            ->with(['empresa' => function ($q) {
                $q->withTrashed();
            }])
            ->paginate($quantidade);
    }

    // Busca movimento por id e tras empresa mesmo que excluida
    public static function porIdComEmpresaExcluida(int $id)
    {
        return self::with(['empresa' => function ($q) {
            $q->withTrashed();
        }])
            ->findOrFail($id);
    }
}
