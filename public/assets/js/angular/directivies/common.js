app.directive('itemMenu', function ($http) {
    return {
        templateUrl: auth.check? settings.url + "angular/elements/item_menu.html" : null,
        replace: true,
        link: function ($scope, $el, $attr) {

            /**
             * Remove the item.
             * @param id
             */
            $scope.remove = function (id)
            {
                $scope.items.remove(id);

                $http({
                    method: 'GET',
                    url: '/admin/api/' + $scope.section,
                    params: {method: 'remove', id: id}
                });
            };

            /**
             * Accept review.
             *
             * @param id
             */
            $scope.accept = function (id)
            {
                $scope.items.toggle(id, 'is_accepted');

                $http({
                    method: 'GET',
                    url: '/admin/api/reviews/',
                    params: {method: 'accept', id: id}
                });
            };

            /**
             * Assign user as admin.
             *
             * @param id
             */
            $scope.setAdmin = function (id)
            {
                $scope.items.toggle(id, 'is_admin');

                $http({
                    method: 'GET',
                    url: '/admin/api/users/',
                    params: {method: 'admin', id: id}
                });
            }
        }
    }
});

app.directive('itemsCount', function ($rootScope) {
    return {
        templateUrl: settings.url +  "angular/elements/items_count.html",
    }
});