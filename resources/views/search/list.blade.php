@extends('header')

@section('title') Поиск заказчиков @endsection

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
                <a ng-click="switchSection('reports')" ng-class="{active: section == 'reports'}" class="nav-link">Репорты </a>
            </li>
            <li class="nav-item">
                <a ng-click="switchSection('customers')" ng-class="{active: section == 'customers'}" class="nav-link">Заказчики</a>
            </li>
        </ul>

        <div class="tab-content">
            <div ng-class="{active: section == 'reports'}" class="tab-pane p-v-sm">
                <div class="box m-t p-a-sm clear" ng-show="items.get().items.length">
                    <ul class="list">
                        @include('components.search.repeat')
                    </ul>
                </div>
            </div>
            <div ng-class="{active: section == 'customers'}" class="tab-pane p-v-sm">
                <div class="m-t" ng-show="items.get().items.length">
                    <div class="row row-sm">
                        <div class="col-xs-6 col-lg-4" ng-repeat="user in items.get().items">
                            <div class="list-item box r m-b">
                                <a herf class="list-left">
                                    <span class="w-40 avatar">
                                      <img ng-src="@{{ user.avatar }}" alt="...">
                                      <!--
                                      <i class="on b-white bottom"></i>
                                      -->
                                    </span>
                                </a>
                                <div class="list-body">
                                    <div class="text-ellipsis"><a href="@{{ user.link }}">@{{ user.username }}</a></div>
                                    <span class="label rounded warn"><a href="@{{ user.url }}">Kwork</a></span>
                                </div>
                            </div>
                        </div>
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