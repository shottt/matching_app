<?php

namespace Tests\Feature;
use Mockery;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use App\User;
use App\Chat;

use App\Facades\Route;
use DatabaseSeeder;


/*
まず,testLoginし、ログイン中の各種テストを行う。
そして、最後にtestLogout
*/
class ChatTest extends TestCase
{
    //use RefreshDatabase;
    protected $me; //User
    protected $friend; //User

    //複数作成してランダムで二人選ぶ
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
        $this->me = User::find($randum_id);

        $randum_id = array_shift($list);
        $this->friend = User::find($randum_id);
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

        Session::start();

        //選択したユーザ一人が存在するかチェック
        $data = $this->user->toArray();
        $this->assertDatabaseHas('users', $data);

        //ログイン
        $response = $this->post('/login', 
            [
                'email' => $this->user->email,
                'password' => 'password',
                '_token' => csrf_token(), 
            ]
            )->assertStatus(302);

        $this->assertAuthenticatedAs($this->user);
        
    }


    /**
     * チャットコメントを取得する
     * 
    */ 
    public function testGet_Chat_Comments(): void
    {
        $this->testLogin();
        $response = $this->actingAs($this->user);
        
        //
        $result = $response->json('POST', '/api/ctrl_get_chat',[
            '_token' => csrf_token(),
            'my_id' => $this->me->id, 
            'user_id' => $this->friend->id
        ]);
        $result->assertStatus(200);

    }


    /**
     * チャットコメントを追加する
     * 
    */ 
    public function testAdd_Chat_Comments(): void
    {
        $this->testLogin();
        $response = $this->actingAs($this->user);
        
        $test_comment =  Str::random(10);

        //コメント追加
        $result = $response->json('POST', '/api/ctrl_add_chat_comment',[
            '_token' => csrf_token(),
            'my_id' => $this->me->id, 
            'user_id' => $this->friend->id,
            'comment' => $test_comment,
        ]);
        $result->assertStatus(200);

        ///最新のコメントの内容が$test_commentとなっているか確認
        //あってるかわからない
        $result = $response->json('POST', '/api/ctrl_get_chat',[
            '_token' => csrf_token(),
            'my_id' => $this->me->id, 
            'user_id' => $this->friend->id
        ]);
        $comment = array_shift($result->toArray());

        $this->assertEquals($comment['comment'], $test_comment);

    }





    public function testLogout(): void
    {
        $this->testLogin();
        
        $response = $this->actingAs($this->user);

        $response = $this->post(route('logout'), [
            '_token' => csrf_token(),
        ]);
        
        $response->assertStatus(302);

        $this->assertGuest();
        $this->tearDown();
        
    }




        //
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

}
