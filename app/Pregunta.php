<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $fillable = ['pregunta', 'nombre', 'apellido', 'anonimo', 'status', 'created_at', 'updated_at'];

    
}
