@extends('admin.starter.starter')

@section('title','View Question')

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
        <div class="card card-transparent">
            <div class="card-header">
                <div class="card-title">Withdrawal Request</div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="withdrawalToken">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Transaction ID</th>
                        <th>Amount</th>
                        <th>date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($UsersRequestLists as  $UsersRequestList)
                        <tr>
                            <td><strong class="text-capitalize">{{$UsersRequestList->name}}</strong>
                            </td>
                            <td>{{$UsersRequestList->email}}</td>
                            <td>{{$UsersRequestList->transaction_id}} </td>
                            <td><strong style="color:#e65d69;">{{$UsersRequestList->withdrawalToken}} Tokens</strong>
                            </td>
                            <td>{{$UsersRequestList->created_at}} </td>
                            <td>
                                <a data-name="{{$UsersRequestList->name}}" data-walletaddress="{{$UsersRequestList->wallet_address}}"
                                   data-transfee="{{round($UsersRequestList->spco_tokenval,4)}}"
                                   data-wdtoken="{{$UsersRequestList->withdrawalToken}}"
                                   data-id="{{$UsersRequestList->user_id}}"
                                   data-transactionID="{{$UsersRequestList->transaction_id ?? 0}}"
                                   data-value="{{$UsersRequestList->user_rewards_id}}" class="btn btn-info requestbtn"
                                   data-type="1" data-token="{{$UsersRequestList->tokens}}" href="javascript:;">Processed</a>
                                <a data-name="{{$UsersRequestList->name}}"  data-toggle="modal" data-target="#declined" class="btn btn-warning d_reason"
                                   data-transactionID="{{$UsersRequestList->transaction_id ?? 0}}"
                                   data-id="{{$UsersRequestList->user_id}}" data-token="{{$UsersRequestList->tokens}}"
                                   data-value="{{$UsersRequestList->user_rewards_id}}" href="">Decline</a>
                            </td>


                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- END CONTAINER FLUID -->


    <div class="modal fade" id="declined">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header pb-4">
                    <h4 class="modal-title">Reason for Request Declined</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>


                <form class="" method="post" id="tokendecline">
                @csrf
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Reason</label>
                            <textarea class="form-control" name="reason" id="reason" rows="4"></textarea>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <a class="btn btn-warning requestbtn cancelrequest" data-type="2" href="">Decline</a>
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection

@section('script_extra')
    <style>
        .mytable td, .mytable th {
            padding: 4px 0 4px 15px !important;
            margin: 0;
            text-align: left;
            word-break: break-word;
        }
    </style>

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
    <script src="{{ asset("js/sweetalert2.all.min.js") }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            $('#declined').on('shown.bs.modal', function () {

                $('#tokendecline')[0].reset();
            })


            var table = $('#withdrawalToken').DataTable({
                "order": [[4, "desc"]]
            });


            $('#withdrawalToken tbody').on('click', 'tr td:not(:last-child)', function () {

                var data = $(this).parent().find("a.requestbtn");


                $walletAddress = $(data).attr("data-walletaddress");

                $transactionID = $(data).attr("data-transactionid");

                $Ammountreq = $(data).attr("data-token");

                $TransFee = $(data).attr("data-transfee");

                $Amtreceived = $(data).attr("data-wdtoken");
                swal({
                    title: 'Request Info',
                    html: ' <table class="table mytable table-bordered small" id="basicTable"> <tbody> <tr> <th class="v-align-middle" width="40%">Transaction id :</th> <td class="v-align-middle "><p>' + $transactionID + '</p></td></tr><tr> <th class="v-align-middle">Wallet Address :</th> <td class="v-align-middle "><p>' + $walletAddress + '</p></td></tr><tr> <th class="v-align-middle">Amount Requested  :</th> <td class="v-align-middle "><p>' + $Ammountreq + '</p></td></tr><tr> <th class="v-align-middle">Transaction Fee :</th> <td class="v-align-middle "><p>' + $TransFee + '</p></td></tr><tr> <th class="v-align-middle">Amount Receivable :</th> <td class="v-align-middle "><p>' + $Amtreceived + '</p></td></tr></tbody> </table> ',
                    showConfirmButton: false
                });
                if ($(this).lastChild) {
                    return
                }


            });


            $(".d_reason").click(function () {
                $dataId = $(this).attr("data-id");
                $username = $(this).attr("data-name");
                $value = $(this).attr("data-value")
                $Token = $(this).attr("data-token")
                $transactionID = $(this).attr("data-transactionID")
                $('.cancelrequest').attr("data-id", $dataId)
                $('.cancelrequest').attr("data-name", $username)
                $('.cancelrequest').attr("data-value", $value)
                $('.cancelrequest').attr("data-transactionID", $transactionID)
                $('.cancelrequest').attr("data-token", $Token)
                $('.cancelrequest').attr("data-transfee", "")
                $('.cancelrequest').attr("data-wdtoken", "")


            });


            $(".requestbtn").click(function (e) {

                e.preventDefault();
                var dataId = $(this).attr("data-id");
                var username = $(this).attr("data-name")
                var type = $(this).attr("data-type")
                var value = $(this).attr("data-value")
                var token = $(this).attr("data-token")
                var transactionID = $(this).attr("data-transactionID")
                var transactionfee = $(this).attr("data-transfee")
                var wdtoken = $(this).attr("data-wdtoken")


                $reason = "";
                if (type == 2) {
                    $reason = $("#reason").val();

                }
                swal({
                    title: 'Please Wait',
                    html: '<h1 class="mt-5 mb-5 fa fa-spinner fa-spin"></h1>',
                    showConfirmButton: false
                });

                $.ajax({
                    url: '{{url('/dashboard/tokenapprove')}}',
                    type: 'POST',
                    data: {
                        "userId": dataId,
                        "_token": "{{ csrf_token() }}",
                        "type": type,
                        "value": value,
                        "reason": $reason,
                        "token": token,
                        "username": username,
                        "transactionID": transactionID,
                        "transactionfee": transactionfee,
                        "wdtoken": wdtoken,


                    },
                    success: function (data) {
                        if (data == 1) {

                            swal({
                                title: "Success!",
                                text: "Status Email send to User",
                                type: "success"
                            }).then((result) => {
                                if (result.value) {

                                }
                            })

                            location.reload();

                        }
                    },
                    error: function (response) {
                        var err = jQuery.parseJSON(response.responseText);

                        /*$("#username").show();
                        $("#username strong").html(err.message);*/
                        if (err.message) {
                            swal({
                                type: 'error',
                                title: 'Oops...',
                                text: err.errors.reason[0],
                            });

                        }

                    }

                });

            });
        });

    </script>
@endsection
