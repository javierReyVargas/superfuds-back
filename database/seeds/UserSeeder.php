<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
          [
              'name' => 'admin',
              'rol_id' => 1,
              'email' => 'admin.example@example.com',
              'cellphone' => '123456789',
              'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password,
          ],[
              'name' => 'proveedor ',
              'rol_id' => 2,
              'email' => 'provider.example@example.com',
              'cellphone' => '123456789',
              'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password,
          ],[
              'name' => 'client',
              'rol_id' => 3,
              'email' => 'client.example@example.com',
              'cellphone' => '123456789',
              'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password,
          ]
        ];

        User::insert($data);
    }
}
