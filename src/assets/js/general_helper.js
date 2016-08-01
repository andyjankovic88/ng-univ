/* 
 * function that returns target element of event
 */
function get_target_of_event(event) {
    var t;
    if (!event) var event = window.event;
    if (event.target) t = event.target;
    else if (event.srcElement) t = event.srcElement;
    if (t.nodeType == 3) t = t.parentNode;
    return t;
}


// $(function() {
		// $('.share').livequery('click',function(){
		// 		$(this).children('.sharrre').sharrre({
		// 				share: {
		// 						facebook: true,
		// 						twitter: true,
		// 						googlePlus: true,
		// 						digg: true,
		// 						delicious: true
		// 				},
		// 				buttons: {
		// 						facebook: {
		// 								layout: 'box_count'
		// 						},
		// 						twitter: {
		// 								count: 'vertical'
		// 						},
		// 						googlePlus: {
		// 								size: 'tall'
		// 						},						
		// 						digg: {
		// 								type: 'DiggMedium'
		// 						},
		// 						delicious: {
		// 								size: 'tall'
		// 						}
		// 				},
		// 				hover: function(api, options){
		// 						$(api.element).find('.buttons').show();
		// 				},
		// 				hide: function(api, options){
		// 						$(api.element).find('.buttons').hide();
		// 				}
		// 		});
		// });
// });

/**
 * function to get an object or json part with a specifi key>value from a list of objects
 */
function getObjects(obj, key, val) {
    var objects = [];
    for (var i in obj) {
	if (!obj.hasOwnProperty(i)) continue;
	if (typeof obj[i] == 'object') {
	    objects = objects.concat(getObjects(obj[i], key, val));
	} else if (i == key && obj[key] == val) {
	    objects.push(obj);
	}
    }
    return objects;
}

/*
 * jQuery Plugin to toggle disabled attribute on element
 * 
 */
(function($) {
    $.fn.toggleDisabled = function(){
        return this.each(function(){
            this.disabled = !this.disabled;
        });
    };
})(jQuery);

/**
 * transform special chars to - and remove whitespaces in given string
 * 
 * @param str
 * @return string
 */
function remove_special_chars(str) {
		//remove whitespace
		str = str.replace(/\s/g, "-");
		//replace special chars with -
		str = str.replace(/['`~!@#$%^&*()_|+=?;:'",.<>\{\}\[\]\\\/]/gi, '-');
		//return clean string
		return str;
}

/*
 * get color for unit/event type
 * 
 * @param event_type
 * @param alpha
 * @return color as hex code
 */
function get_color_for_event(event_type, alpha) {
		//transform some weird subject types
		event_type = event_type.toString().toLowerCase();
		event_type = remove_special_chars(event_type);
		
		alpha = (alpha) ? alpha : 1;
		color = '#777777';
		textColor = '#505051';
		if(event_type.search('lec') != -1 || event_type.search('class') != -1) {
			color = '#f9e595';
			textColor = '#685b34';
		} else if(event_type.search('assessment') != -1 || event_type.search('exam') != -1) {
			border = '#f56767';
			color = '#ffd5d5';
			textColor = '#a12626';
		} else if(event_type.search('tut') != -1) {
			color = '#26abe2';
			textColor = '#344168';
		} else if(event_type.search('lab') != -1) {
			color = '#bd64f5';
			textColor = '#521f5f';
		} else if(event_type.search('studio') != -1 || event_type.search('workshop') != -1 || event_type.search('presen') != -1) {
			color = '#E88900';
			textColor = '#683E00';
		} else if(event_type.search('consultation') != -1) {
			color = '#FFC100';
			textColor = '#F29207';
		}
		backgroundColor = jQuery.Color(color).alpha(alpha).toRgbaString();
		borderColor = (typeof border !== 'undefined') ? jQuery.Color(border).alpha(1).toRgbaString() : jQuery.Color(color).alpha(1).toRgbaString();
		return {
				text: textColor,
				bg: backgroundColor,
				border: borderColor
		};
}

/**
 * function to convert days as string in int
 * @param day_as_string
 * @param day as number
 */
function convert_day_string_in_number(day_as_string) {
		convert_array = {'Mon': '1','Tue': '2','Wed': '3','Thu': '4','Fri': '5','Sat': '6', 'Sun': '7'}
		return convert_array[day_as_string];
}

/**
 * function to check if a checkbox is checked or not
 */
(function($) {
    $.fn.checked = function(value) {
        if(value === true || value === false) {
            // Set the value of the checkbox
            $(this).each(function(){ this.checked = value; });
        } 
        else if(value === undefined || value === 'toggle') {
            // Toggle the checkbox
            $(this).each(function(){ this.checked = !this.checked; });
        }
    };
})( jQuery );


/*
 * Function to create a on-the-fly dialog
 */
function createConfirmDialog(title, content, function_ok, function_abort) {
    $('#confirmDialog').remove();
    var confirmDialog = $('<div id="confirmDialog" title="'+title+'" style="display:none;">'+content+'</div>').appendTo('body');
    
    //$("body").append(confirmDialog);
    $("#confirmDialog").dialog({
         autoOpen: true
        ,height: 'auto'
        ,draggable: false
        ,resizable: false
        ,buttons: {
            "Yes": function_ok,
        'No': {
          text: "No",
          open: function() { $(this).addClass('grey-button-effect') },
          click: function_abort
        }

        },
      close: function() {
        $('button.ui-button').removeAttr('disabled').removeClass('ui-state-disabled');
      }
    });
}

/*
 * Function to create a on-the-fly dialog for separate connection page
 */
function createConfirmDialogIgnore(title, content, function_ok, function_abort) {
    var confirmDialog = $('<div id="confirmDialogIgnore" title="'+title+'" style="display:none;">'+content+'</div>').appendTo('body');
    
    //$("body").append(confirmDialog);
    $("#confirmDialogIgnore").dialog({
         autoOpen: true
        ,height: 'auto'
        ,draggable: false
        ,resizable: false
        ,buttons: {
            "Yes": function_ok
            ,"No": function_abort
        }
    });
}

/*
 * Function to create a Marketplace Soul-out popup
 */
function createSoldDialog(title, content, function_ok, function_abort, function_message) {
    $('#confirmDialog').remove();
    var confirmDialog = $('<div id="confirmDialog" title="'+title+'" style="display:none;">'+content+'</div>').appendTo('body');
    
    //$("body").append(confirmDialog);
    $("#confirmDialog").dialog({
         autoOpen: true
        ,height: 'auto'
        ,draggable: false
        ,resizable: false
        ,buttons: {
            "Yes": function_ok
            ,"No": function_abort,
            "Message buyer" : function_message
        }
    });
}

/*
 * Function to create a on-the-fly dialog
 */
function createOkDialog(title, content,fuction_close) {
    $('#confirmDialog').remove();
    var confirmDialog = $('<div id="confirmDialog" title="'+title+'" style="display:none;">'+content+'</div>').appendTo('body');
    
    //$("body").append(confirmDialog);
    $("#confirmDialog").dialog({
         autoOpen: true
        ,height: 'auto'
        ,draggable: false
        ,resizable: false
        ,buttons: {
            'Ok': {
              text: "Ok",
              click: fuction_close
            }

        }
    });
    
}
    /*
 * Function to create a on-the-fly dialog
 * Add "modal: true" for overlay
 */
function createGotitDialog(title, content,fuction_close) {
    $('#confirmDialog').remove();
    var confirmDialog = $('<div id="confirmDialog" title="'+title+'" style="display:none;">'+content+'</div>').appendTo('body');
    $("#confirmDialog").dialog({
         autoOpen: true
        ,height: 'auto'
        ,draggable: false
        ,resizable: false
        ,modal: true
        ,buttons: {
            'Ok': {
              text: "Got it",
              click: fuction_close
            }
        }
        
    });
  
}

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
            a.push(arguments)
        }, window.zE = window.zE || window.zEmbed, r.src = "javascript:false", r.title = "", r.role = "presentation", (r.frameElement || r).style.cssText = "display: none", d = document.getElementsByTagName("script"), d = d[d.length - 1], d.parentNode.insertBefore(r, d), i = r.contentWindow, s = i.document;
        try {
            o = s
        } catch (c) {
            n = document.domain, r.src = 'javascript:var d=document.open();d.domain="' + n + '";void(0);', o = s
        }
        o.open()._l = function() {
            var o = this.createElement("script");
            n && (this.domain = n), o.id = "js-iframe-async", o.src = e, this.t = +new Date, this.zendeskHost = t, this.zEQueue = a, this.body.appendChild(o)
        }, o.write('<body onload="document._l();">'), o.close()
    }("//assets.zendesk.com/embeddable_framework/main.js", "ucroo.zendesk.com");
    //load zendesk widget end.

    //get zendesk widget in active / open mode start.
    //used setInterval due to it should work on all the browser that's why.
    var intervalID;
    intervalID = setInterval(
        function() {
            if(typeof zE != "undefined") 
                { 
                    if(typeof zE.activate == 'function') {
                        zE.activate();
                    }
                   if(document.getElementById("launcher")) {
                        document.getElementById("custom-zendesk-help-section").style.display = "none";
                        document.getElementById("custom-zendesk-help-loader").style.display = "none";
                        clearInterval(intervalID);
                   }
                } 
        }, 90);   
    //get zendesk widget in active / open mode end.
}