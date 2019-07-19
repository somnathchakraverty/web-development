var theToggle = document.getElementById('toggle');

// based on Todd Motto functions
// http://toddmotto.com/labs/reusable-js/

// hasClass
function hasClass(elem, className) {
    return new RegExp(' ' + className + ' ').test(' ' + elem.className + ' ');
}
// addClass
function addClass(elem, className) {
    if (!hasClass(elem, className)) {
        elem.className += ' ' + className;
    }
}
// removeClass
function removeClass(elem, className) {
    var newClass = ' ' + elem.className.replace(/[\t\r\n]/g, ' ') + ' ';
    if (hasClass(elem, className)) {
        while (newClass.indexOf(' ' + className + ' ') >= 0) {
            newClass = newClass.replace(' ' + className + ' ', ' ');
        }
        elem.className = newClass.replace(/^\s+|\s+$/g, '');
    }
}
// toggleClass
function toggleClass(elem, className) {
    var newClass = ' ' + elem.className.replace(/[\t\r\n]/g, " ") + ' ';
    if (hasClass(elem, className)) {
        while (newClass.indexOf(" " + className + " ") >= 0) {
            newClass = newClass.replace(" " + className + " ", " ");
        }
        elem.className = newClass.replace(/^\s+|\s+$/g, '');
    } else {
        elem.className += ' ' + className;
    }
}

// theToggle.onclick = function() {
//    toggleClass(this, 'on');
//    return false;
// }

(function($) {
    $(window).load(function() {
        $(document).scroll(function() {
            var y = $(this).scrollTop();
            if (y > 642) {
                $('#top-fixed-header').fadeIn();
                $(".popular-pkg-wrap-main").fadeOut();
                $('#toggle').removeClass('on');

            } else {
                if (y < 642) {
                    $('#toggle_head').removeClass('on');
                    $('#top-fixed-header').fadeOut();
                    $('.pop-scroll-pkg-wrap').fadeOut();
                    $(".popular-pkg-wrap").fadeIn();
                }
            }

            $(".tags").click(function() {
                $(".pop-scroll-pkg-wrap").fadeIn();
                $(".popular-pkg-wrap-main").fadeIn();
            });

        });
    });

    $(function() {
        $(document).on('click', '#toggle', function() {
            if ($(this).hasClass('on')) {
                $(this).removeClass('on');
            } else {
                $(this).addClass('on');
            }
            return false;
        });

        $(document).on('click', '#menu a', function() {
            $('#toggle').removeClass('on');
            return true;
        });

        $(document).on('click', '#toggle_head', function() {
            if ($(this).hasClass('on')) {
                $(this).removeClass('on');
            } else {
                $(this).addClass('on');
            }
            return false;
        });

        $(document).on('click', '#menu_head a', function() {
            $('#toggle_head').removeClass('on');
            return true;
        });

        $(document).on('click', 'body', function() {
            $('#toggle').removeClass('on');
            $('#toggle_head').removeClass('on');
        });
    });

    ///////////////////video///////////////////

    $(document).ready(function() {
        // Resive video
        scaleVideoContainer();
        initBannerVideoSize('.video-container .poster img');
        initBannerVideoSize('.video-container .filter');
        initBannerVideoSize('.video-container video');
        $(window).on('resize', function() {
            scaleVideoContainer();
            scaleBannerVideoSize('.video-container .poster img');
            scaleBannerVideoSize('.video-container .filter');
            scaleBannerVideoSize('.video-container video');
        });
        //}); 
    });
    /** Reusable Functions **/
    /********************************************************************/
    function scaleVideoContainer() {
        var height = $(window).height();
        var unitHeight = parseInt(height) + 'px';
        $('.homepage-hero-module').css('height', unitHeight);
    }

    function initBannerVideoSize(element) {
        $(element).each(function() {
            $(this).data('height', $(this).height());
            $(this).data('width', $(this).width());
        });
        scaleBannerVideoSize(element);
    }

    function scaleBannerVideoSize(element) {
        var windowWidth = $(window).width(),
            windowHeight = $(window).height();

        $(element).each(function() {
            var videoAspectRatio = $(this).data('height') / $(this).data('width'),
                windowAspectRatio = windowHeight / windowWidth;
            if (videoAspectRatio > windowAspectRatio) {
                videoWidth = windowWidth;
                videoHeight = videoWidth * videoAspectRatio;
                $(this).css({ 'top': -(videoHeight - windowHeight) / 2 + 'px', 'margin-left': 0 });
            } else {
                videoHeight = windowHeight;
                videoWidth = videoHeight / videoAspectRatio;
                $(this).css({ 'margin-top': 1, 'margin-left': -(videoWidth - windowWidth) / 2 + 'px' });
            }
            $(this).width(videoWidth).height(videoHeight);
            $('.homepage-hero-module .video-container video').addClass('fadeIn animated');

        });
    }

})(jQuery);
