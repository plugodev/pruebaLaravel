@extends('layouts.base')
@section('title')
    <title>Top de Estudiantes</title>
@endsection
@section('style')
    <link rel="stylesheet" href="{{URL::to('css/preguntas.css')}}">
@endsection
@section('content')
    <div class="posts" style="text-align: center;">
    @foreach($top as $usuario)
        <div class="post" style="box-shadow: 1px 5px 5px darkgray">
            <i class="fa fa-user fa-4x" aria-hidden="true"></i><h3 class="">{{$usuario->nombre}} {{$usuario->apellido}}</h3><br>
            <h4>{{$usuario->total_estrellas}}</h4> <i class="fa fa-star-o fa-5x" aria-hidden="true"></i>
        </div>
    @endforeach
    </div>
@endsection