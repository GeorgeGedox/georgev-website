require('./bootstrap')
require('jquery-lazy/jquery.lazy.min')

import HlJs from 'highlight.js/lib/core'
import javascript from 'highlight.js/lib/languages/javascript'
import python from 'highlight.js/lib/languages/python'
import php from 'highlight.js/lib/languages/php'
import bash from 'highlight.js/lib/languages/bash'
import css from 'highlight.js/lib/languages/css'
import json from 'highlight.js/lib/languages/json'
import markdown from 'highlight.js/lib/languages/markdown'
import http from 'highlight.js/lib/languages/http'
import sql from 'highlight.js/lib/languages/sql'
import xml from 'highlight.js/lib/languages/xml'
import dockerfile from 'highlight.js/lib/languages/dockerfile'
import apache from 'highlight.js/lib/languages/apache'
import nginx from 'highlight.js/lib/languages/nginx'

HlJs.registerLanguage('javascript', javascript)
HlJs.registerLanguage('python', python)
HlJs.registerLanguage('php', php)
HlJs.registerLanguage('bash', bash)
HlJs.registerLanguage('css', css)
HlJs.registerLanguage('json', json)
HlJs.registerLanguage('markdown', markdown)
HlJs.registerLanguage('http', http)
HlJs.registerLanguage('sql', sql)
HlJs.registerLanguage('xml', xml)
HlJs.registerLanguage('apache', apache)
HlJs.registerLanguage('dockerfile', dockerfile)
HlJs.registerLanguage('nginx', nginx)
HlJs.initHighlightingOnLoad()

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
    const viewer = '.work-viewer'
    let $currentViewer = null


    $image.click(function () {
        let handlerID = $(this).data('id')

        $currentViewer = $(viewer + '[data-id=' + handlerID + ']')

        if ($currentViewer.length) {
            $('body').css('overflow', 'hidden')
            $currentViewer.toggleClass('is-open')
        }
    })

    $(viewer).find('button.view-close').click(function () {
        $('body').css('overflow', 'inherit')
        $currentViewer.removeClass('is-open')
    })
}

$(document).ready(function () {
    mobileTrigger()
    portfolioHandler()
    $('.lazy-load').lazy()
})


const $viewportHeight = $(window).height()
const $documentHeight = $(document).height()
const heightDifference = ($documentHeight - $viewportHeight)

$(window).scroll(function () {
    let scroll = $(window).scrollTop()
    const $header = $('header.sticky')

    if (scroll > $header[0].offsetTop && heightDifference > 250) {
        $header.addClass("sticky-on")
        $('body').css('padding-top', $header.outerHeight())
    } else {
        $header.removeClass("sticky-on")
        $('body').css('padding-top', 0)
    }
})
