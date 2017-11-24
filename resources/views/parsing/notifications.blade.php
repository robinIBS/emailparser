@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Messages</div>
                @include('partial._filters_search')
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
                                <th>
                                    Action
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

<!-- **** Modal for displaying the emails ***!-->
<!-- Modal -->
<div id="view_message_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!--<h4 class="modal-title">Modal Header</h4>-->
            </div>
            <div class="modal-body view_message_modal_context">
                <!--<p class="view_message_modal_context"></p>-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function () {

        var table = $('#inbox_table').DataTable({});


        $(document).on("click", ".view_message_link", function () {
            var msgId = $(this).attr('msgID');
            var a = {};
//            a["search"] = '{"MessageID":"'+msgId+'"}';

//            ajax_request('POST', 'api/search_messages', 'json', '{"search":"{"MessageID":"'+msgId+'"}', function (d) {
//            ajax_request('POST', 'api/search_messages', 'json', JSON.stringify(a),{'token':"{!!env('TOKEN')!!}"}, function (d) {
            ajax_request('POST', 'api/search_messages', 'json', '{"MessageID":"'+msgId+'"}',{'token':"{!!env('TOKEN')!!}"}, function (d) {

                if (d.success == false) {
                    for (var error in d.message) {
                        $('#errors').append(d.message[error] + '<br>');
                    }
                    $('.error-div').show();
                } else {
                    if (typeof d.data.hits.hits !== 'undefined') {
                        var sr;
                        sr = 1;

                        $.each(d.data.hits.hits, function (index, value) {
                            $('.view_message_modal_context').html(value._source.Messages.Text);
//                            table.row.add([
//                                sr,
//                                value._source.Messages.Sender,
//                                value._source.Messages.Subject,
//                                '<a href="javascript:void(0)" class="view_message_link" msgID="' + value._source.Messages.MessageID + '"><i class="fa fa-eye" aria-hidden="true"></i></a>'
//                            ]).draw(false);
//                            sr++;
                        });
                        $('#view_message_modal').modal('show');
                    }
                }
            });


        });


    });
</script>
@endpush

@endsection
