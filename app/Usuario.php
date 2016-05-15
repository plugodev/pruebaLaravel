<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    //
    public function tipo_usuario()
    {
        return $this->belongsTo('App\TipoUsuario');
    }

    public function asignaturas()
    {
        return $this->hasMany('App\UsuarioAsignatura');
    }

    public function preguntas()
    {
        return $this->hasMany('App\Pregunta');
    }

    public function monitores()
    {
        return $this->hasMany('App\Monitor');
    }
}
