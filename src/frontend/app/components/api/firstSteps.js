(function() {
    "use strict";

    angular.module('api')
        .factory('apiFirstSteps', function(apiTransport, apiServerUrl) {
            return {
                searchGroups: function(keywords) {
                    return apiTransport.postAsForm({search_terms: keywords}, apiServerUrl + '/first_steps/groups');
                },
                joinGroup: function(id) {
                    return apiTransport.postAsForm({group_id: id}, apiServerUrl + '/groups/join');
                },
                completeStep: function(stepNum) {
                    return apiTransport.get(apiServerUrl + '/first_steps/complete_step/' + stepNum);
                },
                getStaffList: function() {
                   return apiTransport.get(apiServerUrl + '/first_steps/listing');
                },
                completeStaffStep: function(link) {
                   return apiTransport.get(apiServerUrl + link);
                }

            };

        });
})();
