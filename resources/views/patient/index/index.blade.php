@extends('layouts.padash')
@section('content')

<div class="row">
<div class="col-md-12">
        @include('patient.index.admin-blog-panel')
    </div>
    <div class="col-md-12">
	{{--@include('patient.index.top-ad')--}}
    </div>
</div>
<!-- begin row -->

<div class="row">
    <!--<div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                @include('patient.index.products-panel')
            </div>
            <div class="col-md-6">
                @include('patient.index.nutritions-panel')
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                @include('patient.index.exercises-panel')
            </div>
			<div class="col-md-6">
                @include('patient.index.supplements-panel')
            </div>
        </div>
    </div> -->

    {{--<div class="col-md-6">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-12">--}}
                {{--@include('patient.index.articles-panel')--}}
            {{--</div>--}}
            {{--<div class="col-md-12">--}}
                {{--@include('patient.index.ad1')--}}
            {{--</div>--}}
            {{--<div class="col-md-12">--}}
                {{--@include('patient.index.articles-panel')--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<!-- row end -->--}}

    {{--</div>--}}
</div>
<!-- end row -->
@endsection

@section('page-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            App.init();
            Dashboard.init();
        });
        $(function () {
            if ($('#data-table').length !== 0) {
                $('#data-table').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [2]}]
                });
            }
        });		
    </script>
@endsection