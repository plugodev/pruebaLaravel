<?php

namespace App\Http\Controllers;

use App\Pregunta;
use App\ValoracionPregunta;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class ValoracionPreguntaController extends Controller
{
    //
    public function postValorarPregunta(Request $request)
    {
        $this->validate($request, [
            'pregunta_id' => 'required|integer|exists:preguntas,id',
            'valoracion' => 'required|integer'
        ]);
        $pregunta = Pregunta::find($request["pregunta_id"]);
        $valoraciones = $pregunta->valoraciones;
        $band=0;
        foreach ($valoraciones as $valoracion) {
            if($valoracion->usuario_id==Auth::user()->id){
                $band=1;
            }
        }
        if ($band){
            return redirect()->back()->with(['mensaje'=>'Ya ha realizado una valoración de ésta pregunta!', 'type'=>'error']);
        }
        $valoracion = new ValoracionPregunta();
        $valoracion->pregunta_id=$request["pregunta_id"];
        $valoracion->usuario_id=Auth::user()->id;
        $valoracion->valoracion=$request["valoracion"];
        $valoracion->save();
        return redirect()->back()->with(['mensaje'=>'Valoración exitosa!', 'type'=>'success']);
    }
}
