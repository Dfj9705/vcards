<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
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
            'telefono' => '000000000',
            'password' => Hash::make('123456789'),
        ]);

      
        $user->assignRole('administrador');

    }
}
