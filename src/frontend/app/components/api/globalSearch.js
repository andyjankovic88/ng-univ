(function() {
   "use strict";

   angular.module('api')
      .factory('apiGlobalSearch', function(apiTransport, apiServerUrl) {
         return {
            list: function(term, page, perPage) {
               page = page || '';

               return apiTransport.postAsForm({
                  search_term: term
               }, apiServerUrl + '/ucroo_search/global/' + page + '/' + perPage);
            }
         };
      });
})();
