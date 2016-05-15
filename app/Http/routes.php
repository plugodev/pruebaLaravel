<?php
Route::get('/asignaturas', [
    'uses' => 'AsignaturaController@getAsignaturas',
    'as' => 'asignaturas',
    'middleware' => 'admin'
]);
Route::post('/registrarUsuario', [
    'uses' => 'UsuarioController@postRegistrarUsuario',
    'as' => 'registrarUsuario',
    'middleware' => 'admin'
]);
Route::get('/usuarios', [
    'uses' => 'UsuarioController@getUsuarios',
    'as' => 'usuarios',
    'middleware' => 'admin'
]);
Route::get('/eliminarAsignatura/{id}', [
    'uses' => 'AsignaturaController@getEliminarAsignatura',
    'as' => 'eliminarAsignatura',
]);
Route::get('/salir', [
    'uses' => 'UsuarioController@getSalir',
    'as' => 'salir',
]);
Route::post('/modificarAsignatura', [
    'uses' => 'AsignaturaController@postModificarAsignatura',
    'as' => 'modificarAsignatura',
]);
Route::get('/inicio', function () {
    return view('inicio');
})->name('inicio')->middleware('auth');

Route::get('/', [
    'uses' => 'UsuarioController@getLogin',
    'as' => 'login',
]);

Route::get('/usuario', [
    'uses' => 'UsuarioController@getAdmin',
    'as' => 'admin',
    'middleware' => 'admin'
]);

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/ingresar', [
    'uses' => 'UsuarioController@postIngresar',
    'as' => 'ingresar'
]);

Route::post('/crearAsignatura', [
    'uses' => 'AsignaturaController@postCrearAsignatura',
    'as' => 'crearAsignatura'
]);

Route::get('/usuario/asignaturas', [
    'uses' => 'UsuarioController@getUsuarioAsignaturas',
    'as' => 'usuarioAsignaturas',
    'middleware' => 'auth'
]);
Route::get('/eliminarUsuario/{id}', [
    'uses' => 'UsuarioController@getEliminarUsuario',
    'as' => 'eliminarUsuario',
    'middleware' => 'admin'
]);
Route::post('/inscribirAsignatura', [
    'uses' => 'UsuarioController@postInscribirAsignatura',
    'as' => 'inscribirAsignatura',
    'middleware' => 'auth'
]);
Route::post('/retirarAsignatura', [
    'uses' => 'UsuarioController@postRetirarAsignatura',
    'as' => 'retirarAsignatura',
    'middleware' => 'auth'
]);

Route::post('/preguntar', [
    'uses' => 'PreguntaController@postPreguntar',
    'as' => 'preguntar',
    'middleware' => 'auth'
]);

Route::get('/preguntas', [
    'uses' => 'PreguntaController@getPreguntas',
    'as' => 'preguntas',
    'middleware' => 'auth'
]);

Route::get('/monitores', [
    'uses' => 'MonitorController@getMonitores',
    'as' => 'monitores',
    'middleware' => 'admin'
]);

Route::post('/usuariosAsignatura', [
    'uses' => 'AsignaturaController@postUsuariosAsignatura',
    'as' => 'usuariosAsignatura',
    'middleware' => 'admin'
]);

Route::post('/registrarMonitorAsignatura', [
    'uses' => 'MonitorController@postRegistrarMonitorAsignatura',
    'as' => 'registrarMonitorAsignatura',
    'middleware' => 'admin'
]);
Route::get('/eliminarMonitor/{id}', [
    'uses' => 'MonitorController@getEliminarMonitor',
    'as' => 'eliminarMonitor',
    'middleware' => 'admin'
]);

Route::post('/responder', [
    'uses' => 'RespuestaController@postResponder',
    'as' => 'responder',
    'middleware' => 'auth'
]);
Route::get('/prueba', function () {
    $respuesta = \App\Respuesta::find(1);
    echo $respuesta->usuario->nombre;
});