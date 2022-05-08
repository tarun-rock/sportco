@extends('admin.starter.starter')

@section('title','View Question')

@section('head_extra')

    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <link href="{{ asset("admin/assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("admin/assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("admin/assets/plugins/datatables-responsive/css/datatables.responsive.css") }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

    <!-- START CONTAINER FLUID -->
    <div class=" container-fluid   container-fixed-lg bg-white">
        <br>
        <div class="row">
            <div class="col-xlg-12 col-xl-12 justify-content-between d-flex">
                <h3 class="page-title">Questions</h3>
                @if(!empty($type))
                    <div>
                    <a href="{{ url("dashboard/add-game-questions",[$id]) }}" class="btn btn-primary">Add Questions</a>
                    <a href="{{ url("dashboard/import-game-questions",[$id]) }}" class="btn btn-success">Import Questions</a>
                    </div>
                @else
                    <a href="{{ url("dashboard/add-questions",[$id]) }}" class="btn btn-primary">Add Questions</a>
                @endif
            </div>
        </div>
        <!-- START card -->
        <div class="card card-transparent">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                <div class="card-title align-self-center">View Questions</div>
                <div>
                     <input type="text" id="search-table" class="form-control pull-right" placeholder="Search">
                </div>
                </div>
                <div class="export-options-container"></div>

                <div class="clearfix"></div>
                <!-- <div class="clearfix"></div> -->
            </div>
            <div class="card-body">
                <table class="table table-striped" id="tableWithExportOptions">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
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




    <div class="modal fade slide-up disable-scroll" id="modalReject" tabindex="-1" role="dialog" aria-hidden="false">
        <div class="modal-dialog ">
            <div class="modal-content-wrapper">
                <div class="modal-content">
                    <div class="modal-header clearfix text-left">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                        </button>
                        <h5>Are you sure?</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-danger btn-block m-t-5 rejected">Yes</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block m-t-5">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>

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

            var table = $('#tableWithExportOptions');


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
                    {data: 'name', name: 'name'},
                    {data: 'details', name: 'details',  orderable: false, searchable: false }
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
