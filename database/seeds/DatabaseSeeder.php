<?php

use App\Rol;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Rol::truncate();
        User::truncate();

        $this->call(RolSeeder::class);
        $this->call(UserSeeder::class);
    }
}
