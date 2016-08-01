(function() {

   'use strict';

   angular
      .module('notifications', [])
      .controller('notificationsCtrl', function($scope, apiService, userService) {
         apiService.notifications.getList().then(function(response) {
            var eventsTypes = ['mentor_event_created', 'customgroups_event_created', 'service_event_created', 'club_event_created'];
            angular.forEach(response, function (activity) {
               if (!!~eventsTypes.indexOf(activity.type) && activity.body && activity.body.object) {
                  for (var key in activity.body.object) {
                     activity.body.object = activity.body.object[key];
                  }
               }
            });
            $scope.notifications = response;

            $scope.acceptRequest = function (index, followed, id) {
               apiService.connections.accept(userService.getInfo().id, followed).then(function (response) {
                   $scope.removeItem(index, id);
               }, function (err) {
                  console.log('-- Error on accepting connections --', err);
               });
            };

            $scope.blockRequest = function ($index, followed, id) {
               apiService.connections.block(userService.getInfo().id, followed).then(function (response) {
                   $scope.removeItem(index, id);
               }, function (err) {
                  console.log('-- Error on block connection request --', err);
               });
            };

            $scope.removeItem = function (index, id) {
                apiService.notifications.remove(id).then(
                   function () {
                      $scope.notifications.splice($index,1);
                   }
                );
            }
         });

      })
      .directive('notificationTitle', function($compile) {
         var getTemplate = function(title, type) {
            var object = title.object;
            var template = "<a class='user-name' style='float:none;' ui-sref='profile({id: activity.title.user.id})'>{{activity.title.user.username}}</a> {{activity.title.notification_text}}";
            var stateLink;

            if (type === 'accepted_connection') {
               return "{{activity.title.notification_text}} <a class='user-name' style='float:none;' ui-sref='profile({id: activity.title.user.id})'>{{activity.title.user.username}}</a>"
            }
            if (type === 'scheduled_post_posted') {
               return "{{activity.title.notification_text}}"
            }


            if (!object) {
               return template;
            }

            if (title.event) {
               template += " <a ui-sref='" + stateLink(title.event.type) + "' class='blue-link'>{{activity.title.event.name}}</a> in"
            }

            return template += " <a ui-sref='" + stateLink(object.type) + "' class='blue-link'>{{activity.title.object.name}}</a>";

            function stateLink(objType) {

               switch (objType) {
                  case 'university':
                     return 'universityFeeds';
                     break;
                  case 'club':
                     return 'club({id:' + object.id + '})';
                     break;
                  case 'Ucroo_mentor':
                  case 'mentors':
                     return 'mentorGroupsFeed({id:' + object.id + '})';
                     break;
                  case 'customgroups':
                     return 'customGroupsFeed({id:' + object.id + '})';
                     break;
                  case 'unit':
                     return 'subjectFeed({id:' + object.id + '})';
                     break;
                  case 'study_group':
                     return 'studyGroupsFeed({id:' + object.id + '})';
                     break;
                  case 'service_event':
                  case 'club_event':
                  case 'ucroo_event':
                     return 'event({id:' + title.event.id + ', type:"' + object.type + '"})';
                     break;
                  case 'marketplace':
                     return 'marketplaceList';
                     break;
                  default:
                     return 'recentActivity'
               }

            }
         }
         return {
            restrict: 'E',
            link: function($scope, element, attr) {
               element.html(getTemplate($scope.activity.title, $scope.activity.type));
               $compile(element.contents())($scope);
            }
         }
      // })
      // .directive('post', function(apiService) {
      //    return {
      //       restrict: 'E',
      //       templateUrl: '/app/main/recentActivity/activity-body/post.html'
      //    }
      });


})();
