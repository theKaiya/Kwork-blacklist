<div class="box-footer" ng-if="!items.get().items.length && !items.spinner" ng-cloak>
    <div class="alert alert-info">
        Тут пусто..
    </div>
</div>


<div class="box-footer" ng-if="items.get().sign_in_to_continue && items.get().last_page > items.get().page" ng-cloak>
    <a class="btn btn-sm btn-block info text-u-c" href="{{ route('login') }}">Войдите, что бы продолжить.</a>
</div>

<div class="box-footer" ng-if='!items.get().sign_in_to_continue && !items.spinner && !items.spinner_more && items.get().last_page > items.get().page' ng-cloak>
    <a ng-click="getContent(true)" href="" class="btn btn-sm btn-block success text-u-c">Больше</a>
</div>