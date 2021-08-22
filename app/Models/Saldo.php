<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    // Define nome da tabela
    protected $table = 'saldo';

    //Define campos para alocação de dados em massa
    protected $fillable = ['valor', 'empresa_id'];

    // Define relação com movimento de estoque e financeiro
    public function movimento()
    {
        return $this->morphTo();
    }

    // Busca último saldo da empresa
    public static function ultimoDaEmpresa(int $empresaId)
    {
        return self::where('empresa_id', $empresaId)
            ->latest()
            ->first();
    }

    // Busca os saldos de uma empresa por intervalo 
    public static function buscaPorIntervalo(int $empresa, string $inicio, string $fim)
    {
        return self::with('movimento')
            ->whereBetween('created_at', [$inicio, $fim])
            ->where('empresa_id', $empresa)
            ->get();
    }
}
