app.controller('Search', function ($scope, $http) {

    let act = 'section';

    let states = ['reports', 'customers'];

    let person_id = typeof root_person_id != 'undefined' ? root_person_id : '';

    $scope.section = _get.getEvenIfNotExist(act, states);

    $scope.query = Url.queryString('query');

    $scope.items = new Container(act, states);

    $scope.switchSection = function (e) {
        $scope.section = _get.setGetParameter(act, e, states);

        if (typeof $scope.items.get($scope.section).items == 'undefined') {
            $scope.getContent();
        }
    };

    $scope.getContent = function (more = false)
    {
        $scope.items.initialize(more);

        var url = '/api/search.get?page=' + $scope.items.get().page;

        $http.post(url, {section: $scope.section, query: $scope.query, person_id: person_id}).then(function (s) {
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