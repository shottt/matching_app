@extends('layouts.app')

@section('content')

<h1>新規登録</h1>
<form method="POST" action="{{ route('register') }}" class="sign-Form mt-5 text-left">
    @csrf
    <label class="mt-2" for="name">氏名</label>
    <input v-model="name" class="u-bg-tr text-left pl-2" type="text" name="name" id="name" placeholder="苗字と名前を入力してください。" required>
    
    <label class="mt-2" for="email">メールアドレス</label>
    <input v-model="email" class="u-bg-tr text-left pl-2" type="email" name="email" id="email" placeholder="メールアドレスを入力してください。" required>      
    
    <label class="mt-2" for="pass">パスワード</label>
    <input v-model="pass" class="u-bg-tr text-left pl-2" type="password" name="password" id="pass" placeholder="パスワードを入力してください。">
    <input v-model="repass" class="u-bg-tr text-left pl-2" type="password" name="password_confirmation" id="repass" placeholder="再度パスワードを入力してください。" required>

    
    <button type="submit"  class="btn btn-light w-100 u-text-pink mt-5">新規登録</button>
</form>
<a href="{{ route('login') }}" class="mb-80 text-center sign-To-Register">サインインしますか？</a>

@endsection
