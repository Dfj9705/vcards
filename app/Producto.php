<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre', 'descripcion', 'precio','tipo_id',
    ];
    public function tipo()
    {
        
        return $this->belongsTo(TipoProducto::class);
    }
    public function fotografias()
    {
        
        return $this->hasMany(ProductoDetalle::class);
    }
}
