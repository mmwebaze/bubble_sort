(function ($) {
    'use strict';

    Drupal.behaviors.bubble_sort = {
        attach: function (context, settings) {
            var data = JSON.parse($('#bubble_sort').attr('data-sort'));
            var colorsArr = $('#bubble_sort').attr('bubblesort_colors').split(',');
            var crc = 0;

            $('#data_table').append(createTable(data, colorsArr));
            $("#bubble_sort_step").attr("href", "/bubblesort/true/"+data.toString());
            var current = 0;
            var numbers = data.toString();

            $('#bubble_sort_result').click(function(){
                $.ajax({
                    url: "/api/result",
                    contentType: "application/json",
                    type: "get",
                    data: {
                        current: current,
                        numbers: numbers,
                        crc: crc
                    },
                    success: function(response) {
                        console.log(response.status);
                        numbers = response.array.toString();
                        current = response.current;
                        crc = response.crc;
                        $('#data_table').empty();
                        $('#data_table').append(createTable(response.array, colorsArr));
                        $('table tr').eq(current).find('div').css( "background-color", response.color );
                        if (response.status === 'false'){
                            console.log('Please disable now');
                            $("#bubble_sort_result").prop('disabled', true);
                        }
                    },
                    error: function(xhr) {
                        //Do Something to handle error
                    }
                });
            });
        }
    };
}(jQuery));