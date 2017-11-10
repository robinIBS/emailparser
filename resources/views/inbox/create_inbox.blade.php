@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Inbox Details</div>

                <div class="panel-body">
                    {{ Form::open(array('url' => 'add_user','class'=>'')) }}
                    <fieldset class="form-group">
                        <legend>Incoming Mail (IMAP) Server</legend>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Server</label>

                            <div class="col-md-6">
                                <input id="imap_server" type="text" class="form-control" name="imap_server" value="{{ old('imap_server') }}" required autofocus>

                                @if ($errors->has('incoming_server'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('imap_server') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">Requires SSL</label>

                            <div class="col-md-6">

                                <input type="radio" name="imap_ssl" checked="checked">Yes
                                <input type="radio" name="imap_ssl" >No
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <label  class="col-md-4 control-label">Port</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="imap_port" id="imap_port">
                            </div>
                        </div>


                    </fieldset>

                    <fieldset class="form-group">
                        <legend>Outgoing Mail (SMTP) Server</legend>
                        <div class="form-group">
                            <label  class="col-md-4 control-label">Server</label>

                            <div class="col-md-6">
                                <input id="smtp_server" type="text" class="form-control" name="smtp_server" value="{{ old('smtp_server') }}" required>

                                @if ($errors->has('incoming_server'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('smtp_server') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">Requires SSL</label>

                            <div class="col-md-6">

                                <input type="radio" name="smtp_ssl" checked="checked">Yes
                                <input type="radio" name="smtp_ssl" >No
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <label  class="col-md-4 control-label">Requires TLS</label>

                            <div class="col-md-6">

                                <input type="radio" name="smtp_tls" checked="checked">Yes
                                <input type="radio" name="smtp_tls" >No
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <label  class="col-md-4 control-label">Requires Authentication</label>

                            <div class="col-md-6">

                                <input type="radio" name="smtp_auth" checked="checked">Yes
                                <input type="radio" name="smtp_auth" >No
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <label  class="col-md-4 control-label">Port for SSL</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="smtp_port_ssl" id="smtp_port_ssl">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <label  class="col-md-4 control-label">Port for TLS/STARTTLS</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="smtp_port_tls" id="smtp_port_tls">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label  class="col-md-4 control-label">Full Name or Dislay Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-md-4 control-label">Email Address</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="email" id="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="password" id="password">
                            </div>
                        </div>

                    </fieldset>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Create
                            </button>
                        </div>
                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
