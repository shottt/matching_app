<?php

namespace Tests\Feature;
use Mockery;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Session;

use App\User;
use App\Facades\Route;
use DatabaseSeeder;


/*
まず,testLoginし、ログイン中の各種テストを行う。
そして、最後にtestLogout
*/
class UsersTest extends TestCase
{
    //use RefreshDatabase;
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
     * 自分以外のユーザー全検索する
     * 
    */ 
    public function testSelect_All_Users(): void
    {
        $this->testLogin();
        $response = $this->actingAs($this->user);

        //API
        $result = $response->json('POST', '/api/ctrl_all_users',['_token' => csrf_token(),]);
        $result->assertStatus(200);
    }

    /**
     * 条件付きでユーザー検索する
     * 名前　職業
    */ 
    public function testSelect_Users(): void
    {
        $this->testLogin();
        $response = $this->actingAs($this->user);

        //API
        $result = $response->json('POST', '/api/ctrl_search_users',
        ['name' => $this->user->name],
        ['occupation' => $this->user->occupation],
        ['_token' => csrf_token(),]);

        $result->assertStatus(200);
    }


    /**
     * 自分以外のユーザー全検索する
     * 
    */ 
    public function testSelect_All_Friends(): void
    {
        $this->testLogin();
        $response = $this->actingAs($this->user);

        //API
        $result = $response->json('POST', '/api/ctrl_all_friends',['_token' => csrf_token(),]);
        $result->assertStatus(200);
    }

    /**
     * プロフィールを閲覧する。
     * 条件：名前　職業
    */ 
    public function testCheck_User(): void
    {
        $this->testLogin();
        $response = $this->actingAs($this->user);

        //API
        $result = $response->json('POST', '/api/ctrl_user_profile',
        ['_token' => csrf_token(),]);
        
        $result->assertStatus(200);
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
