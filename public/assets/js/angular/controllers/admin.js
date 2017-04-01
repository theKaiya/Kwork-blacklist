app.controller('Admin', function ($scope, $http) {

    let act = 'section';

    let states = ['reviews', 'users', 'customers'];

    $scope.s = new QuerySettings (states);

    $scope.section = _get.getEvenIfNotExist(act, states);

    $scope.items = new Container(act, states);

    $scope.query = Url.queryString('query');

    $scope.switchSection = function (e) {
        $scope.s.storeCurrentQuery(e);

        $scope.section = _get.setGetParameter(act, e, states);

        $scope.query = null;

        $scope.getContent();
    };

    $scope.changeSettings = function (param, blocked)
    {
        $scope.s.set(param, blocked);

        $scope.getContent();
    }


    $scope.getContent = function (more = false)
    {
        $scope.items.initialize(more);

        var url = '/admin/api/search?page=' + $scope.items.get().page;

        $http.post(url, Url.parseQuery()).then(function (s) {
            $scope.items.convert(s.data.response, more);
        });
    };

    $scope.updateQuery = function ()
    {
        Url.updateSearchParam('query', $scope.query);
        $scope.getContent();
    }

    $scope.getContent();
});