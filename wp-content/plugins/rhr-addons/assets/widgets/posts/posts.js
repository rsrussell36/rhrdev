/*Blog Post Handler*/(function ($) {
    "use strict";
    var WidgetBlogPostHandler = function ($scope, $) {
        var $blogElement = $scope.find(".elementor-rhr-posts .rhr_blog-grid"),
            $blogAppend = $scope.find(".app-posts"),
            $blogPost = $blogElement.find(".rhr_blog_item"),
            pagination = $blogElement.data("pagination"),
            pagiajax = $blogElement.data("pagiajax"),
            pushHeight = $blogElement.data("equal"),
            scrollAfter = $blogElement.data("scroll"),
            onScroll = $blogElement.data("onscroll"),
            total = $blogPost.data('total'),
            activeCategory = $scope.find(".category.active").data("filter"),
            filterTabs = $blogElement.data("filter"),
            count = 2,
            isLoaded = true,
            page_number = 1;
        if (pagination && pagiajax) {
            $scope.on("click", ".elementor-rhr-posts .page-numbers", function (e) {
                e.preventDefault();
                if ($(this).hasClass("current")) return;
                var currentPage = parseInt($scope.find(".elementor-rhr-posts .page-numbers.current").html());
                if ($(this).hasClass("next")) {
                    page_number = currentPage + 1;
                } else if ($(this).hasClass("prev")) {
                    page_number = currentPage - 1;
                } else {
                    page_number = $(this).html();
                }
                _get_ajax_posts(scrollAfter);
            });
        }
        if (filterTabs) {
            $scope.find(".category").click(function (e) {

                e.preventDefault();

                $scope.find(".category.active").removeClass("active");

                $(this).addClass("active");

                //Get clicked tab slug
                activeCategory = $(this).attr("data-filter");

                page_number = 1;

                if (onScroll) {
                    _get_ajax_posts(false);
                    count = 2;
                    _get_on_scroll_posts();
                } else {
                    //Make sure to reset pagination before sending our AJAX request
                    _get_ajax_posts(scrollAfter);
                }

            });
            if ( $(window).width() < 426 ) {
                $scope.find(".tab-slider-ietms").addClass('owl-carousel');
                $scope.find(".tab-slider-ietms").parent().addClass('tab-before');
                $scope.find(".owl-carousel").owlCarousel({
                    loop:true,
                    margin:0,
                    responsiveClass:true,
                    nav: true,
                    autoplay: false,
                    responsive:{
                        0:{
                            items:2,
                            nav:true
                        },
                        600:{
                            items:2,
                            nav:false
                        },
                        1000:{
                            items:10,
                            nav:true,
                            loop:false
                        }
                    }
                });
            }
        }
        if (!filterTabs || "*" === activeCategory) {

        } else {
            //If `All` categories not exist, then we need to get posts through AJAX.
            _get_ajax_posts(false);
        }



        if (pushHeight) {
            _pushEqualHeight();
        }
        function _pushEqualHeight() {

            var heights = new Array();

            $blogElement.find(".rhr_blog_item").each(function (index, post) {

                var height = $(post).outerHeight();

                heights.push(height);

            });

            var maxHeight = Math.max.apply(null, heights);

            $blogElement.find(".rhr_blog_item").css("height", maxHeight + "px");
        }
        if (onScroll) {
            _get_on_scroll_posts();
        }
        function _get_on_scroll_posts() {
            var windowHeight = jQuery(window).outerHeight() / 1.25;

            $(window).scroll(function () {

                if (filterTabs) {
                    $blogPost = $blogElement.find(".rhr_blog_item");
                    total = $blogPost.data('total');
                }


                if (count <= total) {
                    if (($(window).scrollTop() + windowHeight) >= ($scope.find('.elementor-rhr-posts .rhr_blog-grid .rhr_blog_item:last').offset().top)) {
                        if (true == isLoaded) {
                            page_number = count;
                            _get_ajax_posts(false);
                            count++;
                            isLoaded = false;
                        }
                    }
                }
            });
            return !1;
        }
        function _get_ajax_posts(shouldScroll) {
            if ('undefined' === typeof activeCategory) {
                activeCategory = '*';
            }

            $.ajax({
                url: rhr_ajax_url,
                dataType: 'json',
                type: 'POST',
                data: {
                    action: "posts_ajax_action",
                    page_id: $blogElement.data("page"),
                    widget_id: $scope.data("id"),
                    page_number: page_number,
                    category: activeCategory,
                    nonce: rhr_ajax_nonce
                },
                beforeSend: function () {
                    if (shouldScroll) {
                        $('html, body').animate({
                            scrollTop: (($blogElement.offset().top) - 50)
                        }, 'slow');
                    }
                },
                success: function (response) {
                    if (!response.data) return;
                    var posts = response.data.posts,
                        paging = response.data.paging;
                    if (onScroll) {
                        isLoaded = true;
                        if (filterTabs && page_number === 1) {
                            $blogElement.html(posts);
                        } else {
                            $blogElement.append(posts);
                        }
                    } else {
                        $blogAppend.html(posts);
                        $scope.find(".rhr-pagination").html(paging);
                    }
                    $('[data-cursor="scale"]').on("mouseenter", function () {
                        $('.cursor').addClass("m-scale");
                      });
                      $('[data-cursor="scale"]').on("mouseleave", function () {
                  $('.cursor').removeClass("m-scale");
                      });
                    var $elem = $blogElement.find('.rhr-animation');

                    $elem.each(function () {
                        var $singleElement = $(this);

                        // Get data-attr from element
                        var animateTrans = $singleElement.data('trans') ? $singleElement.data('trans') : 'fadeIn';
                        var animateDelay = $singleElement.data('delay') ? $singleElement.data('delay') : '';
                        var animateDuration = $singleElement.data('duration') ? $singleElement.data('duration') : '';

                        if (animateDelay != '') {
                            $singleElement.css('animation-delay', animateDelay);
                        }

                        if (animateDuration != '') {
                            $singleElement.css('animation-duration', animateDuration);
                        }

                        if ($singleElement.hasClass('animated ' + animateTrans)) return;
                        $singleElement.css('opacity', '1').addClass('animated ' + animateTrans);


                    });
                },
                error: function (error) {
                    console.log(error);
                },
            });
            return !1;
        }

    };
    added_pagination_class();
    function added_pagination_class() {
        $('.elementor-rhr-posts .rhr-pagination .page-numbers').addClass('arrow a-hide a-prev svg');
    }
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/rhr-posts.default', WidgetBlogPostHandler);
    });

})(jQuery);
