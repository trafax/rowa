window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');
//window.lightSlider = require('lightslider');
require('../../node_modules/bxslider/dist/jquery.bxslider');
window.fancybox = require('@fancyapps/fancybox/dist/jquery.fancybox');

var tinymce = require('tinymce/tinymce');
require('tinymce/themes/silver');
require('tinymce/plugins/link');
require('tinymce/plugins/media');
require('tinymce/plugins/image');
require('tinymce/plugins/paste');
require('tinymce/plugins/lists');
require('tinymce/plugins/advlist');
window.bsCustomFileInput = require('bs-custom-file-input');


require('bootstrap');

$(document).ready(function(){

    bsCustomFileInput.init();

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

    tinymce.init({
        selector: '.inline-editor',
        inline: true,
        language: 'nl',
        plugins: ['link', 'image', 'media', 'lists', 'paste', 'advlist'],
        link_list: "/admin/page/tinymce",
        image_title: true,
        menu_bar: false,
        paste_data_images: true,
        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '/admin/asset/upload_tinymce');
            xhr.setRequestHeader("X-CSRF-Token", $('meta[name="csrf-token"]').attr('content'));
            xhr.onload = function() {
                var json;

                if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
                }
                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
                }
                success(json.location);
            };
            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename);
            xhr.send(formData);
            },
        convert_urls: 0,
        toolbar: 'formatselect | fontsizeselect | bold italic strikethrough | numlist bullist | link image media | forms',
        setup: function (editor) {
            editor.on('blur', function (e) {
                var content = editor.getContent();
                var object = $($(e)[0].target.bodyElement);
                var identifier = $(object).data('identifier');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $.extend($(object).data(), {'content': content, 'identifier' : identifier}),
                    url: $(object).data('action'),
                    type: 'POST'
                });
            });

            editor.ui.registry.addMenuButton('forms', {
                text: 'Voeg formulier toe',
                fetch: function (callback) {

                    var items = [];

                    var request = new XMLHttpRequest();
                    request.open('GET', '/form/getForms', false);
                    request.send(null);

                    var forms = JSON.parse(request.responseText);

                    $.each(forms, function(key, form) {

                        var item = {
                            type: 'menuitem',
                            text: form.title,
                            onAction: function () {
                                editor.insertContent('[shortcode module="form" id="'+ form.id +'"]');
                            }
                        };

                        items.push(item);
                    });

                    callback(items);
                  }
            });
        }
    });
});
