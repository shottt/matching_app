@extends('layouts.common')

@section('content')

<h1>投稿一覧</h1>

    @if (count($posts) > 0)
        <ul>
            @foreach ($posts as $post)
                <li><a href="{{ route('posts.show', ['id' => $post->id]) }}">{{ $post->detail }}</a></li>
            @endforeach
        </ul>
    @endif
    <a href="{{ route('posts.create') }}">新規投稿</a>

@endsection