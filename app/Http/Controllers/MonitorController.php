<?php

namespace App\Http\Controllers;

use App\Monitor;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class MonitorController extends Controller
{
    //
    public function getMonitores()
    {
        $asignaturas = \App\Asignatura::all();
        $monitores = \App\Monitor::all();
        return view('monitores')->with(['asignaturas' => $asignaturas, 'monitores'=>$monitores]);
    }

    public function postRegistrarMonitorAsignatura(Request $request)
    {
        $this->validate($request, [
            'usuario_id' => 'required|integer',
            'asignatura_id' => 'required|integer'
        ]);
        $Monitor = new Monitor();
        $Monitor->usuario_id = $request["usuario_id"];
        $Monitor->asignatura_id = $request["asignatura_id"];
        $Monitor->save();
        return redirect()->back()->with(['mensaje' => 'Registro completado!', 'type' => 'success']);
    }

    public function getEliminarMonitor($id)
    {
        if (!$monitor = Monitor::find($id)) {
            return redirect()->back()->with(['mensaje' => 'Ocurrió un error, al parecer el registro ya no existe!', 'type' => 'error']);
        }
        $monitor->delete();
        return redirect()->back()->with(['mensaje' => 'Eliminación exitosa!', 'type' => 'success']);
    }

}