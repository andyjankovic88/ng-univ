/**
 * Created by Andri on 04/12/2015.
 */
(function() {
   'use strict';

   angular
      .module('mentorGroups')
      .config(function($stateProvider) {
         $stateProvider
            .state('mentorgroup', {
               url: '/mentorgroup/:id',
               views: {
                  '': {
                     templateUrl: '/app/main/mentorGroups/group/group.html',
                     controller: 'mentorGroupCtrl',
                  },
                  'right_side': {
                     templateUrl: '/app/main/mentorGroups/group/rightSidePanel/mentorGroupRightSide.html',
                     controller: 'mentorGroupRightSideCtrl'
                  },
               },
               parent: 'main',
               params: {
                  id: ''
               }
            });
      });


})();
