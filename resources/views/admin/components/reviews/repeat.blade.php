<div ng-repeat="item in items.get().items">
    <div class="list-item b-l b-l-3x" ng-class="item.is_accepted ? 'b-success' : 'b-danger'">
        <div class="list-left">
      <span class="w-40 avatar">
        <img ng-src="@{{ item.author_picture }}" title="@{{ item.author_username }}">
      </span>
        </div>
        <div class="list-body">
            <div class="pull-right text-xs">
                <!--
                <div class="text-muted">
                    <span class="hidden-xs">5, July</span>
                </div>
                -->
                <item-menu></item-menu>
            </div>
            <div>
                <a href="@{{ item.link }}" class="_500" ng-bind="item.title"></a>
                <z ng-show="user.is_admin">
                    <span style="margin-left: 10px;" class="label info pos-rlt m-r-xs">
                    <a href="@{{ item.person.link }}">
                        @{{ item.person_username }}
                    </a>
                </span>
                    <span class="text-muted hidden-xs ng-binding" ng-bind="item.person.short_name"></span>
                </z>
            </div>
            <div class="text-ellipsis text-muted text-sm" ng-bind="item.short_desc"></div>
        </div>
    </div>
</div>