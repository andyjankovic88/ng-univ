(function () {
   'use strict';


   var
      POST_TYPE_NAME = 'post',
      FILE_TYPE_NAME = 'file',
      POLL_TYPE_NAME = 'poll';



   angular.module('newFeed', [])
      .directive('newFeed', function (apiService, $timeout, $http, userService, userGroups, ngDialog, helper, alerts) {
         return {
            restrict: 'E',
            scope: {
                postAdded: '&',
                type: '@',
                typeId: '@',
               feedData: '='
            },
            templateUrl: '/app/components/newFeed/newFeed.html',
            link: function ($scope, elem) {
               var
               	$feedTextArea = elem.find("#txt_feed_content");


               $scope.buttonPostActive=false;

               if ($scope.feedData) {
                  $scope.isEditMode = true;

               } else {
                  $scope.isEditMode = false;
               }
               $scope.post = newPost();
               $scope.pollOptionsControl = {};

               $scope.showPinDate = userService.getInfo().group_id != userGroups.student;

               $scope.setType = function (type) {
                  if ($scope.post.type === type) {
                     $scope.post.type = POST_TYPE_NAME;
                     $scope.post.pollOptions.splice(0, $scope.post.pollOptions.length);
                  } else {
                  	if ($scope.post.type === POST_TYPE_NAME) {
	                     $scope.post.type = type;
	                     }
                  }
               };

               $scope.addPost = function () {
                  if ($scope.newPostForm.$invalid) {  // Form validation check : Polls form only
                     angular.forEach($scope.newPostForm.$error.required, function(field) {
                        field['addTag'] && field['addTag'].$setDirty();
                     });
                     alerts.warning('Please add your poll names.').closePromise.then(function (data) {
                        $('.new-post-area textarea.ng-invalid').eq(0).focus();
                     });
                     return false;
                  }
                  if ($scope.post.type === 'poll') { // Check the count of poll answers
                     if (!$scope.post.pollOptions || $scope.post.pollOptions.length < 2) {
                        alerts.warning('You should add more than 2 answers.');
                        return false;
                     }
                  }
                  var feed;
                  var text = $scope.post.text;
                  if (text.trim() === "") {
                     alerts.warning("The Post text cannot be blank.")
                        .closePromise.then(function () {
                           $feedTextArea.focus();
                        });
                     return;
                  }

                  $scope.loaderActive = true;
                  $scope.buttonPostActive=true;

                  switch (getFeedType()) {
                     case POST_TYPE_NAME:
                        feed = createPostFeed();
                        break;
                     case POLL_TYPE_NAME:
                        feed = createPollFeed();
                        break;
                     case FILE_TYPE_NAME:
                        feed = createFileFeed();
                        break;
                  }
                  if (!$scope.isEditMode ) {
                     apiService.feeds.post($scope.type, $scope.typeId, feed).then(
                     function () {
                        $scope.newPostForm.$setPristine();
                           $scope.post = newPost();
                           $scope.postAdded();
                        $scope.loaderActive = false;
                        $scope.buttonPostActive=false;
                        },
                        function (response) {
                           var message;
                           if (response && response.data && response.data.message) {
                              message = response.data.message;
                           } else {
                              message = JSON.stringify(response);
                           }
                           alerts.warning(message);
                        }
                     );
                  } else {
                     apiService.feeds.edit($scope.feedData, feed).then(
                        function () {
                           $scope.postAdded()($scope.feedData, feed);
                        },
                        function (response) {
                           var message;
                           if (response && response.data && response.data.message) {
                              message = response.data.message;
                           } else {
                              message = JSON.stringify(response);
                           }
                           ngDialog.open({
                              template: '<h2>' + message + '</h2>',
                              plain: true
                           });
                           $scope.postAdded()('Error occured while processing the post: ' + message, $scope.feedData, feed);
                        }
                     );
                  }
               };
               $scope.setPinnDate = function (date) {
                  $scope.post.pinnDate = date;  // date is moment object
               };
               $scope.resetPinnDate = function () {
                  $scope.post.pinnDate = false;
               };
               $scope.setScheduleDate = function (date, hasTime) {
                  // $scope.post.scheduleDate = date; // date is moment object
                  if ($scope.post.scheduleDate) {
                     $scope.post.scheduleDate.date = date;
                     $scope.post.scheduleDate.hasTime = hasTime;
                  } else {
                     $scope.post.scheduleDate = {
                        date: date,
                        hasTime: hasTime
                     };
                  }
               };
               $scope.resetScheduleDate = function () {
                  $scope.post.scheduleDate = null;
               };
               $scope.resetPinnDate();
               $scope.uploadImages = function (files) {
                  if (files && files.length) {
                     apiService.feeds.file($scope.type, files).then(
                        function onFileUploaded(response) {
                           if (angular.isArray(response.file_id) && response.file_id.length > 0) {
                              filterFiles(response.file_id);
                           }

                        },
                        function onFileUploadedError() {

                        }
                     );
                  }
               };
               $scope.uploadFiles = function (files) {
                  if (files && files.length) {
                     apiService.feeds.file($scope.type, files).then(
                        function onFileUploaded(response) {
                           if (angular.isArray(response.file_id) && response.file_id.length > 0) {
                              filterFiles(response.file_id);
                           }
                        },
                        function onFileUploadedError() {

                        }
                     );
                  }
               };
               $scope.saveTarget = function ($selected) {
                  if ($selected.faculties.length || $selected.campuses.length || $selected.international) {
                     $scope.post.target = $selected;
                  } else {
                     $scope.post.target = false;
                  }
               };


               function createPostFeed() {
                  var
                     postData = $scope.post;


                  var post = {
                     "feed_item": {
                        "text": postData.text,
                        "type": POST_TYPE_NAME,
                        "is_anonymous": postData.isAnonymous
                     }
                  };
                  if (postData.target) {
                     if (postData.target.faculties) {
                        post.post_faculty = String(postData.target.faculties.map(function (obj) {return obj.id;}));
                     }
                     if (postData.target.campuses) {
                        post.post_campus = String(postData.target.campuses.map(function (obj) {return obj.id;}));
                     }
                     if (postData.target.international) {
                        post.post_is_international = 1;
                     }
                  }
                  if (postData.pinnDate) {
                     postData.pinning_date = postData.pinnDate.format('DD/MM/YYYY');
                  }
                  if (postData.scheduleDate) {
                     post.schedule_date = postData.scheduleDate.date.format('YYYY-MM-DD'); // "2014-09-08T08:02:17-05:00" (ISO 8601)
                     if (postData.scheduleDate.hasTime) {
                        post.schedule_time = postData.scheduleDate.date.format('HH:mm');
                     }
                  }

                  return post;
               }

               function createPollFeed() {
                  var post = createPostFeed();
                  post.feed_item.type = POLL_TYPE_NAME;
                  post.feed_item.poll_answers = [];
                  angular.forEach($scope.post.pollOptions, function (item) {
                     if (item['text']){
                        post.feed_item.poll_answers.push(item['text']);
                     }
                  });
                  return post;
               }

               function createFileFeed() {
                  var post = createPostFeed();
                  post.feed_item.file_id=[];
                  post.feed_item.type = FILE_TYPE_NAME;
                  angular.forEach($scope.post.images, function (item) {
                    if (item['file_id']){
                       post.feed_item.file_id.push(item['file_id']);
                    }
                  });
                     angular.forEach($scope.post.files, function (item) {
                        if (item['file_id']) {
                           post.feed_item.file_id.push(item['file_id']);
                        }
                  });
                  return post;
               }



               function getFeedType() {
                  var postData = $scope.post;

                  if (postData.files.length || postData.images.length) {
                     return FILE_TYPE_NAME;
                  }
                  if (postData.pollOptions.length > 0) {
                     return POLL_TYPE_NAME;
                  }

                  return POST_TYPE_NAME;
               }

               function newPost() {
                  if ($scope.isEditMode) {
                     return {
                        type: $scope.feedData.type,
                        text: $scope.feedData.text,
                        isAnonymous: $scope.feedData.is_anonymous ? true : false,
                        files: [],
                        images: [],
                        pollOptions: $scope.feedData.type == POLL_TYPE_NAME ? $scope.feedData.poll_options.slice() : []
                     };
                  } else {
                     return {
                        type: POST_TYPE_NAME,
                        text: '',
                     isAnonymous: 0,
                        files: [],
                        images: [],
                        pollOptions: []

                     };
                  }
               }

               function filterFiles(uploadedFiles) {
                  angular.forEach(uploadedFiles, function (file) {
                     if (file.file_type.indexOf('image/') === 0) {
                        $scope.post.images.push(file);
                     } else {
                        $scope.post.files.push(file);
                     }
                  });
               }

            }
         };
      });
})
();
