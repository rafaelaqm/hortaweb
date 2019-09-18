<?php

use Illuminate\Database\Seeder;
use App\Entities\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
          'cpf'      => '07941415607',
          'name'     => 'Rafaela Queiroz Miranda',
          'phone'    => '34991276853',
          'birth'    => '1985-12-23',
          'gender'   => 'F',
          'notes'    => 'Usuário Administrador',
          'email'    => 'rafaelaqmd@hotmail.com',
          'password' => env('PASSWORD_HASH') ? bcrypt('iris2312') : 'iris2312',

        ]);
      }
}
