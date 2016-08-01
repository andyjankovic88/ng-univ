(function () {

   'use strict';

   angular.module('timer', [])
      .directive('timer', function (userService, timerService, $timeout, alerts, $rootScope) {
         return {
            restrict: 'E',
            scope: {},
            templateUrl: '/app/components/header/timer/timer.html',
            link: function (scope) {
               var
                  hReminderTimeout,
                  reminderMessage = 'Hey! Looks like your timer is on for a long time. Check if you have stopped your Study timer',
                  reminderSubjectMessage = 'Please choose Subject',
                  alertsNewObject;


               scope.isRunning = false;
               scope.counterValue = '';
               scope.activeSubjectId = -1;


               scope.close = function () {
                  scope.$emit('closeHeaderWidget');
               };
               scope.subjects = userService.getMenu().unit;
               scope.counter = function () {
                  scope.isRunning ? stop() : start();
               };
               scope.selectSubject = function (id) {
                  if (!scope.isRunning) {
                     if (alertsNewObject) {
                        alertsNewObject.close();
                     }
                     scope.activeSubjectId = id;
                  }
               };
               scope.onClickOutside = function () {
                  scope.isShowAdditionalList = false;
                  scope.$digest();
               };

               function start() {
                  if(!timerService.isTimerWorking()) {
                     if (scope.activeSubjectId > 0) {
                        timerService.start(scope.activeSubjectId);
                           scope.isRunning = true;
                        startReminderTimeout();

                  } else {
                     if (!alertsNewObject) {
                        alertsNewObject = alerts.info(reminderSubjectMessage);
                     }
                     }
                  }
               }

               function stop() {
                  stopReminderTimeout();
                  if(timerService.isTimerWorking()) {
                     if (scope.activeSubjectId > 0) {
                        scope.isRunning = false;
                        timerService.stop(scope.activeSubjectId);
                     }
                  }

               }

               function startReminderTimeout() {
                  hReminderTimeout = $timeout(onReminderTimeout, 3600000);
               }

               function stopReminderTimeout() {
                  if (hReminderTimeout) {
                     $timeout.cancel(hReminderTimeout);
                     hReminderTimeout = undefined;
                  }
               }

               function onReminderTimeout() {
                  alerts.info(reminderMessage);
                  startReminderTimeout();
               }

               $rootScope.$on('logoutEvent', function (event, data) {
                  stopReminderTimeout();
               });


            }

         };
      })
      .directive('timerBtn', function (timerService) {
         return {
            restrict: 'E',
            template: '<div><svg><use xlink:href="#header-timer" /></svg></div>',
            link: function (scope, iElement, iAttrs) {


            }
         };
      })
      .directive('counter', function (timerService) {
         return {
            restrict: 'E',
            template: '<div class="counter" ng-hide="isHidden"></span><span></span>:<span></span>:<span></span></div>',
            link: function (scope, iElement, iAttr) {
               var
                  spans = iElement.find('span'),
                  hoursEl = spans[0],
                  minEl = spans[1],
                  secEl = spans[2];


               scope.isHidden = (iAttr.onlyIfCounting !== undefined) && (!timerService.isCounting());
               set('00', '00', '00');

               var callbacks = {
                  set: set,
                  onStart: onStart,
                  onStop: onStop
               };


               timerService._registerCounter(callbacks);
               scope.$on('$destroy', function () {
                  timerService._unregisterCounter(callbacks);
               });

               function onStart() {
                  scope.isHidden = false;
                  // scope.$digest();
               }

               function onStop() {
                  if (iAttr.onlyIfCounting !== undefined) {
                     scope.isHidden = true;
                     // scope.$digest();
                  }
               }


               function set(hour, min, sec) {
                  hoursEl.textContent = toZeroLeadStr(hour);
                  minEl.textContent = toZeroLeadStr(min);
                  secEl.textContent = toZeroLeadStr(sec);
               }

               function toZeroLeadStr(num) {
                  return Math.floor(num / 10).toString() + (num % 10).toString();
               }


            }
         };
      })
      .factory('timerService', function (apiService, $interval, ngDialog, $rootScope) {
         var
            SYNC_EACH_SEC = 10,
            isTimerWork=false;

         var
            counters = [],
            hour = 0,
            min = 0,
            sec = 0,
            hInterval,
            secCountAfterSync,
            subjArray = [];

         function onInterval() {
            sec++;
            if (sec > 59) {
               sec = 0;
               min++;
               if (min > 59) {
                  min = 0;
                  hour++;
               }
               if (hour > 99) {
                  hour = 0;
               }
            }
            secCountAfterSync++;
            if (secCountAfterSync > SYNC_EACH_SEC) {
               syncCounter();
            }
            setCounters(hour, min, sec);

         }

         function setCounters(hour, min, sec) {
            angular.forEach(counters, function (counter) {
               counter.set(hour, min, sec);
            });
         }

         function syncCounter() {
            var currentTimestamp = Date.now() / 1000; // in seconds

            hour = Math.floor(currentTimestamp / 3600);
            min = Math.floor((currentTimestamp % 3600) / 60);
            sec = currentTimestamp % 60;
         }

         function allTimersStop(subj_Array) {
            angular.forEach(subj_Array, function (subj) {
               timerService.stop(subj.id);
            })
         }

         $rootScope.$on('logoutEvent', function (event, data) {
            allTimersStop(subjArray);
         });


         var timerService = {

            _registerCounter: function (counterFuncs) {
               counters.push(counterFuncs);
            },
            _unregisterCounter: function (counterFuncs) {
               var index = counters.indexOf(counterFuncs);

               if (index > -1) {
                  counters.splice(index, 1);
               }
            },
            start: function (subjId) {
               subjArray.push(subjId);
               apiService.timer.start(subjId).then(function () {
                  hInterval = $interval(onInterval, 1000, 0, false);
                  isTimerWork=true;
                  angular.forEach(counters, function (counter) {
                     counter.onStart();
                  });

               }, function () {
                  ngDialog.open({
                     template: '<h2>Server connection problem</h2>',
                     plain: true
                  });
               });
            },
            stop: function (subjId) {
                  subjArray.splice(subjArray.indexOf(subjId), 1);
                  apiService.timer.stop(subjId).then(function () {
                     isTimerWork = false
                  });
                  $interval.cancel(hInterval);
                  hInterval = undefined;
                  hour = 0;
                  min = 0;
                  sec = 0;
                  setCounters(hour, min, sec);
                  angular.forEach(counters, function (counter) {
                     counter.onStop();
                  });
            },
            getTime: function () {
               return {
                  hour: hour,
                  min: min,
                  sec: sec
               };
            },
            isCounting: function () {
               return hInterval !== undefined;
            },
            isTimerWorking:function(){
            return isTimerWork;
         }

         };


         return timerService;
      });


})();
