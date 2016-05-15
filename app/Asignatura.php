<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    //
    public function usuarios_asignaturas()
    {
        return $this->hasMany('App\UsuarioAsignatura');
    }
}
