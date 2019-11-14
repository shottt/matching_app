<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param1 =[
            'name' => 'test taro',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'occupation' => 'エンジニア',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('users')->insert($param1);

        $param2 =[
            'name' => 'a taro',
            'email' => 'a@a.com',
            'password' => bcrypt('password'),
            'occupation' => 'エンジニア',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('users')->insert($param2);

        $param3 =[
            'name' => 'b taro',
            'email' => 'b@b.com',
            'password' => bcrypt('password'),
            'occupation' => 'エンジニア',
            'delete_flag' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('users')->insert($param3);
    }
}
