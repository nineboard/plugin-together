$(function() {
    //$('.main_slide').hide();
    //$('.category_area').hide();
    //
    //$('.sidebar').hide();

    //$('.btn_menu').bind('click', function(e) {
    //    $('#wrap').toggleClass('menu_on');
    //
    //    if ($('#wrap').has('menu_on')) {
    //        $('#container').removeClass('search_on');
    //        $('.area_search').hide();
    //    }
    //});
    //$('.btn_search').bind('click', function(e) {
    //    $('#container').toggleClass('search_on');
    //    $('.area_search').toggle();
    //
    //    if ($('#container').has('search_on')) {
    //        $('#wrap').removeClass('menu_on');
    //    }
    //});

    function menuToggle()
    {
        $('#wrap').toggleClass('menu_on');
        $('.btn_menu').toggleClass('btn_menu_off');

        if ($('#wrap').has('menu_on')) {
            $('#container').removeClass('search_on');
            $('.area_search').hide();
        }
    }

    function searchToggle()
    {
        $('#container').toggleClass('search_on');
        $('.area_search').toggle();

        if ($('#container').has('search_on')) {
            $('#wrap').removeClass('menu_on');
        }
    }

    $('body').bind('click', function (e) {
        var $target = $(e.target);
        if ($target.closest('.btn_menu').length > 0) {
            $('.area_sidebar').show();
            $('.area_popup').hide();
            $('body').css('overflow', 'hidden');
        } else if ($target.closest('.btn_search').length > 0) {
            $('.area_sidebar').hide();
            $('.area_popup').show();
            $('body').css('overflow', 'hidden');
        } else if ($target.closest('.inner_sidebar').length == 0 && $target.closest('.area_popup').length == 0) {
            $('.area_sidebar').hide();
            $('.area_popup').hide();
            $('body').css('overflow', '');
        }
    });

    $('.btn_close').on('click', function () {
        $('.area_sidebar').hide();
        $('.area_popup').hide();
        $('body').css('overflow', '');
    });

    // $('.btn_search').on('click', function () {
    //     $('.area_sidebar').hide();
    //     $('.area_popup').show();
    //     $('body').css('overflow', 'hidden');
    // });
    //
    // $('.btn_menu').on('click', function () {
    //     $('.area_sidebar').show();
    //     $('.area_popup').hide();
    //     $('body').css('overflow', 'hidden');
    // });
    //
    // $('.btn_close').on('click', function () {
    //     $('.area_sidebar').hide();
    //     $('.area_popup').hide();
    //     $('body').css('overflow', '');
    // });
});
