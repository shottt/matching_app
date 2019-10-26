@php
$header_pattern = 0;
$body_color = "bg-main";
$footer_flg = false;
@endphp
@extends('layouts.default')

  @section('main')
  <main class="container u-conainer-y text-center" id="app1">
      <sign-register sign="register"></sign-register>
  </main>
  @endsection