(function () {
   'use strict';
   angular
      .module('event')
      .controller('newEventCtrl', function ($scope,  $sce, apiService, userService, alerts, $state, $stateParams, $q) {
         $scope.group_type = $stateParams.group_type;
         $scope.group_id = $stateParams.group_id;
         $scope.editID = $stateParams.edit_id;
         $scope.viewData = {};

         $scope.newEvent = {
            title: '',
            description: '',
            start_date: '',
            start_time: '',
            end_date: '',
            end_time: '',
            location: '',
            max_attendees: null,
            timezone: '',
            specificto_campus_check: 1,
            campus_id: null,
            target_year: null,
            picture: null,
            start_date_hrs: '',
            end_date_hrs: '',
            event_type: '',
            ticketed_event: 0
         };

         getDataForEvent();


         $scope.selectedCampuses = [];
         $scope.start_date = '';
         $scope.starts_time = {
            hour: '',
            minute: '',
            period: ''
         };

         $scope.ends_time = {
            hour: '',
            minute: '',
            period: ''
         };

         $scope.hourMin = 0;
         $scope.hourMax = 11;
         $scope.stop_hourMax = 12;

         $scope.uploadLogo = function (file) {
            if (file) {
               $scope.newEvent.picture = file;
            }
         };


         $scope.submit = function () {
            if ($scope.newEvent.specificto_campus_check) {
               $scope.newEvent.campus_id = [];
            }
            $scope.newEvent.campus_id = $scope.selectedCampuses;
            if ($scope.group_type == 'club') {
               getTimeForClub();
            } else {
               $scope.newEvent.start_time = getTime($scope.starts_time);
               $scope.newEvent.end_time = getTime($scope.ends_time);
               $scope.newEvent.start_date_hrs = getTime($scope.starts_time);
               $scope.newEvent.end_date_hrs = getTime($scope.ends_time);
            }

            if ($scope.group_type == 'mentors') {
               $scope.newEvent.start_date = getDataForMentor($scope.newEvent.start_date);
               $scope.newEvent.end_date = getDataForMentor($scope.newEvent.end_date);
            }

            if ($scope.editID) {
               apiService.events.editEvent($scope.group_type, $scope.group_id, $scope.editID, $scope.newEvent).then(
                  function (response) {
                    // $state.go('event', {group_type: $scope.group_type, event_id: $scope.editID});
                     redirectionTo($scope.group_type, $scope.editID, $scope.group_id);
                  },
                  function (error) {
                  alerts.warning($sce.trustAsHtml(error));
               }
               )

            } else {

               apiService.events.createNewEvent($scope.group_type, $scope.group_id, $scope.newEvent).then(
                  function (response) {
                     //$state.go('event', {group_type: $scope.group_type, event_id: response.event_id}); // wait for add id event from response (backend)
                     redirectionTo($scope.group_type, response.event_id, $scope.group_id);
                  },
                  function (error) {
                     console.log(error);
                     alerts.warning($sce.trustAsHtml(error));
                  }
               )

            }

         };

         function getTime(time) {
            var timeString = '',
                minute = '',
                hour = '';
            if (time.hour && time.minute && time.period) {
               if (time.hour < 10) hour = '0' + time.hour;
               if (time.minute < 10) minute = '0' + time.minute;
               timeString = hour + ':' + minute + ' ' + time.period;
            }
            return timeString;
         };

         function getTimeForClub() {
            var minute = '',
               hour = '';
            if ($scope.starts_time.hour < 10) hour = '0' + $scope.starts_time.hour;
            if ($scope.starts_time.minute < 10) minute = '0' + $scope.starts_time.minute;
            $scope.newEvent.start_date_hrs =  hour;
            $scope.newEvent.start_date_mins = minute;

            if ($scope.ends_time.hour < 10) hour = '0' + $scope.ends_time.hour;
            if ($scope.ends_time.minute < 10) minute = '0' + $scope.ends_time.minute;
            $scope.newEvent.end_date_hrs = hour;
            $scope.newEvent.end_date_mins = minute;

            $scope.newEvent.start_date_period = $scope.starts_time.period;
            $scope.newEvent.end_date_period = $scope.ends_time.period;
         };

         function getDataForMentor(time) {
            var newTime = '';
            time.replace('/', '-');
            time.replace('/', '-');
            newTime = time;
            return newTime;
         };

         function getDataForEvent() {
            if ($scope.group_type == 'club') {
               apiService.events.createNewEvent($scope.group_type, $scope.group_id, $scope.viewData).then(
                  function (response) {
                     $scope.viewData = response;
                  }
               );
            } else {
               apiService.events.getData(userService.getUnivInfo().id).then(function (response) {
                  $scope.viewData = response;
               });
            }

            if ($scope.editID) {
               apiService.events.getEvent($scope.group_type, $scope.editID).then(
                  function (response) {
                     $scope.event = response[$scope.editID];
                  }
               );

               $scope.newEvent = {
                  title: $scope.event.title,
                  description: $scope.event.description,
                  start_date: $scope.event.start_date,
                  start_time: $scope.event.start_time,
                  end_date: $scope.event.end_date,
                  end_time: $scope.event.end_time,
                  location: $scope.event.location,
                  max_attendees: $scope.event.max_attendees,
                  timezone: $scope.event.timezone,
                  specificto_campus_check: $scope.event.specificto_campus_check,
                  campus_id: $scope.event.current_campus_id,
                  target_year: null,
                  picture: $scope.event.pic,
                  start_date_hrs: $scope.event.start_date_hrs,
                  end_date_hrs: $scope.event.end_date_hrs,
                  event_type: $scope.event.event_type,
                  ticketed_event: $scope.event.ticketed_event


               }
            }
         };

         function redirectionTo(type, eventId, typeId) {
               if(eventId) {
                  $state.go('event', {group_type: type, event_id: eventId, group_id: $scope.group_id });
               } else {
                  switch (type) {
                     case 'club':
                        $state.go('events', {id: typeId});
                        break;
                     case 'customgroups':
                        $state.go('customGroupEvents',{id: typeId});
                        break;
                     case 'servicepage':
                        $state.go('customGroupEvents');
                        break;
                     case 'university':
                        $state.go('universityEvents',{id: typeId});
                        break;
                     case 'mentors':
                        $state.go('mentorGroupEvents',{id: typeId});
                        break;
                     default:
                        $state.go('recentActivity');
                  }
               }
         };

         $scope.cancel = function () {
            redirectionTo($scope.group_type,$scope.editID, $scope.group_id);
         };

         $scope.requiredAll = function () {
            if ($scope.group_type == 'club') {
               if ($scope.newEvent.event_type && $scope.newEvent.title && $scope.newEvent.description && $scope.newEvent.start_date && $scope.newEvent.end_date && $scope.starts_time.hour && $scope.starts_time.minute && $scope.starts_time.period &&
                  $scope.ends_time.hour && $scope.ends_time.minute && $scope.ends_time.period && $scope.newEvent.timezone &&
                  $scope.newEvent.location && $scope.newEvent.max_attendees > 0) {
                  return false;
               } else {
                  return true;
               }
            } else if ($scope.newEvent.title && $scope.newEvent.description && $scope.newEvent.start_date && $scope.newEvent.end_date && $scope.starts_time.hour && $scope.starts_time.minute && $scope.starts_time.period &&
               $scope.ends_time.hour && $scope.ends_time.minute && $scope.ends_time.period && ($scope.newEvent.specificto_campus_check || $scope.newEvent.campus_id.length > 0 ) && $scope.newEvent.timezone &&
               $scope.newEvent.location && $scope.newEvent.target_year && $scope.newEvent.max_attendees > 0) {
               return false;
            } else {
               return true;
            }
         };

         $scope.isClub = function () {
            if ($scope.group_type == 'club') {
               return true
            } else return false;
         }


      });

})();
