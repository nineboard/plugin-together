
/* global $ */

$(function () {
  var $wrapMain = $('.wrap-main')
  var $headerTfc = $('.header-tfc', $wrapMain)

  if ($wrapMain.length) {
    var onScroll = false
    window.addEventListener('scroll', function (e) {
      var scrollTop = $(document).scrollTop()
      if (!onScroll && scrollTop > 10) {
        onScroll = true
        $headerTfc.addClass('header-main-tfc')
      } else if (onScroll && scrollTop <= 10) {
        onScroll = false
        $headerTfc.removeClass('header-main-tfc')
      }
    })
  }

  /* 메뉴 토글 */
  function menuToggle () {
    $('#wrap').toggleClass('menu-open')
    $('.btn-menu').toggleClass('btn-menu-off')

    if ($('#wrap').has('menu_on')) {
      $('#container').removeClass('search_on')
      $('.area_search').hide()
    }
  }

  $('body').bind('click', function (e) {
    var $target = $(e.target)
    if ($target.closest('.btn-menu').length > 0) {
      menuToggle()
    } else if ($target.closest('.btn_search').length > 0) {
      searchToggle()
    } else if ($target.closest('.area_search').length == 0 && $target.closest('.area_menu').length == 0) {
      $('#wrap').removeClass('menu-open')
      $('.btn-menu').removeClass('btn_menu_off')
      $('#container').removeClass('search_on')
      $('.area_search').hide()
    }
  })

  $('.btn_close').on('click', function () {
    $('.area_sidebar').hide()
    $('.area_popup').hide()
    $('body').css('overflow', '')
  })

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
})
