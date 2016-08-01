(function() {
   'use strict';

   angular
      .module('subjects')
      .config(function($stateProvider) {
         $stateProvider
            .state('subjectFeed', {
               url: '/subject-feed/:id',
               views: {
                  '': {
                     templateUrl: '/app/main/subjects/subjectFeed/subjectFeed.html',
                     controller: 'subjectsFeedCtrl',
                  },
                  'right_side': {
                     templateUrl: '/app/main/subjects/subjectFeed/subjectFeedRightSide/subjectFeedRightSide.html',
                     controller: 'subjectFeedRightSideCtrl'
                  },
               },
               parent: 'main',
               params: {id: ''}
            });
      });

})();
