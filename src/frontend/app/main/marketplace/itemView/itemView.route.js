(function() {
    'use strict';

    angular
        .module('marketplace')
        .config(function($stateProvider) {
            $stateProvider
                .state('marketplaceItem', {
                    url: '/:id',
                    templateUrl: '/app/main/marketplace/itemView/itemView.html',
                    controller: 'marketplaceItemViewCtrl',
                    parent: 'marketplace',
                    params: {                        
                        id: ""
                    }
                });
        });

})();
