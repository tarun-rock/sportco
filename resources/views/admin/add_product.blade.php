@extends("admin.starter.starter")

@php $sub = "Add"; @endphp
@if(!empty($edit->name))
    @php $sub = "Edit"; @endphp
@endif

@section("title","$sub Product")

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
                <h3 class="page-title">{{ $sub }} Product</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <form role="form" method="post" action="" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control {{ $errors->has('c_name') ? ' is-invalid' : '' }}" required="" name="name" minlength="3" value="{{ $edit->name ?? old("name") }}" maxlength="40" placeholder="Product's name">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                            @endif

                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control {{ $errors->has('des_name') ? ' is-invalid' : '' }}" rows="4" maxlength="200" minlength="10" name="des_name" required placeholder="Product's description">{{ $edit->description ?? old("des_name") }}</textarea>
                            @if ($errors->has('des_name'))
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('des_name') }}</strong>
                    </span>
                            @endif
                        </div>

                        <div class="row">

                            

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Purchase</label>
                                    <select class="form-control" name="type" required>
                                        <option value="0" 
                                        @isset($edit->type)
                                            
                                        @if(isset($edit->type) || empty(old('type'))) selected @endif
                                        @endisset
                                        >Via Currency Only</option>
                                        <option value="1" @isset($edit->type) @if($edit->type == 1 || old('type') == 1) selected @endif @endisset>Via Token Only</option>
                                        <option value="2" @isset($edit->type) @if($edit->type == 2 || old('type') == 2) selected @endif @endisset>Via Token Also</option>
                                    </select>
                                </div>
                            </div>

                            <div id="tokenInput" class="col-md-4 @if(empty(old('token')) && empty($edit->type)) d-none @endif">
                                <div class="form-group">
                                    <label>Tokens</label>
                                    <input type="number" min="0" value="{{ $edit->token ?? old('token') }}" class="form-control {{ $errors->has('token') ? ' is-invalid' : '' }}" name="token" placeholder="Token to purchase products">
                                    @if ($errors->has('token'))
                                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('token') }}</strong>
                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category" id="category" data-placeholder="Search by name..."
                                            class="js-example-basic-single form-control" tabindex="-1" width="100%" required>
                                             @if(!empty($edit->category_id))
                                                <option selected="selected" value="{{ $edit->category_id }}">{{ $edit->cat_name }}</option>
                                             @endif
                                    </select>
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
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Currency</label>
                                    <select name="currency" class="form-control currency_sel2 {{ $errors->has('currency') ? ' is-invalid' : '' }}">
                                        <option value="">Select currency from the list</option>
                                        @foreach($currencies as $currency)
                                            <option value="{{ $currency->id }}" @if(old("currency") == $currency->id || (!empty($edit->currency_id) && $edit->currency_id == $currency->id)) selected @endif>{{ $currency->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('currency'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('currency') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" step="0.01" name="price" value="{{ $edit->price ?? old('price') }}" min="0" placeholder="Enter Price of product">
                                    @if ($errors->has('price'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" min="1" class="form-control {{ $errors->has('quantity') ? ' is-invalid' : '' }}" step="1" name="quantity" value="{{ $edit->quantity ?? old('quantity') }}" min="0" placeholder="Enter Quantity of product">
                                    @if ($errors->has('quantity'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('quantity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group form-group-default required ">
                                <label>Tags</label>
                                <select name="tags[]" data-placeholder="Search by name..."
                                        class="js-example-basic-single form-control" tabindex="-1" multiple="multiple" width=100% required>

                                    @if(!empty($edit->tag_id))
                                        @php
                                            $tags = explode(returnConfig("column_separator"),$edit->tag_name);
                                            $tagID = explode(returnConfig("column_separator"),$edit->tag_id);
                                        @endphp
                                        @foreach($tags as $key => $tag)
                                            <option selected="selected" value="{{ $tagID[$key] }}">{{ $tag }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group form-group-default required ">
                                <label>Publish</label>
                                <input type="checkbox" data-init-plugin="switchery" data-size="small" name="publish" data-color="primary" checked="checked" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Featured Image</label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="imgInp" aria-describedby="inputGroupFileAddon01" accept="image/x-png,image/jpeg,image/jpg" @if(empty($edit->media_url)) required @endif >
                                    <label class="custom-file-label" id="Picture" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>

                            @if(!empty($edit->media_url))
                                <label>Existing Image</label>
                                <br>
                                <img src="{{ $edit->media_url }}" style="width: 20%; height: 20%;">
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


    <script>
        var uploadedImageURL;
        $(document).ready(function () {

            $(document).on("change","select[name='type']", function () {

                if($(this).val() == 0)
                {

                    $("#tokenInput").addClass("d-none");

                }
                else
                {
                    $("#tokenInput").removeClass("d-none");
                }

            });

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


            {{--     $('#daterangepicker').daterangepicker({
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
--}}

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


            $(".currency_sel2").select2();

            $("#category").select2({
                width: 'element',
                minimumResultsForSearch: Infinity,
                dropdownCssClass: 'bigdrop',
                allowClear: true,
                ajax: {
                    url: "{{ route('store.category.search') }}",
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