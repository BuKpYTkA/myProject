@php
    /**
     * @var \App\Post $post
     */
@endphp
@extends ('layouts.app')

@section('content')

    <div class="container">
        <h1>Редактирование поста</h1>
        <hr>
        <form action="{{ route('posts.editPost', $post->getId()) }}" method="POST" style="margin-bottom: 10px">
            @csrf
            <input type="hidden" name="id" value="{{ $post->getId() }}">
            <input name="caption" class="form-control {{ $errors->has('caption') ? 'is-invalid' : '' }}" type="text" value="{{ $post->getCaption() }}" style="margin-bottom: 10px">
            @if($errors->has('caption')) <span class="invalid-feedback"><strong>{{ $errors->first('caption') }}</strong></span> @endif
            <textarea name="body" id="" cols="30" rows="10" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" style="margin-bottom: 10px">{{ $post->getBody() }}</textarea>
            @if($errors->has('body')) <span class="invalid-feedback"><strong>{{ $errors->first('body') }}</strong></span> @endif
            <input type="submit" name="save" value="Сохранить" class="btn btn-primary" style="margin-bottom: 10px">
        </form>
        <form action="{{ route('posts.deletePost', $post->getId())}}" method="POST">
            @csrf
            <input type="submit" class="btn btn-danger" value="Удалитьпост" >
        </form>
    </div>

@endsection