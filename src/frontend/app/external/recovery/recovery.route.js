(function() {
    'use strict';

    angular
        .module('passwordRecovery')
        .config(routeConfig);

    function routeConfig($stateProvider) {
        $stateProvider
            .state('passwordRecovery', {
                url: '/forgot-password',
                templateUrl: '/app/external/recovery/recovery.html',
                controller: 'recoveryCtrl',
                parent: 'external',
                data: {
                    permissions: {
                        only: ['anonymous'],
                        redirectTo: 'recentActivity'
                    }
                }
            }).state('passwordRecovery.success', {
              url: '/forgot-password/success',
              templateUrl: '/app/external/recovery/recovery-success.html',
              controller: function () {},
              parent: 'external',
              data: {
                 permissions: {
                    only: ['anonymous'],
                    redirectTo: 'recentActivity'
                 }
              }
           }).state('passwordRecoveryConfirm', {
              url: '/forgot-password/password-reset-confirm/:reset_token',
              templateUrl: '/app/external/recovery/recovery-confirm.html',
              controller: 'recoveryConfirmCtrl',
              parent: 'external',
              data: {
                 permissions: {
                    only: ['anonymous'],
                    redirectTo: 'recentActivity'
                 }
              }
           });

    }

})();
