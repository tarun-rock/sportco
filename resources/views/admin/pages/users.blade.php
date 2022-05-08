@extends("admin.starter.starter")
@section('head_extra')

    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <link href="{{ asset("admin/assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("admin/assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("admin/assets/plugins/datatables-responsive/css/datatables.responsive.css") }}" rel="stylesheet" type="text/css" />

@endsection
@section("content")

    <!-- START CONTAINER FLUID -->
    <div class=" container-fluid   container-fixed-lg bg-white">
        <!-- START card -->
        <div class="card card-transparent">
            <div class="card-header">
                <div class="card-title">User List</div>
                <div class="export-options-container"></div>
                <div class="pull-right">
                    <div class="col-xs-12">
                        <input type="text" id="search-table" class="form-control pull-right" placeholder="Search">
                    </div>
                </div>
                <div class="clearfix"></div>
                <!-- <div class="clearfix"></div> -->
            </div>
            <div class="card-body">
                <table class="table table-striped" id="usertable">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        {{--<th>type</th>--}}

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
    <script src="{{ asset("admin/assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js") }}" type="text/javascript"></script>
    <script src="{{ asset("admin/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js") }}" type="text/javascript"></script>
    <script src="{{ asset("admin/assets/plugins/datatables-responsive/js/datatables.responsive.js") }}" type="text/javascript"></script>
    <script src="{{ asset("admin/assets/plugins/datatables-responsive/js/lodash.min.js") }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            var table = $('#usertable');
            var settings = {
                "sDom": "<'exportOptions'T><'table-responsive sm-m-b-15't><'row'<p i>>",
                "destroy": true,
                "ordering": false,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "type": "POST",
                    "data": function (d) {
                        d.ajax = 1;
                        d._token = "{{ csrf_token() }}";
                    }
                },
                columns: [
                    {data: 'name', name: 'name',  orderable: false, searchable: false },
                    {data: 'email', name: 'email'},
                    // {data: 'type', name:'type'}
                ],
                "scrollCollapse": true,
                "oLanguage": {
                    "sLengthMenu": "_MENU_ ",
                    "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
                },
                "iDisplayLength": 10,
                "oTableTools": {
                    "sSwfPath": "assets/plugins/jquery-datatable/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
                    "aButtons": [{
                        "sExtends": "csv",
                        "sButtonText": "<i class='pg-grid'></i>",
                    }, {
                        "sExtends": "xls",
                        "sButtonText": "<i class='fa fa-file-excel-o'></i>",
                    }, {
                        "sExtends": "pdf",
                        "sButtonText": "<i class='fa fa-file-pdf-o'></i>",
                    }, {
                        "sExtends": "copy",
                        "sButtonText": "<i class='fa fa-copy'></i>",
                    }]
                },
                fnDrawCallback: function(oSettings) {
                    $('.export-options-container').append($('.exportOptions'));

                    $('#ToolTables_tableWithExportOptions_0').tooltip({
                        title: 'Export as CSV',
                        container: 'body'
                    });

                    $('#ToolTables_tableWithExportOptions_1').tooltip({
                        title: 'Export as Excel',
                        container: 'body'
                    });

                    $('#ToolTables_tableWithExportOptions_2').tooltip({
                        title: 'Export as PDF',
                        container: 'body'
                    });

                    $('#ToolTables_tableWithExportOptions_3').tooltip({
                        title: 'Copy data',
                        container: 'body'
                    });
                }
            };

            var $loader = table.dataTable(settings);

            $('#search-table').keyup(function() {
                table.fnFilter($(this).val());
            });


        });
    </script>

@endsection