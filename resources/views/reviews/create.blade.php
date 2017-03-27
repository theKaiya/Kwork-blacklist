@extends('header')

@section('title') Добавление нового репорта @endsection

@section('main')
    <div class="col-sm-9 col-lg-10 light lt bg-auto">
        <div class="tab-content pos-rlt">
            <div class="tab-pane active">
                <div class="p-a-md dker _600">Добавление нового репорта</div>
                <form method="post" action="{{ route('reviews_create_action') }}" role="form" class="p-a-md col-md-6" enctype="multipart/form-data">
                    @include('errors.session')
                    <div class="form-group">
                        <label>Заголовок</label>
                        <input name="title" type="text" class="form-control" placeholder="Меня обманули..." >
                    </div>
                    <div class="form-group">
                        <label>Описание</label>
                        <textarea name="description" class="form-control" placeholder="..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Доказательства</label>
                        <input name="images" type="file" class="form-control" multiple>
                    </div>

                    <div class="form-group">
                        <label>Заказчик</label><br>
                        <select name="people" class="select-person form-control" required>
                            @foreach($persons as $person)
                                <option value="{{ $person->id }}">{{ $person->username }}</option>
                            @endforeach
                        </select><bR>
                        <p class="text-muted">
                            Если Вы не нашли заказчика, Вы можете
                            <a href="{{ route('people_create') }}">
                            <span class="label success">добавить его</span>
                            </a>.
                        </p>
                    </div>
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-info m-t">Добавить</button>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".select-person").select2({
                placeholder: "Выберите заказчика..",
                allowClear: true,
            });
        });
    </script>
@endsection