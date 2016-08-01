(function () {
   'use strict';

   angular
      .module('ucrAccountNotification', [])
      .controller('notificationCtrl', function ($scope, apiService, userService, dataShareService) {
         $scope.settings = dataShareService.account.settings;

         $scope.$on('saveAccountSetting', function (event, msg) {
            var param = {};
            angular.forEach($scope.settings.email_notif_details, function (obj, key) {
               param[key] = obj.value;
            });
            apiService.account.settings.updateEmailNotification(param);
         });
      });
})();
