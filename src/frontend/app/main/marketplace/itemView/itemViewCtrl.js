(function() {
   'use strict';

   angular
      .module('marketplace')
      .controller('marketplaceItemViewCtrl', function($scope, apiService, $stateParams, userService) {
         var id = $stateParams.id;

         $scope.commentsCount = 0;
         $scope.currentUserId = userService.getInfo().id;

         apiService.marketplace.itemInfo(id).then(
            function(response) {
               $scope.item = response.items;    
            },
            function() {

            }
         );
         

      });

})();
