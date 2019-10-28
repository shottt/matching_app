@php
$header_pattern = 0;
$body_color = "bg-main";
$footer_flg = false;
@endphp
@extends('layouts.default')

  @section('main')
  <main class="container u-conainer-y text-center">
    <h1>新規登録</h1>
    <form action="{{ route('register.post') }}" class="sign-Form mt-5 text-left" method="post">
    @csrf
      <label class="mt-2" for="name">{{ __('Name') }}</label>
      <input class="u-bg-tr text-left pl-2  @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" id="name" placeholder="苗字と名前を入力してください。">
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

      <label class="mt-2" for="location">{{ __('Adress') }}¥</label>
      <input class="u-bg-tr text-left pl-2" type="text" name="location" id="location" placeholder="住所を入力してください。">
      <label class="mt-2" for="email">{{ __('E-Mail Address') }}</label>
      <input class="u-bg-tr text-left pl-2 @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" id="email" placeholder="メールアドレスを入力してください。">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

      <input class="u-bg-tr mt-3 text-left" type="password" name="pass" id="" placeholder="パスワードを入力してください。">
      
      <button type="submit" class="btn btn-light w-100 u-text-pink mt-5">{{ __('Register') }}</button>
    </form>
  </main>
  @endsection