require('./bootstrap')

function mobileTrigger() {
    const $mobileMenu = $('#navigation-mobile')
    const $mobileBtnClose = $('#navigation-mobile .handler button')
    const $mobileBtnTrigger = $('.navigation .mobile-handler button')


    $mobileBtnTrigger.click(function () {
        $mobileMenu.toggleClass('is-open')
    })

    $mobileBtnClose.click(function () {
        $mobileMenu.removeClass('is-open')
    })
}

function portfolioHandler() {
    const $image = $('.gallery .image')
    const $viewer = $('.work-viewer')


    $image.click(function () {
        $('body').css('overflow', 'hidden')
        $viewer.toggleClass('is-open')
    })

    $viewer.find('button.view-close').click(function () {
        $('body').css('overflow', 'inherit')
        $viewer.removeClass('is-open')
    })
}

$(document).ready(function () {
    mobileTrigger()
    portfolioHandler()
})


const $viewportHeight = $(window).height()
const $documentHeight = $(document).height();
const heightDifference = ($documentHeight - $viewportHeight)

$(window).scroll(function() {
    let scroll = $(window).scrollTop();
    const $header = $('header.sticky')

    if (scroll > $header[0].offsetTop && heightDifference > 250) {
        $header.addClass("sticky-on")
        $('body').css('padding-top', $header.outerHeight())
    } else {
        $header.removeClass("sticky-on");
        $('body').css('padding-top', 0)
    }
})