//$(document).ready(function () {

function ajax_request(method, action, dataType, data = {},headers={},callback) {
    headers['Cache-Control']='no-cache';
    $.ajax({
        type: method,
        dataType: dataType,
        url: action,
        headers: headers,
//                async: true,
        data: data,
        contentType: "application/json; charset=utf-8",
        beforeSend: function () {
            $('.ajax-loader').css('display', 'block');
            $('#errors').html('');
            $('#success-msg').html('');
        },
        success: function (data) {
            callback(data);
        },
        complete: function () {
            $('.ajax-loader').css('display', 'none');
        }
    });
//    return response;
}

function append_error_messages() {

}