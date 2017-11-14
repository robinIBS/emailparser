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
                <div class="panel-heading">Add Inbox Details</div>

                <div class="panel-body">
                    {{ Form::open(array('url' => 'add_user','class'=>'','id'=>'create-inbox-form')) }}
                    <div class="col-md-6">
                        <fieldset class="form-group">
                            <legend>Incoming Mail (IMAP) Server</legend>
                            <div class="form-group required">
                                <label class="col-md-4 control-label">Server</label>

                                <div class="col-md-6">
                                    <input id="imap_server" type="text" class="form-control" name="imap_server" value="{{ old('imap_server') }}" autofocus>

                                    @if ($errors->has('incoming_server'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('imap_server') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group required">
                                <label  class="col-md-4 control-label">Requires SSL</label>

                                <div class="col-md-6">

                                    <input type="radio" name="imap_ssl" checked="checked">Yes
                                    <input type="radio" name="imap_ssl" >No
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group required">
                                <label  class="col-md-4 control-label">Port</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="imap_port" id="imap_port">
                                </div>
                            </div>


                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <fieldset class="form-group required">
                            <legend>Outgoing Mail (SMTP) Server</legend>
                            <div class="form-group">
                                <label  class="col-md-4 control-label">Server</label>

                                <div class="col-md-6">
                                    <input id="smtp_server" type="text" class="form-control" name="smtp_server" value="{{ old('smtp_server') }}">

                                    @if ($errors->has('incoming_server'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('smtp_server') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group required">
                                <label  class="col-md-4 control-label">Requires SSL</label>

                                <div class="col-md-6">

                                    <input type="radio" name="smtp_ssl" checked="checked">Yes
                                    <input type="radio" name="smtp_ssl" >No
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group required">
                                <label  class="col-md-4 control-label">Requires TLS</label>

                                <div class="col-md-6">

                                    <input type="radio" name="smtp_tls" checked="checked">Yes
                                    <input type="radio" name="smtp_tls" >No
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group required">
                                <label  class="col-md-4 control-label">Requires Authentication</label>

                                <div class="col-md-6">

                                    <input type="radio" name="smtp_auth" checked="checked">Yes
                                    <input type="radio" name="smtp_auth" >No
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group required">
                                <label  class="col-md-4 control-label">Port for SSL</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="smtp_port_ssl" id="smtp_port_ssl">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group required">
                                <label  class="col-md-4 control-label">Port for TLS/STARTTLS</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="smtp_port_tls" id="smtp_port_tls">
                                </div>
                            </div>
                            <input type="hidden" id="user_id" name="user_id" value="1">
                        </fieldset>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6">
                        <fieldset class="form-group">
                            <legend>Credentials</legend>
                            <div class="form-group required">
                                <label  class="col-md-4 control-label">Full Name or Dislay Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" id="name">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group required">
                                <label  class="col-md-4 control-label">Email Address</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="email" id="email">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label  class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="password" id="password">
                                </div>
                            </div>

                        </fieldset>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary" id="submit">
                                Create
                            </button>
                            <img width="100" src="{!!asset('images/loading-img.gif')!!}" class="loading-img">
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
