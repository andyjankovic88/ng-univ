(function() {
    "use strict";

    angular.module('api')
        .factory('apiMessages', function(apiTransport, apiServerUrl, $q, $http) {
            return {
               conversations: function (page, conversationId) { // '/conversation/messages'
                  conversationId = conversationId !== undefined ? conversationId + '/' : '';
                  page = page !== undefined ? '?page=' + page : '';

                  return apiTransport.get(apiServerUrl + '/conversation/messages' + '/' + conversationId + page);
               },
               post: function (conversationId, text, fileId) {
                  var message = {
                     text: text
                  };

                  if(fileId) {
                     message.file_id = fileId;
                  }
                  return apiTransport.postAsForm(message, apiServerUrl + '/conversation/message/' + conversationId);
               },
               postNew: function (message) {
                  return apiTransport.postAsForm(message, apiServerUrl + '/conversation/message/');

               },
               file: function (files) {
                  var
                     deferred = $q.defer(),
                     fd = new FormData();

                  angular.forEach(files, function (val) {
                     fd.append('userfile', val, val.name);
                  });

                  $http.post(apiServerUrl + '/conversation/message_attachment', fd, {
                     headers: {'Content-Type': undefined}
                  }).then(function (response) {
                     deferred.resolve(response.data.response);
                  }, function (response) {
                     deferred.reject(response.data.message);
                  });
                  return deferred.promise;
               },
               markAsRead: function(id) {
                  return apiTransport.get(apiServerUrl + '/conversation/read/' + id + '/');
               }
            };
        });
})();
