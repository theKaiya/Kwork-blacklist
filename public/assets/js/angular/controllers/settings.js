app.controller('Settings', function ($scope, $http) {

    let act = 'act';

    let states = ['primary', 'security'];

    $scope.section = _get.getEvenIfNotExist(act, states);

    $scope.switchSection = function (e) {
        $scope.section = _get.setGetParameter(act, e, states);
    };

});