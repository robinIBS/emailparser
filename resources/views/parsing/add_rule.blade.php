@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!--**** Display the error message ****-->
            <div class="alert alert-danger alert-dismissable error-div ">
                <!--<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>-->
                <a class="close" onclick="$('.error-div').hide()">×</a> 
                <strong>Danger!</strong> <p id="errors"></p>
            </div>


            <div class="alert alert-success alert-dismissable success-div">
                <!--<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>-->
                <a class="close" onclick="$('.success-div').hide()">×</a>
                <strong>Success!</strong> <p id="success-msg"></p>
            </div>

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
                                    <option value="subject">subject</option>
                                    <option value="body">body</option>
                                </select>
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

//        $("#select_source_subject,.text-filter-options").on("click", function () {
        $("body").delegate("#select_source_subject,.text-filter-options", "click", function () {
            var view = $(this).attr('value');
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: 'api/get_rule_view/' + view,
                async: false,
                contentType: "application/json; charset=utf-8",
                beforeSend: function () {

                },
                success: function (data) {
                    console.log(data);
                    if (view == '_subject_options') {
                        $('#rule_wrapper_div').html(data.html);

                    } else {
                        $('#rule_filter_div').append(data.html);
                    }

                }
            });
        });

        //remove the filter box
        $("body").delegate(".remove_filter", "click", function () {
            $(this).parent().parent().remove();
        });

    });
</script>
@endpush

@endsection
