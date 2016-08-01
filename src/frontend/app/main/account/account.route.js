(function() {
   'use strict';

   angular
      .module('ucrAccount')
      .config(function($stateProvider) {
         $stateProvider
            .state('ucrAccount', {
               url: '/account',
               templateUrl: '/app/main/account/account.html',
               controller: 'accountCtrl',
               parent: 'main'
            });
      });


})();
