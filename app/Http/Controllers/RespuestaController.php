<?php

namespace App\Http\Controllers;

use App\Pregunta;
use App\Respuesta;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class RespuestaController extends Controller
{
    //
    public function postResponder(Request $request)
    {
        $this->validate($request, [
            'respuesta' => 'required|max:1000',
            'pregunta_id' => 'required|exists:preguntas,id'
        ]);

        $pregunta = Pregunta::find($request["pregunta_id"]);
        $correcta=0;
        foreach($pregunta->respuestas as $respuesta){
            if ($respuesta->correcta){
                $correcta++;
            }
        }
        if ($correcta!=0){
            return response()->json(['mensaje'=>'Ya se ha seleccionado una respuesta correcta, verifique.!', 'type'=>'error']);
        }
        $respuesta = new Respuesta();
        $respuesta->usuario_id=Auth::user()->id;
        $respuesta->pregunta_id=$request["pregunta_id"];
        $respuesta->respuesta = $request["respuesta"];
        $respuesta->correcta = false;
        if ($respuesta->save()){
            return response()->json(['mensaje'=>'Respuesta registrada!', 'type'=>'success']);
        }else{
            return response()->json(['mensaje'=>'Ocurrió un error, intente nuevamente o comuníquese con el administrador!', 'type'=>'error']);
        }
    }
    public function getElegirRespuesta($id)
    {
        $respuesta=Respuesta::find($id);
        $respuesta->correcta=true;
        $respuesta->save();
        return redirect()->back()->with(['mensaje'=>'Se ha elegido una respuesta correcta!', 'type'=>'success']);
    }
}
