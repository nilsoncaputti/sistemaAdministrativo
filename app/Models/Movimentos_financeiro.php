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
    
}
