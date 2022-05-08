@extends("admin.starter.starter")
@section('head_extra')

    {{-- <meta name="csrf_token" content="{{ csrf_token() }}" /> --}}

    <link href="{{ asset('back/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('back/assets/libs/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    {{-- 
     <link href="{{ asset("admin/assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("admin/assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("admin/assets/plugins/datatables-responsive/css/datatables.responsive.css") }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset("admin/assets/plugins/jquery-datatable/media/css/buttons.dataTables.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("admin/assets/plugins/jquery-datatable/extensions/TableTools/css/dataTables.tableTools.css") }}" rel="stylesheet" type="text/css" /> --}}

@endsection
@section("content")
    <!-- START CONTAINER FLUID -->
    <div class=" container-fluid   container-fixed-lg bg-white">
        <!-- START card -->
        <div class="card card-transparent">
            <div class="card-header">
                {{--<div class="card-title">Post Listing</div>--}}
                <h3>RCB Users</h3>

                <div class="export-options-container"></div>
                {{-- <div class="pull-right">
                     <div class="col-xs-12">
                         <input type="text" id="search-table" class="form-control pull-right" placeholder="Search">
                     </div>
                 </div>--}}
                <div class="clearfix"></div>
                <!-- <div class="clearfix"></div> -->
            </div>
            <div class="card-body">
                <table class="table table-striped" id="usertable" style="width: 100% !important">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Users Count</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END card -->
    </div>
    <!-- END CONTAINER FLUID -->

    

@endsection

@section('script_extra')

{{-- <script src="{{ asset('back/assets/extra-libs/DataTables/datatables.min.js') }}"></script> --}}
{{-- <script src="{{ asset('back/assets/libs/sweetalert2/dist/sweetalert2.min.js') }}"></script> --}}
   {{--  <script src="{{ asset("admin/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("admin/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("admin/assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js") }}" type="text/javascript"></script>
    <script src="{{ asset("admin/assets/plugins/datatables-responsive/js/datatables.responsive.js") }}" type="text/javascript"></script>
    <script src="{{ asset("admin/assets/plugins/datatables-responsive/js/lodash.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("admin/assets/plugins/jquery-datatable/media/js/dataTables.buttons.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("admin/assets/plugins/jquery-datatable/media/js/buttons.flash.min.js") }}" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.html5.min.js"></script> --}}

    <script src="{{ asset('back/assets/extra-libs/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('back/assets/libs/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script type="text/javascript">

        $(function() {
        $('#usertable').DataTable({

            "ordering": false,
            "processing": true,
            "serverSide": true,

            "ajax": {

                        "type": "post",
                        'url': "{{ route('communityUsersAjax') }}",
                        "data": function (d) {
                        d.ajax = 1;
                        d._token = "{{ csrf_token() }}";
                    
                    }
            },

            columns: [
                {data: 'date', name: 'date', },
                {data: 'count', name: 'count'},
            ]

        });

    });

    </script>
    

@endsection