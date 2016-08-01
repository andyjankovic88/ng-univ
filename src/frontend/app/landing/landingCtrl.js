(function() {
    'use strict';

    angular
        .module('landing', [])
        .controller('LandingCtrl', function(apiService, $window, $state) {
          $window.goToState = function(stateName) {
             console.log('go from landing to ', stateName);
             $window.setTimeout(function() {
                $state.go(stateName);
             }, 0);

          };

            apiService.getUniversities().then(function(response) {
                console.log('univ response: ', response);
                if (typeof $window.onUnivLoaded === 'function') {
                    console.log('onUnivLoaded called');
                    $window.onUnivLoaded(response);
                } else {
                    $window.universities = response;
                    console.log('onUnivLoaded did not called', $window.universities);

                }

            });
        });


})();
