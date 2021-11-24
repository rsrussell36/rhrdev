(function ($) {
  "use strict";

  $(window).on("load", function () {
    //Header Search
    rhr_setting.rhr_search_filter_class(".rhr-search", ".loading-search-post");
    rhr_setting.rhr_search_filter(".rhr-search", ".loading-search-post");
    //Modal Search
    rhr_setting.rhr_search_filter_class(".rhr-search-modal", ".loading-search-modal");
    rhr_setting.rhr_search_filter(".rhr-search-modal", ".loading-search-modal");
    //Breadcumb Search
    rhr_setting.rhr_search_breadcumbs();
    rhr_setting.rhr_contact_form();
    rhr_setting.rhr_mailchimp();
    rhr_setting._push_equal_height();

    //Modal Pdf
    //For Black Box
    rhr_setting.rhr_download_form_toogle_black();
    rhr_setting.rhr_download_pdf_black(".black-download", ".rhr-download-message");
    rhr_setting.rhr_download_form_toogle('.black-download-modal-mobile', '.b-download');
    rhr_setting.rhr_download_pdf(".black-download-modal-mobile", ".rhr-download-message");

    //For Page Heading
    rhr_setting.rhr_download_form_toogle('.gf-download', '.b-download');
    rhr_setting.rhr_download_pdf(".gf-download", ".rhr-download-message");
    //For Other
    rhr_setting.rhr_download_form_toogle('.gh-download', '.b-download');
    rhr_setting.rhr_download_pdf(".gh-download", ".rhr-bdownload-message");
    //Sidebar scroll
    rhr_setting.rhr_sidebar_section(".solutions-team-image", 150, '.solutions-team-image');
    rhr_setting.rhr_sidebar_section(".solution-assessment-image", 150, ".solution-assessment-image");
    rhr_setting.rhr_sidebar_section(".solution-diversity-image", 50, ".solution-diversity-image");
    rhr_setting.rhr_sidebar_section(".solution-development-image", 50, ".solution-development-image");
    rhr_setting.rhr_sidebar_section(".solution-founder-image", 80, ".solution-founder-image");
    rhr_setting.rhr_sidebar_section(".sidebar-terms-of-service", 0, ".sidebar-terms-of-service");
    rhr_setting.rhr_sidebar_section(".events-news-top", 0, ".events-news-top");
    rhr_setting.rhr_sidebar_section(".client-cases-image", 0, ".client-cases-image");
    rhr_setting.rhr_sidebar_section(".successions-sidebar", 0, ".successions-sidebar",);
    rhr_setting.rhr_sidebar_section(".client-stories-sidebar", 0, ".client-stories-sidebar");
    rhr_setting.rhr_sidebar_section(".about-sidebar", 0, ".about-sidebar");
    rhr_setting.rhr_sidebar_section(".sidebar-our-clients", 0, ".sidebar-our-clients");
    rhr_setting.rhr_sidebar_nav();
  });

  var rhr_setting = {
    rhr_search_breadcumbs: function () {
      var $filter = $('.filters');
      var $btSearch = $filter.find('.i-search');
      var $modalSearch = $('.search-modal');
      if ($filter.length) {
        $btSearch.on('click', function () {
          $modalSearch.fadeIn(200).css('display', 'flex');
          $(this).addClass('active');
          $('.pages').addClass('open-search');
        });
      }
    },
    rhr_search_filter_class: function (search_field, search_result) {
      $(search_field).keyup(function (e) {
        var _this = $(this);
        if (_this.val().length != 0 && _this.val().length > 2) {
          _this.addClass("loading");
          $(search_result).show();
        } else {
          _this.removeClass("loading");
          $(search_result).hide();
        }
      });
    },
    rhr_search_filter: function (search_field, search_result) {
      $(search_field).keyup(function (e) {
        e.preventDefault();
        var _this = $(this),
          _s = _this.val(),
          _ajaxsearch = rhrSetting.ajax_url,
          _t = 'search',
          _a = "rhr_loading_post",
          _n = rhrSetting.rhr_nonce_setting,
          _page_id = rhrSetting.rhr_page_id,
          $search_post_type = $('.' + _page_id).find('.search-post-type'),
          $current_post_type = $search_post_type.length ? $search_post_type.val() : '',
          _item = _this.data("item"),
          data = {
            type: _t,
            action: _a,
            nonce: _n,
            search: _s,
            p_type: $current_post_type,
            item: _item,
          };
        if ($(this).hasClass("loading")) {
          $.ajax({
            url: _ajaxsearch,
            method: "post",
            data: data,
            beforeSend: function () {
              $(search_result).html(
                '<div class="search-result-loading"><div class="search-result-loading-inner"><span class="circle-1"></span><span class="circle-2"></span><span class="circle-3"></span><span class="circle-4"></span><span class="circle-5"></span></div></div>'
              );
            },
            success: function (response) {
              $(search_result).html(response);
            },
            error: function () {
              console.log("Oops! Something wrong, try again!");
            },
          });
          $(".s-close, .hmbrg.active").click(function () {
            $(".rhr-search").removeClass("loading");
            $(".search-action").trigger("reset");
            $(search_result).hide();

          });
          //Modal
          var $searchModal = $('.search-modal');
          var $btClose = $searchModal.find('.sm-close');
          var $btBackground = $searchModal.find('.sm-background');
          $btClose.click(function () {
            $(".rhr-search-modal").removeClass("loading");
            $(".search-global-action").trigger("reset");
            $(search_result).hide();
          });

          $btBackground.on('click', function () {
            $(".rhr-search-modal").removeClass("loading");
            $(".search-global-action").trigger("reset");
            $(search_result).hide();
          });
        }
        return false;
      });
    },
    rhr_download_form_toogle: function (button_wrap, button_class) {
      var $download = $(button_wrap),
        $btDownload = $download.find(button_class),
        $popupModal = $download.find('.successful-popup-wrap'),
        $popupClose = $download.find('.close-icon');
      if ($download.length) {

        $btDownload.on('click', function (e) {
          e.preventDefault();
          var _this = $(this),
            $popuplParent = _this.parent().find('.group-black-inputs'),
            $download_form = $popuplParent.find('.download_form'),
            $btClose = $popuplParent.find('.bt-close');

          $popuplParent.addClass('show-rhr-modal');
          $download_form.addClass('loading');

          $btClose.on('click', function () {
            $($popuplParent).removeClass('show-rhr-modal');
            $($download_form).removeClass('loading');
          });
        });
        $popupClose.on('click', function () {
          $($popupModal).removeClass('missing-popup');
        });
      }
    },
    rhr_download_pdf: function (d_click_class, d_message) {
      var $submitParent = $(d_click_class),
        $submitParentForm = $submitParent.find('.download_form'),
        $submitModal = $submitParent.find('.group-black-inputs'),
        $popupModal = $submitParent.find('#contactPopUp'),
        $submitError = $submitParent.find('.rhr-download-error'),
        $submitResult = $submitParent.find(d_message);
      $($submitParentForm).on('submit', function (e) {
        e.preventDefault();
        $('.d-error').removeClass('d-error');
        $('.has-error-invalidEmail').removeClass('has-error-invalidEmail');
        var _this = $(this),
          name = _this.find('#name').val(),
          email = _this.find('#email').val(),
          company = _this.find('#company').val(),
          nameId = _this.find('#name'),
          emailId = _this.find('#email'),
          companyId = _this.find('#company'),
          terms = _this.find('#popup-terms'),
          datato = _this.data('to'),
          datareply = _this.data('reply'),
          datamsg = _this.data('msg'),
          msgprefix = _this.data('msgprefix'),
          pdffile = _this.data('url'),
          datasuccess = _this.data('success'),
          dataempty = _this.data('empty'),
          dataerror = _this.data('error'),
          datasubject = _this.data('subject'),
          _ajax_form_url = rhrSetting.ajax_url,
          _t = 'download',
          _a = "rhr_download_pdf",
          _n = rhrSetting.rhr_nonce_setting,
          data = {
            type: _t,
            action: _a,
            nonce: _n,
            name: name,
            email: email,
            company: company,
            pdffile: pdffile,
            datato: datato,
            datareply: datareply,
            datamsg: datamsg,
            msgprefix: msgprefix,
            datasuccess: datasuccess,
            dataempty: dataempty,
            dataerror: dataerror,
            datasubject: datasubject,
          };
        if ($(this).hasClass("loading")) {
          var e_patt = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          if (name === '') {
            nameId.closest('.g-half').addClass('d-error');
            return;
          }
          if (email === '') {
            emailId.closest('.g-half').addClass('d-error');
            return;
          }
          if (!e_patt.test(String(email).toLowerCase())) {
            emailId.closest('.g-half').addClass('has-error-invalidEmail');
            return;
          }
          if (company === '') {
            companyId.closest('.g-half').addClass('d-error');
            return;
          }
          if (!$(terms).prop("checked")) {
            terms.closest('.g-half').addClass('d-error');
            return;
          }
          $.ajax({
            url: _ajax_form_url,
            method: "post",
            data: data,
            beforeSend: function () {

            },
            success: function (response) {
              var data = jQuery.parseJSON(response);
              var html = '';
              var file = '';
              if (data.status == 1) {
                html = data.msg;
                file = data.file;
                $($submitResult).html(html);

                if (file != '') {
                  var filename = file.substring(file.lastIndexOf('/') + 1);
                  var a = $("<a />");
                  a.attr("download", filename);
                  a.attr("href", file);
                  $("body").append(a);
                  a[0].click();
                  $("body").remove(a);
                }
                $($submitModal).removeClass('show-rhr-modal');
                $($submitParentForm).addClass('loading');
                $($submitParentForm).trigger("reset");
                setTimeout(function () {
                  $($popupModal).addClass('missing-popup');
                }, 1500);
              } else {
                html = data.msg;
                $($submitError).html(html);
              }
            },
            error: function () {
              console.log("Oops! Something wrong, try again!");
            },
          });
        }
        return false;
      });
    },
    rhr_download_form_toogle_black: function () {
      var $download = $('.gb-download'),
        $btDownload = $download.find('.b-download'),
        $download_form = $download.find('.download_form'),
        $btClose = $download.find('.bt-close'),
        $popupModal = $download.find('.successful-popup-wrap'),
        $popupClose = $download.find('.close-icon');

      if ($download.length) {

        $btDownload.on('click', function () {
          $download.addClass('show-inputs');
          $download_form.addClass('loading');
        });

        $btClose.on('click', function () {
          $download.removeClass('show-inputs');
          $download_form.removeClass('loading');
        });
        $popupClose.on('click', function () {
          $($popupModal).removeClass('missing-popup');
        });
      }
    },
    rhr_download_pdf_black: function (d_click_class, d_message) {
      var $submitParent = $(d_click_class),
        $submitParentForm = $submitParent.find('.download_form'),
        $popupModal = $submitParent.find('.successful-popup-wrap'),
        $popupModalClose = $submitParent.find('.rhr-form-close'),
        $submitError = $submitParent.find('.rhr-download-error'),
        $submitResult = $submitParent.find(d_message);

      $($submitParentForm).on('submit', function (e) {
        e.preventDefault();
        $('.d-error').removeClass('d-error');
        $('.has-error-invalidEmail').removeClass('has-error-invalidEmail');
        var _this = $(this),
          name = _this.find('#name').val(),
          email = _this.find('#email').val(),
          company = _this.find('#company').val(),
          nameId = _this.find('#name'),
          emailId = _this.find('#email'),
          companyId = _this.find('#company'),
          terms = _this.find('#popup-terms'),
          datato = _this.data('to'),
          datareply = _this.data('reply'),
          datamsg = _this.data('msg'),
          msgprefix = _this.data('msgprefix'),
          pdffile = _this.data('url'),
          datasuccess = _this.data('success'),
          dataempty = _this.data('empty'),
          dataerror = _this.data('error'),
          datasubject = _this.data('subject'),
          _ajax_form_url = rhrSetting.ajax_url,
          _t = 'download',
          _a = "rhr_download_pdf_black",
          _n = rhrSetting.rhr_nonce_setting,
          data = {
            type: _t,
            action: _a,
            nonce: _n,
            name: name,
            email: email,
            company: company,
            pdffile: pdffile,
            datato: datato,
            datareply: datareply,
            datamsg: datamsg,
            msgprefix: msgprefix,
            datasuccess: datasuccess,
            dataempty: dataempty,
            dataerror: dataerror,
            datasubject: datasubject,
          };
        if ($(this).hasClass("loading")) {
          var e_patt = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          if (name === '') {
            nameId.closest('.g-half').addClass('d-error');
            return;
          }
          if (email === '') {
            emailId.closest('.g-half').addClass('d-error');
            return;
          }
          if (!e_patt.test(String(email).toLowerCase())) {
            emailId.closest('.g-half').addClass('has-error-invalidEmail');
            return;
          }
          if (company === '') {
            companyId.closest('.g-half').addClass('d-error');
            return;
          }
          if (!$(terms).prop("checked")) {
            terms.closest('.g-half').addClass('d-error');
            return;
          }
          $.ajax({
            url: _ajax_form_url,
            method: "post",
            data: data,
            beforeSend: function () {

            },
            success: function (response) {
              var data = jQuery.parseJSON(response);
              var html = '';
              var file = '';
              if (data.status == 1) {
                html = data.msg;
                file = data.file;
                $($submitResult).html(html);
                if (file != '') {
                  var filename = file.substring(file.lastIndexOf('/') + 1);
                  var a = $("<a />");
                  a.attr("download", filename);
                  a.attr("href", file);
                  $("body").append(a);
                  a[0].click();
                  $("body").remove(a);
                }
                $($popupModalClose).trigger('click');
                $($submitParentForm).trigger("reset");
                setTimeout(function () {
                  $($popupModal).addClass('missing-popup');
                }, 1500);
              } else {
                html = data.msg;
                $($submitError).html(html);
              }
            },
            error: function () {
              console.log("Oops! Something wrong, try again!");
            },
          });
        }
        return false;
      });
    },
    rhr_sidebar_section: function (before_scroll_sec_class, offset_top_active, sidebar_active_class) {
      //offset_top_active (extra height to add active class on nav before show section)
      //sidebar_active_class (extra height to add nav class(sidebarNavIn))
      $('.menu-navigate').removeClass("sidebarNavIn");
      var topSec = $(before_scroll_sec_class);
      if (topSec.length) {
        var sections = [];
        var id = false;
        var $navbara = $(".scroll_menu_item");
        $navbara.each(function () {
          sections.push($($(this).attr("href")));
        });
        $(window).scroll(function (e) {
          var scrollTop = $(this).scrollTop() + $(window).height() / 2;
          for (var i in sections) {
            var section = sections[i];

            if (scrollTop > section.offset().top - offset_top_active) {
              var scrolled_id = section.attr("id");
            }
          }
          if (scrolled_id !== id) {
            id = scrolled_id;
            $($navbara).removeClass("active");
            $('.menu-navigate a[href="#' + id + '"]').addClass("active");
          }
        });
        if (!isNaN(sidebar_active_class)) {
          var change_color = sidebar_active_class;
        } else {
          var change_color = $(sidebar_active_class).outerHeight(true);
        }
        $(window).scroll(function () {
          $('.menu-navigate').removeClass("sidebarNavIn");
          var scrollDistance = $(window).scrollTop();
          $('.pc_section').each(function (i) {
            if ($(this).position().top <= scrollDistance - change_color) {
              $('.menu-navigate').removeClass("sidebarNavIn");
              if (i != 0) {
                $('.menu-navigate').addClass("sidebarNavIn");
              } else {
                $('.menu-navigate').removeClass("sidebarNavIn");
              }
            }
          });
        }).scroll();
      }
    },
    rhr_sidebar_nav: function () {
      $(window).scroll(function () {

        var target = $(window).scrollTop();
        var sidenavwrap = $('.sidenav-wrap');
        if (sidenavwrap.length) {
          var alturaA = $(sidenavwrap).offset().top;
          var alturaB = alturaA + $(sidenavwrap).height() - 32 - $('.menu-navigate').height();

          if (target > alturaB) {
            $('.menu-navigate').addClass('fixed');
            //$('.menu-navigate').css('align-items', 'center');
          } else if (target > alturaA && target < alturaB) {
            $('.menu-navigate').addClass('fixed');
            //$('.menu-navigate').css('align-items', 'center');
          } else {
            $('.menu-navigate').removeClass('fixed');
            //$('.menu-navigate').css('align-items', 'initial');
          }
        }
      });

      $(document).ready(function () {
        $(".scroll_menu_item").on('click', function (event) {
          if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;
            $('html, body').animate({
              scrollTop: $(hash).offset().top
            }, 800);
          }
        });
      });
    },
    rhr_contact_form: function () {
      $('#rhr_contact_form').on('submit', function (e) {
        e.preventDefault();
        $(this).find('.c-error').removeClass('c-error');
        $(this).find('.has-invalidEmail').removeClass('has-invalidEmail');
        $(this).find('.has-minimum-words').removeClass('has-minimum-words');
        $(this).find('.has-maximum-words').removeClass('has-maximum-words');
        var _this = $(this),
          error = false,
          name = _this.find('#name').val(),
          nameId = _this.find('#name'),
          email = _this.find('#email').val(),
          emailId = _this.find('#email'),
          company = _this.find('#company').val(),
          companyId = _this.find('#company'),
          jobtitle = _this.find('#jobtitle').val(),
          jobtitleId = _this.find('#jobtitle'),
          phone = _this.find('#phone').val(),
          phoneId = _this.find('#phone'),
          country = _this.find('#country').val(),
          countryId = _this.find('#country'),
          message = _this.find('#message').val(),
          messageId = _this.find('#message'),
          terms = _this.find('#contact-terms'),
          _ajax_form_url = rhrSetting.ajax_url,
          captcha = grecaptcha.getResponse(),
          captchaId = _this.find('.g-recaptcha'),
          secret = _this.find('.secret-key').data('secret'),
          _t = 'get-in-touch',
          _a = "rhr_contact_send",
          _n = rhrSetting.rhr_nonce_setting,
          data = {
            type: _t,
            action: _a,
            nonce: _n,
            name: name,
            email: email,
            company: company,
            phone: phone,
            country: country,
            jobtitle: jobtitle,
            message: message,
            captcha: captcha,
            secret: secret,
          };
        var e_patt = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (name.length == 0 || name == "" || name == " ") {
          var error = true;
          nameId.closest('.group').addClass('c-error');
          _this.find('.c-error .contact-error-msg').slideDown('slow');
        } else {
          nameId.closest('.group').addClass('c-valid');
          _this.find('.c-valid .contact-error-msg').slideUp('slow');
        }
        if (company.length == 0 || company == "" || company == " ") {
          var error = true;
          companyId.closest('.group').addClass('c-error');
          _this.find('.c-error .contact-error-msg').slideDown('slow');
        } else {
          companyId.closest('.group').addClass('c-valid');
          _this.find('.c-valid .contact-error-msg').slideUp('slow');
        }
        if (jobtitle.length == 0 || jobtitle == "" || jobtitle == " ") {
          var error = true;
          jobtitleId.closest('.group').addClass('c-error');
          _this.find('.c-error .contact-error-msg').slideDown('slow');
        } else {
          jobtitleId.closest('.group').addClass('c-valid');
          _this.find('.c-valid .contact-error-msg').slideUp('slow');
        }
        if (email.length == 0 || email == "" || email == " ") {
          var error = true;
          emailId.closest('.group').addClass('c-error');
          _this.find('.c-error .contact-error-msg').slideDown('slow');
        } else if (!e_patt.test(String(email).toLowerCase())) {
          var error = true;
          emailId.closest('.group').addClass('has-invalidEmail');
          _this.find('.has-invalidEmail .contact-invalidemail-error-msg').slideDown('slow');
        } else {
          emailId.closest('.group').addClass('c-valid');
          _this.find('.c-valid .contact-error-msg').slideUp('slow');
          _this.find('.c-valid .contact-invalidemail-error-msg').slideUp('slow');
          _this.find('.has-invalidEmail .contact-error-msg').slideUp('slow');
          _this.find('.has-invalidEmail .contact-invalidemail-error-msg').slideUp('slow');
        }
        if (message.length == 0 || message == "" || message == " ") {
          var error = true;
          messageId.closest('.group').addClass('c-error');
          _this.find('.c-error .contact-error-msg').slideDown('slow');
        }
        else if (message.split(' ').length < 1) {
          var error = true;
          messageId.closest('.group').addClass('has-minimum-words');
          _this.find('.has-minimum-words .contact-min-msg').slideDown('slow');
        } else if (message.split(' ').length > 100) {
          var error = true;
          messageId.closest('.group').addClass('has-maximum-words');
          _this.find('.has-maximum-words .contact-max-msg').slideDown('slow');
        } else {
          messageId.closest('.group').addClass('c-valid');
          _this.find('.c-valid .contact-error-msg').slideUp('slow');
          _this.find('.c-valid .contact-min-msg').slideUp('slow');
          _this.find('.c-valid .contact-max-msg').slideUp('slow');
        }
        if (!$(terms).prop("checked")) {
          var error = true;
          terms.closest('.group').addClass('c-error');
        }
        if (captcha.length == 0 || captcha == "" || captcha == " ") {
          var error = true;
          captchaId.closest('.group').addClass('c-error');
          _this.find('.c-error .contact-error-msg').slideDown('slow');
        } else {
          captchaId.closest('.group').addClass('c-valid');
          _this.find('.c-valid .contact-error-msg').slideUp('slow');
        }
        if (error == true) {
          _this.find('#err-form').slideDown('slow');
        } else {
          _this.find('#err-form').slideUp('slow');
        }
        if (error == false) {
          $.ajax({
            url: _ajax_form_url,
            method: "post",
            data: data,
            beforeSend: function () {

            },
            success: function (response) {
              var data = jQuery.parseJSON(response);
              var html = '';
              if (data.status == 1) {
                _this.find('.send-message').attr({ 'disabled': 'true' });
                html = data.msg;
                _this.find('#contact-message').html(html);
                _this.find('#contact-message').slideDown("slow");
                _this.trigger("reset");
                grecaptcha.reset();
                setTimeout(function () {
                  _this.find('.send-message').attr({ 'disabled': 'false' });
                  _this.find('#contact-message').addClass('hide-contact-msg');
                  _this.find('.hide-contact-msg').slideUp('slow');
                }, 10000);
              } else {
                html = data.msg;
                _this.find('#contact-message').html(html);
              }
            },
            error: function () {
              console.log("Oops! Something wrong, try again!");
            },
          });
        }
        return false;
      });
    },
    rhr_mailchimp: function () {
      if ($(".newslatter").length > 0) {
        $(".newslatter").each(function () {
          var _this = $(this),
            _mailchimp_api = _this.data("api");
          $(".newslatter").ajaxChimp({
            callback: rhr_setting.rhr_mailchimpcallback,
            url: _mailchimp_api,
          });
        });
      }
      $(".currect_email").on("focus", function () {
        $(".mchimp-errmessage").fadeOut();
        $(".mchimp-sucmessage").fadeOut();
      });
      $(".currect_email").on("keydown", function () {
        $(".mchimp-errmessage").fadeOut();
        $(".mchimp-sucmessage").fadeOut();
      });
      $(".currect_email").on("click", function () {
        $(".currect_email").val("");
      });
    },
    rhr_mailchimpcallback: function (resp) {
      if (resp.result === "success") {
        $(".mchimp-errmessage").html(resp.msg).fadeIn(1000);
        $(".mchimp-sucmessage").fadeOut(500);
      } else if (resp.result === "error") {
        $(".mchimp-errmessage").html(resp.msg).fadeIn(1000);
      }
    },
    _push_equal_height: function () {
      var equal_height = $('.equal_height');
      var heights = new Array();

      equal_height.each(function (index, post) {

        var height = $(post).outerHeight();

        heights.push(height);

      });

      var maxHeight = Math.max.apply(null, heights);

      equal_height.css("height", maxHeight + "px");
    }
  };

  $("body").click(function () {
    $(".popup_body").removeClass("popup_body_show");
    $(".download-popup").removeClass("show-rhr-modal");
  });
  var $menuNav = $('.menu-navigate');
  if ($menuNav.length) {
    var $elem = $('.footer');

    var _scrollTop = null;
    var _offTop = null;
    var _offBtm = null;
    var _sizeScroll = null;

    setTimeout(function () {
      _offTop = $menuNav.offset().top;
      _offBtm = ($elem.offset().top + 40) - $menuNav.outerHeight();
      _sizeScroll = $(document).height() - $(window).height() - $elem.outerHeight() - $menuNav.offset().top;

      $(window).on('resize', function () {
        _offTop = $menuNav.offset().top;
        _offBtm = ($elem.offset().top + 40) - $menuNav.outerHeight();
        _sizeScroll = $(document).height() - $(window).height() - $elem.outerHeight() - $menuNav.offset().top;
      });

      $(window).on('scroll', function (e) {
        _scrollTop = $(window).scrollTop();
        var _barPercent = ((_scrollTop - _offTop) * 100) / _sizeScroll;
        $('.l-bar').css('height', _barPercent + '%');
      });
    }, 100);
  }
  rhr_cookie_popup();
  function rhr_cookie_popup() {
    var $manage_content = $('.manage-content');
    if ($manage_content.length > 0) {
      $(".manage-content").click(function () {
        $(".rhr-cookies").addClass("show-cookie");
      });

      $(".btn-accept, .btn-preference").on("click", function (e) {
        $(".rhr-cookies").removeClass("show-cookie");
      });
      var $default_popup = rhr_get_cookie('rhr_cookies');
      if (!$default_popup) {
        $(".rhr-cookies").addClass("show-cookie");
      }
    }
  }
  var $cookieName = "rhr_cookies",
    $cookieValue = "allowed",
    $cookieFunctional = "rhr_cookies_functional",
    $cookieStatistics = "rhr_cookies_statistics",
    $cookieMarketing = "rhr_cookies_marketing",
    $checked_function = $('#functional'),
    $checked_statistics = $('#statistics'),
    $checked_marketing = $('#marketing'),
    $cookieExpireDays = 30,
    $acceptCookie = document.getElementById("rhrAcceptCookie");
  if ($("#rhrAcceptCookie").length > 0) {
    $acceptCookie.onclick = function () {
      rhr_create_cookie($cookieName, $cookieValue, $cookieExpireDays);
      if ($checked_function.length > 0) {
        if ($($checked_function).is(":checked")) {
          rhr_create_cookie($cookieFunctional, $cookieValue, $cookieExpireDays);
        } else {
          rhr_create_cookie($cookieFunctional, 'notallowed', $cookieExpireDays);
        }
      }
      if ($checked_statistics.length > 0) {
        if ($($checked_statistics).is(":checked")) {
          rhr_create_cookie($cookieStatistics, $cookieValue, $cookieExpireDays);
        } else {
          rhr_create_cookie($cookieStatistics, 'notallowed', $cookieExpireDays);
        }
      }
      if ($checked_marketing.length > 0) {
        if ($($checked_marketing).is(":checked")) {
          rhr_create_cookie($cookieMarketing, $cookieValue, $cookieExpireDays);
        } else {
          rhr_create_cookie($cookieMarketing, 'notallowed', $cookieExpireDays);
        }
      }
    }
  }
  function rhr_create_cookie(cookieName, cookieValue, cookieExpireDays) {
    var currentDate = new Date();
    currentDate.setTime(currentDate.getTime() + (cookieExpireDays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + currentDate.toGMTString();
    document.cookie = cookieName + "=" + cookieValue + ";" + expires + ";path=/";
  }

  function rhr_get_cookie(cookieName) {
    if (typeof document === "undefined") {
      return "";
    }
    var name = cookieName + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

  function rhr_check_cookie() {
    var $check = rhr_get_cookie($cookieName),
      $checkFunction = rhr_get_cookie($cookieFunctional),
      $checkStatistics = rhr_get_cookie($cookieStatistics),
      $checkMarketing = rhr_get_cookie($cookieMarketing);
    if ($checkFunction != '' && $checkFunction == 'allowed') {
      $($checked_function).attr({ 'checked': 'true' });
    }
    if ($checkStatistics != '' && $checkStatistics == 'allowed') {
      $($checked_statistics).attr({ 'checked': 'true' });
    }
    if ($checkMarketing != '' && $checkMarketing == 'allowed') {
      $($checked_marketing).attr({ 'checked': 'true' });
    }
  }
  rhr_check_cookie();
  // video
  var succs_video = $("#video-playpause");
  if (succs_video.length > 0) {
    succs_video.addEventListener("click", function (event) {
      $(succs_video).addClass('playpause-button play-button');
      if (succs_video.paused) {
        succs_video.play();
        $(succs_video).removeClass('play-button');
      } else {
        succs_video.pause();
      }
    }, false);
  }
})(jQuery);
