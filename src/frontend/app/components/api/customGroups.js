(function() {
    "use strict";

    angular.module('api')
        .factory('apiCustomGroups', function(apiTransport, apiServerUrl, $q, $http) {
            return {
                getList: function(page, categories) {
                    console.log('getList Custom Groups...');
                    page = page !== undefined ? '?page=' + page : '';
                    return apiTransport.postAsForm({
                            categories: categories
                        },
                        apiServerUrl + '/customgroups/list' + page
                    );
                },
                getSuggestions: function(page) {
                    console.log('getSuggestions Custom Groups...');
                    page = page !== undefined ? '?page=' + page : '';
                    return apiTransport.post(null, apiServerUrl + '/customgroups/suggested_groups/' + page);
                },
                getInfo: function(id) {
                    console.log('getInfo  Custom Group...');
                    return apiTransport.get(apiServerUrl + '/customgroups/view/' + id);
                    //                  return get(serverUrl + '/custom_group_info');
                },
                getDetails: function(id) {
                    console.log('getDetails  Custom Group...');
                    return apiTransport.get(apiServerUrl + '/customgroups/details/' + id);
                    //                  return get(serverUrl + '/custom_group_info');
                },
                leave: function(groupID) {
                    return apiTransport.postAsForm({
                            id: groupID
                        },
                        apiServerUrl + '/customgroups/leave/'
                    );
                },
                join: function(groupID) {
                    return apiTransport.postAsForm({
                            id: groupID
                        },
                        apiServerUrl + '/customgroups/join/'
                    );
                },
                create: function(data, editID) {
                    var deferred = $q.defer(),
                        fd = new FormData();

                    angular.forEach(data, function(val, key) {
                        if ($.isArray(val)) {
                            angular.forEach(val, function(_val) {
                                fd.append(key + "[]", _val);
                            });
                        } else {
                            fd.append(key, val);
                        }

                    });
                    var action = "create";
                    if (editID) {
                        action = "edit/" + editID;
                    }

                    $http.post(apiServerUrl + '/customgroups/' + action, fd, {
                        headers: {
                            'Content-Type': undefined
                        }
                    }).then(function(response) {
                        deferred.resolve(response.data.response);
                    }, function(response) {
                        deferred.reject(response.data.message);
                    });
                    return deferred.promise;
                }

            };

        });
})();
