<div class="container filter-box">
    <div class="row padding-25px">
        {{ Form::open(array('url' => 'add_user','class'=>'form-inline','id'=>'search_email_form')) }}
        <div class="col-md-12">
            <div class="form-group required">
                <label class=" control-label">Inbox</label>
                <!--<div class="col-md-2">-->
                <select class="form-control" id="filter_email_select_list" name="filter_email">
                    <option value="">Select Email</option>
                </select>
                <!--</div>-->
            </div>
            <div class="form-group">
                <label class="control-label">Filter</label>
                <!--<div class="col-md-2">-->
                <select class="form-control" id="filter_select_list" name="filter_keyword">
                    <option value="">Select Filter</option>
                </select>
                <!--</div>-->
            </div>
            <div class="form-group required">
                <label class=" control-label">Filter Group</label>
                <!--<div class="col-md-2">-->
                <select class="form-control" id="filter_group_select_list" name="filter_group">
                    <option value="">Select Filter Group</option>
                </select>
                <!--</div>-->
            </div>
            <div class="form-group required">
                <label class="control-label">From Date</label>
                <!--<div class="col-md-2">-->
                <input type="text" class="form-control datepicker" id="filter_from_date" name="filter_from_date"> 
                <!--</div>-->
            </div>
            <div class="form-group required">
                <label class="control-label">To Date</label>
                <!--<div class="col-md-2">-->
                <input type="text" class="form-control datepicker" id="filter_to_date" name="filter_to_date"> 
                <!--</div>-->
            </div>
            <div class="form-group">

                <button type="submit" class="btn btn-primary" id="submit">
                    Search
                </button>
                <img width="100" src="{!!asset('images/loading-img.gif')!!}" class="loading-img">

            </div>

        </div>
    </div>
    {{ Form::close() }}
</div>
@push('scripts')
<script>
    $(document).ready(function () {
        //fill the email dropdown
//        list_inbox('filter_email_select_list');


//        $("body").delegate("#filter_email_select_list", "change", function () {
        $("#search_email_form").submit(function (s) {

            s.preventDefault();
            var arr = $("#search_email_form").serializeObject();
            var table = $('#inbox_table').DataTable({
                destroy: true,
            });
//            search_emails();
            table.clear().draw();

            ajax_request('POST', 'api/search_emails', 'json', JSON.stringify(arr), function (d) {
//                console.log(d);
                var sr;
                sr = 1;

                $.each(d.data, function (index, value) {
//                    alert(value.subject);
                    table.row.add([
                        sr,
                        value.fromAddress,
                        value.subject,
                        '<i class="fa fa-eye" aria-hidden="true"></i>'
                    ]).draw(false);
                    sr++;
                });

            });


        });


//        //fill the inbox dropdown
        ajax_request('GET', 'api/list_inbox/1', 'json', '{}', function (d) {
            var options = '<option value="">Select Email</option>';
            $.each(d.data, function (index, value) {
                options += '<option value="' + value._id + '">' + value.name + '(' + value.email + ')</option>';
            });
            $('#filter_email_select_list').html(options);
        });

        //fill the filter dropdown
        ajax_request('POST', 'api/keyword', 'json', '{"action":"list"}', function (d) {
            var options = '<option value="">Select Filter</option>';
            $.each(d.data, function (index, value) {

                options += '<option value="' + value._id + '">' + value.keyword + '</option>';
            });
            $('#filter_select_list').html(options);

        });

        //fill the filter group dropdown
        ajax_request('POST', 'api/keyword_group', 'json', '{"action":"list"}', function (d) {
            var options = '<option value="">Select Filter Group</option>';
            $.each(d.data, function (index, value) {
                options += '<option value="' + value._id + '">' + value.name + '</option>';
            });
            $('#filter_group_select_list').html(options);

        });



    });
</script>
@endpush