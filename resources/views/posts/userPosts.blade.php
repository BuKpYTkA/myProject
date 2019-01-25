@php
    /**
     * @var \App\Post $post
     * @var \App\User $user
     */
@endphp
@extends ('layouts.app')

@section('content')

    <div class="container">
        <h1>Посты от пользователя {{ $user->getName() }}</h1>
        <hr>
        <ul class="list-group">
            @foreach($posts as $post)
                <li class="list-group-item"><a href="/posts/post/{{ $post->getId() }}">{{ $post->getCaption() }}</a><p style="float: right; margin-bottom: 0;">{{ date_format($post->getCreatedAt(), 'd.m.y') }}</p></li>
            @endforeach
        </ul>
    </div>

@endsection