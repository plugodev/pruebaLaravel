<?php

namespace App\Http\Controllers;

use App\Respuesta;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class RespuestaController extends Controller
{
    //
    public function postResponder(Request $request)
    {
        $respuesta = new Respuesta();
        $respuesta->usuario_id=Auth::user()->id;
        $respuesta->pregunta_id=$request["pregunta_id"];
        $respuesta->respuesta = $request["respuesta"];
        if ($respuesta->save()){
            return response()->json(['mensaje'=>'Respuesta registrada!', 'type'=>'success']);
        }else{
            return response()->json(['mensaje'=>'Ocurrió un error, intente nuevamente o comuníquese con el administrador!', 'type'=>'error']);
        }
    }
}
