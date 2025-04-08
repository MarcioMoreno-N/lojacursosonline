<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FotoProduto extends Model
{
    use HasFactory;

    protected $table = 'fotos_produto';

    protected $fillable = [
        'produto_id',
        'arquivo'
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
