<?php

namespace App\Http\Controllers;

use App\Asignatura;
use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class AsignaturaController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAsignaturas()
    {
        $asignaturas = Asignatura::all();
        return view('asignaturas')->with(['asignaturas' => $asignaturas]);
    }

    public function postCrearAsignatura(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|unique:asignaturas'
        ]);
        $asignatura = new Asignatura();
        $asignatura->nombre = $request["nombre"];
        $asignatura->save();
        return redirect()->back()->with(['mensaje' => 'Registro completo', 'type' => 'success']);
    }

    public function getEliminarAsignatura($id)
    {
        if ($asignatura = Asignatura::find($id)) {
            $asignatura->delete();
        } else {
            return redirect()->back()->with(['mensaje' => 'Ocurrió un error, al parecer el registro ya no existe!', 'type' => 'error']);
        }
        return redirect()->back()->with(['mensaje' => 'Eliminación completa!', 'type' => 'success']);
    }

    public function postModificarAsignatura(Request $request)
    {
        if ($asignatura = Asignatura::find($request["id"])) {
            $asignatura->nombre = $request["nombre"];
            $asignatura->update();
            return response()->json(['mensaje' => 'Modificado Correctamente!', 'type' => 'success']);
        } else {
            return response()->json(['mensaje' => 'Ocurrió un error, al parecer el registro ya no existe!', 'type' => 'error']);
        }
    }

    public function postUsuariosAsignatura(Request $request)
    {
        $usuarios_asignatura=DB::table('asignaturas')
            ->join('usuario_asignaturas', 'asignaturas.id', '=', 'usuario_asignaturas.asignatura_id')
            ->join('usuarios', 'usuario_asignaturas.usuario_id', '=', 'usuarios.id')
            ->select('usuarios.nombre', 'usuarios.apellido', 'usuarios.id')
            ->where('asignaturas.id', '=', $request["asignatura_id"])
            ->get();
        return response()->json(['usuarios_asignatura'=>$usuarios_asignatura]);
    }
}
