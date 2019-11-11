@extends('layouts.app')

@section('content')


<h1>サインイン</h1>
<img class="img-fluid u-mt-40" src="/images/man-1.png" alt="">
<form action="{{ route('login') }}" class="sign-Form mt-5" method="POST">
    <input class="u-bg-tr" type="email" name="email" id="" placeholder="メールアドレス">
    <input class="u-bg-tr mt-2" type="password" name="password" id="" placeholder="パスワード">
    <button type="submit" class="btn btn-light w-100 u-text-pink mt-5">はじめる</button>
    @csrf
</form>

@if (Route::has('password.request'))
<a class="mt-3 u-txt-w3 d-inline-block w-100 text-center" href="{{ route('password.request') }}">パスワード忘れましたか？</a>
@endif

<a href="{{ route('register') }}" class="mb-80 text-center sign-To-Register">新規登録しますか？</a>
@endsection
