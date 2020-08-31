require('./bootstrap');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '.ajax-submit', function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();

    let form = $(this).closest('form');
    $('.with-error').removeClass('with-error');
    $('.error-span').remove();
    $('.response-data').html('...');

    $.ajax({
        type: 'POST',
        url: form.attr('action'),
        data: form.serializeArray(),
        success: function (res) {
            // SUCCESS
            if (res.responseType == 'success') {
                $('.status').html(` Status: ${res.data.result.status} `);
                $('.response-time').html(`${res.data.result.time} ms`);
                $('.general-error').html('');

            } else {
                console.log(res);
                if (res.errorMessage && res.errorMessage.error) {
                    $('.status').html(`Status: ${res.errorMessage.status}`);
                    $('.response-time').html(`${res.errorMessage.time} ms`);
                    $('.general-error').html(res.errorMessage.error);
                }

                for (var key in res.errorMessage) {
                    if (res.errorMessage[key] && $(`[name=${key}]`).length) {
                        form.find(`[name=${key}]`).addClass('with-error');
                        form.find(`[name=${key}]`).closest('div').append(`<span class="error-span">${res.errorMessage[key]}</span>`);
                    }
                }
            }
        },
        error: function (res) {
            console.log(res);
        },
    });
});
