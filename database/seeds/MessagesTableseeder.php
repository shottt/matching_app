<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'chat_id' => 1,
            'to_user' => 2,
            'from_user' => 1,
            'detail' => 'aaaaaaaaaaaaa',
            'attachment' => 'bbbbbbb',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::table('messages')->insert($param);
        
        // $param = [
        //     'chat_id' => 1,
        //     'to_user' => 2,
        //     'from_user' => 1,
        //     'detail' => 'aaaaaaaaaaaaa',
        //     'attachment' => 'bbbbbbb',
        //     'send_date' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ];
        // DB::table('messages')->insert($param);

        // $param = [
        //     'chat_id'=> 1,
        //     'to_user' => 2,
        //     'from_user' => 1,
        //     'detail' => 'aaaaaaaaaaaaa',
        //     'attachment' => 'bbbbbbb',
        //     'send_date' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ];
        // DB::table('messages')->insert($param);

        // $param = [
        //     'chat_id' => 1,
        //     'to_user' => 2,
        //     'from_user' => 1,
        //     'detail' => 'aaaaaaaaaaaaa',
        //     'attachment' => 'bbbbbbb',
        //     'send_date' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ];
        // DB::table('messages')->insert($param);

        // $param = [
        //     'chat_id' => 1,
        //     'to_user' => 2,
        //     'from_user' => 1,
        //     'detail' => 'aaaaaaaaaaaaa',
        //     'attachment' => 'bbbbbbb',
        //     'send_date' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ];
        // DB::table('messages')->insert($param);

        // $param = [
        //     'chat_id' => 1,
        //     'to_user' => 2,
        //     'from_user' => 1,
        //     'detail' => 'aaaaaaaaaaaaa',
        //     'attachment' => 'bbbbbbb',
        //     'send_date' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ];
        // DB::table('messages')->insert($param);

        // $param = [
        //     'chat_id' => 1,
        //     'to_user' => 2,
        //     'from_user' => 1,
        //     'detail' => 'aaaaaaaaaaaaa',
        //     'attachment' => 'bbbbbbb',
        //     'send_date' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ];
        // DB::table('messages')->insert($param);

        // $param = [
        //     'chat_id' => 1,
        //     'to_user' => 2,
        //     'from_user' => 1,
        //     'detail' => 'aaaaaaaaaaaaa',
        //     'attachment' => 'bbbbbbb',
        //     'send_date' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ];
        // DB::table('messages')->insert($param);

        // $param = [
        //     'chat_id' => 1,
        //     'to_user' => 2,
        //     'from_user' => 1,
        //     'detail' => 'aaaaaaaaaaaaa',
        //     'attachment' => 'bbbbbbb',
        //     'send_date' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ];
        // DB::table('messages')->insert($param);

        // $param = [
        //     'chat_id' => 1,
        //     'to_user' => 2,
        //     'from_user' => 1,
        //     'detail' => 'aaaaaaaaaaaaa',
        //     'attachment' => 'bbbbbbb',
        //     'send_date' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ];
        // DB::table('messages')->insert($param);

    }
}
