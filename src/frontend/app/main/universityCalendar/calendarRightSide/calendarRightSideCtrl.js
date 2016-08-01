(function () {
   'use strict';

   angular
      .module('uCalendar')
      .controller('uCalendarRightSideCtrl', function ($scope, $filter, apiService, alerts) {
         $scope.subjects = [];
         apiService.calendar.getSetupInfo().then(
            function(response) {
               delete response.subject_repeat.none;
               delete response.reminder_days[0];
               delete response.subject_type[""];
               delete response.subject_days[""];
               delete response.subject_time[""];

               $scope.types = response.subject_type;
               $scope.days = response.subject_days;
               $scope.subjects = response.subject_list;
               $scope.time = response.subject_time;
               $scope.repeatOptions = response.subject_repeat;
               $scope.alertOptions = response.reminder_days;

            }
         );

         $scope.class = {
            type: "class"
         };

         $scope.activity = {
            type: "activity",
         };

         $scope.assessment = {
            type: "assessment",
            by_academic: 1
         };

         $scope.setOnChecked = function(obj, key, value, condition) {
            if (condition) {
               obj[key] = value;
            } else {
               delete obj[key];
            }
         };

         $scope.loadClassTimes = function(){
            if ($scope.class.assessment_unit_id) {
               apiService.calendar.getClassTimes($scope.class.assessment_unit_id).then(
                  function(response){
                     if (response && response.teaching_times && response.teaching_times.options) {
                        $scope.classTimes = response.teaching_times.options;
                     }
                  }
               );
            }
         };

         $scope.importICS = function(file) {
            if (file) {
               apiService.calendar.uploadICS(file).then(
                  function (message) {
                     alerts.info(message);
                  },
                  function (error) {
                     console.error(error);
                     alerts.warning(error);
                  }
               );
            }
         }
         $scope.submit = function(formObj) {
            angular.forEach(['date', 'repeat-start-date', 'repeat-end-date'], function(field) {
               if (formObj[field]) {
                  formObj[field] = $filter('date')(formObj[field],'dd-MM-yyyy');
               }
            });

            apiService.calendar.addEvent(formObj).then(
               function(message) {
                  alerts.info(message);

                  $scope.class = {
                     type: "class"
                  };

                  $scope.activity = {
                     type: "activity",
                  };

                  $scope.assessment = {
                     type: "assessment",
                     by_academic: 1
                  };
                  $scope.classTimes = [];


                  $scope.$parent.$broadcast('addedEvent', 'Event was added');

               }
            );
         };


      });

})();
