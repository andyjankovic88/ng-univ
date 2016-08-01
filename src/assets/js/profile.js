/**
 * JS for users profile page
 * file contains all relevant javascript and is included in
 * /application/views/user/profile.php
 *
 * @author: lars haeuser <lars@ucroo.com>
 * @version: 1.0
 */

jQuery(function($) {
	if(isSelf) {
		//Fileupload for profile picture
		$('#fileupload').fileupload({
			dataType: 'json',
			url: '/upload',
			formData: {
				type: 'profile-pic', csrf_test_name: csrf_token_value
			},
			add: function(e, data) {
				data.submit();
			},
			start: function(){
				$('.loading_profile').removeClass('hidden');
				$('#filemessage').hide();
				$('.fileinput-button').hide();
			},
			done: function (e, data) {
				$.each(data.result, function (index, file) {
					if(file.status == 'success'){
						$('#profile-pic').attr('src', file.url);
                                                $('#profile-picRHS').attr('src', file.url);
                                                $('#profile-pic_HDR').attr('src', file.url);
						$('.loading_profile').addClass('hidden');
						$('.fileinput-button').show();
					}
				});
			}
		});
	}

		//add class enrollments
		$('#form-enroll').on('focus.autocomplete', '.search_class', function() {
			$(this).autocomplete({
				minLength: 2,
				delay: 20,
				source: "/json/search_all_units_jason?format=json",
				search: function(event, ui) {
					var ids = '', url;

					// excluding classes already selected
					ids = $(this).parent().parent().find('input[type=hidden]').map(function() {
						return this.value;
					}).get().join();

					if(ids) {
						url = "/json/search_all_units_jason?format=json&unit_ids=" + ids;
						$(this).autocomplete("option", "source", url);
					}
				},
				"select": function(event, unit_info) {
					// set id in value of next hidden field
					$(this).next('input[type=hidden]').val(unit_info.item.id);
					$(this).prop('readonly', 'readonly');
				}
			});
		}).find('#add-more-class').on('click', function() {
			var new_field = $('<div />', { 'class': 'search' }).append(
				$('<input />', {
					type: 'text',
					'class': 'input search_class',
					'style': 'width:285px;',
					name: 'units[]',
					placeholder: $('#placeholdertext_unit').val()
				})
			).append(
				$('<input />', {
					type: 'hidden',
					name: 'unit_ids[]'
				})
			).append(
				$('<div />', {'class': 'loading hidden' })
			).append(
				$('<button />', {
					"type": "button",
					"class": "remove-class bold"
				}).text("")
			).append(
					$('<div />', { 'class': 'clear' })
			);

			$(this).before(new_field);

			// a little hack to trigger autocomplete on dynamically added fields
			if($(this).parent().find('.search').size() == 2) {
				$(this).prev().remove();
				$(this).before(new_field);
			}

			$(this).prev().find('.search_class').trigger('focus.autocomplete');
		}).end().on('click', '.remove-class', function() {
			$(this).parent().fadeOut('slow', function() {
				$(this).remove();
			});
		});

	var pastClassClickHandler = function (event) {
		event.preventDefault();
		var $this = $(this);
		var arrowElem = $this.children('span').first();
		var arrowClassName = arrowElem.attr('class');

		if (arrowClassName === 'expandable_arrow_down')
		{
			arrowElem.attr('class', 'expandable_arrow_up');
			$this.children('span.text').text('Hide');
		}
		else
		{
			arrowElem.attr('class', 'expandable_arrow_down');
			$this.children('span.text').text('Show');
		}
		$('#past-classes').toggle(0, function() {
			$this.one('click', pastClassClickHandler);
		});
	};

	$('#show_past_classes').one('click', pastClassClickHandler);

	//init fullcalender for timetable
	$('#timetable-profile').fullCalendar({
		firstDay: 1,
		header: {
			left: '',
			center: '',
			right: ''
		},
		weekends: true,
		timeFormat: {
			agenda: 'h(.mm){-h(.mm)}' // 5 - 6.30
		},
		axisFormat: 'hmmm',
		height: 700,
		theme: false,
		defaultView: 'agendaWeek',
		allDaySlot: false,
		minTime: 8,
		maxTime: 22,
		columnFormat: {
			week: 'ddd'
		},
		events: function(start, end, callback) {
			$.ajax({
				url: '/json/get_all_events_for_user/' + userId,
				dataType: 'json',
				success: function(data) {
					callback(data);
				}
			});
		}
	});

	$('.profile_picture').load(function() {

		var img_width = $(this).width();
		var img_height = $(this).height();

		if(img_width > img_height) {
			$(this).addClass('horizontal');
		} else {
			$(this).addClass('vertical');
		}
	});

	$('#profile').on('click', '#profile-pic', function(e) {
		e.preventDefault();
		var uid = 0;
		if (typeof userId === 'number') {
			uid = userId;
		}

		if (uid > 0) {
			getLargeProfilePicUrl(uid).done(function(data) {
				jQuery.facebox({ image: data.pic_url,fitToView: true });
			});
		}

	});
});

function getLargeProfilePicUrl(uid) {
	if ( ! uid ) {
		return false;
	} else {
		var dynamicData = {};
		dynamicData["user_id"] = uid;
		return $.ajax({
			url: base_url + "/json/get_full_profile_pic_by_uid",
			type: "post",
			data: dynamicData
		});
	}
}

