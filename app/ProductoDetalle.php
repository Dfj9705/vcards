<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoDetalle extends Model
{
    protected $fillable = [
        'producto_id', 'imagen'
    ];
    public function producto()
    {
        
        return $this->belongsTo(Producto::class);
    }
}
