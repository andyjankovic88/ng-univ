(function() {
  'use strict';

  angular
    .module('signUp')
    .config(routeConfig);

  /** @ngInject */
  function routeConfig($stateProvider ) {
    $stateProvider
      .state('signUp', {
        url: '/sign-up',
        templateUrl: '/app/external/signUp/signUp.html',
        controller: 'signUpCtrl',
        parent: 'external'
      });

  }

})();
