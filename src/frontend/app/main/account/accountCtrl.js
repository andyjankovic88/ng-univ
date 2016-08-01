(function () {
   'use strict';

   angular
      .module('ucrAccount', [])
      .controller('accountCtrl', function ($scope, apiService, userService, dataShareService) {
         $scope.loaderActive = true;
         $scope.isProgressing = false;
         function init () {
            apiService.account.settings.get().then(function (response) {
               $scope.settingsData = response;
               angular.extend(dataShareService.account.settings, $scope.settingsData);
               $scope.loaderActive = false;
            });
         }

         $scope.$on ('reloadAccountSettings', function () {
            init();
         });

         $scope.saveAccountSetting = function () {
            $scope.$broadcast('saveAccountSetting');
         };

         init();
      });

})();
