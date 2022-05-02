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
            [
                'name' => '新兵張阿峰',
                'email' => 'cc@mail.com',
                'password' => bcrypt('12345678'),
                'rank' => 0
            ],
            [
                'name' => '上士陳大衛',
                'email' => 'ww@mail.com',
                'password' => bcrypt('12345678'),
                'rank' => 1
            ],
            [
                'name' => '上校林午五',
                'email' => 'll@mail.com',
                'password' => bcrypt('12345678'),
                'rank' => 2
            ] 
        ]);

        DB::table('tasks')->insert([
            [
                'name' => '寢室內務',
                'content' => '摺好棉被、蚊帳',
                'user_id' => 1,
                'confidential' => false
            ],
            [
                'name' => '打靶',
                'content' => '1300帶隊至靶場',
                'user_id' => 2,
                'confidential' => false
            ],
            [
                'name' => '國安會議',
                'content' => '2000會議室',
                'user_id' => 3,
                'confidential' => true
            ]
        ]);
    }
}
