@extends ('layouts.app')

@section('content')

    <div class="container">
        <h1>Создание поста</h1>
        <hr>
        <form action="{{ route('posts.createPost') }}" method="POST">
            @csrf
            <input placeholder="Заголовок" name="caption"
                   class="form-control {{ $errors->has('caption') ? 'is-invalid' : '' }}" type="text" value="" style="margin-bottom: 10px">
            @if($errors->has('caption')) <span class="invalid-feedback"><strong>{{ $errors->first('caption') }}</strong></span> @endif
            <textarea placeholder="Текст поста" name="body" id="" cols="30" rows="10"
                      class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" style="margin-bottom: 10px"></textarea>
            @if($errors->has('body')) <span
                    class="invalid-feedback"><strong>{{ $errors->first('body') }}</strong></span> @endif
            <input type="submit" name="save" value="Сохранить" class="btn btn-primary">
        </form>
    </div>

@endsection