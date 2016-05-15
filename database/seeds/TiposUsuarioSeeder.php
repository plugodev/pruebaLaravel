<?php

use Illuminate\Database\Seeder;

class TiposUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tipo_usuarios')->insert([
            'nombre' => 'Administrador',
            'descripcion' => 'Usuarios Administradores'
        ]);
        DB::table('tipo_usuarios')->insert([
            'nombre' => 'Estudiante',
            'descripcion' => 'Usuarios Estudiante'
        ]);
    }
}
