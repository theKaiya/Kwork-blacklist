<div ng-repeat="item in items.get().items">
<div class="list-item col-md-12">
    <div class="clear">
        <h5 class="m-a-0 m-b-sm">
            <a href="@{{ item.link }}" ng-bind="item.title"></a>
        </h5>
        <p class="text-muted" ng-bind="item.medium_desc"></p>
        <span class="label success pos-rlt m-r-xs">
            <b class="arrow right b-success pull-in"></b>Отзыв о
        </span> <a href="@{{ item.person.link }}" class="m-r-sm" ng-bind="item.person.username"></a>
        <span ng-show="user.is_admin" class="pull-right label text-sm" ng-class="item.is_accepted ? 'success' : 'danger'">
            @{{ item.is_accepted ? "Активирован" : "Деактивирован" }}
        </span>
        <item-menu></item-menu>
        </p>
    </div>
    <div class="dropdown-divider"></div>
</div>
</div>