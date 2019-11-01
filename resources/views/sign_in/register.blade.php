@php
$header_pattern = 0;
$body_color = "bg-main";
$footer_flg = false;
@endphp
@extends('layouts.default')

  @section('main')
  <main class="container u-container-y text-center">
    <h1>新規登録</h1>
    <form action="" class="sign-Form mt-5 text-left">
      <label class="mt-2" for="name">氏名</label>
      <input class="u-bg-tr text-left pl-2" type="email" name="" id="name" placeholder="苗字と名前を入力してください。">
      <label class="mt-2" for="location">住所</label>
      <input class="u-bg-tr text-left pl-2" type="password" name="location" id="location" placeholder="住所を入力してください。">
      <label class="mt-2" for="email">メールアドレス</label>
      <input class="u-bg-tr text-left pl-2" type="password" name="email" id="email" placeholder="メールアドレスを入力してください。">      
      <input class="u-bg-tr mt-3 text-left" type="password" name="pass" id="" placeholder="パスワードを入力してください。">
      @csrf
      <button type="button" class="btn btn-light w-100 u-text-pink mt-5">新規登録</button>
    </form>
  </main>
  @endsection