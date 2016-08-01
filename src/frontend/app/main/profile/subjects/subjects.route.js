(function() {
   'use strict';

   angular
      .module('profile')
      .config(function($stateProvider) {
         $stateProvider
            .state('profileSubjects', {
               url: '/subjects',
               templateUrl: '/app/main/profile/subjects/subjects.html',
               controller: 'profileSubjectsCtrl',
               parent: 'profile'
            });
      });

})();
