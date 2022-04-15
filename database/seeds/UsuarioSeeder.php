<?php

use Illuminate\Database\Seeder;
use App\User;
class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Daniel',
            'email' => 'correo@correo.com',
            'password' => Hash::make('123456789'),
        ]);
    }
}
