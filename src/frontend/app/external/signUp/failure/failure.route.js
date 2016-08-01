(function() {
  'use strict';

  angular
    .module('signUpAAFFailure')
    .config(routeConfig);

  /** @ngInject */
  function routeConfig($stateProvider ) {
    $stateProvider
      .state('signUpAAFFailure', {
        url: '/failed',
        templateUrl: '/app/external/signUp/failure/failure.html',
        controller: 'signUpAAFFailureCtrl',
        parent: 'signUp'

      });
  }

})();
