<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $fillable = [
        'user_id', 'imagen'
    ];
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
