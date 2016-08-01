(function() {
   'use strict';

   angular
      .module('groupList')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('groupList', {
            url: '/groupList',
            templateUrl: '/app/main/groupView/customGroup/groupList/groupList.html',
            controller: 'groupListCtrl',
            parent: 'customGroup'

         });

   }

})();
