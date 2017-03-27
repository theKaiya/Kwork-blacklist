@extends('headers.auth')

@section('title') Регистрация  @endsection

@section('main')
    <div class="p-a-md box-color r box-shadow-z1 text-color m-a">
        <div class="m-b text-sm">
            Регистрация
        </div>
        <form name="form">
            <div class="md-form-group float-label">
                <input name="email" type="email" class="md-input" required>
                <label><small>Емейл</small></label>
            </div>
            <div class="md-form-group float-label">
                <input name="username" type="text" class="md-input" required>
                <label><small>Имя пользователя</small></label>
            </div>
            <div class="md-form-group float-label">
                <input name="password" type="password" class="md-input" required>
                <label><small>Пароль</small></label>
            </div>
            <div class="m-b-md">
                <label class="md-check">
                    <input type="checkbox"><i class="primary"></i> Согласен с правилами сервиса
                </label>
            </div>
            <button type="submit" class="btn primary btn-block p-x-md">Регистрация</button>
        </form>
    </div>

    <div class="p-v-lg text-center">
        <div>Уже есть аккаунт? <a href="{{ route('login') }}" class="text-primary _600">Авторизация</a></div>
    </div>
@endsection