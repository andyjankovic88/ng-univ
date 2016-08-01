(function() {
   'use strict';

   angular
      .module('uCalendar')
      .config(function($stateProvider) {
         $stateProvider
            .state('universityCalendar', {
               url: '/university-calendar',
               views: {
                 '' : {
                   templateUrl: '/app/main/universityCalendar/calendar.html',
                   controller: 'uCalendarCtrl'
                 },
                 'right_side' : {
                    templateUrl: '/app/main/universityCalendar/calendarRightSide/calendarRightSide.html',
                    controller:'uCalendarRightSideCtrl'
                 },
               },
               parent: 'main'
            });
      });

})();
