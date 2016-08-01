(function() {
  'use strict';

  angular
    .module('ucroo')
    .config(config).provider('Env', function environment () {
        var location = window.location.href;
        this.environment = 'development';
        if (location.match(/\/\/www\.sucroo\.com/)) {
           this.environment = 'production';
        } else if (location.match(/\/\/dev\.sucroo\.com/)) {
           this.environment = 'staging';
        }
        this.data = {
           development: {
              fbAppKey: '511786369008018'
           },
           production: {
              fbAppKey: '174268539315296'
           },
           staging: {
              fbAppKey: '1417650438487011'
           }
        };

        this.isDev = function () {
           return this.environment == 'development';
        };
        this.isProduction = function () {
           return this.environment == 'production';
        };
        this.isStaging = function () {
           return this.environment == 'staging';
        };

        this.get = function (value) {
           return this.data[this.environment][value];
        };
        this.$get = function() {
           return this;
        };
     });

  /** @ngInject */
  function config($logProvider, $urlRouterProvider, $httpProvider, $locationProvider, FacebookProvider, EnvProvider) {
    // Enable log
    $logProvider.debugEnabled(true);
    $urlRouterProvider.otherwise("/");
    $httpProvider.defaults.withCredentials = true;
   //  $locationProvider.html5Mode(true);
   $locationProvider.html5Mode({enabled: true, requireBase: false});
    $locationProvider.hashPrefix('!');

    // Set options third-party lib

     // FacebookProvider.init('156090291141450'); // www.ucroo.com.au
     // FacebookProvider.init('174268539315296'); // www.sucroo.com
     // FacebookProvider.init('1417650438487011'); // dev.sucroo.com

     FacebookProvider.init(EnvProvider.get('fbAppKey')); // www.sucroo.com
  }

})();
