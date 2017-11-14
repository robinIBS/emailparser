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
                <div class="panel-heading">Parsing Rule Editor</div>

                <div class="panel-body">
                    <div class="btn-group" id="source_select_buttons">
                        <button class="btn btn-primary" id="select_source_subject" data-source="subject"><i class="fa fa-quote-left fa-fw"></i> Subject</button>
                        <button class="btn" id="select_source_body"><i class="fa fa-align-left fa-fw"></i> Body</button>
                        <button class="btn" id="select_source_attachment" data-source="attachment"><i class="fa fa-paperclip fa-fw"></i> Attachment</button>
                        <button class="btn" id="select_source_receiver"><i class="fa fa-user fa-fw"></i> Recipients</button>
                        <button class="btn" id="select_source_header" data-source="header"><i class="fa fa-paragraph fa-fw"></i> Headers</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function () {

//        $("#submit").on("click", function () {
        $("#create-inbox-form").submit(function (s) {
            s.preventDefault();
            var arr = $("#create-inbox-form").serializeObject();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'api/add_inbox',
                async: false,
                data: JSON.stringify(arr),
                contentType: "application/json; charset=utf-8",
                beforeSend: function () {
                    $('.error-div').hide();
                    $('.success-div').hide();
                    $('.loading-img').show();
                    $('#errors').html('');
                    $('#success-msg').html('');
                },
                success: function (data) {
                    console.log(data);

                    if (data.success == false) {
                        for (var error in data.message) {
                            $('#errors').append(data.message[error] + '<br>');
                        }
                        $('.error-div').show();
                    } else if (data.success == true) {
                        $('#success-msg').append(data.message);
                        $('.success-div').show();
                        $("#create-inbox-form")[0].reset();
                    }
                    $('.loading-img').hide();
                }
            });
        });
    });
</script>
@endpush

@endsection
