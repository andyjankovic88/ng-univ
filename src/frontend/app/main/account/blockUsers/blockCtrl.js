(function () {
   'use strict';

   angular
      .module('ucrAccountBlock', [])
      .controller('blockCtrl', function ($scope, $q, apiService, userService, dataShareService, helper) {
         $scope.settings = dataShareService.account.settings;
         $scope.selectedStudent = null;
         $scope.candidateList = [];

         $scope.searchStudents = function (searchKey) {
            var deferred = $q.defer();

            var exceptIds = [];
            if ($scope.settings.blocked_users && $scope.settings.blocked_users.length > 0) {
               exceptIds = exceptIds.concat($scope.settings.blocked_users.map(function (user) {
                  return user.blocked_user_id;
               }));
            }
            if ($scope.candidateList && $scope.candidateList.length > 0) {
               exceptIds = exceptIds.concat($scope.candidateList.map(function (user) {
                  return user.id;
               }));
            }

            apiService.common.searchUsers(searchKey, exceptIds.join(",")).then(function(data) {
               var result = null;
               if (data && data.users && data.users.length > 0) {
                  result = data.users.reduce(function (arr, item) {
                     if ($scope.candidateList.length == 0 || helper.findById($scope.candidateList, 'id', item.id) < 0) {
                        if (item.id && item.id !== "") {
                           arr.push({
                              name: item.value,
                              id: item.id,
                              photoUrl: item.pic
                           });
                        }
                     }
                     return arr;
                  }, []).sort(function (a, b) {
                     return a.name > b.name ? 1 : -1;
                  });
               }
               if (result == null || result.length == 0) {
                  result = [{
                     name: 'No matches found',
                     isNoMatch: true
                  }];
               }
               deferred.resolve(result);
            });
            return deferred.promise;
         };

         $scope.addToCandidateList = function () {
            if ($scope.selectedStudent && $scope.selectedStudent.id) {
               $scope.candidateList.push(angular.extend({}, $scope.selectedStudent));
               $scope.selectedStudent = null;
            }
         };

         $scope.removeFromCandidateList = function (student, $index) {
            if ($scope.candidateList.length != 0) {
               $scope.candidateList.splice($index, 1);
            }
         };

         $scope.blockUser = function (student, $index) {
            apiService.account.settings.blockUser(student.id).then(function (response) {
               $scope.candidateList.splice($index, 1);
               $scope.$emit('reloadAccountSettings');
            });
         };

         $scope.unblockUser = function (student, $index) {
            apiService.account.settings.unblockUser(student.auto_id).then(function () {
               $scope.$emit('reloadAccountSettings');
            });
         }

      });
})();
