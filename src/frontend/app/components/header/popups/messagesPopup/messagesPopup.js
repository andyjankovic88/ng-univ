(function () {

   'use strict';

   angular.module('messagesPopup', [])
      .directive('messagesPopup', function (apiService) {
         return {
            restrict: 'E',
            scope: true,
            templateUrl: '/app/components/header/popups/messagesPopup/messagesPopup.html',
            link: function ($scope) {
               $scope.messages = [];

               updateWidgetMessagesList();

               $scope.$on('headerWidgetActivated', function (event, data) {
                  if (data.name == 'messages') {
                     updateWidgetMessagesList();
                  }
               });


               function updateWidgetMessagesList() {
                  $scope.messages = [];
                  $scope.loaderActive = true;
                  apiService.messages.conversations().then(
                     function (response) {
                        $scope.loaderActive = false;
                        $scope.messages = response;
                     });
               }
            }

         };
      })
      .filter("messageLimit", function () {
         return function (theText, longLimit) {
            if (theText.length > longLimit) {
               theText = theText.slice(0, longLimit) + "...";
               return theText;
            }
            else return theText

         };
      });


})();
