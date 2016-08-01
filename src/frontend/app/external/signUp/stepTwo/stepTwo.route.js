(function() {
  'use strict';

  angular
    .module('stepTwo')
    .config(routeConfig);

  /** @ngInject */
  function routeConfig($stateProvider ) {
    $stateProvider
      .state('stepTwo', {
        url: '/step-two',
        templateUrl: '/app/external/signUp/stepTwo/stepTwo.html',
        controller: 'stepTwoCtrl',
        parent: 'signUp'

      });

  }

})();
