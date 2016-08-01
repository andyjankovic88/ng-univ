(function() {
  'use strict';

  angular
    .module('external')
    .config(routeConfig);

  /** @ngInject */
  function routeConfig($stateProvider ) {
    $stateProvider
      .state('external', {
        url: '/external',
        templateUrl: '/app/external/external.html',
        controller: 'externalCtrl'
      });

  }

})();
