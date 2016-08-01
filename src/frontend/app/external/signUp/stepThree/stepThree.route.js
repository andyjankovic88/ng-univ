(function() {
  'use strict';

  angular
    .module('stepThree')
    .config(routeConfig);

  /** @ngInject */
  function routeConfig($stateProvider ) {
    $stateProvider
      .state('stepThree', {
        url: '/step-three',
        templateUrl: '/app/external/signUp/stepThree/stepThree.html',
        controller: 'stepThreeCtrl',
        parent: 'signUp'

      });

  }

})();
