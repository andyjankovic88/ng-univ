jQuery(function($) {
	//#2191 Make this auto populate
	search_part = $('.search:first').clone(true, true).appendTo('#search').removeClass('hidden');
	search_part.children('.search_class').removeClass('hidden').attr('placeholder', 'Enter the name or code of your subject');

	search_setup_part = $('#search_setup').removeClass('hidden');

	var units_multiselect = $('#unit_info_id').multiselect({
		header: false,
		height: 'auto',
		maxWidthButton: 230,
		noneSelectedText: 'Select Class Times',
		selectedText: "# of # Class Times selected",
		click: function(event, ui) {
			if(ui.value == 'cant_find') {
				$("#unit_info_id").multiselect("uncheckAll");
				units_multiselect.multiselect('close');
			}
		}
	});

	$('.list_type_toggler').change(function() {
		if(this.checked) {
			if(this.value == 'calendar') {
				$('#event-listing').hide();
				$('.part-content.profile-timetable').show();
			} else {
				$('.part-content.profile-timetable').hide();
				$('#event-listing').show();
			}
		}
	});

	$("#radioset").buttonset();

	$("#dialog").dialog({
		autoResize: true,
		autoOpen: false,
		height: 'auto',
		resizable: false,
		minWidth: 00,
		modal: true,
		show: "fade"
	});

	$("#benefits").click(function() {
		$("#dialog").dialog( "open" );
		return false;
	});

	$("#radioset").live('click', function(e){
		checked = $(this).find(":checked").val();

		if(checked == 'assessment') {
			$(".assesssment_form").show();
			$(".class_form").hide();
			$(".assessment-label").show();
			$(".normal-label").hide();
		} else {
			$(".assessment-label").hide();
			$(".normal-label").show();
			$(".assesssment_form").hide();
			$(".class_form").show();
		}
	});

	$("#activity_date, #activity_date_from, #activity_date_to").datepicker({
		minDate: 0,
		dateFormat:'dd-mm-yy'
	}).not('#activity_date_to').datepicker("setDate", new Date());

	$("#datepicker").datepicker({
		minDate: 0,
		dateFormat:'dd-mm-yy',
		altField: "#date",
		altFormat: "yy-mm-dd"
	}).datepicker("setDate", new Date());

	$("#datepicker-repeat-end-date").datepicker({
		minDate: 0,
		dateFormat:'dd-mm-yy',
		altField: '#date-repeat-end-date',
		altFormat: "yy-mm-dd"
	});

	var	tips = $(".validateTips");

	$("select[name=time_from]").change(function(){
		sel_val = ($("select[name=time_from]' option:selected").val());
		sel_val = Date.parse(sel_val).addHours(1).toString("HH:mm:ss");
		$("select[name=time_to]").val(sel_val);
	});

	$("select[name=manual_time_from]").change(function(){
		sel_val = ($("select[name=manual_time_from]' option:selected").val());
		sel_val = Date.parse(sel_val).addHours(1).toString("HH:mm:ss");
		$("select[name=manual_time_to]").val(sel_val);
	});

	$("select[name=activity_time_from]").change(function(){
		sel_val = ($("select[name=activity_time_from]' option:selected").val());
		sel_val = Date.parse(sel_val).addHours(1).toString("HH:mm:ss");
		$("select[name=activity_time_to]").val(sel_val);
	});

	// ICS import - start
	var options = {
		dataType: "json",
		beforeSubmit: function(){
			tips.show();
			$('#progressbar').show();
			$('#progressbar').text('Uploading...');
		},
		success: function(data){
			$(tips).hide();
			$('#progressbar').text(data.msg);
			$('#progressbar').height('auto');
			if(data.success == 'true'){
				location.href = '/timetable/edit';
			}else{
				$('#progressbar').text(data.msg).addClass( "ui-state-highlight" );
			}
			$('#ics-filename').remove();
		},
		uploadProgress: function(event, position, total, percentComplete){

			$('#progressbar').show();
			$('#progressbar').text('Uploading...');
		},
		resetForm: true // reset the form after successful submit
	};

	$('#form-ics').submit(function() {
		$(this).ajaxSubmit(options);
		return false;
	});

	$("#file_ics").change(function(event) {
		$('#ics-filename').remove();
		$('#progressbar').hide();
		tips.hide();
		$('#progressbar').removeClass( "ui-state-highlight");
		var filename = $(this).val();
		filename = filename.split(/(\\|\/)/g).pop();
		$(this).closest('.fileinput-button').after('<div id="ics-filename">'+filename+'</div>');
	});

	$("#dialog-form-ics-upload").dialog({
		autoResize: true,
		autoOpen: false,
		height: 'auto',
		width: '400px',
		draggable: false,
		resizable: false,
		modal: true,
		buttons: {
			"Upload": function() {
				var ics_file = $("#file_ics");
				bValid = true;
				tips.text('');
				tips.removeClass( "ui-state-highlight");
				if(ics_file.val()==''){
					tips.show();
					$('#progressbar').hide();
					bValid = false;
					tips.text('Please select a file').addClass( "ui-state-highlight" );
				}
				if(bValid){
					$('#form-ics').submit();
				}
			},
			'Cancel': {
					text: "Cancel",
					open: function() { $(this).addClass('grey-button-effect') },
					click: function() {
						$( "#dialog-form-ics-upload" ).dialog("close");
						reset_ics();
					}
			}
		},
		close: function() {
			reset_ics();
		}
	});

	function reset_ics(){
		clear_form_elements($("#form-ics"));
		$(tips).hide();
		$(tips).text('');
		$('#progressbar').hide();
		$('#progressbar').text('');
		$('#ics-filename').remove();
		$('#file_ics').val('');
	}
	// ICS import - end

	$('#upload_ics_id').on('click', function(e) {
		e.preventDefault();
		$('#dialog-form-ics-upload').removeClass('hidden').dialog('open');
	});

	$('#event-listing, #lazy_events').on('click', '.timetable_delete', function() {
		delete_timetable_event($(this).data('event-id'));
		$('#timetable1').fullCalendar('removeEvents',$(this).data('event-id'));
	});


	$('#unit_id').change(function() {
		var elm = this;

		if(elm.value) {
			$.ajax({
				url: '/json/get_unit_info_data_json/' + elm.value,
				success: function(data) {
					var class_time =  $('#unit_info_id');
					class_time.children().remove();

					if(data.success) {
						$.each(data.data, function() {
							var time_str = this.time;
							var time_split = time_str.split(":");
							var formated_time =  time_split[0] + ':' + time_split[1];
							var option = $('<option />')
									.text(this.subject_type + ': ' + this.day + ' ' + formated_time)
									.val(this.id);

							if(this.selected) {
								option.attr('selected', 'selected');
							}

							if(this.event_id) {
								option.attr('data-eventid', this.event_id);
							}

							class_time.append(option);
						});
					}

					class_time.append(
						$('<option />').text('Class time not appearing? Click here to add it').val('cant_find')
					);

					units_multiselect.multiselect('refresh');
				}
			});
		}
	});

	$("#dialog-form").dialog({
		autoResize: true,
		autoOpen: false,
		height: 'auto',
		width: 'auto',
		draggable: false,
		resizable: false,
		modal: true,
		buttons: {
			"Save": function() {
				var type = $("#radioset").find(":checked").val();
				var unit = $("select[name=enrolled_units] option:selected");
				var time_from = $("select[name=time_from] option:selected");
				var time_to = $("select[name=time_to] option:selected");
				var time_day = $("select[name=time_day] option:selected");
				var date_due = $("#date");
				var time_assessment = $("select[name=time_assessment] option:selected");
				var alert = $("select[name=alert] option:selected");
				var title	= $("#assesssment_title");
				var by_academic	= false;
				var no_time_to	= false;
				var repeat_event_value = $('#repeat-event-value');
				var repeat_end_date = $('#date-repeat-end-date');

				var bValid = true;

				bValid = bValid && checkType(type, 'type of event');
				bValid = bValid && checkInput(unit, 'unit');
				bValid = bValid && checkInput(time_from, 'from time');
				if($("#no_time_to").is(':checked')) {
					bValid = bValid
				} else {
					bValid = bValid && checkInput(time_to, 'to time');
					bValid = bValid && checkFromTo(time_from, time_to);
				}

				if( type != 'assessment') {
					bValid = bValid && checkInput( time_day, 'day' );
					title	= $("select[name=enrolled_units] option:selected").attr('name');
				} else {
					bValid = bValid && checkInput( title, 'title' );
					bValid = bValid && checkInput( date_due, 'date' );
					bValid = bValid && checkInput( alert, 'alert' );
					title	= $("#assesssment_title").val();
					if($("#by_academic").length != 0) by_academic = $("#by_academic").is(':checked');
					bValid = bValid && checkRepeatDate(repeat_event_value, repeat_end_date);
					no_time_to = $("#no_time_to").is(':checked');
				}
				if (bValid) { //do ajax post
					save_timetable_event(
						event_data = {
							unit_id: unit.val(),
							unit_info_id: '',
							location: '',
							type: type,
							time_from: time_from.val(),
							time_to: time_to.val(),
							time_day: time_day.val(),
							title: title,
							date_due: date_due.val(),
							time_assessment: time_assessment.val(),
							alert: alert.val(),
							by_academic: by_academic,
							no_time_to: no_time_to,
							repeat_val: repeat_event_value.val(),
							repeat_edate: repeat_end_date.val()
						}, function(response) {
							if(response != '') {
								if(response.multiple) {
									window.location.href = window.location.origin + '/timetable/edit'
								} else {
									$("#dialog-form").dialog( "close" );
									$("#unit-manunally-" + response.unit_id).show();
									$("#new_add").show();
									$("#imdone").show();
									$('#welcomemessage').hide();
									$('#new_add_msg').hide();
									$("#firstclasses").show();
									current_units = $("#classes_" + response.unit_id).html();
									if(type == 'assessment') {
										$('#classes_' + response.unit_id).append(formatTimetableAssessment(response));
									} else {
										$('#classes_' + response.unit_id).append(formatTimetableUnit(response));
									}
									//highlight div
									$('#unit_enrolment-' + response.event_id).effect("highlight", {
										color: get_color_for_event(type)
									}, 1000);

									$('#message_'+response.unit_id).html('Test');
								}
							}
						}
					);
				}
			},
			'Cancel': {
				text: "Cancel",
				open: function() { $(this).addClass('grey-button-effect') },
				click: function() {
					$( "#dialog-form" ).dialog("close");
				}
			}
		},
		close: function() {
			clear_form_elements($("#form"));
		}
	});

	if('shoeme' == 'show') {
		$( "#dialog-form" ).dialog("open");
	}

	 /**
		* Okay here we go. So, you need to lets say this is the main editing page of the timetable,
		* well user A's first vists will display a message with a big cal icon. If they click "add a lecture..."
		* we'll need to do the following. Acutally this message will be the message until they put any subject in.
		*
		* - ring up the dialogue box to enter a subject.
		* - when submitted,  hide the timetable stuff
		* - then add all the other stuff in.
		*/
	$('#new_add_tt').live('click', function() {
		$("#dialog-form").removeClass('hidden').dialog('open');
		//remove all options from select box
		$('#enrolled_units').empty();
		//append all options for select box from autocomplete units
		$("#enrolled_units").append(get_all_units());
	});

	function checkType(o, n) {
		if(typeof o === "undefined") {
			var arr = ['a','e','i','o','u'];
			if (jQuery.inArray(n[0], arr) == -1) {
				updateTips("Please select a " + n);
			} else {
				updateTips("Please select an " + n);
			};
			return false;
		} else {
			return true;
		}
	}

	function checkInput(o, n) {
		if(o.val() == '') {
			o.addClass( "ui-state-error" );
			var arr = ['a','e','i','o','u'];
			if (jQuery.inArray(n[0], arr) == -1) {
				updateTips("Please select a " + n);
			} else {
				updateTips("Please select an " + n);
			};
			return false;
		} else {
			return true;
		}
	}

	function checkFromTo(a, b) {
		from = a.val();
		to   = b.val();

		if(Date.parse(from) >= Date.parse(to)) {
			a.addClass( "ui-state-error" );
			updateTips( "Please check your class times");
			return false;
		} else {
			return true;
		}
	}

	function checkRepeatDate(val, date) {
		rep = val.val();
		rep_date = date.val();
		if(rep == '' && rep_date != '') {
			updateTips( "Please add repeat event value.");
			return false;
		} else if(rep != '' && rep_date == '') {
			updateTips( "Please add an end date for repeating event.");
			return false;
		} else {
			return true;
		}
	}

	function updateTips(t) {
		tips.text(t).addClass( "ui-state-highlight" );
		setTimeout(function() {
			tips.removeClass( "ui-state-highlight", 3000 );
		}, 500 );
	}

	function clear_form_elements(ele) {
		$(ele).find(':input').each(function() {
			switch(this.type) {
				case 'password':
				case 'select-multiple':
				case 'select-one':
				case 'text':
				case 'textarea':
					$(this).val('');
					break;
				case 'checkbox':
				case 'radio':
			}
		});
	}

	function formatTimetableUnit(response) {
		return '<div id="unit_enrolment-' + response.event_id + '" class="timetable_set ui-corner-all">' +
		'<div class="timetable_time">' + Date.parse(response.time_from).toString("h:mmtt") + ' - ' +
		Date.parse(response.time_to).toString("h:mmtt") + ' &mdash; ' + response.time_day +
		'</div><div class="timetable_class"><b style="color:' + get_color_for_event(response.type).text + ';">' + response.type_display +
		'</b><br></div><div class="timetable_cross">\n\
								<button class="remove-class" onclick="delete_timetable_event(' +
		response.event_id + ', function(callback){})" type="button" data-id="27979"></button></div></div>';
	}

	function formatTimetableAssessment(response) {
		if(!response.time_to){
			return '<div id="unit_enrolment-' + response.event_id + '" class="timetable_set ui-corner-all"><div class="timetable_time">' +
		response.assessment_date + ' &mdash; Due ' + Date.parse(response.time_from).toString("h:mmtt") + '</div><div class="timetable_class"><b style="color:' +
		get_color_for_event(response.type).text + ';">' + response.type_display + '</b> - ' + response.title + ' ' + response.by_academic +
		'</div><div class="timetable_cross"><span class="timetable-delete" onclick="delete_timetable_event(' + response.event_id +
		', function(callback){})"><img src="/assets/images/icon-delete.png" /></span></div></div>';
		}else{
		return '<div id="unit_enrolment-' + response.event_id + '" class="timetable_set ui-corner-all"><div class="timetable_time">' +
		response.assessment_date + ' &mdash; ' + Date.parse(response.time_from).toString("h:mmtt") + ' - ' + Date.parse(response.time_to).toString("h:mmtt") + '</div><div class="timetable_class"><b style="color:' +
		get_color_for_event(response.type).text + ';">' + response.type_display + '</b> - ' + response.title + ' ' + response.by_academic +
		'</div><div class="timetable_cross"><span class="timetable-delete" onclick="delete_timetable_event(' + response.event_id +
		', function(callback){})"><img src="/assets/images/icon-delete.png" /></span></div></div>';
		}
	}

	 /**
		* bind click event to plus button
		*/
	$('#add-more-class').live('click', function(e) {
		var isWelcomestep = $(this).attr('data');
		search_part = $('.search:first').clone(true, true).appendTo('#search').removeClass('hidden');
		search_part.children('.search_class').removeClass('hidden').attr('placeholder', 'Enter the name or code of your subject');

		if(isWelcomestep != '' && isWelcomestep == 'welcomestep') {
			search_part.children('.search_class').attr('extra', isWelcomestep);
		}
	});

	$('#imdonelink').live('click', function(event) {
		window.location.href = "/timetable";
	});

	$('.remove-class').on('click', function(e) {
		$dialog = $('<div></div>').html('Are you sure you want to remove this subject? This will delete all class times as well.')
		.dialog({
			title: 'Remove Subject',
			modal: true,
			buttons: {
				"Ok": function() {
					box = $(this);
					box.append($('<div class="loading big"></div>'));
					box.dialog("widget").find('.ui-dialog-titlebar-close').remove();
					box.dialog("widget").find("button").addClass("ui-state-disabled").attr("disabled", true);
					box.dialog( "option", "closeOnEscape", false );
					//unenrol user from unit
					if($(get_target_of_event(e)).data('id') === undefined) {
						$(get_target_of_event(e)).parent().remove();
						box.dialog("close");
					} else {
						unenrol_user_from_unit($(get_target_of_event(e)).data('id'), function(response) {
							if(response) {
								//remove unit from dom
								$(get_target_of_event(e)).parent().remove();
								//and remove all events from calendar
								$.each($(get_target_of_event(e)).siblings('select').children('option'), function(index, value) {
									if($(value).attr('data-eventid')) {
										remove_event_from_fullcalendar($(value).attr('data-eventid'));
									}
								});
								//close modal box
								box.dialog("close");
							}
						});
					}
				},
				'Cancel': function() {
					$(this).dialog("close");
				}
			}
		});
	});

});// end ready

/**
 * function to save/add a timetable event
 *
 * @param event_data	object with all relevant event & unit info data
 * @param callback		function used to trigger ajax success for caller
 */
function save_timetable_event(event_data, callback) {
	//save event via ajax call
	var e = $('#search').find('input[name=unit-'+event_data.unit_id+']').parent();

	$.ajax({
		type: 'post',
		url: '/timetable/post_class/' + event_data.unit_id,
		dataType: "json",
		data: {
			type: event_data.type,
			time_from: event_data.time_from,
			time_to: event_data.time_to,
			unit_info_id: event_data.unit_info_id,
			event_location: event_data.location,
			time_day: event_data.time_day,
			title: event_data.title,
			date: event_data.date_due,
			time_assessment: event_data.time_assessment,
			alert: event_data.alert,
			color: get_color_for_event(event_data.type).text,
			by_academic: event_data.by_academic,
			repeat_val: event_data.repeat_val,
			repeat_edate: event_data.repeat_edate,
			no_time_to: event_data.no_time_to
		},
		success: function(response) {
			if(response != '') {
				//send response data to caller function
				callback(response);
				if(event_data.type == 'assessment') {
					e_start = Date.parse(event_data.date_due).toString("yyyy-MM-dd") + 'T' + response.time_from + 'Z';
					e_end = Date.parse(event_data.date_due).toString("yyyy-MM-dd") + 'T' + response.time_to + 'Z';
				} else {
					//add event to calendar (2009-11-05T13:15:30Z)
					if(Date.parse('today').toString('dddd') == 'Sunday'
						&& Date.parse(response.time_day).toString('dddd') != 'Sunday') {
						pre = 'last ';
					} else {
						if(Date.parse(response.time_day).toString('dddd') == 'Sunday' &&
							Date.parse(response.time_day).toString('yyyy-MM-dd') !=  Date.parse('today').toString('yyyy-MM-dd')) {
							pre = 'next ';
						} else {
							pre = '';
						}
					}
					e_start = Date.parse(pre + response.time_day).toString("yyyy-MM-dd") + 'T' + response.time_from + 'Z';
					e_end = Date.parse(pre + response.time_day).toString("yyyy-MM-dd") + 'T' + response.time_to + 'Z';
				}

				if(this.no_time_to) {
					e_end	= null;
				}

				add_event_to_fullcalendar({
					id: response.event_id,
					title: event_data.title,
					start: e_start,
					end: e_end,
					allDay: false,
					className: 'event-' + remove_special_chars(event_data.type.toLowerCase()).replace('/', '-')
				});

				get_info_data_per_ajax(e.find('.search_class'), e.find('.select-subject'),event_data.unit_id)
			}
		},
		error: function (xhr, status) {
			console.log(xhr);
		}
	});
}

/**
 * function to delete a timetable event - ajax call to delete the event
 *
 * @param event_id		event id (same id as in calendar table)
 * @param callback		function used to trigger modal button events
 */
function delete_timetable_event(event_id, callback) {
/*	$dialog = $('<div></div>').html('Are you sure you want to delete this event?')
	.dialog({
		title: 'Confirm delete',
		modal: true,
		closeOnEscape: false,
		closeText: '',
		open: function(event, ui) {
			$(".ui-dialog-titlebar-close").hide();
		},
		buttons: {
			"Ok": function() {
				box = $(this);
				box.append($('<div class="loading big"></div>'));
				box.dialog("widget").find('.ui-dialog-titlebar-close').remove();
				box.dialog("widget").find("button").addClass("ui-state-disabled").attr("disabled", true);
				box.dialog( "option", "closeOnEscape", false );*/
				//delete event via ajax call
				$.ajax({
					type: 'post',
					url: '/timetable/delete_class/' + event_id,
					dataType: "json",
					success: function(response){
						$("#unit_enrolment-" + event_id).hide("highlight",500,function(){
							$(this).remove();
						});
						count = response.count;
						all_tt = response.all_tt;
						remove_event_from_fullcalendar(event_id);
						if(parseInt(count) == 0) {
							$('#unit-manunally-' + response.unit_id).hide();
						}
						if(parseInt(all_tt) == 0) {
							$("#new_add").hide();
							$("#new_add_msg").show();
							$("#imdone").hide();
							$("#firstclasses").hide();
							$('#welcomemessage').show("highlight",500);
						}

						if($.isFunction(callback)) {
							callback(response);
						}
						//box.dialog("close");
					}
				});
			/*},
			'Cancel': function() {
				if($.isFunction(callback)) {
					callback(response);
				}

				$(this).dialog("close");
			}
		}
	});*/
}

/**
 *	init fullcalender
 */
timetableCalend = $('#timetable1');

var current_timetable_url = '';
var new_timetable_url     = '';

timetableCalend.fullCalendar({
	firstDay: 1,
	header: {
		left: 'prev',
		center: 'title',
		right: 'next'
	},
	timeFormat: {
		//agenda: 'h(.mm){-h(.mm)}' // 5 - 6.30
		agenda: 'h(:mm)tt' // 5 - 6.30
	},
	height: 670,
	theme: false,
	defaultView: 'agendaWeek',
	allDaySlot: false,
	minTime: 8,
	maxTime: 22,
	axisFormat: 'hmmm',
	columnFormat: {
		week: 'ddd'
	},
	events: function(start, end, callback) {
		var start_date = start.getFullYear()+"-"+(start.getMonth()+1)+"-"+start.getDate();
		var end_date = end.getFullYear()+"-"+(end.getMonth()+1)+"-"+end.getDate();

		new_timetable_url  = '/json/get_all_events_for_user/' + user_id+"?start_date="+start_date+"&end_date="+end_date;
    if( new_timetable_url != current_timetable_url ){
      $.ajax({
          url: new_timetable_url,
          dataType: 'json',
          success: function( response ) {
            current_timetable_url = new_timetable_url;
            user_events = response;
            callback(response);
          }
      })
   }else{
   	callback(user_events);
   }


		/*$.ajax({
			url: '/json/get_all_events_for_user/' + user_id,
			dataType: 'json',
			success: function(data) {
				callback(data);
			}
		});*/
	},
	eventAfterRender: function(event, elm, view) {
		var event_time = elm.find('.fc-event-time');
		var event_title = elm.find('.fc-event-title');
		var event_head = elm.find('.fc-event-head');

		if(event_title.text().indexOf('Due') != -1) {
			event_time.text('Due ' + event_time.text());
			event_title.text(event_title.text().substr(4));
		}
		$(event_head).before( "<span class='closon'></span>" );
		elm.find(".closon").click(function() {
			// add ajax call of removing events
			delete_timetable_event(event._id);
      $('#timetable1').fullCalendar('removeEvents',event._id);
    });

	},
	buttonText:{
		prev: '',
		next: '',
	}
});

/*
 * function to add an event to the calendar
 * example event: {title: 'new', start: '2012-06-18 15:30:00', allDay: false}
 */
function add_event_to_fullcalendar(event) {
	timetableCalend.fullCalendar('renderEvent', event, true);
}

/*
 * function to remove an event to the calendar
 */
function remove_event_from_fullcalendar(eventId) {
	timetableCalend.fullCalendar('removeEvents', eventId);
}

/*
 * init jQuery multiselect boxes for existing selectboxes - FOR SETUP PROCESS
 */
$('#search_setup .search_setup').not('.hidden').each(function(i, element) {
	e = $(element);
				user_type =e.find('#user_type').val();
	get_info_data_per_ajax(e.find('.search_class'), e.find('.select-subject'), e.find('.search_class').data('id'), user_type);
});

/*
 * init jQuery multiselect boxes for existing selectboxes
 */
$('#search .search').not('.hidden').each(function(i, element) {
	e = $(element);
	get_info_data_per_ajax(e.find('.search_class'), e.find('.select-subject'), e.find('.search_class').data('id'));
});

/*
 * autocomplete function for class search
 */
$('.search_class').on('focus.autocomplete', function() {
	var is_first_steps = $(this).parent().data('section') == 'first_steps';

	$(this).autocomplete({
		focus: function(event, ui)	{
			$(this).val(ui.item.label);
			$(this).attr('name', 'unit-' + ui.item.id);
			return false;
		},
		minLength: 2,
		delay: 20,
		search: function(event, ui) {
			ids = '';
			el = $(get_target_of_event(event));
			if(el.attr('data-id')) el.removeAttr('data-id');
			$('.search_class').each(function(i, v) {
				if($(v).attr('data-id')) {
					ids += $(v).attr('data-id') + ',';
				}
			});
			// update the url with academics before sending the request
			var url = "/json/search_all_units_jason?unit_ids=" + ids + "&format=json";
			$(this).autocomplete("option", "source", url);
		},
		select: function(event, unit_info) {
			autocompl = $(this);
			//enrol user in unit per ajax
			enrol_user_in_unit(unit_info.item.id, function(response) {
				//if response true, then go on
				if(response && !is_first_steps) {
					//show ajax loading gif for usability
					autocompl.siblings('.loading').removeClass('hidden');
					var optionbox = autocompl.siblings('select');
					if(autocompl.siblings('select')) {
						optionbox.remove();
					}
					optionbox = $('.search:first > select').clone(true, true);

					//add id to selected ids array
					autocompl.attr("data-id", unit_info.item.id);
					autocompl.siblings('button.remove-class').attr("data-id", unit_info.item.id);
					autocompl.attr('disabled', 'disabled');
					add_new_unit_to_manually_added(unit_info);

					//send ajax request to get unit info
					get_info_data_per_ajax(autocompl, optionbox, unit_info.item.id);
					checkStepsStarted();
				}
			});
		}
	});
});

/*
 * adds a new div to display manually added events
 */
function add_new_unit_to_manually_added(unit_info) {
	$('.manuelly_added .unit-manu:last').after('<div class="unit-manu" id="unit-manunally-' +
		unit_info.item.id + '" style="display:none;"><h4 class="timetable">' + unit_info.item.label +
		'</h4><div class="class_times"><div id="classes_' + unit_info.item.id +
		'"></div></div></div>');
}

/*
 * function to add a jQuery multiselect box
 * @param element		on which multibox should bind
 * @param data			json data with unit info data objects
 * @param unit_id		unit id as int
 */
function add_multi_select_box(element, data, unit_id) {
	element.multiselect({
		header: false,
		height: 'auto',
		maxWidthButton: 230,
		noneSelectedText: 'Select class times',
		selectedText: "# of # class times selected",
		click: function(event, ui) {
			unit_info_obj = getObjects(data.data, 'id', ui.value)[0];
			if(Date.parse('today').toString('dddd') == 'Sunday') {
				last = 'last';
			} else {
				last = '';
			}
			start_date = Date.parse(last + unit_info_obj.day).toString("yyyy-MM-dd") + ' ' + unit_info_obj.time;
			option = $(get_target_of_event(event)).find('option[value="' + ui.value + '"]');
			if(ui.checked && (typeof noOnClick === 'undefined' || noOnClick === false)) {
				save_timetable_event(
					event_data = {
						unit_id: unit_id,
						unit_info_id: unit_info_obj.id,
						location: unit_info_obj.location,
						type: unit_info_obj.subject_type,
						time_from: Date.parse(unit_info_obj.time).toString("HH:mm:ss"),
						time_to: Date.parse(unit_info_obj.time).add({
							hours: unit_info_obj.duration
							}).toString("HH:mm:ss"),
						time_day: convert_day_string_in_number(unit_info_obj.day),
						title: unit_info_obj.subject_code,
						date_due: '',
						time_assessment: '',
						alert: ''
					}, function(res) {
						option.attr('data-eventid', res.event_id);
						unit_info_obj.event_id = res.event_id;
					}
					);
			} else if (typeof noOnClick === 'undefined' || noOnClick === false) {
				delete_timetable_event(unit_info_obj.event_id, function(response){
					if(response == false) {
						option.attr('selected', 'selected');
						element.multiselect('refresh');
						element.multiselect('open');
					} else {
						option.attr('data-eventid', '');
						remove_event_from_fullcalendar(unit_info_obj.id);
						element.multiselect('open');
					}
				});
			}
		}
	});

	element.multiselect('refresh');
}

/*
 * function to add a jQuery multiselect box
 * and append all unit info data to select box for specific unit
 */
function get_info_data_per_ajax(search_div, optionbox, unit_id, user_type) {
	$.ajax({
		url: '/json/get_unit_info_data_json/' + unit_id,
		success: function(data) {
			search_div.siblings('.loading').addClass('hidden');
			if(data.success) {
				if(search_div.siblings('.message')) search_div.siblings('.message').remove();
				search_div.after(optionbox);
				optionbox.attr('id', unit_id).attr('name', 'select for unit-' + unit_id + '-' + $('.search').length + '[]');
								optionbox.html('');
				$.each(data.data, function(){
					selected = (this.selected) ? 'selected="selected"' : '';
					time_str = this.time;
					time_split = time_str.split(":");
					formated_time =  time_split[0] + ':' + time_split[1];
					option = $('<option value="' + this.id + '" ' + selected + '>' +
						this.subject_type + ': ' + this.day + ' ' + formated_time + ' (' + this.activity_number + ')'
						+ '</option>');
					if(this.event_id) {
						option.attr('data-eventid', this.event_id);
					}
					optionbox.append(option);
				});
				add_multi_select_box(optionbox, data, unit_id);
				optionbox.removeClass('hidden');
			} else {
				 // msg_text = '';
				 // if(user_type != 3) {
				 //     msg_text += 'You can add class times manually below.';
				 // }
				 // msg_text += ''

				if(search_div.parent().data('section') != 'first_steps') {
					message = $('<div class="message">No class times</div><select multiple="multiple" class="select-subject" name="select for unit-2794-5[]" id="'+unit_id+'" style="display: none;"></select>');

					if(optionbox) {
						optionbox.remove();
						if(search_div.siblings('.message').length != 1) search_div.after(message);
					}
				}
			}
		}
	});
}

/*
 * function to enrol user in a unit
 * @param callback	function to notify caller function in ajax success
 * @param unit_id		unit id as int
 */
function enrol_user_in_unit(unit_id, callback) {
	$.ajax({ //save
		type: 'post',
		url: '/classes/enrol/' + unit_id,
		success: function(response){
			callback(response.success);
		}
	});
}

/*
 * function to unenrol user from a unit
 * @param callback	function to notify caller function in ajax success
 * @param unit_id		unit id as int
 */
function unenrol_user_from_unit(unit_id, callback) {
	$.ajax({ //save
		type: 'post',
		url: '/classes/unenrol/' + unit_id,
		success: function(response){
			callback(response.success);
		}
	});
}

/*
 * returns all per autocomplete selected units as options for selectbox
 */
function get_all_units() {
	var available_units = '<option value="" selected="selected">Select Unit</option>';

	$('.search_class').not('.hidden').each(function(i, el) {
		if($(el).attr('value') != '') {
			available_units += '<option name="'
			+ $(el).attr('value').split(' ')[0]
			+ '" value="' + $(el).data('id')
			+ '">' + $(el).attr('value') + '</option>';
		}
	});

	return available_units;
}
