(function() {
  'use strict';

  angular
    .module('stepOne')
    .config(routeConfig);

  /** @ngInject */
  function routeConfig($stateProvider ) {
    $stateProvider
      .state('stepOne', {
        url: '/step-one-e/:university_id',
        templateUrl: '/app/external/signUp/stepOne/stepOne.html',
        controller: 'stepOneCtrl',
        parent: 'signUp'

      })
       .state('stepOneAAF', {
          url: '/step-one/:unique_id',
          templateUrl: '/app/external/signUp/stepOne/stepOne.html',
          controller: 'stepOneCtrl',
          parent: 'signUp'

       });

  }

})();
