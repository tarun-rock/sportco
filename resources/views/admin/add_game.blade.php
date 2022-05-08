@extends("admin.starter.starter")

@php $sub = "Add"; @endphp
@if(!empty($editContest->name))
    @php $sub = "Edit"; @endphp
@endif

@section("title","$sub Game")

@section('head_extra')
    <link rel="stylesheet" href="{{ asset('css/cropper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cropper-main.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}">

    <style type="text/css">
        .invalid-feedback {
            display: block;
        }
    </style>

@endsection
@section("content")
    <div class="container-fluid   container-fixed-lg bg-white">
        <br/>
        <div class="row">
            <div class="col-xlg-12 col-xl-12">
                <h3 class="page-title">{{ $sub }} Game</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <form role="form" method="post" action="" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control {{ $errors->has('c_name') ? ' is-invalid' : '' }}"
                                   required="" name="c_name" minlength="3"
                                   value="{{ $editContest->name ?? old("c_name") }}" maxlength="40">
                            @if ($errors->has('c_name'))
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('c_name') }}</strong>
                    </span>
                            @endif

                        </div>

                        <div class="form-group mb-4">
                            <label>Description</label>
                            <textarea id="descp" class="form-control {{ $errors->has('des_name') ? ' is-invalid' : '' }}" rows="4"
                                      maxlength="200" minlength="10" name="des_name"
                                      required>{{ $editContest->description ?? old("des_name") }}</textarea>
                            <span class="pull-right mt-1 small">Character limit <span id="charlimit">200</span></span>
                            @if ($errors->has('des_name'))
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('des_name') }}</strong>
                    </span>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Entry Token</label>
                                    <input type="number" min="0" value="{{ $editContest->entry ?? old('entry_token') }}"
                                           class="form-control {{ $errors->has('entry_token') ? ' is-invalid' : '' }}"
                                           name="entry_token" placeholder="50 Token" required>
                                    @if ($errors->has('entry_token'))
                                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('entry_token') }}</strong>
                    </span>
                                    @endif
                                </div>
                            </div>
                            {{--<div class="col-md-6">
                                <div class="form-group">
                                    <label>User Slot</label>
                                    <div class="input-group">
                                        <input type="number" min="1" class="form-control {{ $errors->has('userslot') ? ' is-invalid' : '' }}" name="userslot" placeholder="Entery Number" required value="{{ $editContest->total ?? old('userslot') }}">
                                        @if ($errors->has('userslot'))
                                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('userslot') }}</strong>
                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>--}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Score for correct answer</label>
                                    <input type="number"
                                           class="form-control {{ $errors->has('contestscore') ? ' is-invalid' : '' }}"
                                           name="contestscore" value="{{ $editContest->score ?? old('contestscore') }}"
                                           min="1" required>
                                    @if ($errors->has('contestscore'))
                                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('contestscore') }}</strong>
                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Sport</label>
                                    <select name="sports"
                                            class="form-control  {{ $errors->has('sports') ? ' is-invalid' : '' }}"
                                            required>
                                        <option value="">Select Sport from the list</option>
                                        @foreach($sports as $sport)
                                            <option value="{{ $sport->id }}"
                                                    @if(old("sports") == $sport->id || (!empty($editContest->sport_id) && $editContest->sport_id == $sport->id)) selected @endif>{{ $sport->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('sports'))
                                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('sports') }}</strong>
                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group form-group-default required ">
                                <label>Tags</label>
                                <select name="tags[]" data-placeholder="Search by name..."
                                        class="js-example-basic-single form-control" tabindex="-1" multiple="multiple"
                                        width=100% required>

                                    @if(!empty($editContest->tag_id))
                                        @php
                                            $tags = explode(returnConfig("column_separator"),$editContest->tag_name);
                                            $tagID = explode(returnConfig("column_separator"),$editContest->tag_id);
                                        @endphp
                                        @foreach($tags as $key => $tag)
                                            <option selected="selected" value="{{ $tagID[$key] }}">{{ $tag }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date (in UTC)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input type="date"
                                               value="{{ !empty($editContest->start_utc) ? date("Y-m-d",strtotime($editContest->start_utc )) : (old('start_date') ?? "") }}"
                                               class="form-control" min="{{ date("Y-m-d") }}" name="start_date"
                                               placeholder="Enter Your date" required/>
                                        @if ($errors->has('start_date'))
                                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('start_date') }}</strong>
                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Time (in UTC)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input type="time"
                                               value="{{ !empty($editContest->start_utc) ? date("H:i",strtotime($editContest->start_utc )) : (old('start_time') ?? "") }}"
                                               class="form-control" name="start_time"
                                               placeholder="Enter Your Time Range" required/>
                                        @if ($errors->has('start_time'))
                                            <span class="invalida-feedback" role="alert">
                        <strong>{{ $errors->first('start_time') }}</strong>
                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Upload Image</label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="imgInp"
                                           aria-describedby="inputGroupFileAddon01"
                                           accept="image/x-png,image/jpeg,image/jpg">
                                    <label class="custom-file-label" id="Picture" for="inputGroupFile01">Choose
                                        file</label>
                                </div>
                            </div>

                            @if(!empty($editContest->media_url))
                                <label>Existing Image</label>
                                <br>
                                <img src="{{ $editContest->media_url }}" style="width: 20%; height: 20%;">
                            @endif
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
    <script src="{{asset('admin/assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('js/select2.full.min.js')}}"></script>
    <script src="{{ asset("js/sweetalert2.all.min.js") }}" type="text/javascript"></script>


    <script>
        var uploadedImageURL;
        $(document).ready(function () {


            var maxLength = 200;
            $('#descp').keyup(function() {
                var textlen = maxLength - $(this).val().length;
                $('#charlimit').text(textlen);
                var textarea = $('#descp').val().length;

                if (textarea == 200){
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Your have reached Description limit 200',
                    });

                }
            });
            $('.custom-file-input').on('change', function () {
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
            }, function (start, end, label) {
                //console.log("A new date selection was made: " + start.format('YYYY-MM-DD h:mm A') + ' to ' + end.format('YYYY-MM-DD'));
                $('#daterangepicker').attr('value', start.format('YYYY-MM-DD h:mm A') + ' to ' + end.format('YYYY-MM-DD h:mm A'));

            });


            function formatRepoSelection(repo) {
                return repo.name || repo.text;
            }

            function formatRepo(repo) {
                if (repo.loading) return repo.text;
                var markup = repo.name;
                return markup;
            }

            $(".js-example-basic-single").select2({
                width: 'element',
                minimumResultsForSearch: Infinity,
                dropdownCssClass: 'bigdrop',
                allowClear: true,
                tags: true,
                tokenSeparators: [','],
                ajax: {
                    url: "{{ url('get-tags') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (data, params) {

                        params.page = params.page || 1;

                        return {
                            results: data.data,
                            pagination: {
                                more: (params.page * 10) < data.total_count
                            }
                        };
                    },
                    cache: true
                },
                escapeMarkup: function (markup) {
                    return markup;
                },
                minimumInputLength: 3,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            });


        });


    </script>
@endsection