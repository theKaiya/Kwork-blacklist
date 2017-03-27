@extends('headers.auth')

@section('title') Вход @endsection

@section('main')
    <div class="p-a-md box-color r box-shadow-z1 text-color m-a">
        <div class="m-b text-sm">
            Авторизация
        </div>
        <form name="form" action="{{ route('login_action') }}" method="post">
            <div class="md-form-group float-label">
                <input name="usernameOrEmail" type="text" class="md-input" required>
                <label>Имя пользователя или Емейл</label>
            </div>
            <div class="md-form-group float-label">
                <input name="password" type="password" class="md-input" required>
                <label>Пароль</label>
            </div>
            <div class="m-b-md">
                <label class="md-check">
                    <input type="checkbox" name="remember_me"><i class="primary"></i> Запомнить меня
                </label>
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn primary btn-block p-x-md">Войти</button>
        </form>
    </div>

    <div class="p-v-lg text-center">
        <div>Нет аккаунта? <a href="{{ route('register') }}" class="text-primary _600">Зарегистрироватся</a></div>
    </div>
@endsection