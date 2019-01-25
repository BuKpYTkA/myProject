@php
    /**
    * @var \App\User $user
    */
@endphp
@extends('layouts.app')
@section('content')

    <div class="container">
        <h1>Смена пароля</h1>
        <hr>
        <form action="{{ route('cabinet.editPassword') }}" method="POST">
            @csrf
            @if($errors->has('success')) <strong style="color: green;">{{ $errors->first('success') }}</strong> @endif
            <p>Старый пароль</p>
            <input name="oldPass" class="form-control {{ ($errors->has('oldPass')) ? 'is-invalid' : '' }}"
                   type="password" placeholder="старый пароль" style="margin-bottom: 10px; width: 300px">
            @if($errors->has('oldPass')) <span class="invalid-feedback"><strong>{{ $errors->first('oldPass') }}</strong></span> @endif
            <p>Новый пароль</p>
            <input name="newPass" class="form-control {{ ($errors->has('newPass')) ? 'is-invalid' : '' }}"
                   type="password" placeholder="новый пароль" style="margin-bottom: 10px; width: 300px">
            @if($errors->has('newPass')) <span class="invalid-feedback"><strong>{{ $errors->first('newPass') }}</strong></span> @endif
            <p>Повторите пароль</p>
            <input name="repeatPass" class="form-control {{ ($errors->has('repeatPass')) ? 'is-invalid' : '' }}"
                   type="password" placeholder="повторите пароль" style="margin-bottom: 10px; width: 300px">
            @if($errors->has('repeatPass')) <span
                    class="invalid-feedback"><strong>{{ $errors->first('repeatPass') }}</strong></span> @endif
            <input class="btn btn-primary" type="submit" value="Сохранить пароль">
        </form>
    </div>

@endsection