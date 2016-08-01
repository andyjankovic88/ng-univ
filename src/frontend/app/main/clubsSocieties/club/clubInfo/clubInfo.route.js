(function() {
   'use strict';

   angular
      .module('clubInfo')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('clubInfo', {
            url: '/club-info',
            templateUrl: '/app/main/clubsSocieties/club/clubInfo/clubInfo.html',
            controller: 'clubInfoCtrl',
            parent: 'club'

         });

   }

})();
