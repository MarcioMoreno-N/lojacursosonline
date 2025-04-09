<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'endereco_id', // ✅ incluído
        'valor_total', 
        'status'
    ];
    
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function endereco() // ✅ relacionamento
    {
        return $this->belongsTo(Endereco::class);
    }

    public function itens()
    {
        return $this->hasMany(PedidoItem::class);
    }
}
