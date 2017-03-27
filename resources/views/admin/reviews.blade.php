@extends('header')

@@section('title') Просмотр отзывов  @endsection

@section('main')
    <div class="row-col">
        <div class="col-sm w w-auto-xs light lt bg-auto">
            <div class="padding pos-rlt">
                <div>
                    <button class="btn btn-sm white pull-right hidden-sm-up" ui-toggle-class="show" target="#inbox-menu"><i class="fa fa-bars"></i></button>
                    <a href="" class="btn btn-sm white w-xs">Compose</a>
                </div>
                <div class="hidden-xs-down m-t" id="inbox-menu">
                    <div class="nav-active-primary">
                        <div class="nav nav-pills nav-sm">
                            <a class="nav-link active">
                                Inbox
                            </a>
                            <a class="nav-link">
                                Starred
                            </a>
                            <a class="nav-link">
                                Sent
                            </a>
                            <a class="nav-link">
                                Important
                            </a>
                            <a class="nav-link">
                                Draft
                            </a>
                            <a class="nav-link">
                                Trash
                            </a>
                        </div>
                    </div>
                    <div class="m-y">Labels</div>
                    <div class="nav-active-white">
                        <ul class="nav nav-pills nav-stacked nav-sm">
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="fa m-r-sm fa-circle text-primary"></i>
                                    Angular
                                </a>
                                <a class="nav-link">
                                    <i class="fa m-r-sm fa-circle text-info"></i>
                                    Bootstrap
                                </a>
                                <a class="nav-link">
                                    <i class="fa m-r-sm fa-circle text-warn"></i>
                                    Client
                                </a>
                                <a class="nav-link">
                                    <i class="fa m-r-sm fa-circle text-accent"></i>
                                    Work
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="p-y">
                        <form name="label">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" placeholder="New label" required="">
                                <span class="input-group-btn">
                <button class="btn btn-default btn-sm no-shadow" type="button">Add</button>
              </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div ui-view="" class="padding pos-rlt">
                <a href="" class="md-btn md-fab md-fab-bottom-right pos-fix red">
                    <i class="material-icons i-24 text-white"></i>
                </a>
                <div>
                    <!-- header -->
                    <div class="m-b">
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-sm white"><i class="fa fa-chevron-left"></i></button>
                            <button type="button" class="btn btn-sm white"><i class="fa fa-chevron-right"></i></button>
                        </div>
                        <div class="btn-toolbar">
                            <div class="btn-group dropdown">
                                <button class="btn white btn-sm dropdown-toggle" data-toggle="dropdown">
                                    <span class="dropdown-label">Filter</span>
                                    <span class="caret"></span>
                                </button>
                                <div class="dropdown-menu text-left text-sm">
                                    <a class="dropdown-item" href="">Unread</a>
                                    <a class="dropdown-item" href="">Starred</a>
                                </div>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-sm white" data-toggle="tooltip" data-placement="bottom" data-title="Refresh" data-original-title="" title=""><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- / header -->

                    <!-- list -->
                    <div class="list white">
                        <div class="list-item b-l b-l-2x b-info">
                            <div class="list-left">
              <span class="w-40 avatar">
                <img src="../assets/images/a0.jpg">
              </span>
                            </div>
                            <div class="list-body">
                                <div class="pull-right text-muted text-xs">
                                    <span class="hidden-xs">5, July</span>
                                    <i class="fa fa-paperclip m-l-sm"></i>
                                </div>
                                <div>
                                    <a href="" class="_500">Bootstrap components written in pure AngularJS</a>
                                    <span class="label label-xs m-l-sm text-u-c">Bootstrap</span>
                                </div>
                                <div class="text-ellipsis text-muted text-sm">Retur adipiscing elit. Morbi id neque quam. Aliquam sollicitudin venenatis ipsum ac feugiat. Vestibulum ullamcorper Neque quam. Aliquam sollicitudin venenatis ipsum ac feugiat.</div>
                            </div>
                        </div>









                    </div>
                    <!-- / list -->
                </div>

            </div>
        </div>
    </div>
@endsection