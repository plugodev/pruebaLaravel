@extends('layouts.base')
@section('title')
    <title>Asignaturas</title>
@endsection
@section('script')
    <script>
        var tr={};
        var urlModificar='{{route('modificarAsignatura')}}';
        var token='{{csrf_token()}}';
        var button={};
        $(document).ready(function () {
            $("#nombre").focus();
        });
    </script>
    <script src="{{URL::to('js/app.js')}}"></script>
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
        <div class="panel-heading">Administración de Asignaturas</div>
        <div class="panel-body">
            <form action="{{route('crearAsignatura')}}" method="post">
                <div class="row">
                    <div class="form-group col-md-6 col-md-offset-3">
                        @if ($errors->get('nombre'))
                            <ul>
                                @foreach($errors->get('nombre') as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Asignatura">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-md-offset-3">
                        <input type="submit" class="btn btn-success" value="Registrar">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                    </div>
                </div>
            </form>
            <table id="asignaturas" class="table table-hover table-stripped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th style="width: 20%;">Acciones</th>
                </tr>
                </thead>
                <tbody>
                {{--*/ $cont = 1 /*--}}
                @foreach($asignaturas as $asignatura)
                    <tr>
                        <td>{{$cont}}</td>
                        <td>{{$asignatura->nombre}}</td>
                        <td>
                            <a class="btn btn-danger eliminar" href="{{route('eliminarAsignatura', ['id'=>$asignatura->id])}}" data-id="{{$asignatura->id}}">Eliminar</a>
                            <a class="btn btn-primary modificar" data-nombre="{{$asignatura->nombre}}" data-id="{{$asignatura->id}}">Modificar</a>
                        </td>
                    </tr>
                    {{--*/ $cont++/*--}}
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modificar Asignatura</h4>
                </div>
                <div class="modal-body">
                    <form action="">
                        <input type="text" id="edit-nombre" class="form-control">
                        <input type="hidden" id="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="edit-id" id="id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button id="guardar" type="button" class="btn btn-success">Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection