<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('inicio')}}">Inicio</a>
        </div>
        <ul class="nav navbar-nav">
            @if(Auth::check())
                <li><a href="{{route('usuarioAsignaturas')}}">Inscribir Asignatura</a></li>
                <li><a href="{{route('preguntas')}}">Preguntas</a></li>
                @if(Auth::user()->tipo_usuario_id==1)
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administrar <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('asignaturas')}}">Asignaturas</a></li>
                            <li><a href="{{route('usuarios')}}">Usuarios</a></li>
                            <li><a href="{{route('monitores')}}">Monitores</a></li>
                        </ul>
                    </li>
                @endif
            @endif
        </ul>
        @if(Auth::check())
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::user()->email}} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href=""><i class="fa fa-user" aria-hidden="true"></i> Perfil</a></li>
                        <li><a href="{{route('salir')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> Salir</a></li>
                    </ul>
                </li>
            </ul>
        @endif
    </div><!-- /.container-fluid -->
</nav>