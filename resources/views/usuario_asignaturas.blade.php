@extends('layouts.base')
@section('title')
    <title>Inscripción de Asignaturas</title>
@endsection
@section('script')
    <script>
        var urlInscribir='{{route('inscribirAsignatura')}}';
        var urlRetirar='{{route('retirarAsignatura')}}';
        var token='{{csrf_token()}}';
    </script>
    <script src="{{URL::to('js/usuarioAsignatura.js')}}"></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <h3>Asignaturas Disponibles</h3>
            <ul>
                @foreach($asignaturas as $asignatura)
                    <li>{{$asignatura->nombre}} <a class="btn btn-success inscribir" data-id="{{$asignatura->id}}"><span class="glyphicon glyphicon-plus"></span></a></li><br>
                @endforeach
            </ul>
        </div>
        <div class="col-md-6">
            <h3>Asignaturas Inscritas</h3>
            <ul>
                @foreach($usuario_asignaturas as $usuario_asignatura)
                    <li>{{$usuario_asignatura->asignatura->nombre}} <a class="btn btn-danger retirar" data-id="{{$usuario_asignatura->id}}"><span class="glyphicon glyphicon-minus"></span></a></li><br>
                @endforeach
            </ul>
        </div>
    </div>
@endsection