<?php

namespace App\Http\Controllers;

use App\Asignatura;
use App\TipoUsuario;
use App\Usuario;
use App\UsuarioAsignatura;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use DB;

class UsuarioController extends Controller
{
    //
    public function postIngresar(Request $request)
    {
        $this->validate($request, [
            'email'=>'required',
            'password' => 'required'
        ]);
        if (Auth::attempt(['email' => $request["email"], 'password' => $request["password"]])) {
            return redirect()->route('inicio');
        }
        return redirect()->back();
    }

    public function getSalir()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function getLogin()
    {
        if (Auth::check())
            return redirect()->route('inicio');
        else
            return view('login');
    }

    public function getUsuarioAsignaturas()
    {
        $usuario = Usuario::find(Auth::user()->id);
        $asignaturas = DB::table('asignaturas')->whereNotIn('id', function ($query) {
            $query->select('asignatura_id')
                ->from('usuario_asignaturas')
                ->whereRaw('usuario_asignaturas.asignatura_id = asignaturas.id and usuario_asignaturas.usuario_id = ' . Auth::user()->id);
        })->get();
        $usuario_asignaturas = $usuario->asignaturas;
        return view('usuario_asignaturas')->with(['asignaturas' => $asignaturas, 'usuario_asignaturas' => $usuario_asignaturas]);
    }

    public function getUsuarios()
    {
        $usuarios = Usuario::all();
        $tipos = TipoUsuario::all();
        return view('usuarios')->with(['usuarios' => $usuarios, 'tipos_usuario' => $tipos]);
    }

    public function postRegistrarUsuario(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:usuarios|email',
            'nombre' => 'required|max:100|min:4',
            'apellido' => 'required|max:100|min:4',
            'password' => 'required|min:5|max:20|confirmed',
            'tipo_usuario_id' => 'required|integer|exists:tipo_usuarios,id'
        ]);
        $usuario = new Usuario();
        $usuario->nombre = $request["nombre"];
        $usuario->apellido = $request["apellido"];
        $usuario->email = $request["email"];
        $usuario->password = bcrypt($request["password"]);
        $usuario->tipo_usuario_id = $request["tipo_usuario_id"];
        $usuario->save();
        session()->flash('mensaje', 'Registro exitoso!');
        session()->flash('type', 'success');
        return redirect()->back()->with(['mensaje' => 'Registro exitoso!', 'type' => 'success']);
    }

    public function getEliminarUsuario($id)
    {
        if (!$usuario = Usuario::find($id)) {
            return redirect()->back()->with(['mensaje' => 'No se pudo eliminar, al parecer el registro no existe!', 'type' => 'error']);
        }
        $usuario->delete();
        return redirect()->back()->with(['mensaje' => 'Eliminación completada!', 'type' => 'success']);
    }

    public function postInscribirAsignatura(Request $request)
    {
        $this->validate($request, [
            'asignatura_id' => 'required|integer'
        ]);
        $UsuarioAsignatura = new UsuarioAsignatura();
        $UsuarioAsignatura->usuario_id = Auth::user()->id;
        $UsuarioAsignatura->asignatura_id = $request["asignatura_id"];
        $UsuarioAsignatura->save();
        return response()->json(['mensaje' => 'Inscripción exitosa!', 'type' => 'success']);
    }

    public function postRetirarAsignatura(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer'
        ]);
        if (!$UsuarioAsignatura = UsuarioAsignatura::find($request["id"])){
            return response()->json(['mensaje' => 'Error al eliminar, al parecer el registro no existe!', 'type' => 'error']);
        }else{
            $UsuarioAsignatura->delete();
            return response()->json(['mensaje' => 'Retiro exitoso!', 'type' => 'success']);
        }
    }
}
