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

    $.ajax({
        type: 'POST',
        url: form.attr('action'),
        data: form.serializeArray(),
        success: function (res) {
            // SUCCESS
            if (res.responseType == 'success') {

            } else {
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
