@extends('header')

@section('title') Просмотр отзывов  @endsection

@section('main')
    <div class="row-col" ng-controller="Admin">
        <div class="col-sm w light lt bg-auto">
            <div class="padding pos-rlt">
                <div>
                    <button class="btn btn-sm white pull-right hidden-sm-up" ui-toggle-class="show" target="#inbox-menu"><i class="fa fa-bars"></i></button>
                </div>
                <div class="hidden-xs-down m-t" id="inbox-menu">
                    <div class="nav-active-border b-success left">
                        <ul class="nav nav-sm">
                            <li class="nav-item">
                                <a ng-click="switchSection('reviews')" ng-class="{active: section == 'reviews'}" class="nav-link" href="">
                                    Отзывы
                                </a>
                                <items-count ng-show="section == 'reviews'" />
                            </li>
                            <li class="nav-item">
                                <a ng-click="switchSection('users')" ng-class="{active: section == 'users'}" class="nav-link" href="">
                                    Пользователи
                                </a>
                                <items-count ng-show="section == 'users'" />
                            </li>
                            <li class="nav-item">
                                <a ng-click="switchSection('customers')" ng-class="{active: section == 'customers'}" class="nav-link" href="">
                                    Заказчики
                                </a>
                                <items-count ng-show="section == 'customers'" />
                            </li>
                        </ul>
                    </div>
                    <div class="m-y">Настройки</div>
                    <div class="nav-active-white">
                        <ul class="nav nav-pills nav-stacked nav-md">
                            <li class="nav-item">
                                <div ng-if="section == 'reviews'">
                                    @include('admin.components.reviews.review_settings')
                                </div>
                                <div ng-if="section == 'users'">
                                    @include('admin.components.users.user_settings')
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm col-md-6">
            <div ui-view="" class="padding pos-rlt">
                <div>
                    <!-- header -->
                    <div class="m-b">
                        <div class="btn-toolbar">
                            <div class="input-group">
                                <input
                                        ng-change="updateQuery()"
                                        ng-model="query"
                                        ng-model-options="{debounce: 500}"
                                        name="query"
                                        type="text"
                                        class="form-control form-control-sm p-x b-a rounded"
                                        placeholder="Найти что-то...">
                            </div>
                        </div>
                    </div>
                    <!-- / header -->

                    <!-- list -->
                    <div class="list white">
                        <div ng-show="section == 'reviews'">
                            @include('admin.components.reviews.repeat')
                        </div>

                        <div ng-show="section == 'users'">
                            @include('admin.components.users.repeat')
                        </div>

                        <div ng-show="section == 'customers'">
                            @include('admin.components.customers.repeat')
                        </div>
                        <br>
                    </div>

                    @include('components.buttons.ajax')
                    <!-- / list -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/assets/js/angular/controllers/admin.js"></script>
@endsection