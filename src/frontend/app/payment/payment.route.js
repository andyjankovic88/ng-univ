(function() {
  'use strict';

  angular
    .module('payment')
    .config(routeConfig);

  /** @ngInject */
  function routeConfig($stateProvider ) {
    $stateProvider
      .state('payment', {
        url: '/',
        templateUrl: '/app/landing/landing.html',
        controller: 'paymentCtrl',
         params: {url: ''}
      });

  }

})();
