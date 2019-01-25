@php
    /**
     * @var \App\Post $post
     * @var \App\User
     */
@endphp
@extends ('layouts.app')

@section('content')

    <div class="container">
        <h3>{{ $userName }}</h3>
        <hr>
        <div style="display: inline">
            <h1 style="float: left">{{ $post->getCaption() }}</h1>
            <p style="float: right; margin-bottom: 0">{{ date_format($post->getCreatedAt(),'d.m.y H:i') }}</p>
        </div>
        <textarea disabled name="" id="" cols="30" rows="10" class="form-control">{{ $post->getBody() }}</textarea>
        <br>
        <a href="javascript:history.back()"><--Назад</a>
    </div>

@endsection