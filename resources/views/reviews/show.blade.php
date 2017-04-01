@extends('header')

@section('title') Просмотр отзыва @endsection

@section('seo_desc')
    Просмотр отзыва о {{ $report->person->username }} на Kwork.ru,
    {{ $report->medium_desc }}
@endsection

@section('seo_keywords')
    Кворк.ру, отзывы, отзывы на фрилансеров kwork.ru, reviews kwork.ru, фриланс-биржа кворк отзывы
@endsection

@section('main')
    <div class="padding">
        <div class="row">
            <div class="col-sm-8 col-md-9">
                <h4 class="m-a-0 m-b-sm text-md">{{ $report->title  }}</h4>
                <div class="m-b" id="accordion">

                    <div class="panel box no-border m-b-xs">

                        <div id="c_5" class="collapse in">
                            <div class="box-body">
                                <span class="w-40 circle avatar pull-left m-r rounded">
                                    <img src="{{ $report->user->avatar ?? deletedPicture()  }}">
                                </span>
                                <p class="text-sm m-x-xs clear">{!! nl2br($report->text)  !!}</p>
                            </div>
                        </div>

                        <div id="c_5" class="collapse in">
                            <div class="box-body">
                                @if(count($report->images))
                                    <div class="slider-gallery">
                                        @foreach($report->images as $image)
                                            <img src="{{ $image->link  }}">
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-3">
                <h4 class="m-a-0 m-b-sm text-md">Подробнее</h4>
                <div class="box">
                    <ul class="list inset">
                        <li class="list-item">
                            <a herf class="list-left">
                              <span class="w-40 circle avatar">
                                <img src="{{ $report->user->avatar ?? deletedPicture()  }}">
                              </span>
                            </a>
                            <div class="list-body">
                                <div><a href="#">{{ $report->user->username ?? 'Deleted.'  }}</a></div>
                                <small class="text-muted text-ellipsis">{{ $report->user ? "Создатель отзыва" : "Пользователь был удален." }}</small>
                            </div>
                        </li>

                        <li class="list-item">
                            <a href="{{ $report->person->link  }}" class="list-left">
                              <span class="w-40 circle avatar">
                                <img src="{{ $report->person->avatar  }}">
                              </span>
                            </a>
                            <div class="list-body">
                                <div><a href="{{ $report->person->link  }}">{{ $report->person->username  }}</a></div>
                                <small class="text-muted text-ellipsis">Обвиняемая персона</small>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.slider-gallery').lightSlider({
                adaptiveHeight:true,
                item:1,
                slideMargin:0,
                loop:true
            });
        });
    </script>
@endsection