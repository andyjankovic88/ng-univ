(function() {
   'use strict';

   angular
      .module('studyGroupsCreate')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('studyGroupsCreate', {
            url: '/study/create',
            templateUrl: '/app/main/studyGroups/create/create.html',
            controller: 'studyGroupsCreateCtrl',
            parent: 'main'
         }).state('studyGroupsEdit', {
            url: '/study/edit/:group_id',
            templateUrl: '/app/main/studyGroups/create/create.html',
            controller: 'studyGroupsCreateCtrl',
            parent: 'main'
         });
   }

})();
