(function() {
  'use strict';

  angular
    .module('landing')
    .config(routeConfig);

  /** @ngInject */
  function routeConfig($stateProvider ) {
    $stateProvider
      .state('landing', {
        url: '/',
        templateUrl: '/app/landing/landing.html',
        controller: 'LandingCtrl'
      });

  }

})();
