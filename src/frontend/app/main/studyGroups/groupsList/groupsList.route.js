(function() {
   'use strict';

   angular
      .module('studyGroups')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('studyGroupsList', {
            url: '/list',
            templateUrl: '/app/main/studyGroups/groupsList/groupsList.html',
            controller: 'studyGroupsListCtrl',
            parent: 'studyGroups'

         });

   }

})();
