@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Emails</div>
                @include('partial._filters')
                <div class="panel-body table-responsive">
                    
                    <table class="table table-bordered datatable" id="inbox_table">
                        <thead>
                            <tr>
                                <th>
                                    Sr.
                                </th>
                                <th>
                                    From
                                </th>
                                <th>
                                    Subject
                                </th>
                            </tr>

                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function () {

        var table = $('#inbox_table').DataTable({});



        function table_data() {
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
                    var string = '';
                    $.each(data.data, function (index, value) {

                        string += '<div id="address_id-33792" class="dashboard_inbox_wrapper dashboard_panel">';
                        string += '<span class="dashboard_inbox_move"></span>';
                        string += '<a href="#modal_address_delete_33792" data-placement="right" data-toggle="modal" class="btn tooltip_trigger dashboard_delete" title="" data-id="33792" data-original-title="Delete Inbox"><i class="fa fa-trash-o"></i></a>';
                        string += '<a href="view?i=' + value._id + '" class="dashboard_inbox_link">';
                        string += '<span class="dashboard_inbox_total tooltip_trigger" title="" data-original-title="E-mails last 30 days">0</span>';
                        string += '<span class="dashboard_inbox_title">Important Emails</span>';
                        string += '<span class="dashboard_inbox_address">' + value.email + '</span>';
                        string += '</a></div>';

//                        var view = 
                        //adding the row
//                        table.row.add([sr, value.name, value.email, value.imap_server, (value.imap_ssl == 1) ? 'Yes' : 'No', value.imap_port, value.smtp_server, (value.smtp_ssl == 1) ? 'Yes' : 'No', (value.smtp_tls == 1) ? 'Yes' : 'No', (value.smtp_auth == 1) ? 'Yes' : 'No', value.smtp_port_ssl, value.smtp_port_tls])
//                                .draw();
//                        sr++;
                    });

                    $('#dashboard_wrapper').html(string);
                }
            });
        }

        //refresnhing the data
//        table_data();


    });
</script>
@endpush

@endsection
