@extends('admin.starter.starter')

@php $sub = "Add"; @endphp
@if(!empty($questions->name))
    @php $sub = "Edit"; @endphp
@endif
@section('title','Add Questions')

@section('head_extra')

    <meta name="csrf_token" content="{{ csrf_token() }}" />

@endsection

@section("content")
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header ">
                    <div class="card-title">
                        {{$sub}} Questions
                    </div>
                </div>
                <div class="card-body">
                    <form class="mainForm" role="form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12" id="mainPredict">
                                <div class="sm-m-l-5 sm-m-r-5">
                                    <div class="card-group horizontal" id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="card card-default m-b-0">
                                            <div class="card-header " role="tab" id="headingOne">
                                                <h4 class="card-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="">
                                                        Question 1
                                                    </a>
                                                </h4>
                                            </div>
                                            <div class="card-body pb-0">
                                            <div class="col-md-6">
                                                @if (count($errors) > 0)
                                                    <div class=alert-danger>
                                                    <div class="alert pl-4">
                                                        <ul class="m-0 p-0">
                                                            @foreach ($errors->all() as $error)
                                                                <li >{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    </div>
                                                @endif
                                            </div>
                                            </div>
                                            <div id="collapseOne" class="collapse show" role="tabcard" aria-labelledby="headingOne" style="">
                                                <div class="card-body">
                                                    <div class="form-group form-group-default required">
                                                        <label>Question</label>
                                                        <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" minlength="5" value="{{ $questions->name ?? old("name") }}" @if(($edit==1)) name="questions" @else name="questions[]" @endif


                                                        {{-- name= "@if($edit==1) questions  @else questions[]" @endif --}} maxlength="150" required placeholder="">
                                                    </div>
                                                    <div class="form-group"><label class="control-label">Options</label>
                                                        <div class="more_option moreOptions">
                                                            @if($edit==1)
                                                                @php $i=0; @endphp
                                                                @foreach($answers as $key => $answer)
                                                                    <div class="mb-3">
                                                                        <div class="input-group transparent">
                                                                            <div class="input-group-prepend">
                                                                    <span class="input-group-text transparent">
                                                                       <input  type="radio" name="is_correct[0][]" value="{{ $i++ }}" @if($answer['correct'] == 1) checked @endif required>
                                                                    </span>
                                                                            </div>
                                                                            <input  type="text" name="option[0][]" value="{{ $answer['option']}}" class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                                <div class="more-option"></div>
                                                            <div class="col-md-4">
                                                                <div class="image-cont">

                                                                    <img src="{{$questions->media_url ?? ''}}" class="img-fluid" />
                                                                </div>
                                                            </div>
                                                                    <div class="form-group uploadimage">
                                                                        <label>Upload Image</label>
                                                                        <div class="input-group mb-3">
                                                                            <div class="custom-file">
                                                                                <input type="file" class="custom-file-input" name="image[]" id="imgInp" aria-describedby="inputGroupFileAddon01" accept="image/x-png,image/jpeg,image/jpg">
                                                                                <label class="custom-file-label" id="Picture" for="inputGroupFile01">Choose file</label>
                                                                            </div>
                                                                        </div>
                                                                        @if ($errors->has('image'))
                                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('image') }}</strong>
                                                                </span>
                                                                        @endif
                                                                    </div>

                                                                @else
                                                                <div class="mb-3">
                                                                    <div class="input-group transparent">
                                                                        <div class="input-group-prepend">
                                                                    <span class="input-group-text transparent">
                                                                        <input  type="radio" name="is_correct[0][]" value="0" required>
                                                                    </span>
                                                                        </div>
                                                                        <input  type="text" name="option[0][]" placeholder="Enter Option Text Here" class="form-control" required>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <div class="input-group transparent">
                                                                        <div class="input-group-prepend">
                                                                    <span class="input-group-text transparent">
                                                                        <input type="radio" name="is_correct[0][]" value="1" required>
                                                                    </span>
                                                                        </div>
                                                                        <input  type="text" name="option[0][]" placeholder="Enter Option Text Here" class="form-control" required>
                                                                    </div>
                                                                </div>
                                                            <div class="more-option"></div>
                                                                <div class="form-group uploadimage">
                                                                    <label>Upload Image</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="custom-file">
                                                                            <input type="file" class="custom-file-input" name="image[]" id="imgInp" aria-describedby="inputGroupFileAddon01" accept="image/x-png,image/jpeg,image/jpg">
                                                                            <label class="custom-file-label" id="Picture" for="inputGroupFile01">Choose file</label>
                                                                        </div>
                                                                    </div>
                                                                    @if ($errors->has('image'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('image') }}</strong>
                                                                </span>
                                                                    @endif
                                                                </div>
                                                                @endif
                                                        </div>




                                                        <div class="p-t-10 text-center">
                                                            <button class="btn btn-warning add_options"  data-position="0" type="button">Add More Option</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        @if($edit==0)
                        <div style="text-align: center;">
                            <button type="button" style="margin-top: 20px;" class="btn btn-primary btn-lg add_pred"><i class="fa fa-plus"></i> Add More</button>

                        </div>
                        @endif

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>

        </div>
    </div>


@endsection


@section('script_extra')

    <script type="text/javascript">
        function uploadimage(){
            $('input[type="file"]').on('change',function(e){
                //var fileName = document.getElementsByClassName("imgInp").files[0].name;
                var fileName = e.target.files[0].name;
                $(this).next('label').text(fileName);
                //$(this).next('.custom-file-label').addClass("selected").html(fileName);

            });
        }

        $(function () {



            uploadimage();

     /*       $(document).on("click","input[name='is_correct[]']",function () {

                $("input[name='is_correct[]").removeAttr('checked');

                $("input[name='is_correct[]").val('0');

                $(this).val("1");



            });*/


            $(document).on("click",".add_options",function () {


                var i = $('input[name="is_correct[0][]"]').length;

                var $this = $(this);

                var $length = $this.attr("data-position");

                /*var $optionsAdded = $this.parent().prev().find(".col-sm-5").length;*/

                var  $html = '<div class="removeable mb-3"><div class="input-group transparent">\n' +
                    '\t<div class="input-group-prepend">\n' +
                    '\t\t<span class="input-group-text transparent">\n' +
                    '\t\t\t<span class="trashBtn option_delete"><i class="fa fa-trash"></i></span>\n' +
                    '\t\t</span>\n' +
                    '\t</div><div class="input-group-prepend">\n' +
                    '\t\t<span class="input-group-text transparent">\n' +
                    '\t\t\t<input type="radio" name="is_correct['+ $length +'][]" value="'+ i  +'" required>\n' +
                    '\t\t</span>\n' +
                    '\t</div>\n' +
                    '\t<input type="text" name="option['+ $length +'][]" placeholder="Enter Option Text Here" class="form-control" required>\n' +
                    '</div></div>';

                $this.parent().parent().find(".more-option").append($html);


            });

            $(document).on("click",".option_delete", function () {

                $(this).parents(".removeable").remove();

            });



                $(document).on("click",".add_pred", function () {



                var $main = $("#mainPredict");

                var $key = $main.find(".sm-m-l-5").length + 1;

                var $length = $key - 1;



                var $html = '<div class="sm-m-l-5 sm-m-r-5" data-position="'+ $length + '">\n' +
                    '                                    <div class="card-group horizontal" id="accordion" role="tablist" aria-multiselectable="true">\n' +
                    '                                        <div class="card card-default m-b-0">\n' +
                    '                                            <div class="card-header " role="tab" id="headingOne">\n' +
                    '                                                <h4 class="card-title">\n' +
                    '                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse'+ $key + '" aria-expanded="false" aria-controls="collapseOne" class="">\n' +
                    '                                                        Question '+ $key +'\n' +
                    '                                                    </a>\n' +
                    '                                                </h4>\n' +
                    '                                            </div>\n' +
                    '                                            <div id="collapse'+ $key +'" class="collapse" role="tabcard" aria-labelledby="headingOne" style="">\n' +
                    '                                                <div class="card-body">\n' +
                    '\n' +
                    '                                                    <div class="form-group form-group-default required">\n' +
                    '                                                        <label>Question</label>\n' +
                    '                                                        <input type="text" required class="form-control" minlength="5" name="questions[]" maxlength="150" placeholder="Type your Question Here">\n' +
                    '                                                    </div>\n' +
                    '                                                    <div class="form-group"><label class="col-sm-2 control-label">Options</label>\n' +
                    '\n' +
                    '                                                        <div class="more_option moreOptions">\n' +
                    '                                                            <div class="input-group transparent mb-3">\n' +
                    '<div class="input-group-prepend">\n' +
                    '<span class="input-group-text transparent ">\n' +
                    '<input type="radio" name="is_correct[' + $length + '][]" value="0" required>\t\n' +
                    '</span>\n' +
                    '</div>\n' +
                    '<input type="text" required name="option[' + $length + '][]" placeholder="Enter Option Text Here" class="form-control" >\n' +
                    '</div>\n' +
                    ' <div class="input-group transparent mb-3">\n' +
                    '<div class="input-group-prepend">\n' +
                    '<span class="input-group-text transparent">\n' +
                    '<input type="radio" name="is_correct[' + $length + '][]" value="1" required>\t\n' +
                    '</span>\n' +
                    '</div>\n' +
                    '<input type="text" required name="option[' + $length + '][]" placeholder="Enter Option Text Here" class="form-control" >\n' +
                    '</div><div class="more-option"></div>' +
                    '\n' +
                    '                                                        <div class="form-group uploadimage">\n' +
                    '                                                            <label>Upload Image</label>\n' +
                    '                                                            <div class="input-group mb-3">\n' +
                    '                                                                <div class="custom-file">\n' +
                    '                                                                    <input type="file" class="custom-file-input" name="image[]" id="imgInp" aria-describedby="inputGroupFileAddon01" accept="image/x-png,image/jpeg,image/jpg">\n' +
                    '                                                                    <label class="custom-file-label" id="Picture" for="inputGroupFile01">Choose file</label>\n' +
                    '                                                                </div>\n' +
                    '                                                            </div>\n' +
                    '                                                        </div></div>\n' +
                    '                                                        <div style="text-align: center;" class="p-t-35">\n' +
                    '                                                        <button class="btn btn-warning add_options" data-position="'+ $length + '" type="button">Add More Option</button>\n' +
                    '                                                        </div>\n' +
                    '                                                    </div>\n' +
                    '                                                </div>\n' +
                    '                                            </div>\n' +
                    '                                        </div>\n' +
                    '                                    </div>\n' +
                    '                                </div>';


                $main.append($html);
                uploadimage();

            });

        });

    </script>

@endsection
