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
            'email' => 'robertty55@gmail.com',
            'password' => bcrypt('123123'),
            'nombre' => 'Pedro',
            'apellido' => 'Lugo',
            'tipo_usuario_id' => 1
        ]);
    }
}
