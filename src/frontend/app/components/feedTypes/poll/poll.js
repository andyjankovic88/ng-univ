(function() {
      "use strict";

      angular.module('feedTypes')
         .directive('feedsPoll', function($sce, apiService, helper) {
            return {
               restrict: 'E',
               scope: {
                  feed: '=',
                  feedType: '@',
                  feedTypeId: '@'
               },
               templateUrl: '/app/components/feedTypes/poll/poll.html',
               link: function($scope) {
                  $scope.text = $sce.trustAsHtml($scope.feed.text);

                  initVotedOption();
                  $scope.$watch('voted', function (newVal, oldVal) {
                     if((newVal !== oldVal) && (newVal > 0)) {
                        apiService.feeds.selectOptionPoll($scope.feedType, $scope.feedTypeId, newVal).then(
                           function(response) {
                              if(response.poll_options) {
                                 $scope.feed.poll_options = response.poll_options;
                                 calculateTotalVotes();
                              }
                           }
                        );
                     }
                  });

                  function initVotedOption() {
                     var selectedOptionInd = helper.findById($scope.feed.poll_options, 'has_voted', true);
                     $scope.voted = 0;
                     if(selectedOptionInd > -1) {
                        $scope.voted = $scope.feed.poll_options[selectedOptionInd].id;
                     }
                     calculateTotalVotes();
                  }

                  function calculateTotalVotes() {
                     $scope.totalVotes = $scope.feed.poll_options.reduce(function (prev, current, idx) {
                        return prev + current.n_votes;
                     }, 0);
                  }

               }
            }
         });
   }
)();
