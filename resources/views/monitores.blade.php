@extends('layouts.base')
@section('title')
    <title>Monitores</title>
@endsection
@section('script')
    <script>
        var token='{{csrf_token()}}';
        var urlGetUsuarios='{{route('usuariosAsignatura')}}';
    </script>
    <script src="{{URL::to('js/monitores.js')}}"></script>
@endsection
@section('content')
    <div class="panel panel-default">
        @if(Session::has('mensaje'))
            <script>
                $(function(){
                    new PNotify({
                        title: 'Mensaje',
                        text: '{{Session::get('mensaje')}}',
                        type: '{{Session::get('type')}}'
                    });
                });
            </script>
        @endif
        <div class="panel-heading">Seleccionar Monitores</div>
        <div class="panel-body">
            <form action="{{route('registrarMonitorAsignatura')}}" method="post">
                <div class="row">
                    <div class="form-group col-md-5 col-md-offset-1">
                        <label for="asignatura_id">Asignatura</label>
                        <select name="asignatura_id" id="asignatura_id" class="form-control">
                            <option value="">Seleccione</option>
                            @foreach($asignaturas as $asignatura)
                                <option value="{{$asignatura->id}}">{{$asignatura->nombre}}</option>
                            @endforeach
                        </select>
                        @if ($errors->get('asignatura_id'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                @foreach($errors->get('asignatura_id') as $error)
                                    <strong>Error:</strong>{{$error}}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-5">
                        <label for="usuario_id">Usuario</label>
                        <select name="usuario_id" id="usuario_id" disabled class="form-control">
                            <option value="">Seleccione</option>
                        </select>
                        @if ($errors->get('usuario_id'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                @foreach($errors->get('usuario_id') as $error)
                                    <strong>Error:</strong>{{$error}}
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-md-offset-1">
                        <input type="submit" value="Registrar" class="btn btn-success">
                    </div>
                </div>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
            </form><br><br>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <table id="monitores" class="table table-responsive table-stripped table-hover">
                        <thead>
                        <tr>
                            <th>Asignatura</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($monitores as $monitor)
                            <tr>
                                <td>{{$monitor->asignatura->nombre}}</td>
                                <td>{{$monitor->usuario->nombre}} {{$monitor->usuario->apellido}}</td>
                                <td>
                                    <a href="{{route('eliminarMonitor', ['id'=>$monitor->id])}}" class="btn btn-danger eliminar">Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection