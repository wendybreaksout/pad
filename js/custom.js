jQuery(document).ready( function( $ ) {


  var hideHeaderThreshold = 450;
  var desktopViewBreakpoint = 1080;
  var currentPathname = window.location.pathname;
  var viewWidth = window.outerWidth;
  var shortHeaderHeightDesktop = '60px';
  var shortHeaderHeightMobile = '85px';

  var shortHeaderHeight = shortHeaderHeightMobile;

  if ( viewWidth >= desktopViewBreakpoint) {
      shortHeaderHeight = shortHeaderHeightDesktop;
  }

  var tallHeaderHeight = '165px';

  $('#home-blog-grid article').addClass('hoverable');

  $('.pad-featured-article').enllax();


  $('#pad-logo').show();

  if ( viewWidth >= desktopViewBreakpoint ) {
      $('.pad-icon-container .et-social-icons').show();
  }


    $(window).scroll( function( ){

        var pos = $(window).scrollTop();

        if ( pos >  hideHeaderThreshold ) {
            // scrolled down the page.
            $('.pad-icon-container .et-social-icons').hide();
            $('#pad-logo').hide();
            if ( $('#top-header').data('height-status') !== 'short' ) {
                $('#top-header').animate( {'height': shortHeaderHeight });
                $('#top-header').data('height-status', 'short');
            }
        }
        else {
            // at the top of the page
            $('#pad-logo').show();

            if ( window.outerWidth >= desktopViewBreakpoint ) {
                $('.pad-icon-container .et-social-icons').show();

                if ( $('#top-header').data('height-status') === 'short' ) {
                    $('#top-header').animate( {'height': tallHeaderHeight });
                    $('#top-header').data('height-status', 'tall');

                }
            }

        }

    });

    $(window).resize( function() {
        if ( window.outerWidth < desktopViewBreakpoint ) {
            $('.pad-icon-container .et-social-icons').hide();

            var pos = $(window).scrollTop();
            shortHeaderHeight = shortHeaderHeightMobile;
            $('#top-header').height( shortHeaderHeight );


        }
        else {

            shortHeaderHeight = shortHeaderHeightDesktop;

            var pos = $(window).scrollTop();
            if ( pos <= hideHeaderThreshold ) {
                $('.pad-icon-container .et-social-icons').show();
                $('#top-header').height( tallHeaderHeight );
            }

        }
    });

    // Show/hide top header when menu button pressed
    $('#responsive-menu-pro-button').click( function () {
        $('#top-header').toggle();
    });







    $('.pad-mask').hover(
        function() {
           var icon_name = $( this ).data('icon-name');
           $( this ).append('<div class="pad-animate animated slideInUp"><i class="fa fa-' + icon_name + '"></i></div>');

  },
        function() {
          $('.pad-animate').remove('');

  });




});


