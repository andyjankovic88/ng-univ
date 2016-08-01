(function () {
   'use strict';

   angular
      .module('payment', [])
      .controller('paymentCtrl', function ($scope, $window, $state, $sce, $stateParams) {
         $window.goToState = function (stateName, params) {

            $window.setTimeout(function () {
               $state.go(stateName, params);
            }, 0);

            $scope.url = $sce.trustAsResourceUrl();
         };


      });


})();
