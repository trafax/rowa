window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');
//window.lightSlider = require('lightslider');
require('../../node_modules/bxslider/dist/jquery.bxslider');
window.fancybox = require('@fancyapps/fancybox/dist/jquery.fancybox');

require('bootstrap');

$(document).ready(function(){
    $('.menu-toggle').click(function(e){
        if ($('#main-menu').hasClass('d-none')) {
            $('#main-menu').removeClass('d-none');
        } else {
            $('#main-menu').addClass('d-none');
        }
        e.stopPropagation();
    });

    $('[data-fancybox="gallery"]').fancybox({
        thumbs: {
          },
    });
});
