@extends('layouts.base')
@section('title')
    <title>Inicio</title>
@endsection
@section('content')
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
    <h1>Bienvenido</h1>
@endsection