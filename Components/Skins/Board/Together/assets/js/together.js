window.jQuery(function ($) {
  /* view. 첨부파일 목록 토글 */
  $('.btn-file').on('click', function toggleAttachList () {
    $('.list-file').toggle()
  })

  /* 목록. 공지사항 슬라이드 */
  $('.board-notice-tfc .area-slide').slick({
    dots: true,
    prevArrow: null,
    nextArrow: null,
    dotsClass: 'area-paging'
  })

  /* view. 글 삭제 */
  $('.bd_delete').on('click touchstart', function (event) {
    if (confirm(window.XE.Lang.trans('board::msgDeleteConfirm'))) {
      var url = $(this).data('url')
      window.XE.delete(url, {}).then(function (response) {
        if (response.data.links && response.data.links.href) {
          document.location.href = response.data.links.href
        }
      })
    }
  })

  /* view. like 버튼 */
  $('.btn-like').on('click touchstart', function (event) {
    event.preventDefault()
    var $target = $(event.target).closest('button')
    var url = $target.data('url')

    window.XE.post(url).then(function (response) {
      $target.toggleClass('active')
      $('.bd_like_num').text(response.data.counts.assent)
      toggleAreaLike()
    })
  })

  function toggleAreaLike () {
    var $linkNum = $('.bd_like_num')
    if ($linkNum.length && parseInt($linkNum.text()) !== 0) {
      window.XE.page($linkNum.data('url'), '#area-like-more' + $linkNum.data('id'), {}, function () {
        $('#area-like-more' + $linkNum.data('id')).show()
      })
    } else {
      $('#area-like-more' + $linkNum.data('id')).hide()
    }
  }
  toggleAreaLike()

  /* like */

  $('.__xe-bd-favorite').on('click', function (event) {
    var $target = $(event.target)
    var $anchor = $target.closest('button')
    var id = $anchor.data('id')
    var url = $anchor.data('url')

    window.XE.post(url, { id: id }).then(function (response) {
      console.debug(response.data)
      if (response.data.favorite === true) {
        $anchor.addClass('active')
      } else {
        $anchor.removeClass('active')
      }
    })
  })
})

window.AssentVirtualGrid = (function (XE, $) {
  var self
  var startId = 0
  var limit = 10

  return {
    getTemplate: function () {
      return [
        '<a href="{{profilePage}}" class="list-inner-item">',
        '<div class="img-thumbnail"><img src="{{profileImage}}" width="48" height="48" alt="{{displayName}}" /></div>',
        '<div class="list-text">',
        '<p>{{displayName}}</p>',
        '</div>',
        '</a>'
      ].join('\n')
    },
    init: function () {
      console.debug('this', this)
      self = AssentVirtualGrid

      $('.xe-list-group').css('height', '365px')

      XE.DynamicLoadManager.jsLoad('/assets/core/xe-ui-component/js/xe-infinite.js', function () {
        window.XeInfinite.init({
          wrapper: '.xe-list-group',
          template: self.getTemplate(),
          loadRowCount: 3,
          rowHeight: 80,
          onGetRows: self.onGetRows
        })
      })

      return self
    },
    onGetRows: function () {
      window.XeInfinite.setPrevent(true)
      var data = {
        limit: limit
      }

      if (startId !== 0) {
        data.startId = startId
      }

      window.XE.get($('.xe-list-group').data('url'), data).then(function (response) {
        window.XeInfinite.setPrevent(response.data.nextStartId === 0)
        startId = response.data.nextStartId
        for (var k = 0, max = response.data.list.length; k < max; k += 1) {
          window.XeInfinite.addItems(response.data.list[k])
        }
      })
    }
  }
})(window.XE, window.jQuery)
