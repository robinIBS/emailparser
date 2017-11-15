@extends('layouts.empty')

@section('content')
<div class="container filter-box">
    <div class="row">
        <div class="col-md-9">
            <div class="field_preview_wrapper" id="before_rule_1">
                <div class="field_preview_label">
                    Content filter
                </div>
            </div>
            <div class="rule_wrapper">

                <a href="#" class="rule_delete remove_filter" data-order-id="1" data-id="rule5a0bd1f638006553"><i class="fa fa-times"></i></a>

                <div class="">
                    <label class="rule_label pull-left">Find Start Position</label>
                    <div class="rule_inputs_wrapper">

                        <select class="rule_option pull-left input-medium valid" id="" name="" >
                            <option value="search_after" selected="">Text match: after</option>
                            <option value="search_before">Text match: before</option>
<!--                            <option value="line_start">After [x] lines</option>
                            <option value="chars">After [x] characters</option>
                            <option value="words">After [x] words</option>
                            <option value="empty_line">After next empty line</option>
                            <option value="last_lines">Keep last [x] lines</option>
                            <option value="last_words">Keep last [x] words</option>
                            <option value="last_chars">Keep last [x] characters</option>-->
                        </select>


                        <input type="text" name="" id="" value="" title="" placeholder="e.g. Name:">



                        <div class="clearfix inputs_newline"></div>


                        <!--                        <label class="checkbox pull-left">
                                                    <input type="checkbox" name="option_input_rule5a0bd1f638006553_casesensitive" id="option_input_rule5a0bd1f638006553_casesensitive" class="rule_option_input input-checkbox" data-id="rule5a0bd1f638006553">
                                                    Case sensitive</label>
                        
                        
                        
                                                <label class="checkbox pull-left">
                                                    <input type="checkbox" name="option_input_rule5a0bd1f638006553_startofline" id="option_input_rule5a0bd1f638006553_startofline" class="rule_option_input input-checkbox" data-id="rule5a0bd1f638006553">
                                                    Beginning of line</label>-->



                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>





        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function () {




    });
</script>
@endpush

@endsection
