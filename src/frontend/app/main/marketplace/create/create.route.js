(function() {
    'use strict';

    angular
        .module('marketplace')
        .config(function($stateProvider) {
            $stateProvider
                .state('marketplaceCreateItem', {
                    url: '/create/:id',
                    templateUrl: '/app/main/marketplace/create/create.html',
                    controller: 'marketplaceItemCreateCtrl',
                    parent: 'marketplace',
                    params: {                        
                        id: ''
                    }
                });
        });
})();
