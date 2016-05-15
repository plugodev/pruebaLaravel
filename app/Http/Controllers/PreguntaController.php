<?php

namespace App\Http\Controllers;

use App\Pregunta;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class PreguntaController extends Controller
{
    //
    public function getPreguntas()
    {
        $usuario = \App\Usuario::find(Auth::user()->id);
        $pregunta_respuesta=(object) array();

        $preguntas = \App\Pregunta::orderby('updated_at', 'desc')->get();
        $usuario_asignaturas = $usuario->asignaturas;
        $usuario_monitores = $usuario->monitores;
        $array_monitor = [];
        foreach($usuario_monitores as $usuario_monitor){
            $monitor = \App\Monitor::find($usuario_monitor->id);
            array_push($array_monitor, $monitor->asignatura->nombre);
        }
        return view('preguntas')->with(['usuario_asignaturas' => $usuario_asignaturas, 'preguntas' => $preguntas, 'usuario_monitor' => $array_monitor]);
    }
    public function postPreguntar(Request $request)
    {
        $this->validate($request, [
            'pregunta' => 'required|min:10|max:1000',
            'asignatura_id' => 'required|integer'
        ]);
        $pregunta = new Pregunta();
        $pregunta->pregunta=$request["pregunta"];
        $pregunta->asignatura_id=$request["asignatura_id"];
        $pregunta->usuario_id=Auth::user()->id;
        $pregunta->save();
        return redirect()->back()->with(['mensaje'=>'Pregunta realizada con éxito!', 'type'=>'success']);
    }
}
