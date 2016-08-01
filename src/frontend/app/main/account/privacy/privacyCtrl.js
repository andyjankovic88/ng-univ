(function () {
   'use strict';

   angular
      .module('ucrAccountPrivacy', [])
      .controller('privacyCtrl', function ($scope, apiService, userService, dataShareService) {
         $scope.settings = dataShareService.account.settings;

         $scope.$on('saveAccountSetting', function (event, msg) {
            var param = {
               user_permissions: {}
            };
            angular.forEach($scope.settings.privacy_settings, function (obj, key) {
               param.user_permissions[key] = obj.selected;
            });
            apiService.account.settings.updatePrivacy(param);
         });
      });
})();
