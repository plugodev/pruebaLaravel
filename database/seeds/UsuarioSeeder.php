<?php

use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('usuarios')->insert([
            'email' => 'prueba@laravel.com',
            'password' => bcrypt('123123'),
            'nombre' => 'Prueba',
            'apellido' => 'Laravel',
            'tipo_usuario_id' => 1
        ]);
    }
}
