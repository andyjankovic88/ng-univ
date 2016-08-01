(function() {
    'use strict';

    angular
        .module('profile')
        .config(function($stateProvider) {
            $stateProvider
                .state('profile', {
                  //   abstract: true,
                    url: '/user/profile/:id',
                    templateUrl: '/app/main/profile/profile.html',
                    controller: 'profileCtrl',
                    parent: 'main',
                    params: {
                        id: ''
                    },
                });
        });

})();
