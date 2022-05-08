@extends("admin.starter.starter")
@section('head_extra')

    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <link href="{{ asset("admin/assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("admin/assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("admin/assets/plugins/datatables-responsive/css/datatables.responsive.css") }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset("admin/assets/plugins/jquery-datatable/media/css/buttons.dataTables.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("admin/assets/plugins/jquery-datatable/extensions/TableTools/css/dataTables.tableTools.css") }}" rel="stylesheet" type="text/css" />

@endsection
@section("content")
    <!-- START CONTAINER FLUID -->
    <div class=" container-fluid   container-fixed-lg bg-white">
        <!-- START card -->
        <div class="card card-transparent">
            <div class="card-header">
                {{--<div class="card-title">Post Listing</div>--}}
                <h3>Post Listing</h3>

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
                <table class="table table-striped" id="usertable">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Sports</th>
                        <th>Author</th>
                        <th>Type</th>
                        <th>likes</th>
                        <th>views</th>
                        <th>Created Date</th>
                        <th>Publish Date</th>
                        <th>timeGap</th>
                        <th>action</th>

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
    <script src="{{ asset("admin/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("admin/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js") }}" type="text/javascript"></script>
    {{--<script src="https://cdn.datatables.net/tabletools/2.2.4/js/dataTables.tableTools.js" type="text/javascript"></script>--}}
    {{--<script src="https://legacy.datatables.net/release-datatables/extras/TableTools/media/js/TableTools.min.js" type="text/javascript"></script>--}}
    <script src="{{ asset("admin/assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js") }}" type="text/javascript"></script>
    {{--<script src="{{ asset("admin/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js") }}" type="text/javascript"></script>--}}
    <script src="{{ asset("admin/assets/plugins/datatables-responsive/js/datatables.responsive.js") }}" type="text/javascript"></script>
    <script src="{{ asset("admin/assets/plugins/datatables-responsive/js/lodash.min.js") }}" type="text/javascript"></script>
    {{--<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>--}}
    <script src="{{ asset("admin/assets/plugins/jquery-datatable/media/js/dataTables.buttons.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("admin/assets/plugins/jquery-datatable/media/js/buttons.flash.min.js") }}" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.html5.min.js"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>

    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js" type="text/javascript"></script>--}}
    <script type="text/javascript">
        $(document).ready(function () {
            <?php $t=time(); ?>
            var table = $('#usertable');
            var settings = {
                "autoWidth": false,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'csv',
                        //filename: 'post_stats.csv',
                        className: 'btn btn-primary',
                        text:'Download Post Stats',
                        title: 'post_stats_{{date("Y-m-d",$t)}}'
                    },
                ],
                "ajax": {
                    "type": "POST",
                    "data": function (d) {
                        d.ajax = 1;
                        d._token = "{{ csrf_token() }}";
                    }
                },
                columns: [
                    {data: 'title', name: 'title', },
                    {data: 's_name', name: 's_name'},
                    {data: 'name', name: 'name'},
                    {data: 'p_type', name: 'p_type'},
                    {data: 'likes', name: 'likes'},
                    {data: 'views', name: 'views'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'publish_utc', name: 'publish_utc'},
                    {data: 'timeGap', name: 'timeGap'},
                    {data: 'action', name: 'action'},
                ],
                fnDrawCallback: function(oSettings) {
                }
            };
             var $loader = table.dataTable(settings);
        });
    </script>

@endsection