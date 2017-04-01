@extends('header')

@section('title') Настройки  @endsection

@section('main')
    <div class="row" ng-controller="Settings">
        <br>
        <div class="col-sm-2">
            <div class="nav-active-border b-info left">
                <ul class="nav nav-sm">
                    <li class="nav-item">
                        <a ng-click="switchSection('primary')" ng-class="{active: section == 'primary'}" class="nav-link" href="">Основные</a>
                    </li>
                    <li class="nav-item">
                        <a ng-click="switchSection('security')" ng-class="{active: section == 'security'}" class="nav-link" href="">Безопасность</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="tab-pane" ng-show="section == 'primary'">
            <div class="box">
                <div class="box-header">
                    <span class="label success pull-right">PRIMARY</span>
                    <h3>Настройки профиля</h3>
                </div>
                <div class="box-body">
                    <form role="form" action="{{ route('settings_primary') }}" method="post">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" value="{{ u()->username }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" type="text" class="form-control" value="{{ u()->email }}">
                        </div>
                        @include('components.buttons.update')
                    </form>
                </div>
            </div>
            </div>

            <div class="tab-pane" ng-show="section == 'security'">
                <div class="box">
                    <div class="box-header">
                        <span class="label success pull-right">SECURITY</span>
                        <h3>Настройки безопасности</h3>
                    </div>
                    <div class="box-body">
                        <form role="form" action="{{ route('settings_security') }}" method="post">
                            <div class="form-group">
                                <label>Новый пароль</label>
                                <input name="password" type="password" class="form-control" placeholder="dadada...">
                            </div>
                            @include('components.buttons.update')
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane col-md-4">
            <div class="box">
                @include('errors.session')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/assets/js/angular/controllers/settings.js"></script>
@endsection