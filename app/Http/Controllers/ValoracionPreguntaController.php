<?php

namespace App\Http\Controllers;

use App\Pregunta;
use App\ValoracionPregunta;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use DB;

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

    public function getTop()
    {
        $top = DB::table('valoracion_preguntas')
            ->join('preguntas', 'preguntas.id', '=', 'valoracion_preguntas.pregunta_id')
            ->join('usuarios', 'usuarios.id', '=', 'preguntas.usuario_id')
            ->select('usuarios.nombre', 'usuarios.apellido', 'usuarios.id', DB::raw('sum(valoracion_preguntas.valoracion) as total_estrellas'))
            ->groupBy('preguntas.usuario_id')
            ->take(5)
            ->get();
        return view('top')->with(['top'=>$top]);
    }
}
