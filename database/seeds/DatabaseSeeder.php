<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TiposUsuarioSeeder::class);
        $this->call(UsuarioSeeder::class);
    }
}
