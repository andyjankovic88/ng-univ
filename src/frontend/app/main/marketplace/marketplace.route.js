(function() {
    'use strict';

    angular
        .module('marketplace')
        .config(function($stateProvider) {
            $stateProvider
                .state('marketplace', {
                    url: '/marketplace',
                    abstract: true,
                    templateUrl: '/app/main/marketplace/marketplace.html',
                    controller: 'marketplaceCtrl',
                    parent: 'main'                    
                });
        });

})();
