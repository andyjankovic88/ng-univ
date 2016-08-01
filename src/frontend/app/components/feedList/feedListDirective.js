(function () {
   "use strict";

   angular.module('feedList', [])
      .directive('feedList', function (apiService, userService, helper) {
         return {
            restrict: 'E',
            scope: {
               type: '@',
               typeId: '@'
            },
            templateUrl: '/app/components/feedList/feedList.html',
            link: function ($scope, $elem, $attr) {

               var page = 0;

               $scope.listRequestInProgress = false;
               $scope.list = [];
               $scope.searchString = '';
               $scope.listPin = [];
               $scope.listScheduled = [];
               $scope.feedInEditMode = null;
               $scope.isScheduledVisible = true;

               $scope.loadNextPage = function (reset) {
                  $scope.listRequestInProgress = true;

                  if (reset) {
                     page = 0;
                  }
                  $scope.loaderActive = true;
                  apiService.feeds.get($scope.type, $scope.typeId, page).then(
                     function (response) {
                        $scope.loaderActive = false;
                        if (page === 0 && response.feed_title && response.unit_code) {
                           $scope.name = response.feed_title;
                           $scope.code = response.unit_code;
                        }
                        if (angular.isArray(response.posts)) {
                           if (response.posts.length > 0) {
                              $scope.list = reset ? response.posts : $scope.list.concat(response.posts);
                              page++;
                              $scope.listRequestInProgress = false;
                           }
                        } // if posts.length < 1 - we reach end of list so we leave listRequestInProgress = false to prevent nextPage requests
                        if (angular.isArray(response.scheduled_posts)) {
                           if (response.scheduled_posts.length > 0) {
                              $scope.listScheduled = reset ? response.scheduled_posts : $scope.listScheduled.concat(response.scheduled_posts);
                           }
                        }
                        if (angular.isArray(response.pin_posts)) {
                           if (response.pin_posts.length > 0) {
                              $scope.listPin = reset ? response.pin_posts : $scope.listPin.concat(response.pin_posts);
                           }
                        }
                     }, function () {
                        $scope.loaderActive = false;
                     }
                  );
               };

               $scope.toggleEditMode = function (feed) {
                  if (feed.isEditMode) {
                     feed.isEditMode = false;
                     $scope.feedInEditMode = null;
                  } else {
                     if ($scope.feedInEditMode) {
                        $scope.feedInEditMode.isEditMode = false;
                     }
                     feed.isEditMode = true;
                     $scope.feedInEditMode = feed;
                  }
               };

               $scope.postEdited = function (err, orgFeed, newFeed) {
                  console.log('--PostEditComplete : ', arguments);
                  if (err) {
                     $scope.feedInEditMode.isEditMode = false;
                     $scope.feedInEditMode = null;
                  } else if ($scope.feedInEditMode && $scope.feedInEditMode.id == orgFeed.id) {
                     $scope.feedInEditMode.text = newFeed.feed_item.text;
                     $scope.feedInEditMode.isEditMode = false;
                     $scope.feedInEditMode = null;
                  }
               };
               $scope.$on('doFeedSearch', function (evt, keyword) {
                     // console.log(' - do feed search - ', arguments);
                     $scope.searchString = keyword;
                     // $scope.$digest();
                  });

               $scope.deletePostInView=function(post){
                           var indexInList = helper.findById($scope.list, 'id', post.id);
                           if (indexInList<0) {
                              indexInList = helper.findById($scope.scheduled_posts, 'id', post.id);
                              if (indexInList<0) {
                                 indexInList = helper.findById($scope.listPin, 'id', post.id);
                                 $scope.listPin.splice(indexInList, 1);
                              } else {$scope.scheduled_posts.splice(indexInList, 1);}
                           }else{$scope.list.splice(indexInList, 1);}

               };

                  $scope.getFeedList = function () {
                     return $scope.list.reduce(function (previousValue, currentValue, currentIndex, array) {
                        if (currentValue.text.indexOf($scope.searchString) > -1) {
                           previousValue.push(currentValue);
                        }
                        return previousValue;
                     }, []);
                  };

                  $scope.scheduledVisible = function(){
                     console.log('$scope.isScheduledVisible', $scope.isScheduledVisible);
                    return $scope.isScheduledVisible ? $scope.isScheduledVisible=false : $scope.isScheduledVisible=true;
                  };

               $scope.loadNextPage();
            }
         };
      });
})();
