(function() {
    'use strict';

    angular
        .module('studentServicesList')
        .config(function($stateProvider) {
            $stateProvider
                .state('studentServicesList', {
                    url: '/list',
                    templateUrl: '/app/main/studentServices/list/list.html',
                    controller: 'studentServicesListCtrl',
                    parent: 'studentServices'
                });
        });

})();
