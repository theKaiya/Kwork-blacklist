@extends('header')

@section('title') Поиск заказчиков @endsection

@section('seo_desc')
Просмотр всех отзывов о KWORK.
@endsection

@section('seo_keywords')
    Кворк.ру, отзывы, отзывы на фрилансеров kwork.ru, reviews kwork.ru, фриланс-биржа кворк отзывы
@endsection

@section('main')
    <div class="padding" ng-controller="Search">
        <form action="#" class="m-b-md">
            <div class="input-group input-group-lg">
                <input ng-model-options="{debounce:500}" ng-change="updateQuery()" ng-model="query" type="text" class="form-control" placeholder="Меня обманул %username%....">
                <span class="input-group-btn">
      </span>
            </div>
        </form>
        <p class="m-b-md"></p>

        <ul class="nav nav-sm nav-pills nav-active-primary clearfix">
            <li class="nav-item">
                <a ng-click="switchSection('reviews')" ng-class="{active: section == 'reviews'}" class="nav-link">Отзывы </a>
            </li>
            <li class="nav-item">
                <a ng-click="switchSection('customers')" ng-class="{active: section == 'customers'}" class="nav-link">Заказчики</a>
            </li>
        </ul>

        <div class="tab-content">
            <div ng-class="{active: section == 'reviews'}" class="tab-pane p-v-sm">
                <div class="m-t" ng-show="items.get().items.length">
                    <div class="row row-sm">
                        @include('components.reviews.repeat')
                    </div>
                </div>
            </div>
            <div ng-class="{active: section == 'customers'}" class="tab-pane p-v-sm">
                <div class="m-t" ng-show="items.get().items.length">
                    <div class="row row-sm">
                        @include('admin.components.users.repeat')
                    </div>
                </div>
            </div>
            @include('components.buttons.ajax')
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/assets/js/angular/controllers/search.js"></script>
@endsection