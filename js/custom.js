
(function($) {
    "use strict"; // Start of use strict

    // Pre-loader
    $(window).load(function(){
        $('#preloader').fadeOut('slow',function(){
            $(this).remove();
            $('.animated-greeting-text').animate({'left': '50%'}, 'slow');
        });
    });

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




})(jQuery); // End of use strict