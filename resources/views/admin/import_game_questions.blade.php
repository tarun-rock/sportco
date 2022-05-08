@extends("admin.starter.starter")
x
@section("title","Import Questions")

@section('head_extra')
    <link rel="stylesheet" href="{{ asset('css/cropper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cropper-main.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}">

    <style type="text/css">
        .invalid-feedback
        {
            display: block;
        }
    </style>

@endsection
@section("content")
    <div class="container-fluid   container-fixed-lg bg-white">
        <br/>
        <div class="row">
            <div class="col-xlg-12 col-xl-12">
                <h3 class="page-title">Import CSV</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <form role="form" method="post" action="" enctype="multipart/form-data">
                        @csrf


                        <div class="form-group">
                            <label>Upload CSV</label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="imgInp" aria-describedby="inputGroupFileAddon01" accept=".csv">
                                    <label class="custom-file-label" id="Picture" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-save">Save</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection
@section('script_extra')


    <script>
        var uploadedImageURL;
        $(document).ready(function () {
            $('.custom-file-input').on('change',function(){
                var fileName = document.getElementById("imgInp").files[0].name;
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });

            $("#imgInp").change(function () {
                readURL(this);
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        //$('#Picture').html(e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }


            $('#daterangepicker').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                minDate: "{{ date("m/d/Y", strtotime("+1 day")) }} 00:00 am",
                format: 'MM/DD/YYYY h:mm A',
                // startDate: moment().startOf('hour'),
                //  endDate: moment().startOf('hour').add(32, 'hour'),
            },function(start, end, label) {
                //console.log("A new date selection was made: " + start.format('YYYY-MM-DD h:mm A') + ' to ' + end.format('YYYY-MM-DD'));
                $('#daterangepicker').attr('value', start.format('YYYY-MM-DD h:mm A') + ' to ' + end.format('YYYY-MM-DD h:mm A') );

            });






        });


    </script>
@endsection