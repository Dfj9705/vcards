<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    protected $table = 'cotizaciones';
    protected $fillable = [
        'fecha', 'producto_id', 'cantidad','user_id',
    ];

    public function producto()
    {
        
        return $this->belongsTo(Producto::class);
    }
    public function usuario()
    {
        
        return $this->belongsTo(User::class,'user_id','id');
    }
}
