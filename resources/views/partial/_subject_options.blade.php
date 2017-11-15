@extends('layouts.empty')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">

            <div class="btn-group field_refine_add">
                <div class="dropdown margin-top-20px">
                    <!--                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Add Text Filter
                                            <span class="caret"></span></button>-->
                    <ul class="nav navbar-nav">


                        <li class="dropdown">
                            <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Add Text Filter <b class="caret"></b></a> 

                            <ul class="dropdown-menu">
                                <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Set Start & End Position</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" class="text-filter-options" value="_find_first_pos">Find Start Position</a></li>
                                        <li><a href="#" class="text-filter-options" value="_define_end_pos">Define End Position</a></li>

                                    </ul>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
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
