@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div id="field_detail_content_pane">
                    <div class="panel-heading">Create Filter Group</div>
                    {{ Form::open(array('url' => 'crate_filter_group','class'=>'form-horizontal','id'=>'create_filter_group_form')) }}
                    <div class="panel-body">

                        <div class="form-group required">
                            <label class="col-md-2 control-label">Group Name</label>
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" id="group">
                            </div>
                        </div>

                        <div class="form-group required">
                            <label class="col-md-2 control-label">Search In</label>

                            <div class="col-md-6">
                                <select class="form-control" multiple="true" name="keyword[]" id="keywords">

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="submit">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
                <div class="panel-body table-responsive">

                    <table class="table table-bordered datatable" id="filter_group_table">
                        <thead>
                            <tr>
                                <th>
                                    Sr.
                                </th>
                                <th>
                                    Group Name
                                </th>
<!--                                <th>
                                    Keywords
                                </th>-->
<!--                                <th>
                                    Action
                                </th>-->
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
        var table = $('#filter_group_table').DataTable({});

        $("#create_filter_group_form").submit(function (s) {
            s.preventDefault();
            var arr = $("#create_filter_group_form").serializeObject();
            arr['action'] = 'add';

            //ADD Filter
            ajax_request('POST', 'api/keyword_group', 'json', JSON.stringify(arr), {'token': "{!!env('TOKEN')!!}"}, function (d) {
                if (d.success == false) {
                    for (var error in d.message) {
                        $('#errors').append(d.message[error] + '<br>');
                    }
                    $('.error-div').show();
                } else if (d.success == true) {
                    $('#success-msg').append(d.message);
                    $('.success-div').show();
                    $("#create_filter_group_form")[0].reset();
                }

            });

        });

        //fill the filter group dropdown
        ajax_request('POST', 'api/keyword', 'json', '{"action":"list"}', {'token': "{!!env('TOKEN')!!}"}, function (d) {
            var options = '';
            $.each(d.data, function (index, value) {
                options += '<option value="' + value._id + '">' + value.keyword + '</option>';
            });
            $('#keywords').html(options);

        });

        function refresh_table() {
            ajax_request('POST', 'api/keyword_group', 'json', '{"action":"list"}', {'token': "{!!env('TOKEN')!!}"}, function (d) {

                if (d.success == false) {
                    for (var error in d.message) {
                        $('#errors').append(d.message[error] + '<br>');
                    }
                    $('.error-div').show();
                } else {
                    if (typeof d.data !== 'undefined') {
                        var sr;
                        sr = 1;

                        $.each(d.data, function (index, value) {
                            table.row.add([
                                sr,
                                value.name,
//                                value._source.Messages.Subject,
//                                '<a href="javascript:void(0)" class="view_message_link" msgID="' + value._source.Messages.MessageID + '"><i class="fa fa-eye" aria-hidden="true"></i></a>'
                            ]).draw(false);
                            sr++;
                        });
                    }
                }
            });
        }
refresh_table();
    });
</script>
@endpush

@endsection
