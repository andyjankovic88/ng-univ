(function() {
   'use strict';

   angular
      .module('studyGroupsView')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('studyGroupsInfo', {
            url: '/info',
            templateUrl: '/app/main/studyGroups/group/groupInfo/groupInfo.html',
            controller: 'studyGroupsInfoCtrl',
            parent: 'studygroupview'

         });

   }

})();
