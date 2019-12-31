<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'user_name' => 'Admin',
            'password' => bcrypt('minhhieu97'),
            'is_super_manager' => 1,
        ]);
    }
}
