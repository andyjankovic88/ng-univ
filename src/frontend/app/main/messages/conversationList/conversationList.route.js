(function() {
    'use strict';

    angular
        .module('conversationList')
        .config(routeConfig);

    /** @ngInject */
    function routeConfig($stateProvider ) {
        $stateProvider
            .state('conversationList', {
                url: 'inbox',
                templateUrl: '/app/main/messages/conversationList/conversationList.html',
                controller: 'conversationListCtrl',
                parent: 'messages'
            });

    }


})();
