/**
 * Created by Andri on 04/12/2015.
 */
(function() {
   'use strict';

   angular
      .module('customgroups')
      .config(function($stateProvider) {
         $stateProvider
            .state('customgroup', {
               url: '/customgroup/:id',
               views: {
                  '': {
                     templateUrl: '/app/main/customGroups/group/group.html',
                     controller: 'customGroupCtrl',
                  },
                  'right_side': {
                     templateUrl: '/app/main/customGroups/group/customGroupRightSide/customGroupRightSide.html',
                     controller: 'customGroupRightSideCtrl'
                  },
               },
               parent: 'main',
               params: {
                  id: ''
               }
            });
      });


})();
