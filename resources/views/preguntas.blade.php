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
        <div class="panel-heading">Preguntas</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <form id="form_preguntar" action="{{route('preguntar')}}" method="post">
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
                        <input type="submit" id="preguntar" value="Preguntar" class="btn btn-success">
                    </form>
                </div>
            </div>
            <hr>
            <section class="row posts">
                <div class="col-md-6 col-md-offset-3">
                    <header><h3>Otras Preguntas</h3></header>
                    {{--*/ $arrayCorrect = [] /*--}}
                    @foreach($preguntas as $pregunta)
                        <article class="post">
                            <p>{{$pregunta->pregunta}}</p>
                            <div class="info">
                                Realizada por {{$pregunta->usuario->nombre}} {{$pregunta->usuario->apellido}}
                                / {{$pregunta->updated_at->format('d-m-Y h:i:s A')}}<br>
                                Asignatura: {{$pregunta->asignatura->nombre}}
                            </div>
                            <div class="interaccion">
                                {{--*/ $valoracion_usuario = 0 /*--}}
                                @foreach($pregunta->valoraciones as $valoracion)
                                    @if($valoracion->usuario_id==Auth::user()->id)
                                        {{--*/ $valoracion_usuario = $valoracion->valoracion /*--}}
                                    @endif
                                @endforeach
                                @if(in_array($pregunta->asignatura->nombre, $usuario_monitor))
                                    <a href="#" @if (!$valoracion_usuario and $pregunta->usuario_id != Auth::user()->id) class="valorar" @endif @if($valoracion_usuario) class="valorar_lista" @endif @if($pregunta->usuario_id == Auth::user()->id) class="valorar_propia" @endif data-id="{{$pregunta->id}}">
                                        @if ($valoracion_usuario)
                                            @for($i=0;$i<5;$i++)
                                                @if($i<$valoracion_usuario)
                                                    <i class="fa fa-star fa-lg" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-star-o fa-lg" aria-hidden="true"></i>
                                                @endif
                                            @endfor
                                        @else
                                            <i class="fa fa-star-o fa-lg" aria-hidden="true"></i>
                                            <i class="fa fa-star-o fa-lg" aria-hidden="true"></i>
                                            <i class="fa fa-star-o fa-lg" aria-hidden="true"></i>
                                            <i class="fa fa-star-o fa-lg" aria-hidden="true"></i>
                                            <i class="fa fa-star-o fa-lg" aria-hidden="true"></i>
                                        @endif
                                    </a>
                                @endif
                            </div>
                            <div class="respuestas">
                                <ul>
                                    {{--*/ $correcta = 0 /*--}}
                                    @foreach($pregunta->respuestas as $respuesta)
                                        {{--*/ $resp = \App\Respuesta::find($respuesta->id) /*--}}
                                        <li @if($respuesta->correcta==true) class="alert alert-success" @endif>
                                            {{$respuesta->respuesta}}
                                            <div class="info">
                                                {{$resp->usuario->nombre}} {{$respuesta->usuario->apellido}}
                                                / {{$respuesta->updated_at->format('d-m-Y H:i:s')}}
                                                @if(Auth::user()->id==$pregunta->usuario->id)
                                                    <br><a href="{{route('elegirRespuesta', ['id' =>$respuesta->id])}}" class="btn btn-primary correcta correcta{{$pregunta->id}}" data-id="{{$respuesta->id}}">Correcta</a>
                                                @endif
                                            </div>
                                            <hr>
                                        </li>
                                        @if($respuesta->correcta==true)
                                            {{--*/ $correcta++ /*--}}
                                            @if(!in_array('correcta'.$pregunta->id, $arrayCorrect))
                                                {{--*/ array_push($arrayCorrect, ".correcta".$pregunta->id)/*--}}
                                            @endif
                                        @endif
                                    @endforeach
                                </ul>
                                @if(in_array($pregunta->asignatura->nombre, $usuario_monitor))
                                    <textarea placeholder="Respuesta" id="respuesta" class="form-control respuesta" cols="5" @if($correcta!=0) readonly @endif
                                              rows="3"></textarea>
                                    <a class="btn btn-success responder @if($correcta!=0) disabled @endif" id="resp{{$pregunta->id}}" data-id="{{$pregunta->id}}">Responder</a>
                                @endif
                            </div>
                        </article>
                        <hr>
                    @endforeach
                    @foreach($arrayCorrect as $eliminar)
                        <script>
                            elemento='{{$eliminar}}';
                            $(elemento).remove();
                        </script>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-valoracion">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">¿Con cuantas estrellas desea valorar la pregunta?</h4>
                </div>
                <form action="{{route('valorar')}}" method="post">
                <div class="modal-body">
                        <input id="valoracion" type="range" name="valoracion" value="1" min="1" max="5">
                        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" id="pregunta_id" name="pregunta_id" value="{{csrf_token()}}">
                        <div id="estrellas" style="text-align: center;">
                            <i class="fa fa-star-o fa-lg" aria-hidden="true"></i>
                        </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-default" data-dismiss="modal">Cerrar</a>
                    <input id="valorar" type="submit" class="btn btn-success" value="Valorar">
                </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection