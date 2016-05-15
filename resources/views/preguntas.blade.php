@extends('layouts.base')
@section('title')
    <title>Preguntas</title>
@endsection
@section('style')
    <link rel="stylesheet" href="{{URL::to('css/preguntas.css')}}">
@endsection
@section('script')
    <script>
        var urlResponder = '{{route('responder')}}';
        var token = '{{csrf_token()}}';
    </script>
    <script src="{{URL::to('js/preguntas.js')}}"></script>
@endsection
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Preguntas</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <form action="{{route('preguntar')}}" method="post">
                        <div class="form-group">
                            <label for="pregunta">Pregunta</label>
                            <textarea name="pregunta" id="pregunta" cols="5" rows="5"
                                      class="form-control">{{old('pregunta')}}</textarea>
                            @if ($errors->get('pregunta'))
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    @foreach($errors->get('pregunta') as $error)
                                        <strong>Error:</strong>{{$error}}
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="asignatura_id">Asignatura</label>
                            <select name="asignatura_id" id="asignatura_id" class="form-control">
                                <option value="">Seleccione...</option>
                                @foreach($usuario_asignaturas as $usuario_asignatura)
                                    <option value="{{$usuario_asignatura->asignatura->id}}">{{$usuario_asignatura->asignatura->nombre}}</option>
                                @endforeach
                            </select>
                            @if ($errors->get('asignatura_id'))
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    @foreach($errors->get('asignatura_id') as $error)
                                        <strong>Error:</strong>{{$error}}
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="submit" value="Preguntar" class="btn btn-success">
                    </form>
                </div>
            </div>
            <hr>
            <section class="row posts">
                <div class="col-md-6 col-md-offset-3">
                    <header><h3>Otras Preguntas</h3></header>
                    @foreach($preguntas as $pregunta)
                        <article class="post">
                            <p>{{$pregunta->pregunta}}</p>
                            <div class="info">
                                Compartida por {{$pregunta->usuario->nombre}} {{$pregunta->usuario->apellido}}
                                / {{$pregunta->updated_at->format('d-m-Y h:i:s A')}}<br>
                                Asignatura: {{$pregunta->asignatura->nombre}}
                            </div>
                            <div class="interaccion">
                                @if(in_array($pregunta->asignatura->nombre, $usuario_monitor))
                                    <a href="#" class="like"><i class="fa fa-star fa-lg" aria-hidden="true"></i></a>
                                @endif
                            </div>
                            <div class="respuestas">
                                @if(in_array($pregunta->asignatura->nombre, $usuario_monitor))
                                    <textarea id="respuesta" class="form-control respuesta" cols="5"
                                              rows="3"></textarea>
                                    <a class="btn btn-success responder" data-id="{{$pregunta->id}}">Responder</a>
                                @endif
                                <ul>
                                    @foreach($pregunta->respuestas as $respuesta)
                                        {{--*/ $resp = \App\Respuesta::find($respuesta->id) /*--}}
                                        <li>
                                            {{$respuesta->respuesta}}
                                            <div class="info">
                                                {{$resp->usuario->nombre}} {{$respuesta->usuario->apellido}}
                                                / {{$respuesta->updated_at->format('d-m-Y H:i:s')}}
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </article>
                        <hr>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
@endsection