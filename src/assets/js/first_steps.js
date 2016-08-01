/*
 * JS for first steps page after user sign up
 * file contains all relevant javascript and is included in
 * /application/views/user/first_steps_one.php
 * 
 * @author: lars haeuser <lars@ucroo.com>
 * @version: 1.0
 * 
 */


//autocomplete function for class search
$('.search_class').on('focus.autocomplete', function(){
		$(this).autocomplete({
				focus: function(event,ui)	{
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
						$('.ui-autocomplete-input').each(function(i, v) {
								if($(v).attr('data-id')) {
										ids += $(v).attr('data-id') + ',';  
								}
						});
						// update the url with academics before sending the request
						var url = "/json/search_all_units_jason?unit_ids=" + ids + "&format=json";
						$(this).autocomplete("option", "source", url);
				},
				select: function(event, ui) {
						//show ajax loading gif for usability
						$(this).siblings('.loading').removeClass('hidden');
						var search = $(this);
						var optionbox = $(this).siblings('select');
						if($(this).siblings('select')) optionbox.remove();
						optionbox = $('.search:first > select').clone(true, true);
						//add id to selected ids array
						search.attr("data-id", ui.item.id);
						//send ajax request to get unit info
						var xmlRequest = $.ajax({
								url: '/json/get_unit_info_data_json/' + ui.item.id,
								success: function(data) {
										search.siblings('.loading').addClass('hidden');
										if(data.success) {
												if(search.siblings('.message')) search.siblings('.message').remove();
												search.after(optionbox);
												optionbox
												.removeClass('hidden').attr('id', ui.item.id)
												.attr('name', 'select for unit-' + ui.item.id + '-' + $('.search').length + '[]');
												$.each(data.data, function(){
														optionbox.append('<option value="' + this.id + '">' +
																this.subject_type + ': ' + this.day + ' ' + this.time + ' (' + this.activity_number + ')'
																+ '</option>');
												});
												optionbox.multiselect({
														header: false,
														height: 'auto',
														noneSelectedText: 'Select class times',
														selectedText: "# of # class times selected",
														create: function() {
																if($('#timetable').hasClass('no')) {
																		$('.note.signup').animate(
																		{
																				marginLeft: -140
																		}, 500, function() {
																				optionbox.multiselect('open');
																		});
																		$('#timetable').animate({
																				height: 690, 
																				opacity: 1
																		}, 500);
																		$('#timetable').removeClass('no').addClass('open');
																		$('#cal').fullCalendar('render');
																}
														},
														open: function() {
																if($('#timetable').hasClass('no')) {
																		optionbox.multiselect('close');
																		$('.note.signup').animate(
																		{
																				marginLeft: -140
																		}, 500, function() {
																				optionbox.multiselect('open');
																		});
																		$('#timetable').animate({
																				height: 690, 
																				opacity: 1
																		}, 500);
																		$('#timetable').removeClass('no').addClass('open');
																		$('#cal').fullCalendar('render');
																}
														},
														click: function(event, ui) {
																obj = getObjects(data.data, 'id', ui.value)[0];
																if(Date.parse('today').toString('dddd') == 'Sunday') {
																		last = 'last';
																} else {
																		last = '';
																}
																start_date = Date.parse(last + obj.day).toString("yyyy-MM-dd") + ' ' + obj.time;
																if(ui.checked) {
																		addEvent({
																				id: obj.id, 
																				title: obj.subject_code + '\n' + obj.subject_type, 
																				start: start_date, 
																				end: Date.parse(start_date).add({
																						hours: obj.duration
																						}),
																				allDay: false,
																				className: 'event-' + obj.subject_type.toLowerCase()
																		});
																} else {
																		removeEvent(obj.id);
																}
														}
												});
										} else {
												message = $('<div class="message">No Info available. ' +
														'You can add the timetable info for this class manually in your profile.</div>');
												if(optionbox) {
														optionbox.remove();
														if(search.siblings('.message').length != 1) search.after(message);
												}
										}
								}
						});
				}
		});
});
//init fullcalender
$('#cal').fullCalendar({
		firstDay: 1,
		header: {
				left: '',
				center: '',
				right: ''
		},
		timeFormat: {
				 agenda: 'h:mm' // 5:00 - 6:30
		},
		height: 670,
		theme: false,
		defaultView: 'agendaWeek',
		allDaySlot: false,
		minTime: 8,
		maxTime: 22,
		columnFormat: {
				week: 'ddd'
		}
});

//bind click event to plus button
$('#add-more-class').bind('click', function(e){
		$('.search:first').clone(true, true).appendTo('#search').removeClass('hidden');
});

//bin click event to remove button
$('.remove-class').on('click', function(e){
		$(get_target_of_event(e)).parent().remove();
		//and remove all events from calendar
		calElements = $(get_target_of_event(e)).parent().children('select').val();
		if(calElements) {
				$.each(calElements, function(index, value) {
						removeEvent(value);
				});
		}
});

//bind click event to close timetable botton
$('#close_timetable').bind('click', function() {
		//some animation effects to show/hide calendar
		$('#timetable').animate({
				height: 0,
				opacity: 0
		}, 500);
		$('.note.signup').animate({
				marginLeft: 70
		}, 500);
		$('#timetable').delay(400).queue(function(next){
				$(this).removeClass('open').addClass('no');
				next();
		});
		$('#calendar').fullCalendar('destroy');
});

//function to add an event to the calendar
//example event: {title: 'new', start: '2012-06-18 15:30:00', allDay: false}
function addEvent(event) {
		$('#cal').fullCalendar('renderEvent', event, true);
}

//function to remove an event to the calendar
function removeEvent(eventId) {
		$('#cal').fullCalendar('removeEvents', eventId);
}
