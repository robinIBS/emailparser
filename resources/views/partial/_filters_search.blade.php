<div class="container filter-box">
    <div class="row padding-25px">
        {{ Form::open(array('url' => 'add_user','class'=>'form-inline','id'=>'search_email_form')) }}
        <div class="col-md-12">


            <div class="form-group required">
                <label class="control-label">Search Pattern</label>
                <!--<div class="col-md-2">-->
                <input type="text" class="form-control" id="filter_to_date" name="search"> 
                <!--</div>-->
            </div>
            <div class="form-group">

                <button type="submit" class="btn btn-primary" id="submit">
                    Search
                </button>

            </div>

        </div>
    </div>
    {{ Form::close() }}
</div>
@push('scripts')
<script>
    $(document).ready(function () {

        $("#search_email_form").submit(function (s) {

            s.preventDefault();
            var arr = $("#search_email_form").serializeObject();
            var table = $('#inbox_table').DataTable({
                destroy: true,
            });
            table.clear().draw();

            ajax_request('POST', 'api/search_messages', 'json', JSON.stringify(arr), function (d) {

                if (d.success == false) {
                    for (var error in d.message) {
                        $('#errors').append(d.message[error] + '<br>');
                    }
                    $('.error-div').show();
                } else {
                    if (typeof d.data.hits.hits!== 'undefined') {
                        var sr;
                        sr = 1;

                        $.each(d.data.hits.hits, function (index, value) {
                            table.row.add([
                                sr,
                                value._source.Messages.Sender,
                                value._source.Messages.Subject,
                                    '<a href="javascript:void(0)" class="view_message_link" msgID="'+value._source.Messages.MessageID+'"><i class="fa fa-eye" aria-hidden="true"></i></a>'
                            ]).draw(false);
                            sr++;
                        });
                    }
                }
            });
        });
    });
</script>
@endpush