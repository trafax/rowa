require('./bootstrap');

require('checkboxes.js/dist/jquery.checkboxes-1.2.2');

window.sortable = require('jquery-ui/ui/widgets/sortable');
window.Dropzone = require('dropzone');

$(function(){

    $('.toast').toast('show');

    $('.table').checkboxes('range', true);

    $(".nav-tabs > a").on("shown.bs.tab", function(e) {
        var id = $(e.target).attr("href").substr(1);
        window.location.hash = id;
    });

    var hash = window.location.hash;
    $('.nav-tabs a[href="' + hash + '"]').tab('show');

    $('.with-selected').on('change', function(){
        var action = $('.with-selected').val();
        var ids = $(".check:checked").map(function(){
            if ($(this).val()) {
                return $(this).val();
            }
        }).get();

        if (confirm('Geselecteerde actie uitvoeren?'))
        {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {'ids' : ids},
                url: action,
                type: 'POST',
                success: function(response)
                {
                    if (response) {
                        window.location.reload();
                    }
                },
                dataType: 'json'
            });
        }

        $(this).prop('selectedIndex', 0);
    });

    $('[name="check_all"]').on('click', function(){
        if($(this).prop('checked') == true)
        {
            $('.check').prop('checked', true);
        }
        else
        {
            $('.check').prop('checked', false);
        }
    });

    $('.sortable').sortable({
        delay: 300,
        update: function( event, ui ) {

           var action = $(this).data('action');
           var data = $(this).sortable('toArray');

           $.ajax({
              headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {'items' : data},
              url: action,
              type: 'POST',
              success: function(response)
              {
                  if (response.reload) {
                    window.location.reload();
                  }
              },
              dataType: 'json'
           });
        }
     });
});
