<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            'name' => '張阿峰',
            'email' => 'cc@mail.com',
            'password' => bcrypt('12345678'),
        ]);

        DB::table('tasks')->insert([
            'name' => '寢室內務',
            'content' => '摺好棉被、蚊帳',
            'user_id' => 1
        ]);
    }
}
