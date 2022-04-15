<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_productos')->insert([
            'nombre' => 'Producto',
            'created_at' => date('Y-m-d H:i:s'),

        ]);
        DB::table('tipo_productos')->insert([
            'nombre' => 'Servicio',
            'created_at' => date('Y-m-d H:i:s'),

        ]);
    }
}
