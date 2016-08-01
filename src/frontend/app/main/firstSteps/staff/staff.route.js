(function() {
    'use strict';

    angular
        .module('firstSteps')
        .config(function($stateProvider) {
            $stateProvider
                .state('firstStepsStaff', {
                    url: '/firstSteps/staff',
                    templateUrl: '/app/main/firstSteps/staff/staff.html',
                    controller: 'firstStepsStaffCtrl',
                    parent: 'main'                    
                });

        });



})();
