(function () {
   'use strict';
   angular
      .module('studentServicesCreate', [])
      .controller('studentServicesCreateCtrl', function ($scope, apiService, userService, alerts, $state, $stateParams, $q, $timeout) {
         $scope.serviceInfo = {
            name: '',
            description: '',
            faculty: '',
            campus: '',
            noFaculty: false,
            noCampus: false,
            locations: [],
            consultationTimes: [],
            siteUrl: '',
            phoneNo: '',
            email: '',
            stuffNames: [],
            stuffEmails: []
         };

         $scope.formInfo = {
            campuses: [],
            faculties: [],
            days: [],
            times: [
               {key:'08:00 AM', value: '08:00 AM'},
               {key:'08:30 AM', value: '08:30 AM'},
               {key:'09:00 AM', value: '09:00 AM'},
               {key:'09:30 AM', value: '09:30 AM'},
               {key:'10:00 AM', value: '10:00 AM'},
               {key:'10:30 AM', value: '10:30 AM'},
               {key:'11:00 AM', value: '11:00 AM'},
               {key:'11:30 AM', value: '11:30 AM'},
               {key:'12:00 PM', value: '12:00 PM'},
               {key:'12:30 PM', value: '12:30 PM'},
               {key:'01:00 PM', value: '01:00 PM'},
               {key:'01:30 PM', value: '01:30 PM'},
               {key:'02:00 PM', value: '02:00 PM'},
               {key:'02:30 PM', value: '02:30 PM'},
               {key:'03:00 PM', value: '03:00 PM'},
               {key:'03:30 PM', value: '03:30 PM'},
               {key:'04:00 PM', value: '04:00 PM'},
               {key:'04:30 PM', value: '04:30 PM'},
               {key:'05:00 PM', value: '05:00 PM'},
               {key:'05:30 PM', value: '05:30 PM'},
               {key:'06:00 PM', value: '06:00 PM'},
               {key:'06:30 PM', value: '06:30 PM'},
            ]
         };

         $scope.followers = [];

         $scope.usersEmail = [];

         $scope.loadStatus = '';
         $scope.groupFormSubmitted = false;

         /********************* initializers ****************************/

         $scope.editID = $stateParams['service_id'];

         function init () {
            $scope.loadStatus = 'loading';
            if ($scope.editID) {
               loadDetail($scope.editID).then(function () {
                  loadFollowers().then(function () {
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
               loadDetail().then(function () {
                  $scope.loadStatus = 'success';
               }, function () {
                  $scope.loadStatus = 'failed';
               });
            }
         }
         function loadDetail(serviceID) {
            var deferred = $q.defer();
            apiService.studentServices.getInitialData(serviceID).then(
               function (response) {
                  console.log('load initial data', response);
                  if (response && response.form_select_options) {
                     angular.forEach(response.form_select_options.campus, function (obj, key) {
                        if(key !== '') {
                           $scope.formInfo.campuses.push({
                              key: obj.id,
                              value: obj.name
                           });
                        }
                     });
                     angular.forEach(response.form_select_options.faculty, function (obj, key) {
                        if(key !== '') {
                           $scope.formInfo.faculties.push({
                              key: obj.id,
                              value: obj.name
                           });
                        }
                     });
                     angular.forEach(response.form_select_options.days, function (obj, key) {
                        if(key !== '') {
                           $scope.formInfo.days.push({
                              key: key,
                              value: obj
                           });
                        }
                     });
                  }
                  $scope.formInfo.consultationTimes = {
                     campuses: $scope.formInfo.campuses,
                     days: $scope.formInfo.days,
                     times: $scope.formInfo.times
                  };
                  if (serviceID) {
                     $scope.serviceInfo.name = response.name;
                     $scope.serviceInfo.description = response.description;
                     $scope.serviceInfo.siteUrl = response.website;
                     $scope.serviceInfo.email = response.email;
                     $scope.serviceInfo.phoneNo = response.phone;
                     $scope.serviceInfo.faculty = response.faculty_id;
                     $scope.serviceInfo.campus = response.campus_id;
                     $scope.serviceInfo.locations = response.office_location;
                  }
                  return deferred.resolve();
               },
               function() {
                  return deferred.reject();
               }
            );
            return deferred.promise;
         }

         function loadFollowers () {
            var deferred = $q.defer();
            apiService.studentServices.getFollowers($scope.editID).then(
               function(response) {
                  $scope.followers = response;
                  return deferred.resolve();
               },
               function() {
                  return deferred.reject();
               }
            );
            return deferred.promise;
         }

         /******************* helper functions *****************/

         $scope.pageStatus = function (status) {
            return $scope.loadStatus == status;
         };

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
            return $scope.groupFormSubmitted && $scope.serviceInfo[field] == '';
         };

         /**************** Action functions *******************/

         $scope.uploadLogo = function(file) {
            if (file) {
               $scope.groupInfo.userfile = file;
            }
         };

         $scope.submit = function (form) {
            $scope.groupFormSubmitted = true;
            if (form.$invalid || $scope.serviceInfo.name == '' || $scope.serviceInfo.name.trim() == '') {
               return;
            }
            var newStudentService = {};

            newStudentService.name = $scope.serviceInfo.name;
            newStudentService.description = $scope.serviceInfo.description;
            newStudentService.website = $scope.serviceInfo.siteUrl;
            newStudentService.email = $scope.serviceInfo.email;
            newStudentService.phone = $scope.serviceInfo.phoneNo;
            if ($scope.serviceInfo.noFaculty) {
               newStudentService.faculty_id = '-1';
            } else {
               newStudentService.faculty_id = $scope.serviceInfo.faculty;
            }
            if ($scope.serviceInfo.noCampus) {
               newStudentService.campus_id = '-1';
            } else {
               newStudentService.campus_id = $scope.serviceInfo.campus;
            }
            newStudentService.office_location = $scope.serviceInfo.locations;
            newStudentService.dropin_day = $scope.serviceInfo.consultationTimes.map(function (obj) { return obj.day;});
            newStudentService.dropin_start = $scope.serviceInfo.consultationTimes.map(function (obj) { return obj.time_from;});
            newStudentService.dropin_end = $scope.serviceInfo.consultationTimes.map(function (obj) { return obj.time_to;});
            newStudentService.dropin_location = $scope.serviceInfo.consultationTimes.map(function (obj) { return obj.location;});
            newStudentService.dropin_campus = $scope.serviceInfo.consultationTimes.map(function (obj) { return obj.campus;});
            newStudentService.staff_email = $scope.serviceInfo.stuffEmails;
            newStudentService.staff_name = $scope.serviceInfo.stuffNames;
            newStudentService.bulk_add_member_file = $scope.serviceInfo.file;

            if ($scope.editID) {
               apiService.studentServices.edit(newStudentService).then(function (response) {
                  if (response && response.id) {
                     $state.go('studentServicesEvents', {id: response.id});
                     return;
                  }
                  $state.go('studentServicesListGeneral');
               }, function (error) {
                  alerts.warning(error);
               });
            } else {
               apiService.studentServices.create(newStudentService, $scope.editID).then(function (response) {
                  if (response && response.id) {
                     $state.go('studentServicesEvents', {id: response.id});
                     return;
                  }
                  $state.go('studentServicesListGeneral');
               }, function (error) {
                  if (error && error.data && error.data.message) {
                     alerts.warning(error.data.message);
                  } else {
                     console.error('Create student service', error);
                  }
               });
            }
         };

         $scope.cancel = function () {
            $state.go('studyGroupsList');
         };

         /***********************************************************/

         init();

      });

})();
