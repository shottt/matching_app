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
            'id' => 1,
            'to_user' => 2,
            'from_user' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('chats')->insert($param);

        $param = [
            'id' => 2,
            'to_user' => 3,
            'from_user' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('chats')->insert($param);

        $param = [
            'id' => 3,
            'to_user' => 4,
            'from_user' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('chats')->insert($param);

        $param = [
            'id' => 4,
            'to_user' => 5,
            'from_user' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('chats')->insert($param);

        $param = [
            'id' => 5,
            'to_user' => 6,
            'from_user' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('chats')->insert($param);

        $param = [
            'id' => 6,
            'to_user' => 7,
            'from_user' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('chats')->insert($param);

        $param = [
            'id' => 7,
            'to_user' => 8,
            'from_user' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('chats')->insert($param);

        $param = [
            'id' => 8,
            'to_user' => 9,
            'from_user' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('chats')->insert($param);

        $param = [
            'id' => 9,
            'to_user' => 10,
            'from_user' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('chats')->insert($param);

        $param = [
            'id' => 10,
            'to_user' => 11,
            'from_user' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('chats')->insert($param);
    }
}
