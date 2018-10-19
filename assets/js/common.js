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
        $('#wrap').toggleClass('menu-open');
        $('.btn-menu').toggleClass('btn-menu-off');

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
        if ($target.closest('.btn-menu').length > 0) {
            menuToggle();
        } else if ($target.closest('.btn_search').length > 0) {
            searchToggle();
        } else if ($target.closest('.area_search').length == 0 && $target.closest('.area_menu').length == 0) {
            $('#wrap').removeClass('menu-open');
            $('.btn-menu').removeClass('btn_menu_off');
            $('#container').removeClass('search_on');
            $('.area_search').hide();
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
