(function() {
	'use strict';

	angular.module('zendesk', [])
		.directive('zendeskChat', function() {
			return {
				restrict: 'E',
				scope: {},
				templateUrl: '/app/components/zendesk/zendeskDirective.html',
				link: function(scope, element, attrs) {

					//General function for run time load zendesk widget.
					//For optimization purpose load zendesk widget runtime as required instead of loading on all pages as before.
					function loadZendeskWidget() {
						//when start to load zendesk widget, just hide custom help button and start loader.
						document.getElementById("custom-zendesk-help-button").style.display = "none";
						document.getElementById("custom-zendesk-help-loader").style.display = "";

						//load zendesk widget start.
						window.zEmbed || function(e, t) {
							var n, o, d, i, s, a = [],
								r = document.createElement("iframe");
							window.zEmbed = function() {
								a.push(arguments);
							}, window.zE = window.zE || window.zEmbed, r.src = "javascript:false", r.title = "", r.role = "presentation", (r.frameElement || r).style.cssText = "display: none", d = document.getElementsByTagName("script"), d = d[d.length - 1], d.parentNode.insertBefore(r, d), i = r.contentWindow, s = i.document;
							try {
								o = s;
							} catch (c) {
								n = document.domain, r.src = 'javascript:var d=document.open();d.domain="' + n + '";void(0);', o = s;
							}
							o.open()._l = function() {
								var o = this.createElement("script");
								n && (this.domain = n), o.id = "js-iframe-async", o.src = e, this.t = +new Date, this.zendeskHost = t, this.zEQueue = a, this.body.appendChild(o)
							}, o.write('<body onload="document._l();">'), o.close()
						}("//assets_new.zendesk.com/embeddable_framework/main.js", "ucroo.zendesk.com");
						//load zendesk widget end.

						//get zendesk widget in active / open mode start.
						//used setInterval due to it should work on all the browser that's why.
						var intervalID;
						intervalID = setInterval(
							function() {
								if (typeof zE != "undefined") {
									if (typeof zE.activate == 'function') {
										zE.activate();
									}
									if (document.getElementById("launcher")) {
										document.getElementById("custom-zendesk-help-section").style.display = "none";
										document.getElementById("custom-zendesk-help-loader").style.display = "none";
										clearInterval(intervalID);
									}
								}
							}, 90);
						//get zendesk widget in active / open mode end.

					}
				}

			};
		});

})();
