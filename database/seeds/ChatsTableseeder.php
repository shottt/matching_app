<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ChatsTableseeder extends Seeder
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
    }
}
