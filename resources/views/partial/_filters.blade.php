<div class="container filter-box">
    <div class="row padding-25px">
        {{ Form::open(array('url' => 'add_user','class'=>'form-inline','id'=>'create-inbox-form')) }}
        <div class="col-md-12">
            <div class="form-group required nopadding">
                <label class=" control-label">Inbox</label>
                <!--<div class="col-md-2">-->
                <select class="form-control" id="filter_email_select_list">
                    <!--<option value="enquiry">Emails</option>-->
                </select>
                <!--</div>-->
            </div>
            <div class="form-group required nopadding">
                <label class="control-label">From Date</label>
                <!--<div class="col-md-2">-->
                <input type="text" class="form-control datepicker" id="filter_from_date"> 
                <!--</div>-->
            </div>
            <div class="form-group required nopadding">
                <label class="control-label">To Date</label>
                <!--<div class="col-md-2">-->
                <input type="text" class="form-control datepicker" id="filter_to_date"> 
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
        list_inbox('filter_email_select_list');
    });
</script>
@endpush