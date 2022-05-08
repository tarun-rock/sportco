@extends('admin.starter.starter')

@section('title','View Pending Posts')

@section('head_extra')

    <meta name="csrf_token" content="{{ csrf_token() }}"/>
    <link href="{{ asset("admin/assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css") }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset("admin/assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css") }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset("admin/assets/plugins/datatables-responsive/css/datatables.responsive.css") }}"
          rel="stylesheet" type="text/css"/>

@endsection

@section('content')

    <!-- START CONTAINER FLUID -->
    <div class=" container-fluid   container-fixed-lg bg-white">
        <!-- START card -->
        <div class="card card-transparent">
            <div class="card-header">
                <div class="card-title">Pending Posts</div>
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

                <table class="table table-striped" id="tableWithExportOptions" style="width: 100% !important">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Sports</th>
                        <th>Author</th>
                        <th>Type</th>
                        <th>created at</th>
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
                        <h5>Are you sure?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                    class="pg-close fs-14"></i>
                        </button>
                        {{--<h5>Declined Post</h5>--}}
                    </div>
                    <div class="modal-body">
                        <form action="" id="rejectform" method="POST">
                            @csrf
                        <div class="row">
                            <div class="col-12">
                                <label>Share Feedback
                                    <small class="text-muted">(Optional)</small>
                                </label>
                                <textarea class="form-control" name="rejectstatus" rows="4"></textarea>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-danger btn-block m-t-5 rejected">Reject Post!
                                </button>
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
    <script src="{{ asset("js/sweetalert2.all.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("admin/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js") }}"
            type="text/javascript"></script>
    <script src="{{ asset("admin/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js") }}"
            type="text/javascript"></script>
    <script src="{{ asset("admin/assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js") }}"
            type="text/javascript"></script>
    <script src="{{ asset("admin/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js") }}"
            type="text/javascript"></script>
    <script src="{{ asset("admin/assets/plugins/datatables-responsive/js/datatables.responsive.js") }}"
            type="text/javascript"></script>
    <script src="{{ asset("admin/assets/plugins/datatables-responsive/js/lodash.min.js") }}"
            type="text/javascript"></script>


    <script type="text/javascript">
        /*$(document).ready(function() {
            $('#example').DataTable( {
                "ajax": "data/arrays.txt"
            } );
        } );*/
        $(document).ready(function () {


            var table = $('#tableWithExportOptions');


            var settings = {
                // "sDom": "<'exportOptions'T><'table-responsive sm-m-b-15't><'row'<p i>>",
                "destroy": true,
               "ordering": false,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "type": "GET",
                    'url': "{{ route('post-ajax') }}",
                    "data": function (d) {
                        d.ajax = 1;
                        d._token = "{{ csrf_token() }}";
                    }
                },
                columns: [
                    {data: 'title', name: 'title'},
                    {data: 's_name', name: 's_name'},
                    {data: 'name', name: 'name'},
                    {data: 'p_type', name: 'p_type'},
                    {data: 'date', name: 'created_at'},

                    {data: 'details', name: 'details', orderable: false, searchable: false}
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
                fnDrawCallback: function (oSettings) {
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

            /*var $loader = table.DataTable({

                "ajax": {
                    "type": "GET",
                    'url': "{{ route('post-ajax') }}",

                    "dataSrc": 'responseData',
                    "data": function (d) {
                        d.ajax = 1;
                        d._token = "{{ csrf_token() }}";
                    }
                },
            });*/



            $('#search-table').keyup(function () {
                table.fnFilter($(this).val());
            });


            $(document).on("click", ".reject", function () {

                var $this = $(this);

                var $id = $this.attr("data-id");
                var $uid = $this.attr("data-uid");

                $(".rejected").attr("data-id", $id);
                $(".rejected").attr("data-uid", $uid);


            });
            $("form#rejectform").submit(function (e) {
                e.preventDefault();
                swal({
                    html: '<i class="fa fa-spinner fa-spin mb-3" style="font-size:24px"></i>',
                    title: "Please wait, processing...",
                    showConfirmButton: false,
                })
                var $id = $('.rejected').attr("data-id");
                var $uid = $('.rejected').attr("data-uid");
                var $feedback = $("textarea[name='rejectstatus']").val();
                $.ajax({
                  "type": "POST",
                'url': "{{ route('post-ajax') }}",

                  "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                  "data": {
                      "ajax": 3,
                      "id": $id,
                      "uid": $uid,
                      "feedback":$feedback,
                  },
                  "success": function (response)
                  {

                      if(response.status == 1)
                      {
                          swal({
                              title: "Success!",
                              type: "success",
                          })

                          $("#modalReject").modal("hide");

                          $loader.api().ajax.reload();

                      }

                  }
              });


            });

            $(document).on("click", ".rejected", function () {


                var $id = $(this).attr("data-id");



            });

        });

    </script>
@endsection
