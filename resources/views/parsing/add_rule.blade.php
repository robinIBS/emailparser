@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div id="field_detail_content_pane">
                    <div class="panel-heading">Add Filter Keywords</div>
                    {{ Form::open(array('url' => 'add_rule','class'=>'form-horizontal','id'=>'create-rule-form')) }}
                    <div class="panel-body">

                        <div class="form-group required">
                            <label class="col-md-2 control-label">Filter Group</label>
                            <div class="col-md-6">
                                <select class="form-control" id="filter_group_select_list" name="filter_group">
                                    <option value="">Select Filter Group</option>
                                </select>
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
                                <select class="form-control" multiple="true" name="search_in[]">
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
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function () {
        $("#create-rule-form").submit(function (s) {
            s.preventDefault();
            var arr = $("#create-rule-form").serializeObject();
            arr['action'] = 'add';

            //ADD Filter
            ajax_request('POST', 'api/keyword', 'json', JSON.stringify(arr), function (d) {
                if (d.success == false) {
                    for (var error in d.message) {
                        $('#errors').append(d.message[error] + '<br>');
                    }
                    $('.error-div').show();
                } else if (d.success == true) {
                    $('#success-msg').append(d.message);
                    $('.success-div').show();
                    $("#create-rule-form")[0].reset();
                }

            });

        });

        //fill the filter group dropdown
        ajax_request('POST', 'api/keyword_group', 'json', '{"action":"list"}', function (d) {
            var options = '<option value="">Select Filter Group</option>';
            $.each(d.data, function (index, value) {
                options += '<option value="' + value._id + '">' + value.name + '</option>';
            });
            options += '<option value="new">New</option>';
            $('#filter_group_select_list').html(options);

        });

    });
</script>
@endpush

@endsection
