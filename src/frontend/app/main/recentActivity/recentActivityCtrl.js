(function() {

   'use strict';

   angular
      .module('recentActivity', [])
      .controller('recentActivityCtrl', function($scope, apiService, userService, userGroups) {
         var page = 0;

         $scope.listRequestInProgress = false;

         $scope.activities = [];

         $scope.loadNextPage = function() {
            $scope.listRequestInProgress = true;

            apiService.recentActivity.getList(page).then(
               function (response) {
                 if(angular.isArray(response)) {
                    if (response.length > 0) {
                       var eventsTypes = ['mentor_event_created', 'customgroups_event_created', 'service_event_created', 'club_event_created'];
                       angular.forEach(response, function (activity) {
                          if (!!~eventsTypes.indexOf(activity.type) && activity.body && activity.body.object) {
                             for (var key in activity.body.object) {
                                activity.body.object = activity.body.object[key];
                             }
                          }
                       });
                       $scope.activities = $scope.activities.concat(response);
                       page++;
                       $scope.listRequestInProgress = false;
                    }
                 };
               }
            );
         };
      })
      .directive('activityTitle', function($compile) {
         var getTemplate = function(object) {
            var template = "<a class='user-name' ui-sref='profile({id: activity.title.user.id})'>{{activity.title.user.username}}</a> {{activity.title.activity_text}}";
            var stateLink;


            if (!object) {
               return template;
            }

            switch (object.type) {
               case 'university':
                  stateLink = 'universityFeeds';
                  break;
               case 'club':
                  stateLink = 'club({id:' + object.id + '})';
                  break;
               case 'Ucroo_mentor':
               case 'mentors':
                  stateLink = 'mentorGroupsFeed({id:' + object.id + '})';
                  break;
               case 'customgroups':
                  stateLink = 'customGroupsFeed({id:' + object.id + '})';
                  break;
               case 'unit':
                  stateLink = 'subjectFeed({id:' + object.id + '})';
                  break;
               case 'study_group':
                  stateLink = 'studyGroupsFeed({id:' + object.id + '})';
                  break;
               case 'servicepage':
                  stateLink = 'studentServicesEvents({service_id:' + object.id + '})';
                  break;
               case 'groups':
                  stateLink = 'studyGroupsFeed({id:' + object.id + '})';
                  break;
               case 'marketplace':
                  stateLink = 'marketplaceList';
                  break;
               default:
                  stateLink = 'recentActivity'
            }
            return template += " <a ui-sref='" + stateLink + "' class='blue-link'>{{activity.title.object.name}}</a>";
         }
         return {
            restrict: 'E',
            link: function($scope, element, attr) {
               element.html(getTemplate($scope.activity.title.object));
               $compile(element.contents())($scope);
            }
         }
      })
      .directive('post', function(apiService) {
         return {
            restrict: 'E',
            templateUrl: '/app/main/recentActivity/activity-body/post.html'
         }
      })
      .directive('club', function(apiService) {
         return {
            restrict: 'E',
            templateUrl: '/app/main/recentActivity/activity-body/club.html'
         }
      })
      .directive('servicepage', function(apiService) {
         return {
            restrict: 'E',
            templateUrl: '/app/main/recentActivity/activity-body/servicepage.html'
         }
      })
      .directive('group', function(apiService) {
         return {
            restrict: 'E',
            templateUrl: '/app/main/recentActivity/activity-body/group.html'
         }
      })
      .directive('customgroup', function(apiService) {
         return {
            restrict: 'E',
            templateUrl: '/app/main/recentActivity/activity-body/customgroup.html'
         }
      })
      .directive('unit', function(apiService) {
         return {
            restrict: 'E',
            templateUrl: '/app/main/recentActivity/activity-body/unit.html'
         }
      })
      .directive('ucrooEvent', function(apiService, $state) {
         return {
            restrict: 'E',
            templateUrl: '/app/main/recentActivity/activity-body/ucroo_event.html',
            link: function($scope, element, attr) {
               $scope.key = $scope.activity.body.object.id;
               $scope.event = $scope.activity.body.object;
               $scope.joinEvent = function () {
                  if ($scope.activity.title.object.type === 'club_event') {
                     $state.go('clubInfo', {id: $scope.activity.title.object.id});
                     return;
                  }
                  apiService.events.joinEvent($scope.activity.title.object.type, $scope.activity.title.object.id, $scope.activity.body.object.id).then(
                     function () {
                        $scope.event.is_joined = true;
                     }
                  );
               };
               $scope.leaveEvent = function (event, eventID) {
                  apiService.events.leaveEvent($scope.activity.title.object.type, $scope.activity.title.object.id, $scope.activity.body.object.id).then(
                     function () {
                        $scope.event.is_joined = false;
                     }
                  );
               };
            }
         };
      })
      .directive('marketplace', function() {
         return {
            restrict: 'E',
            templateUrl: '/app/main/recentActivity/activity-body/marketplace.html',
            link: function($scope) {
               $scope.item = $scope.activity.body.object;
            }
         };
      });




})();
