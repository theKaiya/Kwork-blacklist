<a class="nav-link" ng-click="changeSettings('all', ['is_accepted', 'is_not_accepted'])">
    <i class="fa m-r-sm fa-circle" ng-class="s.style('all')"></i>
    Все
</a>
<a class="nav-link" ng-click="changeSettings('is_accepted', ['all', 'is_not_accepted'])">
    <i class="fa m-r-sm fa-circle" ng-class="s.style('is_accepted')"></i>
    Активированные
</a>

<a class="nav-link" ng-click="changeSettings('is_not_accepted', ['all', 'is_accepted'])">
    <i class="fa m-r-sm fa-circle" ng-class="s.style('is_not_accepted')"></i>
    Неактивированные
</a>