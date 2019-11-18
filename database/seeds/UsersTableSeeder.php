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
        $param =[
            'id' => 1,
            'name' => 'testtaro',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'occupation' => 'エンジニア',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('users')->insert($param);

        $param =[
            'id' => 2,
            'name' => 'ataro',
            'email' => 'a@a.com',
            'password' => bcrypt('password'),
            'occupation' => 'エンジニア',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('users')->insert($param);

        $param =[
            'id' => 3,
            'name' => 'btaro',
            'email' => 'b@b.com',
            'password' => bcrypt('password'),
            'occupation' => 'エンジニア',
            'delete_flag' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('users')->insert($param);
    }
}
