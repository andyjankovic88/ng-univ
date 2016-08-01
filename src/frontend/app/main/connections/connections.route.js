(function() {
    'use strict';

    angular
        .module('connections')
        .config(function($stateProvider) {
            $stateProvider
                .state('connections', {
                    url: '/connections',
                    templateUrl: '/app/main/connections/connections.html',
                    controller: 'connectionsCtrl',
                    parent: 'main'
                });
        });


})();
