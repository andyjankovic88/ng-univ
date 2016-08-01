(function() {
   'use strict';

   angular
      .module('ucrAccountOther')
      .config(function($stateProvider) {
         $stateProvider
            .state('ucrAccountOther', {
               url: '/other',
               templateUrl: '/app/main/account/other/other.html',
               controller: 'otherCtrl',
               parent: 'ucrAccount'
            });
      });


})();
