(function () {
   'use strict';

   angular
      .module('clubsSuggestions', [])
      .controller('clubsSuggestionsCtrl', function ($scope) {
         $scope.basedOnYourConnectionsEnable = 'false';
         $scope.basedOnYourInterestsEnable = 'false';
      });

})();
