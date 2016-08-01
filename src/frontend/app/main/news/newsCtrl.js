(function () {
   'use strict';

   angular
      .module('news', [])
      .controller('newsCtrl', function ($scope, apiService, userService, $sce) {
         var page = 0;

         $scope.listRequestInProgress = false;
         $scope.feedTypeId = userService.getMenu().student_news.id;
         $scope.posts = [];


         $scope.loadNextPage = function(reset) {
            $scope.listRequestInProgress = true;

            if(reset) {
               page = 0;
            }
            $scope.loaderActive = true;
            apiService.feeds.get('university_rss', $scope.feedTypeId, page).then(
               function (response) {
                  $scope.loaderActive = false;
                  if(angular.isArray(response.posts)) {
                     if(response.posts.length > 0) {
                        $scope.posts = reset ? response.posts : $scope.posts.concat(response.posts);
                        page++;
                        $scope.listRequestInProgress = false;
                     }
                  }  // if posts.length < 1 - we reach end of list so we leave listRequestInProgress = false to prevent nextPage requests
               }
            );
         };

         $scope.like = function(post) {
            apiService.feeds.like('university_rss', userService.getMenu().student_news.id, post.id).then(
               function(response) {
                  if(response.likes_count) {
                     post.has_liked = true;
                     post.likes_count++;
                  } else {
                     post.has_liked = false;
                     post.likes_count--;
                  }
               }
            );
         };

      })
      .directive('scrollToTop', function () {
         return {
            restrict: 'A',
            link: function($scope) {
               $('.middle-section')[0].scrollTop = 0;
               Ps.update($('.middle-section')[0]);
            }
         }
      })
      .filter('trim', function () {
         return function (inputHTML, limit) {
            var
               $html,
               out = '';

            limit = limit || 300;

            if (!inputHTML || inputHTML.length < 1) return out;

            $html = jQuery('<div>' + inputHTML.trim() + '</div>');
            out = $html.text();
            out = out.substr(0, limit) + '...';

            return out;
         };
      });


})();
