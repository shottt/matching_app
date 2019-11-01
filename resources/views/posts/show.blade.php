@extends('layouts.common')

@section('content')

<h1>id = {{ $post->id }} の投稿詳細ページ</h1>

    <p>{{ $post->detail }}</p>

@endsection