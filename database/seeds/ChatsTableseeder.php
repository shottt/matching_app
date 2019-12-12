<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ChatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'to_user' => 2,
            'from_user' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('chats')->insert($param);

        $param = [
            'to_user' => 3,
            'from_user' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('chats')->insert($param);

        $param = [
            'to_user' => 4,
            'from_user' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('chats')->insert($param);

        $param = [
            'to_user' => 5,
            'from_user' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('chats')->insert($param);

        $param = [
            'to_user' => 6,
            'from_user' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('chats')->insert($param);

        $param = [
            'to_user' => 7,
            'from_user' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('chats')->insert($param);

        $param = [
            'to_user' => 8,
            'from_user' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('chats')->insert($param);

        $param = [
            'to_user' => 9,
            'from_user' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('chats')->insert($param);

        $param = [
            'to_user' => 10,
            'from_user' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('chats')->insert($param);

        $param = [
            'to_user' => 11,
            'from_user' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('chats')->insert($param);
    }
}
