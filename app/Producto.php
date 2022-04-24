<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre', 'descripcion', 'precio','tipo',
    ];
    public function tipo()
    {
        
        return $this->belongsTo(TipoProducto::class, 'tipo' , 'id');
    }
}
