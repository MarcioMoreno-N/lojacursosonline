<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfiguracaoApi extends Model
{
    protected $table = 'configuracoes_api';

    protected $fillable = [
        'nome_sistema',
        'url_base',
        'token',
    ];
}
