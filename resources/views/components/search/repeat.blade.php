<li class="list-item col-md-6" ng-repeat="report in items.get().items">
    <div class="clear">
        <h5 class="m-a-0 m-b-sm"><a href="@{{ report.link }}" ng-bind="report.title"></a></h5>
        <p class="text-muted" ng-bind="report.short_text"></p>
        <p>
        <span class="label success pos-rlt m-r-xs">
            <b class="arrow right b-success pull-in"></b>Заказчик
        </span> <a href="@{{ report.person.link }}" class="m-r-sm" ng-bind="report.person.username"></a>
        </p>
    </div>
</li>