(function($) {
    "use strict";
    $(window).on("load", function () {
    	
	    rhr.dashboard_();
	    rhr.dashboard_backToTop();
	    rhr.dashboard_search();
	    rhr.dashboard_filter();
	    rhr.dashboard_enable();
	    rhr.dashboard_elements();
	    rhr.dashboard_disable();
	    rhr.dashboard_cache_remove();
	    rhr.dashboard_cache_backend();
	 });
    var rhr = {
    	dashboard_: function () {
    		$(document).on("click", ".dashboard-menu .dashboard-item", function() {
			var numberIndex = $(this).index();
			if (!$(this).is("active")) {
				$(".dashboard-menu .dashboard-item").removeClass("active");
				$(".dashboard-content .content-item").removeClass("active");

				$(this).addClass("active");
				$(".dashboard-content").find(".content-item:eq(" + numberIndex + ")").addClass("active");
			}
		});
    	},
    	dashboard_backToTop: function () {
    		var scrollTrigger = 50,
				t = 0;
			$(window).scroll(function () {
				var scrollTop = $(window).scrollTop();
				if (scrollTop > scrollTrigger) {
					$('#back-to-top').addClass('show');
					$('#back-to-top').removeClass('hide');
					t = 1;
				}
				
				if (scrollTop < scrollTrigger && t==1) {
					$('#back-to-top').addClass('hide');
				}
			});
		},
		dashboard_search: function () {
			var timeout;
			$("#search").on('keyup',  function(event) {
				var searchText = $("#search").val().toLowerCase().replace(/ +(?= )/g,'');

				window.clearTimeout(timeout);
				timeout = window.setTimeout(function(){
					if($.trim(searchText)){
						rhr_.dashboard_search_result(searchText);
					}else{
						$( ".search-item .dashboard-col" ).show();
						$('#no-result').fadeOut(0);

					}
				},500);

			});
		},
		dashboard_search_result: function (searchText) {
			Array.prototype.hasSubStringOf = function( text ){
				for ( var i in this )
				{
					if ( text.toString().indexOf( this[i].toString() ) != -1 )
						return i;
				}
				return -1;
			}

			$('#no-result').fadeOut(0);
			var section = $( ".search-item .dashboard-col" ),
				resultFound = 0;

			section.hide();

			section.each(function( index ) {

				var titleText = '',
					$heading = $(this).find('.search_value');

				if( $heading.length > 0){

					titleText = $heading.text().toLowerCase().split(" ");

					if( titleText && titleText.hasSubStringOf( searchText ) !== -1 ){

						$(this).fadeIn();
						resultFound = 1;

					}else{

						$(this).fadeOut();
					}

				}

			});

			if( resultFound == 0 ){
				$('#no-result').fadeIn(400);
			}

			resultFound = 0;
		},
		dashboard_filter: function (){
			$( ".dashboard-filter .widgets-filter" ).on("change",function () {
			var selected = $( this ).val();
			var widget_filter = $(".dashboard-col");
			if(selected!='all'){
				widget_filter.removeClass('has-animated')
					.fadeOut(5).promise().done(function() {
					  widget_filter.filter(".type-"+selected)
						.addClass('has-animated').fadeIn();
					});
			}else if(selected=='all'){
				widget_filter.removeClass('has-animated')
					.fadeOut(5).promise().done(function() {
						widget_filter.addClass('has-animated').fadeIn();
					});
			}
		});
		},
		dashboard_enable: function () {
			$('#widget_check_all').on('click', function() {
				$('.dashboard-col input:checkbox:enabled').prop('checked', $(this).prop('checked'));
				if(this.checked){
					$(this).closest(".dashboard-widget-check-all").addClass("active-all");
				}else{
					$(this).closest(".dashboard-widget-check-all").removeClass("active-all");
				}
			});
		},
		dashboard_disable: function () {
			$(document).on("click", "._disabled_remove", function () {
	            $(".save_elements").addClass("save-instant").removeAttr("disabled").css("cursor", "pointer");
	        });
		},
		dashboard_elements: function () {
			$(document).on("click", ".save_elements", function () {
            var $this = $(this),
                $type = $this.data('layout'),
               	$none = $("#security").val(),
                $data_serilize = $(".elements_form :input[type=checkbox]").serialize(),
                $data = { type: $type, action: "rhr__elements", security: $none, data: $data_serilize };
                $(this).hasClass("save-instant")
                ? $.ajax({
                      url: rhrDashboardConfig.rhr_ajax,
                      type: "post",
                      data: $data,
                      beforeSend: function () {
                      	$this.addClass('visible-ring');
                      },
                      success: function (res) {
                          1 == res
                              ? rhr.dashboard_message("Success", "Setting successfully saved.", "success_popup")
                              : -1 == f
                              ? rhr.dashboard_message("Warning!", "Nonce Verification is incorrect.", "warning_popup")
                              : rhr.dashboard_message("Error!", "Settings could not be saved successfully.", "error_popup");
                          $(".save_elements").removeClass("save-instant");
                          $this.removeClass('visible-ring');
                    	},
                      error: function () {
                           rhr.dashboard_message("Error!", "Settings could not be saved successfully.", "error_popup");
                      },
                  })
                : $(this).attr("disabled", "true").css("cursor", "not-allowed");
            return !1;
		});
		},
		dashboard_cache_remove: function () {
			$(document).on("click", ".rhr-remove-cache", function () {
            var $this = $(this),
            	$button_txt = $this.text(),
                $data = { action: "rhrs_clear_cache", security: rhrDashboardConfig.rhr_nonce};
                $.ajax({
                      url: rhrDashboardConfig.rhr_ajax,
                      type: "post",
                      data: $data,
                      beforeSend: function () {
                      	$this.addClass('visible-ring');
                      },
                      success: function (res) {
                          $this.removeClass('visible-ring');
                          rhr.dashboard_message("Successfully", "Purge removed.", "success_popup")
                    	},
                      error: function () {
                          console.log('error');
                      },
                  })
            return !1;
		});
		},
		dashboard_cache_backend: function () {
			$(document).on("click", ".rhr-remove-backend", function () {
            var $this = $(this),
            	$button_txt = $this.text(),
                $data = { action: "backend_clear_cache", security: rhrDashboardConfig.rhr_nonce};
                $.ajax({
                      url: rhrDashboardConfig.rhr_ajax,
                      type: "post",
                      data: $data,
                      beforeSend: function () {
                      	$this.addClass('visible-ring');
                      },
                      success: function (res) {
                          $this.removeClass('visible-ring');
                          rhr.dashboard_message("Successfully", "Purge removed.", "success_popup")
                    	},
                      error: function () {
                          console.log('error');
                      },
                  })
            return !1;
		});
		}, 
		dashboard_message: function (b, c, d) {
	        b = void 0 === b ? "Thank You!" : b;
	        c = void 0 === c ? "The changes were made successfully." : c;
	        d = void 0 === d ? "success_popup" : d;
	        $(".rhr_message_ajax").addClass("popup-visible");
	        $("body").addClass("rhr_close_ajax_popup");
	        $(".rhr_message_ajax").addClass(d);
	        $("#message").text(b);
	        $("#message_text").text(c);
	        $(document).on("click", ".rhr_close_ajax_popup .popup-visible", function () {
	            $(".rhr_message_ajax").removeClass("popup-visible");
	        });

	        setTimeout(function () {
	            $(".rhr_message_ajax").removeClass("popup-visible");
	        }, 3e3);
	    }
    }

}(jQuery));

