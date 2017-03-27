@extends('header')

@section('title') Просмотр заказчика {{ $person->username  }} @endsection

@section('main')
<script>
    var root_person_id = "{{ $person->id }}";
</script>

<div class="padding ng-scope" ng-controller="Search">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="box">
                <div class="item">
                    <div class="item-bg">
                        <img src="{{ asset('/assets/images/background.jpg')  }}">
                    </div>
                    <div class="p-a-lg pos-rlt text-center">
                        <img src="{{ $person->avatar }}" class="img-circle w-56" style="margin-bottom: -7rem">
                    </div>
                </div>
                <div class="p-a text-center">
                    <a href="" class="text-md m-t block">{{ $person->username }}</a>
                    <p><small></small></p>
                    <p><a href="{{ $person->url }}" class="btn btn-sm warn">Kwork</a></p>
                    <div class="text-xs">
                        <em>Reports: <strong>{{ $person->reports_count  }}</strong>
                        </em>
                    </div>
                </div>
            </div>

            <div class="tab-pane p-v-sm active">
                <div class="box m-t p-a-sm clear">
                    <ul class="list">
                        @include('components.search.repeat')
                    </ul>
                </div>
                @include('components.buttons.ajax')
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="/assets/js/angular/controllers/search.js"></script>
@endsection