(function () {
   "use strict";

   angular.module('datePickerEx', [])
      .directive('datePickerEx', function () {
         return {
            restrict: 'E',
            scope: {
               selectedDate: '=?',
               initial: '@',
               onSave: '&',
               onCancel: '&',
               timeselect: '@',
               noMinDate: '@'
            },
            templateUrl: '/app/components/datePickerEx/datePickerEx.html',
            link: function ($scope, elem, attrs) {
               $scope.isOnSave = 'onSave' in attrs;
               $scope.isOnCancel = 'onCancel' in attrs;
               $scope.selectedDate = $scope.selectedDate || moment();
               $scope.timeInfo = {
                  enabled: true,
                  dayPeriod: $scope.selectedDate.hours() > 12 ? 'PM' : 'AM',
                  hours: $scope.selectedDate.hours() > 12 ? $scope.selectedDate.hours() - 12 : $scope.selectedDate.hours(),
                  minutes: $scope.selectedDate.minutes()
               };

               $scope.minDate = moment();
               if ($scope.noMinDate) {
                  $scope.minDate = undefined;
               }
               $scope.dtpId = parseInt(Date.now());

               $scope.save = function() {
                  var hours = $scope.timeInfo.hours;
                  if($scope.timeInfo.dayPeriod === 'PM') {
                     hours += 12;
                  }
                  $scope.selectedDate.hours(hours);
                  $scope.selectedDate.minutes($scope.timeInfo.minutes);
                  // console.log($scope.selectedDate);
                  $scope.onSave({$date: $scope.selectedDate, $hasTime: $scope.timeInfo.enabled});
               };

               $scope.today = function() {
                  $scope.selectedDate = moment();
               };
               $scope.$broadcast('pickerUpdate', '', {
                  minDate: $scope.minDate
               });

            }
         }
      });


})();
