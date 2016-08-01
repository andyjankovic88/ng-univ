(function() {
   'use strict';

   angular
      .module('calendar')
      .config(function($stateProvider) {
         $stateProvider
            .state('profile.calendar', {
               url: '/calendar',
               templateUrl: '/app/main/profile/calendar/calendar.html',
               controller: 'calendarCtrl',
               parent: 'profile'
            });
      });

})();
