(function() {
    "use strict";

    angular.module('api')
        .factory('apiFeeds', function(apiTransport, apiServerUrl, $q, $http) {
    		var urls = {
    			feeds: {
                    post: '/feeds/add/',
                    get: '/feeds/list/', // /feeds/list/:feed_object/:feed_object_id/:feed_post_id
                    comments: {
                        get: '/feeds/posts/', // /feeds/posts/:post_id/comments[/page/1]
                    },
                    like: '/feeds/posts/', ///feeds/posts/:post_id/like/,
                    selectOptionPoll: '/feeds/poll_answers/',
                    file: '/feeds/attachment/', // /feeds/attachment/<object_type>
                    edit: '/feeds/posts'
                }
    		};

            return {
               like: function (feedType, objectId, postId) { // /feeds/posts/:post_id/like/
                  return apiTransport.postAsForm({
                     object_type: feedType,
                     object_id: objectId
                  }, apiServerUrl + urls.feeds.comments.get + '/' + postId + '/like');
               },
               get: function (feedType, universityId, pageNum) { // POST feeds/list/:feed_object/:feed_object_id/page/:page_number
                  pageNum = pageNum !== undefined ? '?page=' + pageNum : '';
                  return apiTransport.postAsForm({}, apiServerUrl + urls.feeds.get + feedType + '/' + universityId + '/' + pageNum);
               },
               edit: function (orgFeed, newFeed) { // POST feeds/list/:feed_object/:feed_object_id/page/:page_number
                  return apiTransport.postAsForm({
                     object_type: newFeed.feed_item.type,
                     object_id: orgFeed.id,
                     feed_item: newFeed.feed_item
                  }, apiServerUrl + urls.feeds.edit + '/' + orgFeed.id + '/edit');
               },
               delete: function (feedType, objectId, postId) { // /feeds/posts/:post_id/delete/
                  return apiTransport.postAsForm({
                     object_type: feedType,
                     object_id: objectId
                  }, apiServerUrl + urls.feeds.comments.get + '/' + postId + '/delete');
               },
               report: function (feedType, objectId, postId) { // /feeds/posts/:post_id/report/
                  return apiTransport.postAsForm({
                     object_type: feedType,
                     object_id: objectId
                  }, apiServerUrl + urls.feeds.comments.get + '/' + postId + '/report');
               },
               selectOptionPoll: function (feedType, objectId, pollOptionId) {
                  return apiTransport.postAsForm({
                     object_type: feedType,
                     object_id: objectId,
                     id: pollOptionId
                  }, apiServerUrl + urls.feeds.selectOptionPoll);
               },
               file: function (feedType, files) {
                  var
                     deferred = $q.defer(),
                     fd = new FormData();


                  angular.forEach(files, function (val) {
                     fd.append('userfile[]', val, val.name);
                  });

                  $http.post(apiServerUrl + urls.feeds.file + feedType, fd, {
                     headers: {'Content-Type': undefined}
                  }).then(function (response) {
                     deferred.resolve(response.data.response);
                  }, function (response) {
                     deferred.reject(response.data.message);
                  });
                  return deferred.promise;
               },
               post: function (feedType, feedTypeId, feed) {
                  return apiTransport.postAsForm(feed, apiServerUrl + urls.feeds.post + feedType + '/' + feedTypeId);
               }
            };

        });
})();
