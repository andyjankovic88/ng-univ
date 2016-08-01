(function () {
   'use strict';

   angular
      .module('subjects')
      .controller('addSubjectAdminCtrl', function ($scope, $q, $state, apiService, userService, $timeout, $stateParams) {
         $scope.searchResults = [];
         $scope.search = {};
         $scope.editMode = false;
         var searchPromise;
         $scope.searchSubject = function () {
            if (!$scope.search.keywords.length) {
               $scope.searchResults = [];
               return;
            }
            apiService.subjects.cancel(searchPromise);
            searchPromise = apiService.subjects.search($scope.search.keywords);
            searchPromise.then(
               function (response) {
                  $scope.searchResults = response;
               }
            );
         };
         $scope.subject = {};
         $scope.isSubjectSelected = false;

         var oldValue = '';
         $scope.select = function(item) {
            $scope.showDetails = false;
            $scope.subject = item;
            $scope.isSubjectSelected = true;
            $scope.search.keywords = item.code ? item.code : '' + ' ' + item.name ? item.name : '';
            oldValue = $scope.search.keywords;
            $scope.loading = true;

            apiService.subjects.details($scope.subject.id).then(
               function (response) {
                  $scope.subject = response;
                  $scope.subject.colleagues = [];
                  $scope.subject.students = [];
                  $scope.subject.selectedUsers = [];
                  $scope.showDetails = true;
                  if ($stateParams.id) {
                     $scope.search.keywords = response.code + ' ' + response.name;
                     $scope.loading = false;
                  }
               }
            );
         }
         $scope.resetValue = function () {
            $scope.search.keywords = '';
            $scope.searchResults = [];
         }
         $scope.returnValue = function() {
            if (!$scope.search.keywords.length) $scope.search.keywords = oldValue;
            if ($scope.search.keywords !== oldValue) $scope.search.keywords = oldValue;
         };

         $scope.cancel = function () {
            $state.go('subjectsList');
         };


         $scope.defaultObj = {
            coursework_topics: {
               title: "Default text"
            }
         };


         if ($stateParams.id) {
            $scope.editMode = true;
            $scope.isSubjectSelected = true;
            $scope.subject.id = $stateParams.id;
            $scope.select($scope.subject);
         }

         $scope.submit = function () {
            var submitObject = {
               consultation_times_day: [],
               consultation_times_from: [],
               consultation_times_to: [],
               monitor_keywords_topic: [],
               monitor_keywords_notify_email: [],
               coursework_topics: [],
               coursework_topics_id: [],
               invite_colleagues_email: [],
               individually_add_member_userid: []
            };

            if ($scope.subject.consultation_times && $scope.subject.consultation_times.current.length) {
               angular.forEach($scope.subject.consultation_times.current, function(obj) {
                  if (obj.time_day && obj.time_from && obj.time_to) {
                     submitObject.consultation_times_day.push(obj.time_day);
                     submitObject.consultation_times_from.push(obj.time_from);
                     submitObject.consultation_times_to.push(obj.time_to);
                  };
               });
            }

            angular.forEach($scope.subject.monitor_keywords, function(obj) {
               if (obj.keyword && obj.email) {
                  submitObject.monitor_keywords_topic.push(obj.keyword);
                  submitObject.monitor_keywords_notify_email.push(obj.email);
               }
            });

            angular.forEach($scope.subject.coursework_topics, function(obj) {
               if (obj.title) {
                  submitObject.coursework_topics_id.push(obj.id ? obj.id : '');
                  submitObject.coursework_topics.push(obj.title);
               }
            });

            submitObject.invite_colleagues_email = $scope.subject.colleagues.map(function(obj){return obj.email;});

            submitObject.individually_add_member_userid = $scope.subject.selectedUsers.map(function(user){return user.user_id});

            if ($scope.csvFiles && $scope.csvFiles.length) {
               submitObject.bulk_add_member_file = $scope.csvFiles[0].file_id;
            }

            apiService.subjects.setup(submitObject, $scope.subject.id).then(
               function () {
                  $state.go('subjectsList');
               }
            );

         };
      });

})();
