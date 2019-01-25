@php
    /**
     * @var \App\User $user
     */
@endphp
@extends('layouts.app')
@section('content')

    <div class="container">
        <h1>Редактирование персональной информации</h1>
        <hr>
        <form action="{{ route('cabinet.editPersonal') }}" method="POST" style="margin-bottom: 10px">
            @csrf
            @if($errors->has('success')) <strong style="color: green;">{{ $errors->first('success') }}</strong> @endif
            <p>Никнейм</p>
            <input name="name" class="form-control {{ ($errors->has('name')) ? 'is-invalid' : '' }}" type="text"
                   value="{{ $user->getName() }}" style="margin-bottom: 10px; width: 300px">
            @if($errors->has('name')) <span
                    class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span> @endif
            <p>e-mail</p>
            <input name="email" class="form-control {{ ($errors->has('email')) ? 'is-invalid' : '' }}" type="email"
                   value="{{ $user->getEmail() }}" style="margin-bottom: 10px; width: 300px">
            @if($errors->has('email')) <span
                    class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span> @endif
            <p>Пседоним</p>
            <input name="alias" class="form-control {{ ($errors->has('alias')) ? 'is-invalid' : '' }}" type="text"
                   value="{{ $user->getAlias() }}" style="margin-bottom: 10px; width: 300px">
            @if($errors->has('alias')) <span
                    class="invalid-feedback"><strong>{{ $errors->first('alias') }}</strong></span> @endif
            <input class="btn btn-primary" type="submit" value="Сохранить данные">
        </form>
        <a href="{{ route('cabinet.editPasswordForm') }}">Изменить пароль</a>
    </div>

@endsection