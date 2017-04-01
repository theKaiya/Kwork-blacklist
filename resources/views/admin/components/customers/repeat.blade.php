<div class="col-xs-6 col-lg-4" ng-repeat="item in items.get().items">
    <div class="list-item box r m-b">
        <a href="@{{ item.link }}" class="list-left">
        <span class="w-40 avatar">
          <img ng-src="@{{ item.image }}" alt="...">
        </span>
        </a>
        <div class="list-body" >
            <div class="text-ellipsis"><a href="@{{ item.link }}">@{{ item.username }}</a></div>
            <div class="text-muted text-xs">
                <span class="hidden-xs ng-binding" ng-bind="item.short_name"></span>
            </div>
            <item-menu></item-menu>
        </div>
    </div>
</div>