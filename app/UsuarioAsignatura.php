<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioAsignatura extends Model
{
    //
    public function usuario(){
        return $this->belongsTo('App\Usuario');
    }
    public function asignatura(){
        return $this->belongsTo('App\Asignatura');
    }
}
