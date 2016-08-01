(function() {
    'use strict';

    angular
        .module('studyGroups')
        .config(function($stateProvider) {
            $stateProvider
                .state('studyGroups', {
                    url: '/study',
                    templateUrl: '/app/main/studyGroups/studyGroups.html',
                    controller: 'studyGroupsCtrl',
                    parent: 'main'
                });
        });

})();
