(function() {
    'use strict';

    angular
        .module('studentServices')
        .config(function($stateProvider) {
            $stateProvider
                .state('studentServices', {
                    url: '/student-services',
                    templateUrl: '/app/main/studentServices/studentServices.html',
                    controller: 'studentServicesCtrl',
                    parent: 'main'
                });
        });

})();
