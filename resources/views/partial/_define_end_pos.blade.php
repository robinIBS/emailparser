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
                    <label class="rule_label pull-left">Define End Position</label>
                    <div class="rule_inputs_wrapper">

                        <select class="rule_option pull-left input-medium valid" id="" name="" data-id="">
                            <option value="current_line" selected="">End of line</option>
                            <option value="search_before">Text match: before</option>
                            <option value="search">Text match: after</option>
<!--                            <option value="empty_line">Next blank line</option>
                            <option value="white_space">Next blank space</option>
                            <option value="line_end">After [x] lines</option>
                            <option value="chars">After [x] characters</option>
                            <option value="words">After [x] words</option>
                            <option value="reply">After most recent reply</option>
                            <option value="last_lines">Crop last [x] lines</option>
                            <option value="last_words">Crop last [x] words</option>
                            <option value="last_chars">Crop last [x] characters</option>
                            <option value="text_end">End of content</option>-->
                        </select>

                        <input type="text" name="end_pos" id="end_pos" value=""  placeholder="e.g. Name:" >

                        <div class="clearfix inputs_newline"></div>

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
