(function() {
   'use strict';

   angular
      .module('clubs', [])
      .controller('clubsCtrl', function($scope, apiService) {
         $scope.dataClubs = {};
         apiService.clubs.getList().then(
            function(response){
               $scope.dataClubs=response ;
            },
            function(){}
         );
      });

})();
