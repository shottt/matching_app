@php
$header_pattern = 2;
$footer_flg = true;
@endphp
@extends('layouts.default')
 
  @section('main')  
  <main class="u-conainer-y">
    <div class="container-fluid">
      
      <form class="search-Form text-center" action="">
        <label class="my-5 u-txt-b" for="search-key">キーワードを入力してください</label>
        <input class="u-bt-border-grey w-100" type="text" id="search-key" name="search-key">

        <button type="button" class="btn w-100 bg-main u-mt-200 position-relative text-light">
          <img class="pr-1" src="/images/search-icon-white.png" style="display: inline-block; vertical-align: sub;" alt="">
          はじめる
        </button>
      </form>
    </div>
  </main>
  @endsection