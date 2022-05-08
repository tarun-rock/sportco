@extends("admin.starter.starter")


@section("title","Store Category")

@section('head_extra')

    <link href="{{ asset('admin/assets/plugins/jquery-nestable/jquery.nestable.css') }}" rel="stylesheet" type="text/css" media="screen" />

    <style type="text/css">
        .invalid-feedback
        {
            display: block;
        }
    </style>

@endsection
@section("content")
    <div class="container-fluid container-fixed-lg bg-white">
        <br/>
        <div class="row">
            <div class="col-xlg-12 col-xl-12">
                <h3 class="page-title">Store Category</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-6">
                    <div class="dd" id="basic_example">
                            <ol class="dd-list">
                                @foreach($categories as $category)
                                <li class="dd-item">
                                    <div class="dd-handle">
                                        {{ $category->name }}
                                    </div>
                                    @if(count($category->childs))
                                        @include('admin.partials.store_cat',['childs' => $category->childs])
                                    @endif
                                </li>
                                @endforeach
                            </ol>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <form role="form" method="post" action="" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group form-group-default required">
                                <label>Parent Category</label>
                                <select name="parent_category" data-placeholder="Search by name..."
                                        class="js-example-basic-single form-control" tabindex="-1" width="100%" ></select>
                            </div>
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" class="form-control" name="name" minlength="3"  maxlength="40" placeholder="New Category's name" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
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


        </div>
    </div>
@endsection
@section('script_extra')
    <script src="{{asset('admin/assets/plugins/jquery-nestable/jquery.nestable.js')}}"></script>
    <script src="{{asset('js/select2.full.min.js')}}"></script>


    <script>
        var uploadedImageURL;
        $(document).ready(function () {


            $('#basic_example').nestable();

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