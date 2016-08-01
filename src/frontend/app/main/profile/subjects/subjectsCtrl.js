(function() {
    'use strict';

    angular
        .module('profile')
        .controller('profileSubjectsCtrl', function($scope, apiService, profileStateService, helper, userService) {
            $scope.showPastSubjects = profileStateService.subjects.showPastSubjects;

            $scope.pastSubjects = profileStateService.subjects.pastSubjects;

            function saveState() {
                profileStateService.subjects.showPastSubjects = $scope.showPastSubjects;
                profileStateService.subjects.pastSubjects = $scope.pastSubjects;

            }

            $scope.isAlreadyEndorsed = function(endorsements) {
                return ~helper.findById(endorsements, 'id', $scope.currentUserId); // return -1 if element isn't found and operator "~" convert -1 to zero so it will be typecasted to false
            };

            var currentUserSubjectsID = userService.getMenu().unit.map(function(subject){
               return subject.id;
            })
            $scope.currentUserEnrolled = function (id) {
               return !!~currentUserSubjectsID.indexOf(String(id));
            }


            $scope.$watch('showPastSubjects', function(val) {
                if (val && ($scope.pastSubjects.length < 1)) {
                    apiService.profile.pastSubjects($scope.userId).then(
                        function(response) {
                            $scope.pastSubjects = response;
                            saveState();

                        },
                        function() {

                        }
                    );

                }

            });
        });

})();
