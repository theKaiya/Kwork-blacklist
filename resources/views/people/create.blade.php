@extends('header')

@section('title') Добавление нового заказчика @endsection

@section('main')
    <div class="col-sm-9 col-lg-10 light lt bg-auto">
        <div class="tab-content pos-rlt">
            <div class="tab-pane active">
                <div class="p-a-md dker _600">Добавление нового заказчика</div>
                <form role="form" class="p-a-md col-md-6" action="{{ route('people_create_action') }}" method="post">
                    @include('errors.session')
                    <div class="form-group">
                        <label>Ссылка на профиль</label>
                        <input name="url" type="text" class="form-control" placeholder="https://kwork.ru/user/....">
                    </div>
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-info m-t">Добавить</button>
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection