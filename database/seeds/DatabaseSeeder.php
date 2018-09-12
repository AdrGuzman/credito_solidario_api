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
        $this->call(UsuariosTableSeeder::class);
        $this->call(SistemasTableSeeder::class);
        $this->call(ModulosTableSeeder::class);
        $this->call(OpcionesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsuariosRolesTableSeeder::class);
        $this->call(AutorizacionesTableSeeder::class);
        //$this->call(RolesOpcionesTableSeeder::class);
    }
}
