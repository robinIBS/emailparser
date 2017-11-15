@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
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
                    <div class="panel-heading">Parsing Rule Editor</div>
                    {{ Form::open(array('url' => 'add_rule','class'=>'','id'=>'create-rule-form')) }}
                    <div class="panel-body">
                        <div id="field_edit_1">
                            <div class="section-header">
                                <h1><i class="nav-circle">1.</i>Select Data Source</h1>
                                <div classs="clearfix"></div>
                            </div>

                            <div class="btn-group padding-25px" id="source_select_buttons">
                                <button type="button" class="btn btn-primary" id="select_source_subject" data-source="subject" value="_subject_options"><i class="fa fa-quote-left fa-fw"></i> Subject</button>
                                <button type="button" class="btn" id="select_source_body"><i class="fa fa-align-left fa-fw"></i> Body</button>
                                <button type="button" class="btn" id="select_source_attachment" data-source="attachment"><i class="fa fa-paperclip fa-fw"></i> Attachment</button>
                                <button type="button" class="btn" id="select_source_receiver"><i class="fa fa-user fa-fw"></i> Recipients</button>
                                <button type="button" class="btn" id="select_source_header" data-source="header"><i class="fa fa-paragraph fa-fw"></i> Headers</button>
                            </div>
                        </div>
                        <div id="field_edit_2">
                            <div class="section-header">
                                <h1><i class="nav-circle">2.</i>Crop, Modify & Find Patterns With Filters</h1>
                                <div classs="clearfix"></div>
                            </div>
                            
                            <div id="rule_filter_div">

                            </div>
                            <div id="rule_wrapper_div">

                            </div>
                        </div>
                        <div id="field_edit_3">
                            <div class="section-header">
                                <h1><i class="nav-circle">3.</i>Validate and save</h1>
                                <div classs="clearfix"></div>
                            </div>

                            <div class="form-group required col-md-6">
                                <label class="col-md-4 control-label">Name of the Field</label>

                                <div class="col-md-6">
                                    <input id="field_name" type="text" class="form-control" name="field_name" value="{{ old('field_name') }}">


                                </div>
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
        $("body").delegate("#select_source_subject,.text-filter-options", "click", function() {
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
        $("body").delegate(".remove_filter", "click", function() {
            $(this).parent().parent().remove();
        });
        
    });
</script>
@endpush

@endsection
