@php
$header_pattern = 0;
$body_color = "bg-main";
$footer_flg = false;
@endphp
@extends('layouts.default')

  @section('main')
  <main class="container u-conainer-y text-center">
    <h1>サインイン</h1>
    <img class="img-fluid u-mt-40" src="/images/man-1.png" alt="">
    <form action="" class="sign-Form mt-5">
      <input class="u-bg-tr" type="email" name="email" id="" placeholder="メールアドレス">
      <input class="u-bg-tr mt-2" type="password" name="pass" id="" placeholder="パスワード">
      <button type="button" class="btn btn-light w-100 u-text-pink mt-5">はじめる</button>
      @csrf
    </form>
    
    <a class="mt-3 u-txt-w3 d-inline-block w-100 text-center">パスワード忘れましたか？</a>
    <a href="./register.html" class="mb-80 text-center sign-To-Register">新規登録しますか？<a>
  </main>
  @endsection


  