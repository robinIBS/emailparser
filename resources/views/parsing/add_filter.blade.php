@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div id="field_detail_content_pane">
                    <div class="panel-heading">Create Filter</div>
                    {{ Form::open(array('url' => 'create_filter','class'=>'form-horizontal','id'=>'create-rule-form')) }}
                    <div class="panel-body">

                        <div class="form-group">
                            <label class="col-md-2 control-label">Filter Group</label>
                            <div class="col-md-6">
                                <select class="form-control select2" id="group_list" name="group">
                                    <option value="">Select Filter Group</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group required group_name_div">
                            <label class="col-md-2 control-label">Group Name</label>
                            <div class="col-md-6">
                                <input type="text" name="group_name" class="form-control" id="group_name">
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-md-2 control-label">Keyword</label>

                            <div class="col-md-6">
                                <!--<input id="keyword" type="text" class="form-control" name="keyword" value="" autofocus>-->

                                <textarea id="keyword" cols="5" rows="3" class="form-control" name="keyword"></textarea>

                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-md-2 control-label">Search In</label>

                            <div class="col-md-6">
                                <select class="form-control select2" multiple="true" name="search_in[]">
                                    <option value="SUBJECT">SUBJECT</option>
                                    <option value="BODY">BODY</option>
                                    <option value="FROM">FROM</option>
                                    <option value="TO">TO</option>
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

                    <table class="table table-bordered datatable" id="filter_table">
                        <thead>
                            <tr>
                                <th>
                                    Sr.
                                </th>
<!--                                <th>
                                    Group Name
                                </th>-->
                                <th>
                                    Keywords
                                </th>
                                <th>
                                    Search IN
                                </th>
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

        var table = $('#filter_table').DataTable({});


        $("#create-rule-form").submit(function (s) {
            s.preventDefault();
            var arr = $("#create-rule-form").serializeObject();
            arr['action'] = 'add';

            //ADD Filter
//            ajax_request('POST', 'api/keyword', 'json', JSON.stringify(arr), {'token': "{!!env('TOKEN')!!}"}, function (d) {
            ajax_request('POST', 'api/keyword', 'json', JSON.stringify(arr), {'token': "5a16a5e50af69"}, function (d) {
                if (d.success == false) {
                    if ($.isArray(d.message)) {
                        for (var error in d.message) {
                            $('#errors').append(d.message[error] + '<br>');
                        }
                    } else {
                        $('#errors').append(d.message);
                    }
                    $('.error-div').show();
                } else if (d.success == true) {
                    refresh_table();
                    $('#success-msg').append(d.message);
                    $('.success-div').show();
                    $("#create-rule-form")[0].reset();

                }

            });

        });

        //fill the filter group dropdown
//        ajax_request('POST', 'api/keyword_group', 'json', '{"action":"list"}', {'token': "{!!env('TOKEN')!!}"}, function (d) {
        ajax_request('POST', 'api/keyword_group', 'json', '{"action":"list"}', {'token': "5a16a5e50af69"}, function (d) {
            var options = '<option value="">Select Filter Group</option>';
            $.each(d.data, function (index, value) {
                options += '<option value="' + value._id + '">' + value.name + '</option>';
            });
            options += '<option value="new">New</option>';
            $('#group_list').html(options);

        });
        $(document).on('change', '#group_list', function () {

            if ($(this).val() != '') {
                if ($(this).val() == 'new') {
                    $('.group_name_div').show();
//                $('#keyword').text('');
                } else {
                    $('.group_name_div').hide();

//                //fetch the details
                    ajax_request('POST', 'api/keyword_group', 'json', '{"action":"fetch_rec","id":"' + $(this).val() + '"}', {'token': "5a16a5e50af69"}, function (d) {
                        var options = '';
//                    if (typeof d.data.keywords != 'undefined') {
//                    alert(JSON.stringify(d.data));
                        $.each(d.data[0].keywords, function (index, value) {
                            options += value.keyword_name + ',';
                        });
//                    }
                        options = options.substring(0, options.length - 1);
                        $('#keyword').text(options);

                    });
                }
            }

        });

        function refresh_table() {

            //clear the table
            table.clear().draw();


//            ajax_request('POST', 'api/keyword', 'json', '{"action":"list"}', {'token': "{!!env('TOKEN')!!}"}, function (d) {
            ajax_request('POST', 'api/keyword', 'json', '{"action":"list"}', {'token': "5a16a5e50af69"}, function (d) {

                if (d.success == false) {
                    for (var error in d.message) {
                        $('#errors').append(d.message[error] + '<br>');
                    }
                    $('.error-div').show();
                } else {
                    if (typeof d.data !== 'undefined') {
                        var sr;
                        sr = 1;
                        var keywords = '';
                        $.each(d.data, function (index, value) {

                            table.row.add([
                                sr,
//                                '',
                                value.keyword,
                                value.search_in,
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
