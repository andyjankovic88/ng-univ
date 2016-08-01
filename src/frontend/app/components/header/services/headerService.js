(function() {
	"use strict";

	angular.module('header')
		.factory('header', function() {
			var headerDirective;


			var Header = {
				register: function(obj) {
					headerDirective = obj;

				},
				activateWidget: function(name, hideContent, data) {
					headerDirective.activateWidget(name, hideContent, data);
				},
				deactivateWidget: function() {
					headerDirective.deactivateWidget();
				}


			};

			return Header;
		});

})();