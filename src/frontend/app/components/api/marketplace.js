(function() {
    "use strict";

    angular.module('api')
        .factory('apiMarketplace', function(apiTransport, apiServerUrl, $q, $http) {
            return {                
                list: function(searchTerm, category, campus, order, userId) {  // order: asc or desc
                    var data = {
                        filter_input : searchTerm,
                        filter_campus : campus,
                        filter_category : category,
                        filter_order : order
                    };

                    userId = userId || '';
                    return apiTransport.postAsForm(data, apiServerUrl + '/marketplace/itemlisting/' + userId);
                },
                initialInfo: function() {
                    return apiTransport.get(apiServerUrl + '/marketplace/marketplace'); 
                },
                remove: function(userId, itemId) {
                    return apiTransport.get(apiServerUrl + '/marketplace/removeitem/' + userId + '/' + itemId);
                },
                sold: function(userId, itemId) {
                    return apiTransport.get(apiServerUrl + '/marketplace/markassold/' + userId + '/' + itemId);  
                },
                itemInfo: function(id) {
                    return apiTransport.get(apiServerUrl + '/marketplace/get_item_details/' + id);
                },
                save: function(item, id) {
                    id = id || '';
                    return apiTransport.postAsForm(item, apiServerUrl + '/marketplace/saveitem/' + id);
                },
                uploadImages: function (file) {
                    var
                        deferred = $q.defer(),
                        fd = new window.FormData();

                  
                    fd.append('userfile', file, file.name);
                    fd.append('type', 'marketplace');

                  $http.post(apiServerUrl + '/upload/index', fd, {
                     headers: {'Content-Type': undefined}
                  }).then(function (response) {                    
                     deferred.resolve(response.data.response);
                  }, function (response) {
                     deferred.reject(response.data.message);
                  });
                  return deferred.promise;
               },


            };

        });
})();
