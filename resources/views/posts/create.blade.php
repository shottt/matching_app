@extends('layouts.common')

@section('content')

<h1>投稿新規作成ページ</h1>
<form action="{{ route('posts.store') }}" method="post">
  @csrf
  <label for="post">投稿</label>
  <input type="text" name="detail" id="post">
  <input type="submit" value="投稿する">
</form>

@endsection