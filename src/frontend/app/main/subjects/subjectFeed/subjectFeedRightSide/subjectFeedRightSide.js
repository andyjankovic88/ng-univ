(function () {
   'use strict';

   angular
      .module('subjects')
      .controller('subjectFeedRightSideCtrl', function ($scope, $stateParams, apiService) {
         apiService.getSpecificRHS('subject', $stateParams.id).then(
            function (response) {
               $scope.academics = userDecorator(response.subject_academics.subject_academics);
               $scope.connections = userDecorator(response.subject_connections.subject_connections);
               $scope.students = userDecorator(response.subject_students.subject_students);
               $scope.assessments = response.subject_assessments;
               $scope.topics = response.subject_topics;
            }
         );

         function userDecorator(array) {
            return array.map(function (user) {
               return {
                  user_id: user.user_id,
                  image_url: user.photo_url,
                  name: user.name,
                  summary_options: user.summary_options,
                  user_relationship_summary_text: user.user_relationship_summary_text ? user.user_relationship_summary_text.substr(4) : ''
               };
            })
         }
      });

})();
