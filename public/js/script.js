//$(document).ready(function () {

function ajax_request(method, action, dataType, data = {},callback) {
    $.ajax({
        type: method,
        dataType: dataType,
        url: action,
//                async: false,
        data: data,
        contentType: "application/json; charset=utf-8",
        beforeSend: function () {

        },
        success: function (data) {
            callback(data);
        }
    });
//    return response;
}

function search_emails(id = '', criteria) {
//    $('.ajax-loader').css('display','block');
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: 'api/search_emails',
//        async: true,
        contentType: "application/json; charset=utf-8",
        beforeSend: function () {
            $('.ajax-loader').css('display', 'block');
            $('#errors').html('');
            $('#success-msg').html('');
        },
        success: function (data) {
            console.log(data);
        },
        complete: function () {
            $('.ajax-loader').css('display', 'none');
        }
    });
}

function append_error_messages() {

}