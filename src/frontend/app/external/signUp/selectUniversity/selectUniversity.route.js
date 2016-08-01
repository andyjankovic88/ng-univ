(function() {
  'use strict';

  angular
    .module('signUpSelectUniversity')
    .config(routeConfig);

  /** @ngInject */
  function routeConfig($stateProvider ) {
    $stateProvider
      .state('signUpSelectUniversity', {
        url: '/select-university',
        templateUrl: '/app/external/signUp/selectUniversity/selectUniversity.html',
        controller: 'selectUniversityCtrl',
        parent: 'signUp'

      });
  }

})();
