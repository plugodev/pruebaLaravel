<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    //
    public function usuario()
    {
        return $this->belongsTo('App\Usuario');
    }

    public function asignatura()
    {
        return $this->belongsTo('App\Asignatura');
    }
}
