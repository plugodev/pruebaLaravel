@extends('layouts.base')
@section('title')
    <title>Login</title>
@endsection
@section('content')
    <div class="panel panel-default">
        @if(isset($mensaje))
            <p>{{$mensaje}}</p>
        @endif
        @if (isset($errors))
            <ul>
                @foreach($errors as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif
        <div class="panel-heading">Iniciar Sesión</div>
        <div class="panel-body">
            <div class="col-md-6 col-md-offset-3">
                <h3>Ingreso</h3>
                <form action="{{route('ingresar')}}" method="post">
                    <div class="form-group">
                        <label for="email">Correo</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Correo">
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
                        <input type="password" name="password" id="password" class="form-control" placeholder="Clave">
                        @if ($errors->get('password'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                @foreach($errors->get('password') as $error)
                                    <strong>Error:</strong>{{$error}}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="submit" value="Entrar" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection