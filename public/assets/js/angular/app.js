let app = angular.module('BlackList', []);

function Container($section = 'section', $states = []) {

    let self = this;

    this.page = 1;

    this.items = [];

    this.spinner = false;

    this.spinner_more = false;


    /**
     * Create a cache slots for current allowed $states in url.
     */
    this.createItemSlots = function ()
    {
        $states.forEach(function (item, index) {
            self.items[item] = {page: 1, sign_in_to_continue: false};
        });
    };

    /**
     * Update current shots if $loadMore = true,
     * And set the page to 1.
     */
    this.initialize = function ($loadMore) {
        let items = this.items[Url.queryString($section)];

        if (!$loadMore) {
            items.items = [];
            items.page = 1;
            this.spinner = true;
        } else {
            items.page++;
            this.spinner_more = true;
        }
    };

    /**
     * @param object
     * @param loadMore
     */
    this.convert = function (object, loadMore) {
        let items = this.items[Url.queryString($section)];

        if (loadMore) {
            this.spinner_more = false;

            /**
             * Concat not working. o__o
             */
            object.data.forEach(function (e) {
                items.items.push(e);
            });
        } else {
            this.spinner = false;
            items.last_page = object.last_page;
            items.items = object.data;
            items.total = object.total;
        }
        this.get().sign_in_to_continue = this.get().page >= sign_in_to_continue && !auth ? true : false;
    };

    /**
     * Get current items cache container.
     * @returns {*}
     */
    this.get = function (act = false)
    {
        if(! act)
            act = Url.queryString($section);

        return this.items[act];
    };

    this.hasItems = function ()
    {
        return this.get().items.length;
    };

    /**
     * Remove object from current collection.
     * @param id
     */
    this.remove = function (id)
    {
        let items = this.get().items;

        items.map(function (e, i) {
            if(e.id == id) {
                items.splice(i, 1);
            }
        })
    };

    this.toggle = function (id, parameter)
    {
        this.get().items.forEach(function (e) {
           if(e.id == id) {
               e[parameter] = e[parameter] ? 0 : 1;
           }
        });
    };

    /**
     * Get items count.
     * @param section
     * @returns {Number|number}
     */
    this.count = function (section)
    {
        if(typeof this.get(section).items != 'undefined') {
            return this.get(section).items.length;
        }
        return 0;
    };

    this.createItemSlots();
}

/**
 * Object for better working with urls.
 */
let _get = {
    previous: null,

    /**
     * Устанавливает нужному нам гет параметру нужное нам значение.
     * Если replace не совпадает ни с одним значением из allowed, вернется первое значение allowed.
     *
     * @param name
     * @param replace
     * @param allowed
     * @returns {*}
     */
    setGetParameter: function (name, replace, allowed) {
        if (allowed.indexOf(replace) > -1) {
            Url.updateSearchParam(name, replace, true);
        } else {
            return allowed[0];
        }

        return replace;
    },
    /**
     * Берем нужное нам $_GET значение.
     * Если значение name не совпадает ни с одним из allowed
     * Вернется первое значение массива allowed.
     * @param name
     * @param allowed
     * @returns {*}
     */
    getEvenIfNotExist: function (name, allowed) {
        let get = Url.queryString(name);

        if (get) {
            if (allowed.indexOf(get) > -1) {
                return get;
            }
        }
        Url.updateSearchParam(name, allowed[0], true);

        return allowed[0];
    }
};

function QuerySettings (states)
{
    var self = this;

    this.states = states;

    this.initialize = function ()
    {
        this.states.forEach(function (item, index) {
            self[item] = {section: item};
        });
    };

    /**
     *
     * @param value | is_activated
     * @param another | all
     */
    this.set = function (value, another = [])
    {
       let section = this[Url.queryString('section')];

       let current_value = section[value];

       section[value] = current_value ? 0 : 1;

       section[value] ? Url.updateSearchParam(value, 1) : Url.updateSearchParam(value);

       if(another.length) {
           another.forEach(function (e) {
               if(section[value] == 1) {
                   section[e] = 0;
                   Url.updateSearchParam(e);
               }
           });
       }

       console.log(section);
    };

    this.get = function (name = null)
    {
        let section = this[Url.queryString('section')];

        return typeof section[name] != 'undefined' && section[name] == 1;
    }

    this.switchSection = function (e)
    {
        var section = this[e];

        for(let q in section)
        {
            if(q != 'section' && section[q] == 1) {
                Url.updateSearchParam(q, section[q]);
            }
        }
        console.log(section);
        return section;
    }

    this.storeQuery = function ()
    {
        let query = Url.parseQuery();

        let section = this[Url.queryString('section')];

        for(var q in query)
        {
            section[q] = query[q];
        }

        return section;
    }

    this.storeCurrentQuery = function (e)
    {
        let section = this.storeQuery();

        for(let q in section)
        {
            if(q != 'section') {
                Url.updateSearchParam(q);
            }
        }

        return this.switchSection(e);
    }

    /**
     * Get style for nav-link
     * @param parameter
     * @returns {string}
     */
    this.style = function (parameter)
    {
        return this.get(parameter) ? 'text-success' : 'text-danger';
    }

    this.initialize();

    this.storeQuery();
}

app.factory('httpInterceptor', ['$q', '$rootScope',
    function ($q, $rootScope) {
        var loadingCount = 0;

        return {
            request: function (config) {
                if(++loadingCount === 1) $rootScope.$broadcast('loading:progress');
                return config || $q.when(config);
            },

            response: function (response) {
                if(--loadingCount === 0) $rootScope.$broadcast('loading:finish');
                return response || $q.when(response);
            },

            responseError: function (response) {
                if(--loadingCount === 0) $rootScope.$broadcast('loading:finish');
                return $q.reject(response);
            }
        };
    }
]).config(['$httpProvider', function ($httpProvider) {
    $httpProvider.interceptors.push('httpInterceptor');
}]);

app.directive('itemMenu', function ($http) {
    return {
        templateUrl: auth.check? settings.url + "angular/elements/file.html" : null,
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

app.run(function ($rootScope) {
    $rootScope.user = auth;
});