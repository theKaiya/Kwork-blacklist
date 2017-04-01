
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Kwork BlackList - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="@yield('seo_desc')">
    <meta name="keywords" content="@yield('seo_keywords')">
    <meta name="author" content="https://github.com/theKaiya">

    <!-- for ios 7 style, multi-resolution icon of 152x152 -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
    <link rel="apple-touch-icon" href="/assets/images/logo.png">
    <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" sizes="196x196" href="/assets/images/logo.png">

    <!-- style -->
    <link rel="stylesheet" href="/assets/animate.css/animate.min.css" type="text/css" />
    <link rel="stylesheet" href="/assets/glyphicons/glyphicons.css" type="text/css" />
    <link rel="stylesheet" href="/assets/font-awesome/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="/assets/material-design-icons/material-design-icons.css" type="text/css" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="/assets/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="/assets/styles/app.min.css">
    <link rel="stylesheet" href="/assets/styles/font.css" type="text/css" />
    <link rel="stylesheet" href="/assets/css/lightslider.css" type="text/css" />
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="/libs/angular/angular/angular.js"></script>

    <style>
        [ng\:cloak], [ng-cloak], .ng-cloak, .hide {
            display: none;
        }
    </style>

    <script>
        var auth = {
            check: {{ u() ? 1 : 0 }},
            id: {{ u() ? u()->id : 0 }},
            is_admin: {{ u() ? u()->is_admin : 0 }},
            email: "{{ u() ? u()->email : null }}"
        };
        var sign_in_to_continue = 2;

        let settings = {
            url: "{{ url('/').'/' }}"
        };
    </script>

</head>
<body class="container">
<div class="app-header navbar-md white box-shadow">
    <div class="navbar ng-scope">
        <a data-toggle="collapse" data-target="#navbar-4" class="navbar-item pull-right hidden-md-up m-a-0 m-l">
            <i class="material-icons"></i>
        </a>
        <a class="navbar-brand ng-scope" href="{{ route('home') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="24" height="24">
                <path d="M 4 4 L 44 4 L 44 44 Z" fill="#009688"></path>
                <path d="M 4 4 L 34 4 L 24 24 Z" fill="rgba(0,0,0,0.15)"></path>
                <path d="M 4 4 L 24 4 L 4  44 Z" fill="#6cc788"></path>
            </svg>
            <img src="/assets/images/logo.png" alt="." class="hide">
            <span class="hidden-folded inline ng-binding">Kwork-BlackList</span>
        </a>
        <ul class="nav navbar-nav pull-right">
            <li class="nav-item dropdown">
                <a href="" class="nav-link p-l b-l" data-toggle="dropdown">
                  <span class="avatar w-32">
                    <img src="{{ u() ? u()->avatar : asset('/assets/images/guest.png') }}" alt="...">
                    <i class="{{ u() ? "success" : 'busy' }} b-white right"></i>
                  </span>
                </a>
                @if(u())
                    <div class="dropdown-menu pull-right dropdown-menu-scale ng-scope">
                        @if(u()->can('see-admin-area'))
                            <a class="dropdown-item" href="/admin/list"><small>Админка</small></a>
                        @endif
                        <a class="dropdown-item" href="{{ route('settings') }}"><small>Настройки</small></a>
                        <a class="dropdown-item" href="{{ route('people_create') }}"><small>Новый заказчик</small></a>
                        <a class="dropdown-item" href="{{ route('reviews_create') }}"><small>Новый репорт</small></a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"><small>Выход</small></a>
                    </div>
                @else
                    <div class="dropdown-menu pull-right dropdown-menu-scale ng-scope">
                        <a class="dropdown-item" href="{{ route('register') }}"><small>Регистрация</small></a>
                        <a class="dropdown-item" href="{{ route('login') }}"><small>Вход</small></a>
                        <!--
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('about') }}"><small>Что здесь происходит?</small></a>
                        -->
                    </div>
                @endif
            </li>
        </ul>
        <div class="collapse navbar-toggleable-sm" id="navbar-4" data-pjax="">
            <form class="navbar-form form-inline pull-right pull-none-sm navbar-item v-m ng-pristine ng-valid ng-scope"
                  role="search"
                  action="{{ route('home') }}"
                  method="get"
            >
                <div class="form-group l-h m-a-0">
                    <div class="input-group">
                        <input name="query" type="text" class="form-control form-control-sm p-x b-a rounded" placeholder="Найти что-то...">
                    </div>
                </div>
            </form>
            <ul class="nav navbar-nav pull-left nav-active-border b-success">
                <li class="nav-item">
                    <a href="{{ route('home')  }}" class="nav-link" ui-sref="app.dashboard" ui-sref-active="active">
                        <span class="nav-text">Главная</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="app-body">
    <div id="content" class="app-content box-shadow-z0 ng-scope" role="main" ng-app="BlackList">
        @yield('main')
    </div>
    <div class="app-footer white ng-scope">
        <div class="p-a text-xs ng-scope">
            <div class="pull-right text-muted">© Copyright
                <strong class="ng-binding"><a href="https://themeforest.net/user/flatfull/portfolio?ref=theKaiya">Flatfull</a> & <a href="https://github.com/theKaiya">TheKaiya</a></strong>
                <span class="hidden-xs-down ng-binding">- Made in one night v0.1</span>
                <a><i class="fa fa-long-arrow-up p-x-sm"></i></a>
            </div>
            <div class="nav">
                <a class="nav-link" href="https://github.com/theKaiya/Kwork-blacklist">About</a>
                <span class="text-muted">-</span>
                <a class="nav-link label accent" href="https://github.com/theKaiya/Kwork-blacklist">Get it</a>
            </div>
        </div>
    </div>
</div>

<script src="/libs/jquery/tether/dist/js/tether.min.js"></script>
<script src="/libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
<script src="/assets/js/lightslider.js"></script>
<script src="/assets/js/url.min.js"></script>
<script src="/assets/js/angular/helpers.js"></script>
<script src="/assets/js/angular/app.js"></script>
<script src="/assets/js/angular/directivies/common.js"></script>

@yield('scripts')
</body>
</html>
