(function() {
    'use strict';

    angular
        .module('calendar', [])
        .controller('calendarCtrl', function($scope) {
            $scope.title = 'calendar module';

            $scope.onWindowResized = function(view) {
        		$scope.$broadcast('calendarRendered', view);
            };
            $scope.viewRender = function(view) {
            	$scope.$broadcast('calendarRendered', view);
            };

            $scope.calendarConfig = {
                height: 635,
                editable: true,
                header: {
                    left: '',
                    center: '',
                    right: ''
                },
                dayClick: $scope.alertEventOnClick,
                eventDrop: $scope.alertOnDrop,
                eventResize: $scope.alertOnResize,

                // firstDay: 1,
                // header: {
                //     left: '',
                //     center: '',
                //     right: ''
                // },
                // weekends: true,
                // timeFormat: {
                //     agenda: 'h(.mm){-h(.mm)}' // 5 - 6.30
                // },
                axisFormat: 'hh:mm',
                // height: 700,
                // theme: false,
                defaultView: 'agendaWeek',
                // allDaySlot: false,
                minTime: "08:00:00",
                maxTime: "20:00:00",
                allDaySlot: false,
                columnFormat: {
                    week: 'ddd'
                },
                slotDuration: "01:00:00",
                dayNamesShort: ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
                windowResize: $scope.onWindowResized,
                viewRender: $scope.viewRender
            };

            $scope.now = moment().format('dddd, MMMM D YYYY');
            $scope.eventSources = [{
                "id": 53182,
                "title": "BUA5HER",
                "start": "2015-10-27T08:30:00Z",
                "end": "2015-10-27T09:00:00Z",
                "allDay": false,
                "className": "event-lecture"
            }];
        });

})();
