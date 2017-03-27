var app = angular.module('BlackList', []);

function Container($section = 'section', $states = []) {

    var self = this;

    this.page = 1;

    this.items = [];

    this.spinner = false;

    this.spinner_more = false;

    this.sign_in_to_continue = false;

    /**
     * Create a cache slots for current allowed $states in url.
     */
    this.createItemSlots = function ()
    {
        $states.forEach(function (item, index) {
            self.items[item] = {page: 1};
        });
    }

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
    }

    /**
     * @param object
     * @param loadMore
     */
    this.convert = function (object, loadMore) {
        var items = this.items[Url.queryString($section)];

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
        }
        this.get().sign_in_to_continue = this.get().page > 2 && !auth.check ? true : false;
    }

    /**
     * Get current items cache container.
     * @returns {*}
     */
    this.get = function (act = false)
    {
        if(! act)
            act = Url.queryString($section);

        return this.items[act];
    }

    this.hasItems = function ()
    {
        return this.get().items.length;
    }

    this.createItemSlots();
}

/**
 * Object for better working with urls.
 */
var _get = {
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
        var get = Url.queryString(name);

        if (get) {
            if (allowed.indexOf(get) > -1) {
                return get;
            }
        }
        Url.updateSearchParam(name, allowed[0], true);

        return allowed[0];
    },
    /**
     * Store the current $url to the previous variable inside _get.
     */
    storeCurrentUrl: function ($url) {
        _get.previous = $url;
        console.log('Previous url was saved.');
    },

    /**
     * Формирует предыдущее действие пользователя.
     * @param action
     * @param action_id
     * @param action_data
     * @returns {string}
     */
    getPreviousUrl: function (action, action_id, action_data = null) {
        var back = "/login?back=" + Url.getLocation().substr(1);
        var action = "&action=" + action;
        var action_id = "&action_id=" + action_id;

        var url = back + action + action_id;

        return action_data ? url + '&action_data=' + action_data : url;
    }
}