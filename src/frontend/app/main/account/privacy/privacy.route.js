(function() {
   'use strict';

   angular
      .module('ucrAccountPrivacy')
      .config(function($stateProvider) {
         $stateProvider
            .state('ucrAccountPrivacy', {
               url: '/privacy',
               templateUrl: '/app/main/account/privacy/privacy.html',
               controller: 'privacyCtrl',
               parent: 'ucrAccount'
            });
      });
})();
