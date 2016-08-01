(function() {
    "use strict";

    angular.module('api')
        .factory('apiTransport', function($http, $q) {
            var
                cache = {},
                deferreds = {};


            var apiTransport = {
                concurrentCachedGet: function(key, url, type, data) {
                    var deferred;


                    if (deferreds[key]) {
                        return deferreds[key].promise;
                    }

                    deferred = $q.defer();

                    deferreds[key] = deferred;

                    if (cache[key]) {
                        deferred.resolve(cache[key]);
                        delete deferreds[key];
                    } else {
                        if (type === 'GET') {
                            this.get(url).then(
                                function(data) {
                                    console.log('getRHS responsed');
                                    cache[key] = data;
                                    deferred.resolve(data);
                                    delete deferreds[key];
                                },
                                function(data) {
                                    deferred.reject(data);
                                    delete deferreds[key];
                                }
                            );
                        }
                        if (type === 'POST') {
                            this.postAsForm(data, url).then(
                                function(data) {
                                    console.log('getRHS responsed');
                                    cache[key] = data;
                                    deferred.resolve(data);
                                    delete deferreds[key];
                                },
                                function(data) {
                                    deferred.reject(data);
                                    delete deferreds[key];
                                }
                            );
                        }
                    }

                    return deferred.promise;
                },
                postAsForm: function(data, url) {
                    var deferred = $q.defer();

                    $http({
                        method: 'POST',
                        url: url,
                        data: $.param(data),
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        }
                    }).then(
                        function(response) {
                            if(response.data.response) {
                                deferred.resolve(response.data.response);
                            }
                            deferred.resolve(response.data);
                        },
                        function(response) {
                            deferred.reject(response);
                        }
                    );

                    return deferred.promise;
                },
               postAsFormPureRes: function(data, url) {
                  return $http({
                     method: 'POST',
                     url: url,
                     data: $.param(data),
                     headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                     }
                  });
               },
                post: function(data, url) {
                    var deferred = $q.defer();

                    $http({
                        method: 'POST',
                        url: url,
                        data: data,
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        }
                    }).then(
                        function(response) {
                            deferred.resolve(response.data.response);
                        },
                        function(response) {
                            deferred.reject(response);
                        }
                    );

                    return deferred.promise;
                },
                get: function(url) {
                    var deferred = $q.defer();
                    $http({
                        method: 'GET',
                        url: url,
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        }
                    }).then(
                        function(response) {
                            deferred.resolve(response.data.response);
                        },
                        function(response) {
                            deferred.reject(response);
                        }
                    );
                    return deferred.promise;
                }
            };
            return apiTransport;
        });
})();
