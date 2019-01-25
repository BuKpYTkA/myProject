@php
    /**
     * @var \App\User $user
     */
@endphp
@extends('layouts.app')
@section('content')
    <div class="container">
        @if (!($result === null))
            <h3>Результат поиска по запросу "{{ $result }}"</h3>
            <hr>
            <h1>Псевдоним</h1>
            <ul class="list-group" style="margin-bottom: 10px">
                <li class="list-group-item"><a href="{{ route('posts.postsByAlias', $result) }}">{{ $result }}</a></li>
            </ul>
            <h1>ID</h1>
            <ul class="list-group">
                <li class="list-group-item"><a href="{{ route('posts.postsById', intval($result)) }}">{{ $result }}</a>
                </li>
            </ul>
        @else
            <h1>По вашему запросу ничего не найдено</h1>
        @endif
    </div>
@endsection