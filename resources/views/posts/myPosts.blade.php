@php
    /**
     * @var \App\Post $post
     */
@endphp
@extends ('layouts.app')

@section('content')

    <div class="container">
        <h1>Управление постами</h1>
        <hr>
        <a href="{{ route('posts.createPostForm') }}"><input type="button" value="Создать пост" class="btn btn-success" style="margin-bottom: 10px"></a>
        <ul class="list-group">
            @foreach($posts as $post)
                <li class="list-group-item"><a href="/posts/post/{{ $post->getId() }}/edit">{{ $post->getCaption() }}</a><p style="float: right; margin-bottom: 0;">{{ date_format($post->getCreatedAt(), 'd.m.y') }}</p></li>
            @endforeach
        </ul>
    </div>

@endsection