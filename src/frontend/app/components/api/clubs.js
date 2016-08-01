(function() {
   "use strict";

   angular.module('api')
      .factory('apiClubs', function(apiTransport, apiServerUrl, $q, $http) {
         return {
            getList: function() {
               return apiTransport.get(apiServerUrl + '/club/listing');
            },
            addNew: function(data) {
               var deferred = $q.defer(),
                  fd = new FormData();

               angular.forEach(data, function(val, key) {
                  fd.append(key, val);
               });

               $http.post(apiServerUrl + '/club/edit/new', fd, {
                  headers: {
                     'Content-Type': undefined
                  }
               }).then(function(response) {
                  deferred.resolve(response.data.response);
               }, function(response) {
                  deferred.reject(response.data.message);
               });
               return deferred.promise;
            },
            getInfo: function(id) {
               return apiTransport.get(apiServerUrl + '/club/view/' + id);
            },
            join: function(id) {
               return apiTransport.postAsForm({}, apiServerUrl + '/club/join/' + id);
            },
            receipt: function(clubId) {
               return apiTransport.get(apiServerUrl + '/club/successful_payment/' + clubId);
            },
            createTicket: function (data, ticketId) {
               return apiTransport.postAsForm(data, apiServerUrl + '/club/event_ticket_edit/' + data.event_id + (ticketId ? '/' + ticketId:''));
            },
            buyFreeTicket: function (data) {
               return apiTransport.postAsForm(data, apiServerUrl + '/club/event_ticket_buy/')
            },
            ticketReceipt: function(token) {
               return apiTransport.get(apiServerUrl + '/club/download_ticket/' + token);
            },

         };

      });
})();
