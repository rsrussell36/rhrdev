jQuery(document).ready(function ($) {
	"use strict";

	/* Tabs */
	$('#metabox-tab').easyResponsiveTabs({
		type: 'vertical',
		width: 'auto',
		fit: true
	});

	//Repeatable Fields
	$('.repeatable-add').click(function (e) {

		e.preventDefault();

		var field = $(this).closest('.rhr_repeatable_field').find('.empty-row.screen-reader-text').clone(true),
			fieldLocation = $(this).closest('.rhr_repeatable_field').find('.rhr_repeatable_field_set:last');

		field.removeClass('empty-row screen-reader-text');

		/*$('*', field).val('').attr('name', function(index, name) {
			if( typeof(name) != "undefined" ) {
				return name.replace(/(\d+)/, function(fullMatch, n) {
					return Number(n) + 1;
				});
			}
		});	*/

		var length = ($(this).closest('.rhr_repeatable_field').find('.rhr_repeatable_field_set').length) - 1;

		$('*', field).attr('id', function (index, name) {
			if (typeof (name) != "undefined") {
				return name.replace(/(\d+)/, function (fullMatch, n) {
					return Number(n) + length;
				});
			}
		}).attr('for', function (index, name) {
			if (typeof (name) != "undefined") {
				return name.replace(/(\d+)/, function (fullMatch, n) {
					return Number(n) + length;
				});
			}
		});

		field.insertBefore(fieldLocation, $(this).closest('.rhr_repeatable_field'));
	});

	$('.repeatable-remove').click(function (e) {
		e.preventDefault();
		$(this).parent().remove();
	});

	$('.rhr_repeatable_field').sortable({
		opacity: 0.6,
		revert: true,
		cursor: 'move',
		handle: '.sort',
		axis: 'y',
	});

	//(un)fold options
	$('.fld').change(function () {

		var $fold = $('.f_' + $(this).data('id')),
			val = $(this).val();

		if ($fold.hasClass(val)) {
			$fold.slideDown('normal', "swing");
		} else {
			$fold.slideUp('normal', "swing");
		}

	}).change();

	$(".datepicker").datepicker();
	$(".datesFormat").datepicker({dateFormat: 'yy-mm-dd'});
	$(".date_year").datepicker({
		dateFormat: 'yy',
		changeYear: true,
		changeMonth: true,
	});

	$('.timepicker').timepicker({
		timeFormat: 'hh:mm tt'
	});
	$(function () {
		$('.date_range').daterangepicker({
			opens: 'center',
			timePicker: true,
			showWeekNumbers: true,
			autoUpdateInput: true,
			drops: "auto",
			locale: {
				"format": "MMMM DD, YYYY",
				"separator": " - ",
				"applyLabel": "Apply",
				"cancelLabel": "Cancel",
				"fromLabel": "From",
				"toLabel": "To",
				"customRangeLabel": "Custom",
				"weekLabel": "W",
				"daysOfWeek": [
					"Su",
					"Mo",
					"Tu",
					"We",
					"Th",
					"Fr",
					"Sa"
				],
				"monthNames": [
					"January",
					"February",
					"March",
					"April",
					"May",
					"June",
					"July",
					"August",
					"September",
					"October",
					"November",
					"December"
				],
				"firstDay": 1
			},
		}, function (start, end, label) {
			console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
		});
	});

	$('.selectpicker').select2({
		placeholder: 'Select an option',
		allowClear: true,
	});
	if ($('.meta-color').length > 0) {
		$('.meta-color').wpColorPicker();
	}

	if ($('.metabox').length > 0) {
		$('.metabox').parent('.inside').css({
			margin: '0',
			padding: '0'
		});
	}

	$('.rhr-switch label').on('click', function (event) {
		//event.preventDefault();

		var $switchVal = $(this).data('id'), $hiddenInput = $(this).parent('.rhr-switch').find('.rhr-switch-value');

		$(this).addClass('selected').siblings('label').removeClass('selected');

		$hiddenInput.val($switchVal);

		if ($hiddenInput.hasClass('fld-switch')) {

			var $fold = $('.f_' + $hiddenInput.data('id'));
			$.each($fold, function (index, value) {
				if ($(value).hasClass($switchVal)) {
					$(value).slideDown('normal', "swing");
				} else {
					$(value).slideUp('normal', "swing");
				}
			});

		}

	});

	//triger switch on load
	$('.rhr-switch label.selected').trigger('click');

	var $sidebarPosition = $('.rhr-image-select');

	setOutline($sidebarPosition, $);

	function setOutline(selector, $) {

		selector.find('li a img').addClass('img-border');
		selector.find('input:radio:checked').parent('li').find('a img').addClass('outline');

		selector.find('li a').on('click', function (e) {
			var $hiddenInput = $(this).parent('li').find('input'), val = $hiddenInput.val();
			$hiddenInput.prop('checked', true);
			$(this).find('img').addClass('outline');
			$(this).parent('li').siblings().find('a img').addClass('img-border').removeClass('outline');

			if ($hiddenInput.hasClass('fld-img-sel')) {
				var $fold = $('.f_' + $hiddenInput.data('id'));

				if ($fold.hasClass(val)) {
					$fold.slideDown('normal', "swing");
				} else {
					$fold.slideUp('normal', "swing");
				}
			}

			e.preventDefault();

		});

	}

	//Hide post field
	var val = $("input[name='post_format']:checked").val();
	hideMetaFields(val);

	$('.post-format').on('change', function (event) {
		var val = $("input[name='post_format']:checked").val();
		hideMetaFields(val);
	});

	function hideMetaFields(val) {
		if (val == 0 || val == 'image') {
			//Hide tab content
			$('.post-format-options').hide();
			$('li.layout').trigger('click');
		}
		else {
			//Show tab content
			$('.post-format-options').show();
			$('li.post-format-options').trigger('click');

			//hide and show particular tab fields
			if (val == 'audio') {
				$('.format-audio').show();
				$('.format-video, .format-gallery, .format-quote, .format-link').hide();
			}
			else if (val == 'video') {
				$('.format-video').show();
				$('.format-link, .format-gallery, .format-quote, .format-audio').hide();
			}
			else if (val == 'quote') {
				$('.format-quote').show();
				$('.format-video, .format-gallery, .format-link, .format-audio').hide();
			}
			else if (val == 'link') {
				$('.format-link').show();
				$('.format-video, .format-gallery, .format-quote, .format-audio').hide();
			}
			else {
				$('.format-gallery').show();
				$('.format-video, .format-link, .format-quote, .format-audio').hide();
			}

		}
	}

});
