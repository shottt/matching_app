<?php

namespace Tests\Feature;
use Mockery;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

use App\User;
use App\Facades\Route;
use DatabaseSeeder;

class UsersTest extends TestCase
{
    use RefreshDatabase;
    protected $user; //User

    //複数作成してランダムで一人選ぶ
    public function setUp(): void
    {
        parent::setUp();

        // テストユーザ作成
        $p1 = factory(User::class)->create();
        $p2 = factory(User::class)->create();
        $p3 = factory(User::class)->create();
        $p4 = factory(User::class)->create();
        $list = [ $p1->id, $p2->id, $p3->id, $p4->id];

        //選択
        shuffle($list);
        $randum_id = array_shift($list);
        $this->user = User::find($randum_id);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLogin(): void
    {   

        //選択したユーザ一人が存在するかチェック
        $data = $this->user->toArray();
        $this->assertDatabaseHas('users', $data);

        //ログイン
        $response = $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'password'
        ])->assertStatus(200);

        /*もしかして、login画面からpostが必要？
        fromメソッドの意味はまだわかっていない
        $response = $this->from('/login')->post('/login', [
            'email' => $this->user->email,
            'password' => 'password'
        ])->assertStatus(200);
        */
        //指定したユーザーが認証されていることを確認
        
        //ユーザー全検索する

        //ユーザーを「職業」で検索する

        //検索機能はどうしますか？

        //友達を全表示する

        //友達の声を全表示する

        //settings系
        //プロフィール確認する

        //プロフィール編集する

        //パスワード変更する

        //サインアウトする
        
        //$response->assertStatus(200);
        //退会処理する
        $this->tearDown();
    }

           

}
