<a class="nav-link" ng-click="changeSettings('all', ['admins'])">
    <i class="fa m-r-sm fa-circle" ng-class="s.style('all')"></i>
    Все
</a>
<a class="nav-link" ng-click="changeSettings('admins', ['all', 'users'])">
    <i class="fa m-r-sm fa-circle" ng-class="s.style('admins')"></i>
    Администраторы
</a>

<a class="nav-link" ng-click="changeSettings('users', ['all', 'admins'])">
    <i class="fa m-r-sm fa-circle" ng-class="s.style('users')"></i>
    Обычные
</a>