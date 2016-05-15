@extends('layouts.base')
@section('title')
    <title>Administrar Usuarios</title>
@endsection
@section('style')
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $("#asignaturas").dataTable({
                language:{
                    url:'js/Spanish.json'
                }
            });
        });
        $(document).on("click", "#registrar", function (e) {
            e.preventDefault();
            if (!confirm("¿Está seguro de registrar éste usuario?")){
                return;
            }
            $("form").submit();
        });
    </script>
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
        <div class="panel-heading">Administrar Usuarios</div>
        <div class="panel-body">
            <form action="{{route('registrarUsuario')}}" method="post">
                <h3>Registro</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Correo</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Correo" value="{{old('email')}}">
                            @if ($errors->get('email'))
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    @foreach($errors->get('email') as $error)
                                        <strong>Error:</strong>{{$error}}
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">Clave</label>
                            <input type="password" name="password" id="password" class="form-control"
                                   placeholder="Clave">
                            @if ($errors->get('password'))
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    @foreach($errors->get('password') as $error)
                                        <strong>Error:</strong>{{$error}}
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmación</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                                   placeholder="Clave">
                        </div>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nommbre" placeholder="Nombre" class="form-control" value="{{old('nombre')}}">
                            @if ($errors->get('nombre'))
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    @foreach($errors->get('nombre') as $error)
                                        <strong>Error:</strong>{{$error}}
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input type="text" name="apellido" id="apellido" placeholder="Apellido" class="form-control" value="{{old('apellido')}}">
                            @if ($errors->get('apellido'))
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    @foreach($errors->get('apellido') as $error)
                                        <strong>Error:</strong>{{$error}}
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="tipo_usuario_id">Tipo Usuario</label>
                            <select name="tipo_usuario_id" id="tipo_usuario_id" class="form-control">
                                <option value="">Seleccione...</option>
                                @foreach($tipos_usuario as $tipo_usuario)
                                    <option value="{{$tipo_usuario->id}}">{{$tipo_usuario->nombre}}</option>
                                @endforeach
                            </select>
                            @if ($errors->get('tipo_usuario_id'))
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    @foreach($errors->get('tipo_usuario_id') as $error)
                                        <strong>Error:</strong>{{$error}}
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-md-offset-6">
                        <input type="submit" id="registrar" value="Registrar" class="btn btn-success">
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-12">
                    <table id="asignaturas" class="table table-responsive table-stripped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo</th>
                                <th>Tipo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{$usuario->id}}</td>
                                <td>{{$usuario->nombre}}</td>
                                <td>{{$usuario->apellido}}</td>
                                <td>{{$usuario->email}}</td>
                                <td>{{$usuario->tipo_usuario->nombre}}</td>
                                <td>
                                    <a class="btn btn-danger eliminar" href="{{route('eliminarUsuario', ['id'=>$usuario->id])}}">Eliminar</a>
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