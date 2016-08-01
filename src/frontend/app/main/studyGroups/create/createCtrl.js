(function () {
   'use strict';
   angular
      .module('studyGroupsCreate', [])
      .controller('studyGroupsCreateCtrl', function ($scope, apiService, userService, alerts, $state, $stateParams, $q, $timeout) {
         $scope.groupInfo = {
            name: '',
            userfile: null,
            purpose: '',
            privacy: '',
            day: '',
            fromHour: '09',
            fromMinute: '00',
            fromPeriod: 'am',
            toHour: '10',
            toMinute: '00',
            toPeriod: 'am',
            file_id: ''
         };
         $scope.forms = {};
         $scope.usersEmail = [];

         $scope.formInfo = {};
         $scope.formInfo.dayNames = [{
            name: 'Monday',
            value: '0'
         },{
            name: 'Tuesday',
            value: '1'
         },{
            name: 'Wednesday',
            value: '2'
         },{
            name: 'Thursday',
            value: '3'
         },{
            name: 'Friday',
            value: '4'
         },{
            name: 'Saturday',
            value: '5'
         },{
            name: 'Sunday',
            value: '6'
         }];
         $scope.formInfo.purpose = [];
         $scope.formInfo.privacies = [
            {
               name: "Public",
               value: "open"
            },
            {
               name: "Private",
               value: "close"
            }
         ];


         $scope.hourMin = 0;
         $scope.hourMax = 11;

         $scope.loadStatus = '';
         $scope.groupFormSubmitted = false;

         /********************* initializers ****************************/

         $scope.editID = $stateParams['group_id'];

         function init () {
            $scope.loadStatus = 'loading';
            if ($scope.editID) {
               loadDetail().then(function () {
                  loadCreateInitial().then(function () {
                     $scope.loadStatus = 'success';
                  }, function () {
                     $scope.loadStatus = 'failed';
                  });
               }, function (err) {
                  if (err == 'permission_error') {
                     $scope.loadStatus = 'permission_error';
                  } else {
                     $scope.loadStatus = 'failed';
                  }
               });
            } else {
               loadCreateInitial().then(function () {
                  $scope.loadStatus = 'success';
               }, function () {
                  $scope.loadStatus = 'failed';
               });
            }
         }
         function loadCreateInitial () {
            var deferred = $q.defer();
            apiService.studyGroups.getInitialData().then(
               function (response) {
                  console.log('load initial data', response);
                  //angular.forEach(response.days, function (obj, key) {
                  //   if(key !== '') {
                  //      $scope.formInfo.dayNames.push({
                  //         name: obj,
                  //         value: key
                  //      });
                  //   }
                  //});
                  angular.forEach(response.purpose, function (obj, key) {
                     if(key !== '') {
                        $scope.formInfo.purpose.push({
                           name: obj,
                           value: key
                        });
                     }
                  });
                  return deferred.resolve();
               },
               function() {
                  return deferred.reject();
               }
            );
            return deferred.promise;
         }
         function loadDetail () {
            var deferred = $q.defer();
            apiService.studyGroups.get($scope.editID).then(
               function(response) {
                  console.log('load initial data', response);
                  if (!response.data || !response.data.is_editable) {
                     return deferred.reject('permission_error');
                  }
                  $scope.groupInfo.name = response.data.study_group.name;
                  $scope.groupInfo.purpose = response.data.study_group.purpose;
                  $scope.groupInfo.privacy = response.data.study_group.privacy;
                  $scope.groupInfo.day = response.data.study_group.time_day;
                  var timeFrom = fullTimeToPeriodTime(response.data.study_group.time_from);
                  var timeTo = fullTimeToPeriodTime(response.data.study_group.time_to);
                  $scope.groupInfo.fromHour = timeFrom.hour;
                  $scope.groupInfo.fromMinute = timeFrom.minute;
                  $scope.groupInfo.fromPeriod = timeFrom.period;
                  $scope.groupInfo.toHour = timeTo.hour;
                  $scope.groupInfo.toMinute = timeTo.minute;
                  $scope.groupInfo.toPeriod = timeTo.period;

                  $scope.members = response.members;
                  return deferred.resolve();
               },
               function() {
                  return deferred.reject();
               }
            );
            return deferred.promise;
         }

         /******************* helper functions *****************/

         function getData(apiData, innerObj, responseObj){
            var deferred = $q.defer();
            apiData.then(
               function(response){
                  if (responseObj) {
                     $scope[innerObj]=response[responseObj];
                     return deferred.resolve();
                  }
                  $scope[innerObj]=response;
                  return deferred.resolve();
               },
               function () {
                  return deferred.reject();
               }
            );
            return deferred.promise;
         }
         function mk2str (str) {
            return str.length < 2 ? '0' + str : '' + str;
         }
         function periodTimeToFullTime (hour, munite, period) {
            var result = '';

            if (period === 'am') {
               result = mk2str(parseInt(hour) + '') + ':' + mk2str(munite) + ':00';
            } else {
               result = mk2str((parseInt(hour) % 12 + 12) + '') + ':' + mk2str(munite) + ':00';
            }
            return result;
         }

         function fullTimeToPeriodTime (time) {
            var result = {
               hour: '00',
               minute: '00',
               period: 'am'
            };
            if (time.length < 8) {
               return result;
            }
            var tmp = parseInt(time.substring(0, 2));
            result.period = isNaN(tmp) || tmp < 12 ? 'am' : 'pm';
            tmp = tmp > 12 ? tmp % 12 : tmp;
            result.hour = isNaN(tmp) ? '00' : mk2str((tmp % 12) + '');
            tmp = parseInt(time.substring(3, 4));
            result.minute = isNaN(tmp) ? '00' : mk2str(tmp + '');

            return result;
         }

         $scope.pageStatus = function (status) {
            return $scope.loadStatus == status;
         };

         /****************** watch functions ***********************/
         $scope.$watch('groupInfo.fromPeriod', function (newValue) {
            if (newValue == 'am') {
               $scope.hourMin = 0;
               $scope.hourMax = 11;
            } else {
               $scope.hourMin = 1;
               $scope.hourMax = 12;
            }
         });

         /****************** Validation check helpers **************/

         $scope.isShowError = function (form) {
            var elements = Array.prototype.slice.call(arguments, 1);
            var status = form.$submitted;
            var invalidStatus = false;
            if (elements.length && elements.length > 0) {
               elements.map(function (obj) {
                  status |= obj.$dirty;
               });
               elements.map(function (obj) {
                  invalidStatus |= obj.$invalid;
               });
            }
            return status && invalidStatus;
         };

         $scope.isShowSuccess = function (form) {
            var elements = Array.prototype.slice.call(arguments, 1);
            var status = form.$submitted;
            var validStatus = false;
            if (elements.length && elements.length > 0) {
               elements.map(function (obj) {
                  status |= obj.$dirty;
               });
               elements.map(function (obj) {
                  validStatus |= obj.$valid;
               });
            }
            return status && validStatus;
         };

         $scope.showError = function (field) {
            return $scope.groupFormSubmitted && $scope.groupInfo[field] == '';
         };

         /**************** Action functions *******************/

         $scope.uploadLogo = function(file) {
            if (file) {
               $scope.groupInfo.userfile = file;
            }
         };

         $scope.submit = function (form) {
            $scope.groupFormSubmitted = true;
            if (form.$invalid || $scope.groupInfo.name == '') {
               return;
            }
            var emails = $scope.usersEmail.map(function(email) { return email.email; });
            if (emails[0]) {
               $scope.groupInfo.member_email =  emails;
            }
            var newStudyGroup = {};

            newStudyGroup.name  =  $scope.groupInfo.name;
            newStudyGroup.purpose =  $scope.groupInfo.purpose;
            newStudyGroup.privacy =  $scope.groupInfo.privacy;
            newStudyGroup.time_from =  periodTimeToFullTime($scope.groupInfo.fromHour, $scope.groupInfo.fromMinute, $scope.groupInfo.fromPeriod);
            newStudyGroup.time_to =  periodTimeToFullTime($scope.groupInfo.toHour, $scope.groupInfo.toMinute, $scope.groupInfo.toPeriod);
            newStudyGroup.time_day = $scope.groupInfo.day;

            if (!$scope.editID) {
               apiService.studyGroups.create(newStudyGroup).then(function (response) {
                  if (response && response.id) {
                     $state.go('studyGroupEvents', {id: response.id});
                     return;
                  }
                  $state.go('studyGroupsList');
               }, function (error) {
                  alerts.warning(error);
               });
            } else {
               apiService.studyGroups.edit(newStudyGroup, $scope.editID).then(function (response) {
                  if (response && response.id) {
                     $state.go('studyGroupEvents', {id: response.id});
                     return;
                  }
                  $state.go('studyGroupsList');
               }, function (error) {
                  alerts.warning(error);
               });
            }
         };

         $scope.cancel = function () {
            $state.go('studyGroupsList');
         };

         /***********************************************************/

         init();

      }).directive("numberCheck", function() {
         return {
            require: 'ngModel',
            scope: {
               'max': '=',
               'min': '=',
               'maxlength': '@'
            },
            link: function (scope, elem, attrs, ctrl) {
               var firstPassword = '#' + attrs.pwCheck;
               var strZero = '0000000000000000000000000000000';
               elem.bind('input', function () {
                  console.log(arguments);
                  scope.$apply(function () {
                     var val = parseInt(elem.val());
                     if (isNaN(val)) {
                        ctrl.$setValidity('isnumber', false);
                     } else {
                        ctrl.$setValidity('isnumber', val >= scope.min && val <= scope.max);
                     }
                  });
               });
               if (scope.maxlength) {
                  elem.bind('blur', function () {
                     if (ctrl.$valid) {
                        scope.$apply(function () {
                           var missingPrefix = scope.maxlength - elem.val().length;
                           elem.val(strZero.substring(0, missingPrefix) + elem.val());
                        });
                     }
                  });
               }
               scope.$watch('min', function () {
                  var val = parseInt(elem.val());
                  if (isNaN(val)) {
                     ctrl.$setValidity('isnumber', false);
                  } else {
                     ctrl.$setValidity('isnumber', val >= scope.min && val <= scope.max);
                  }
               });
               scope.$watch('max', function () {
                  var val = parseInt(elem.val());
                  if (isNaN(val)) {
                     ctrl.$setValidity('isnumber', false);
                  } else {
                     ctrl.$setValidity('isnumber', val >= scope.min && val <= scope.max);
                  }
               });
               scope.$on('$destroy', function () {
                  elem.unbind('input').unbind('blur');
               });
            }
         };
      });

})();
