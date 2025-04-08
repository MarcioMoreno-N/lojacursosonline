<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'nome',
        'categoria_pai_id',
    ];

    public function categoriaPai()
    {
        return $this->belongsTo(Categoria::class, 'categoria_pai_id');
    }

    public function subcategorias()
    {
        return $this->hasMany(Categoria::class, 'categoria_pai_id');
    }
}
