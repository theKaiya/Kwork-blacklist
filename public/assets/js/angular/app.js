let app = angular.module('BlackList', []);

app.run(function ($rootScope) {
    $rootScope.user = auth;
});