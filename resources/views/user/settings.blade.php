@extends('header')

@section('title') Настройки  @endsection

@section('main')
    <div class="row-col">
        <div class="col-sm-3 col-lg-2">
            <div class="p-y">
                <div class="nav-active-border left b-success">
                    <ul class="nav nav-sm">
                        <li class="nav-item"><a class="nav-link block active" href="#">Профиль</a></li>
                    </ul>
                </div>
            </div>
        </div>
    <div class="col-sm-9 col-lg-10 light lt bg-auto">
        <div class="tab-content pos-rlt">
            <div class="tab-pane active">
                <div class="p-a-md dker _600">Редактирование основной информации</div>
                <form role="form" class="p-a-md col-md-6">
                    @include('errors.session')
                    <small>Will be updated later.</small><br>
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-info m-t">Обновить</button>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection