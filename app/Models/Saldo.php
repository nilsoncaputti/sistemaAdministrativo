<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    //Define nome da tabela
    protected $table = 'saldo';

    //Define campos para alocação de dados em massa
    protected $fillable = ['valor', 'empresa_id'];

    public static function ultimoDaEmpresa(int $empresaId)
    {
        return self::where('empresa_id', $empresaId)
            ->latest()
            ->first();
    }

    use HasFactory;
}
