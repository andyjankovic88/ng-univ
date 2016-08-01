(function () {
   'use strict';

   angular
      .module('uCalendar', [])
      .controller('uCalendarCtrl', function ($scope, apiService, uiCalendarConfig, userService) {
         $scope.onWindowResized = function (view) {
            $scope.$broadcast('calendarRendered', view);
         };
         $scope.viewRender = function (view) {
            $scope.$broadcast('calendarRendered', view);
         };
         $scope.calendarConfig = {
            height: 665,
            editable: false,
            header: {
               left: 'prev',
               center: 'title',
               right: 'next'
            },
            axisFormat: 'h:mm',
            defaultView: 'agendaWeek',
            minTime: "08:00:00",
            maxTime: "20:00:00",
            allDaySlot: false,
            columnFormat: {
               week: 'ddd'
            },
            slotDuration: "01:00:00",
            dayNamesShort: ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
            windowResize: $scope.onWindowResized,
            viewRender: $scope.viewRender,
            eventRender: function (event, element) {
               element.append('<span class="remove"><svg class="ico-cross"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-cross"></use></svg></span>');
               element.find(".remove").click(function () {
                  apiService.calendar.removeEvent(event.id).then(
                     function (response) {
                        console.log(event.title + " was removed");
                        uiCalendarConfig.calendars.uCalendar.fullCalendar('removeEvents', event._id);
                        var index = $scope.events.indexOf(event);
                        $scope.events.splice(index,1);
                        // uiCalendarConfig.calendars.uCalendar.fullCalendar('refetchEvents');
                     },
                     function (message) {
                        console.error(message);
                     }
                  );
               });
            }
         };

         $scope.now = moment().format('dddd, MMMM D YYYY');
         $scope.eventSources = [{
            url: 'https://background.ucroo.com.au/json/get_all_events_for_user/' + userService.getInfo().id,
            success: function (response) {
               $scope.events = response;
            },
            color: 'rgba(29, 135, 229, 0.75)',
            textColor: 'white'
         }];

         $scope.$on('addedEvent', function (event, data) {
           uiCalendarConfig.calendars.uCalendar.fullCalendar('refetchEvents');
         });

      });

})();
