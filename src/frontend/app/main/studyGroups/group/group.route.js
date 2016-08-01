/**
 * Created by Andri on 04/12/2015.
 */
(function() {
   'use strict';

   angular
      .module('studyGroupsView')
      .config(function($stateProvider) {
         $stateProvider
            .state('studygroupview', {
               url: '/study/:id',
               templateUrl: '/app/main/studyGroups/group/group.html',
               controller: 'studyGroupViewCtrl',
               parent: 'main',
               params: {id: ''}
            });
      });


})();
