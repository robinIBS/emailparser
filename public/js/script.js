//$(document).ready(function () {

    function list_inbox(id='') {
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: 'api/list_inbox/1',
//                async: false,
            contentType: "application/json; charset=utf-8",
            beforeSend: function () {

            },
            success: function (data) {
                console.log(data);
//                    var sr = 1;
                var options = '<option value="">Select Email</option>';
                $.each(data.data, function (index, value) {
                    
                    options+='<option value="'+value._id+'">'+value.name+'('+value.email+')</option>';
//                        var view = 
                    //adding the row
//                    table.row.add([sr, value.name, value.email, value.imap_server, (value.imap_ssl == 1) ? 'Yes' : 'No', value.imap_port, value.smtp_server, (value.smtp_ssl == 1) ? 'Yes' : 'No', (value.smtp_tls == 1) ? 'Yes' : 'No', (value.smtp_auth == 1) ? 'Yes' : 'No', value.smtp_port_ssl, value.smtp_port_tls])
//                            .draw();
//                        sr++;
                });

                $('#'+id).html(options);
            }
        });
    }

//});