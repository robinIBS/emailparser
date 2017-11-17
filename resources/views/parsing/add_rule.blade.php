@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div id="field_detail_content_pane">
                    <div class="panel-heading">Add Filter Keywords</div>
                    {{ Form::open(array('url' => 'add_rule','class'=>'','id'=>'create-rule-form')) }}
                    <div class="panel-body">

                        <div class="form-group required">
                            <label class="col-md-4 control-label">Keyword</label>

                            <div class="col-md-6">
                                <input id="keyword" type="text" class="form-control" name="keyword" value="" autofocus>


                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-md-4 control-label">Search In</label>

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
                            <div class="col-md-6 col-md-offset-4">
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
                        $('#errors').append(data.message[error] + '<br>');
                    }
                    $('.error-div').show();
                } else if (d.success == true) {
                    $('#success-msg').append(d.message);
                    $('.success-div').show();
                    $("#create-rule-form")[0].reset();
                }

            });

        });
    });
</script>
@endpush

@endsection
