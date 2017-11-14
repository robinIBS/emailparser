@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Inbox List</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered datatable" id="inbox_table">
                        <thead>
                            <tr>
                                <th>
                                    Sr.
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Imap Server
                                </th>
                                <th>
                                    Imap requires SSL
                                </th>
                                <th>
                                    Imap Port
                                </th>
                                <th>
                                    SMTP Server
                                </th>
                                <th>
                                    SMTP Requires SSL
                                </th>
                                <th>
                                    SMTP Requires TLS
                                </th>
                                <th>
                                    SMTP Requires Authentication
                                </th>
                                <th>
                                    SMTP SSL Port
                                </th>
                                <th>
                                    SMTP TLS Port
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
                    var sr = 1;
                    $.each(data.data, function (index, value) {
//                        var view = 
                        //adding the row
                        table.row.add([sr,value.name,value.email,value.imap_server,(value.imap_ssl==1)?'Yes':'No',value.imap_port,value.smtp_server,(value.smtp_ssl==1)?'Yes':'No',(value.smtp_tls==1)?'Yes':'No',(value.smtp_auth==1)?'Yes':'No',value.smtp_port_ssl,value.smtp_port_tls])
                                .draw();
                        sr++;
                    });
                }
            });
        }

        //refresnhing the data
        table_data();


    });
</script>
@endpush

@endsection
