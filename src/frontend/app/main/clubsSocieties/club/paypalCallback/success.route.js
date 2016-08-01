(function() {
   'use strict';

   angular
      .module('club')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('club.success', {
            url: '/success',
            controller: function($scope, $state, ngDialog, apiService, $stateParams) {
               apiService.clubs.receipt($stateParams.id).then(
                  function(response) {
                     ngDialog.open({
                        template: '<div>' + response.invoice_html + '</div>',
                        plain: true
                     }).closePromise.then(
                        function (data) {$state.go('events', {paypalResult: 'success'});
                     });
                  },
                  function() {

                  }
               );

            },
            parent: 'club'

         });

   }

})();
