<div class="col-xs-6 col-lg-4" ng-repeat="item in items.get().items">
    <div class="list-item box r m-b">
        <a href="@{{ item.link }}" class="list-left">
        <span class="w-40 avatar">
          <img ng-src="@{{ item.avatar }}" alt="...">
        </span>
        </a>
        <div class="list-body" >
            <div class="text-ellipsis"><a href="@{{ item.link }}">@{{ item.username }}</a></div>
            <span class="label rounded" ng-class="item.is_admin ? 'light-blue' : 'success'">@{{ item.is_admin ? 'Администратор' : 'Пользователь' }}</span>
            <item-menu></item-menu>
        </div>
    </div>
</div>