window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');

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
});
