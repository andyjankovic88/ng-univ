(function() {
    'use strict';

    angular
        .module('groupView')
        .config(function($stateProvider) {
            $stateProvider
                .state('groupView', {
                    url: '/groupView',
                    templateUrl: '/app/main/groupView/groupView.html',
                    controller: 'groupViewCtrl',
                    parent: 'main'
                });
        });

})();
