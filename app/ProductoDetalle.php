<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoDetalle extends Model
{
    protected $fillable = [
        'producto', 'imagen'
    ];
    public function producto()
    {
        
        return $this->belongsTo(Producto::class);
    }
}
