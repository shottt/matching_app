<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;
use DatabaseSeeder;

class UsersTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {   
        /*
        //テーブルテスト
        $data = [
            'name' => '111',
            'email' => '111st@example.com',
        ];

        //create
        $user = new User();    
        $user->fill($data)->save();
        $this->assertDatabaseHas('users', $data);

        //update
        $user->name = 'Dummy';
        $user->save();
        $data['name'] = $user->name = 'Dummy';
        $this->assertDatabaseHas('users', $data);

        //serach

        //serach_by

        //delete
        $user->delete();
        $this->assertDatabaseMissing('users', $data);

        //シーダー利用
        $this->seed(DatabaseSeeder::class);
        $user = User::find(1);
        $data = $user->toArray();
        $this->assertDatabaseHas('users', $data);

        $user->delete();
        $this->assertDatabaseMissing('users', $data);
        */

        //ランダムテスト
        /*
        for ($i = 0; $i < 100; $i ++ ) {
            factory(User::class)->create();
        }
        $count = User::get()->count();
        $user = User::find(rand(1, $count));
        $data = $user->toArray();
        print_r($data);

        $this->assertDatabaseHas('users', $data);
        $user->delete();
        $this->assertDatabaseMissing('users', $data);
        */

        //ランダムテスト state版
        $list = [];
        for ($i = 0; $i < 10; $i ++ ) {
            $p1 = factory(User::class)->create();
            $p2 = factory(User::class)->states('upper')->create();
            $p3 = factory(User::class)->states('lower')->create();
            $p4 = factory(User::class)->states('upper')->states('lower')->create();
            $list = array_merge($list, [$p1->id, $p2->id, $p3->id, $p4->id]);
        }
        for ($i = 0; $i < 10; $i ++ ) {
            shuffle($list);

            $item = array_shift($list);
            $user = User::find($item);
            $data = $user->toArray();
            print_r($data);

            $this->assertDatabaseHas('users', $data);
            
            $user->delete();
            $this->assertDatabaseMissing('users', $data);

        }
        
    }
}
