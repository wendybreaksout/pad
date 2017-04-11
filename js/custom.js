
(function($) {
    "use strict"; // Start of use strict

    // Pre-loader
    $(window).load(function(){
        $('#preloader').fadeOut('slow',function(){
            $(this).remove();
            $('.animated-greeting-text').animate({'left': '50%'}, 'slow');
        });
    });

    // Set up pad model click on close event handlers
    var closeOnClickSelector = $('#padModal').data('close-on-click');
    $( closeOnClickSelector).click( function() {
            $('#padModal').modal('hide');
    });



    // Modal auto display/display only so often 
    var modalAutoDisplay = ( $('#padModal').data('auto-display') == true );
    if ( modalAutoDisplay) {

        // See if modal has display interval(i). If so, only display every i days.
        // Check for cookie set.
        var modalDelayCookieName = $('#padModal').data('delay-cookie-name');
        var modalDisplayInterval = parseInt( $('#padModal').data('display-interval') );

        if ( modalDelayCookieName != undefined ) {
            var modalDelayCookieValue = Cookies.get( modalDelayCookieName );
            if ( modalDelayCookieValue == undefined ) {
                // No cookie set, set it and display modal
                Cookies.set( modalDelayCookieName, 'true', { expires: modalDisplayInterval });

                var modalDisplayDelay = parseInt( $('#padModal').data('auto-display-delay') );

                var displayInterval = setInterval( function() {
                    $('#padModal').modal('show');
                    clearInterval( displayInterval );
                }, modalDisplayDelay * 1000 );
            }

        }
    }


   // Hover caption effect
    $('.pad-hover-caption-container').hover( function() {
            $( this ).find('span.pad-hover-caption').css('opacity', '1');
            $( this ).find('.pad-onsale').css('opacity', '0');

        },
        function(){
            $( this ).find('span.pad-hover-caption').css('opacity', '0');
            $( this ).find('.pad-onsale').css('opacity', '1');
        });


    // Start carousel

    $('.pad-product-carousel').slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 5,
        arrows: true,
        mobileFirst: true,
        centerMode: true,
        centerPadding: 0,
        dots: true,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    dots: true
                }
            },
            {
                breakpoint: 995,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                }
            },
            {
                breakpoint: 650,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 450,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 300,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }

            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

    // End carousel


    /*
     * Set fillwidth or fillheight on card images based on image aspect ratio relative
     * to that of the container.
    */

    setImageFillPolicy();

    $(window).resize(function() {
        setImageFillPolicy();
    });

    function setImageFillPolicy(){

        $('.pad-product-hover-slide, .pad-product-horizontal-hover-slide').each( function( idx,elem ) {
            var cntnrHeight = $(this).height();
            var cntnrWidth = $(this).width();

            var topImage = $(this).find('img.product-image-top');
            var bottomImage = $(this).find('img.product-image-bottom');

            var imgHeight = $(topImage).data('height');
            var imgWidth = $(topImage).data('width');

            var cntnrAR = cntnrWidth / cntnrHeight ;
            var imgAR = imgWidth / imgHeight ;

            var fillClass = 'fillwidth';
            if ( imgAR > cntnrAR ) {
                fillClass = 'fillheight';
            }
            

            $( topImage ).removeClass( 'fillheight');
            $( topImage ).removeClass( 'fillwidth');


            $(topImage).addClass( fillClass );


            var imgHeight = $(bottomImage).data('height');
            var imgWidth = $(bottomImage).data('width');
            var imgAR = imgWidth / imgHeight ;

            var fillClass = 'fillwidth';
            if ( imgAR > cntnrAR ) {
                fillClass = 'fillheight';
            }



            $( bottomImage ).removeClass( 'fillheight');
            $( bottomImage ).removeClass( 'fillwidth');
            $(bottomImage).addClass( fillClass );


        });



        $('.pad-featured-article-image').each( function( idx,elem ) {
            var cntnrHeight = $(this).height();
            var cntnrWidth = $(this).width();

            var imageElem = $( this ).find('img');

            var imgHeight = $( imageElem ).data('height');
            var imgWidth = $( imageElem ).data('width');

            var cntnrAR = cntnrWidth / cntnrHeight ;
            var imgAR = imgWidth / imgHeight ;


            var fillClass = 'fillwidth';
            if ( imgAR > cntnrAR ) {
                fillClass = 'fillheight';
            }


            $( imageElem ).removeClass( 'fillheight');
            $( imageElem ).removeClass( 'fillwidth');

            $( imageElem ).addClass( fillClass );
           
        });

    }





    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 51
    });

    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function(){
        $('.navbar-toggle:visible').click();
    });

    // Close mobile menu when user clicks elsewhere.
    $(document).click(function (event) {
        var clickover = $(event.target);
        var _opened = $(".navbar-collapse").hasClass("collapse in");
        if (_opened === true && !clickover.hasClass("navbar-toggle")) {
            $("button.navbar-toggle").click();
        }
    });

    // Offset for Main Navigation
    $('#site-navigation').affix({
        offset: {
            top: padThemeObjects.configuration.navAffixScrollThreshold
        }
    });

    $('.pad-mask').hover(
        function() {
            var icon_name = $( this ).data('icon-name');
            $( this ).append('<div class="pad-animate animated slideInUp"><i class="fa fa-' + icon_name + '"></i></div>');

        },
        function() {
            $('.pad-animate').remove('');

    });

    $('.pad-card-group').matchHeight();

    // Show/hide scroll to top icon, language swither
    $(window).scroll( function( ) {

        var pos = $(window).scrollTop();
        if (pos > (2 * window.innerHeight)) {
            $('.scroll-to-top').show();
        }
        else {
            $('.scroll-to-top').hide();
        }
    });

    // Sticky content
    $(function () {
        $(".sticky-top").sticky({
            topSpacing: 90,
            bottomSpacing: 470
        });
    });





    })(jQuery); // End of use strict