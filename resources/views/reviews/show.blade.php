@extends('header')

@section('title') Просмотр репорта @endsection

@section('main')
    <div class="padding">
        <div class="row">
            <div class="col-sm-8 col-md-9">
                <h4 class="m-a-0 m-b-sm text-md">{{ $report->title  }}</h4>
                <div class="m-b" id="accordion">

                    <div class="panel box no-border m-b-xs">

                        <div id="c_5" class="collapse in">
                            <div class="box-body">
                                <span class="w-40 circle avatar pull-left m-r rounded dark">
                                    <img src="{{ $report->user->avatar  }}">
                                </span>
                                <p class="text-sm text-muted clear">{{ $report->text  }}</p>
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
                                <img src="{{ $report->user->avatar  }}">
                              </span>
                            </a>
                            <div class="list-body">
                                <div><a href="#">{{ $report->user->username  }}</a></div>
                                <small class="text-muted text-ellipsis">Создатель отзыва</small>
                            </div>
                        </li>

                        <li class="list-item">
                            <a herf class="list-left">
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