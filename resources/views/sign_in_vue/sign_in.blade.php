@php
$header_pattern = 0;
$body_color = "bg-main";
$footer_flg = false;
@endphp
@extends('layouts.default')

@section('main')
<main class="container u-container-y text-center" id="app1">

  <sign-register></sign-register>
  <a class="mt-3 u-txt-w3 d-inline-block w-100 text-center">パスワード忘れましたか？</a>
  <button-sign-register></button-sign-register>

</main>
@endsection


  