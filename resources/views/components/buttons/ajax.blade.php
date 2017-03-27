<div class="box-footer" ng-if="!items.get().items.length && !items.spinner" ng-cloak>
    <div class="alert alert-info">
        Тут пусто..
    </div>
</div>

<div class="box-footer" ng-if='!items.spinner && !items.spinner_more && items.get().last_page > items.get().page' ng-cloak>
    <a ng-click="getContent(true)" href="" class="btn btn-sm btn-block info text-u-c">Больше</a>
</div>