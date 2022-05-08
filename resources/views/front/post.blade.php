@extends('front.master.main')
@section('head_extra')
    <script>

        ga('send', {
            hitType: 'event',
            eventCategory: 'Publish',
            eventAction: 'Post Loaded',
            eventLabel: 'Publish Post Loaded'
        });
        @if(auth()->user()->type == returnConfig("user"))
        @if(!empty($publishfirstpostload))
        ga('send', {
            hitType: 'event',
            eventCategory: 'Publish',
            eventAction: 'First Post Loaded',
            eventLabel: 'Publish First Post Loaded'
        });
        @endif
        @endif

    </script>
    <link rel="canonical" href="http://www.google.co.uk<?php echo $_SERVER['REQUEST_URI'];?>">


    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/custom-fonts/style.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/cropper.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/cropper-main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/yoast.css') }}"> --}}


    <link rel="stylesheet" href="{{ asset('back/dist/css/yoast.css') }}">
<link rel="stylesheet" href="{{ asset('back/assets/libs/cropper/dist/cropper.min.css') }}">
    <style>
        /*.alertmsg span{
            display: block;
            margin-bottom: 10px;
        }*/
        .swal2-popup .swal2-actions {
            margin: 0 !important;
        }

        .imagearticle.loader-mask {
            background: rgba(0, 0, 0, 0.8);
            display: block !important;
        }

        .imagearticle.loader-mask .loader {
            display: block !important;
        }

        .imagearticle.loader-mask .loader > div {
            width: 80px;
            height: 80px;
            border-width: 10px;
        }
    </style>

@endsection
@section('content')
    <br/><br/>
    <div class="contentOuter postEditPage mb-5">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8 mainCntnt">
                    <!-- Create Post Form -->
                    <div class="sh_tabsOuter">
                        <div class="tabs">
                            <ul class="tabs__list">

                                <li class="tabs__item tabs__item--active">
                                    <a href="#article" class="tabs__url tabs__trigger">Article</a>
                                </li>
                                <li class="tabs__item" id="secondtab">
                                    <a href="#images-section" data-postID="{{$sportsgram->id ?? 0}}"
                                       class="tabs__url tabs__trigger">Images</a>
                                </li>
                                <li class="tabs__item">
                                    <a href="javascript:void(0);" class="tabs__url tabs__trigger">Video <span
                                                class="badge badge-danger">Coming Soon</span></a>
                                </li>
                            </ul> <!-- end tabs -->
                        </div>
                        <div class="tabs__content tabs__content-trigger">
                            <div id="images-section" class="tabs__content-pane ">
                                <div class="alert alert-danger small sportsgramerror" style="display: none;">
                                    <ul class="">

                                    </ul>
                                </div>
                                <input class="articleTitle" placeholder="Title" name="sportsgramTitle"
                                       value="{{ $sportsgram->title ?? "" }}" required>

                                <div class="tabCntnt mt-4">

                                    @if(auth()->user()->type == returnConfig("admin"))
                                        <ul class="gallery" id="admingallery">
                                            {{--{{ dd(explode(',',$mediaUrl[0])) }}--}}
                                            @foreach($results as $result)
                                                <li class="square-box">
                                                    <div class="inner-img-cont">
                                                        <a href="javascript:void(0);" title="Delete Image"
                                                           data-pid="{{ $sportsgram->id ?? "" }}"
                                                           data-id="{{$result['id']}}" class="deleteimg text-white p-2"><i
                                                                    class="fas fa-trash"></i> </a>
                                                        <img src="{{$result['url']}}" class="cropperlargeimg"/>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>

                                    @else
                                        <ul class="gallery" id="galleryImages">
                                            <li class="square-box addmoreimg d-none" id="insertbefore">
                                                <a href="javascript:void(0);" title="Add More Images" id="triggerclick"><i
                                                            class="fas fa-plus"></i></a>
                                            </li>
                                        </ul>

                                        <div class="cropperimg-container d-none mb-3">
                                        </div>
                                        <div style="position: relative;">
                                            <div class="img-container">
                                                <img id="image" src="{{ url("images/image-icon.svg") }}" alt="Picture">
                                            </div>
                                            {{--<input type="hidden" id="myOutputId" value="">--}}

                                            <div class="uploadImage overlay-cont">
                                                {{-- <p>Drop file here<span>or</span></p>--}}
                                                <button class="btn btn-lg btn-color">Choose Files</button>
                                                {{--<input type="file" name="shareImage" id="shareImage">--}}
                                                <input type="file" id="gallery-photo-add" name="files"
                                                       multiple="multiple"
                                                       accept=".jpg,.jpeg,.png,.gif">
                                            </div>
                                            <div class="d-none">
                                                <input class="articleTitle" placeholder="Title">
                                                <div class="tabCntnt">
                                                    <div class="uploadImage">
                                                        <p>Drop file here<span>or</span></p>
                                                        <button class="btn btn-lg btn-color">Select</button>
                                                        <input type="file" name="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div id="article" class="tabs__content-pane tabs__content-pane--active">
                                <div class="alert alert-danger small posterror" style="display: none;">
                                    <ul class="">

                                    </ul>
                                </div>
                                <div id="error-msg" class="invalid-feedback"></div>
                                <input class="articleTitle" value="{{ $content->title ?? "" }}" placeholder="Title"
                                       name="title" required>
                                <div class="tabCntnt mt-4">
                                    <div id="error-msg" class="invalid-feedback"></div>
                                    <textarea name="content" id="editor"
                                              maxlength="50">{{ $content->description ?? "" }}</textarea>
                                    <div id="counter"></div>

                                </div>
                                <br/>
                                <div class="alert alert-warning">
                                    <small> Works best on <b>Chrome, Safari, Mozilla</b> browsers</small>
                                </div>


                            </div>


                            {{-- <div id="video" class="tabs__content-pane">
                                <input class="articleTitle" placeholder="Title">
                                <div class="tabCntnt">
                                    <div class="uploadImage">
                                        <p>Drop file here<span>or</span></p>
                                        <button class="btn btn-lg btn-color">Select</button>
                                        <input type="file" name="">
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <br/>
                        <div class="small alert-danger alert">
                            In case you are facing any issues, please reach out to us on
                            <a href="mailto:support@sportco.io" class="text-danger">support@sportco.io</a>
                        </div>
                    </div>
                    <br/>
                    @if(auth()->user()->type == returnConfig("admin"))
                        <div class="tabs__content">
                            <div id="snippet" class="output"></div>
                            <label for="focusKeyword">Focus Keyword</label>
                            <input id="focusKeyword" placeholder="Enter Your main keyword" name="focus"
                                   value="{{ $content->meta_keyword ?? "" }}">
                            <div id="output" class="output"></div>
                        </div>
                    @endif
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 sidebar sidebar--right">
                    <div class="sideCntntBlk widget selectsports ">
                        <h4 class="widget-title">Select Sports</h4>
                        <div class="sideCntntBody">
                            <div id="error-msg" class="invalid-feedback"></div>
                            <select data-placeholder="Choose a Sport" class="chosen-select" tabindex="2" name="sports"
                                    required>
                                <option value=""></option>

                                @foreach ($sports as $sport)
                                    <option @if(!empty($edit) && $content->sports_id == $sport->id ) selected
                                            @endif value="{{$sport->id }}">{{$sport->name}}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>


                    {{-- <div class="sideCntntBlk widget">
                        <h4 class="widget-title">Publish</h4>
                        <div class="sideCntntBody">
                            <div class="pubStatus">
                                 <span><i class="icon-key"></i> Status: Publish</span>
                            </div>
                            <div class="pubStatus">
                                 <span><i class="icon-eye"></i> Visibillity: Public</span>
                            </div>
                            <div class="pubStatus">
                                 <span><i class="icon-time"></i> Revisionns: 2</span>
                            </div>
                            <div class="pubStatus">
                                 <span><i class="icon-calendar"></i> Published on: <strong>Sep 1, 2018 @14:57</strong></span>
                            </div>
                        </div>
                    </div> --}}
                    <div class="sideCntntBlk  widget salecttags">
                        <h4 class="widget-title">Select Tags</h4>
                        <div class="sideCntntBody">

                            <select name="tags[]" data-placeholder="Search by name..."
                                    class="js-example-basic-single form-control" tabindex="-1" multiple="multiple"
                                    width=100%>

                                @if(!empty($content->tag_id))
                                    @php
                                        $tags = explode(",",$content->tag_name);
                                        $tagID = explode(",",$content->tag_id);
                                    @endphp
                                    @foreach($tags as $key => $tag)
                                        <option selected="selected" value="{{ $tagID[$key] }}">{{ $tag }}</option>
                                    @endforeach
                                @endif
                                @if(!empty($content->temp_name))
                                    @php $tempTags = explode(",",$content->temp_name) @endphp
                                    @foreach($tempTags as $tag)
                                        <option selected="selected" value="{{ $tag }}">{{ $tag }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <br/>
                        <div class="alert alert-warning">
                            <small>Separated By Comma (,)</small>
                        </div>
                    </div>


                    <div class="sideCntntBlk featuredImg widget">
                        <h4 class="widget-title">Featured Image</h4>
                        <div class="sideCntntBody">
                            <div class="docs-preview clearfix">
                                {{-- <div class="preview img-preview preview-lg"> --}}
                                <div class="">
                                    <form id="form1" runat="server">

                                        <img id="Picture" data-src="#" src="{{ $content->media_url ?? "" }}"/> <br/>
                                        <label>Set featured Image
                                            <input type="file" id="imgInp" accept="image/*" name=""
                                                   class="hidden-field">
                                        </label>
                                    </form>
                                </div>
                                <div class="clearfix"></div>

                                <div class="alert alert-warning">
                                    <small>Minimum image resolution should be 800(w)*400(h)</small>
                                </div>
                                <div class="invalid-feedback"></div>
                            </div>


                        </div>
                    </div>
                    <div class="sideCntntBlk text-right">


                        @if(auth()->user()->type == returnConfig("admin"))
                            <button class="btn btn-lg btn-color postBtn btn-button" id="draft" name="draft"
                                    data-type='2'>
                                Save
                            </button>
                            @if(!empty($acceptpostedit))
                                <button data-type='3' type="button"
                                        class="btn postBtn btn-button btn-color btn-lg">Publish
                                </button>
                            @else
                                <button type="button" class="btn btn-lg btn-color btn-button approve"
                                        data-toggle="modal">
                                    Save and Approve
                                </button>
                            @endif

                        @else
                            <button class="btn btn-lg btn-color postBtn btn-button" data-type='1'>Post</button>
                            <button class="btn btn-lg btn-color postBtn btn-button" id="draft" name="draft"
                                    data-type='2'>
                                Save Draft
                            </button>


                        @endif


                    </div>

                </div>

            </div>
        </div>
    </div>

    @if(auth()->user()->type == returnConfig("admin") && empty($acceptpostedit))

        <div class="modal fade slide-up disable-scroll" id="modalSlideUp" tabindex="-1" role="dialog"
             aria-hidden="false">
            <div class="modal-dialog ">
                <div class="modal-content-wrapper">
                    <div class="modal-content">
                        <div class="modal-header clearfix imagehideadmin">

                            <h5 class="modal-title">Action Required
                                <br/>
                                <p class="mb-0">
                                    <small>Please select respective options</small>
                                </p>
                            </h5>


                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                            </button>
                        </div>
                        <div class="modal-body">
                            <form role="form" action="post">
                                <div class="form-group-attached">
                                    @if(!empty($sections->count()))
                                        <div class="row imagehideadmin">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Section</label><br>
                                                    <div class="radio radio-success">

                                                        @foreach($sections as $section)
                                                            <div class="form-check form-check-inline">
                                                                <input type="radio" value="{{ $section->id }}"
                                                                       name="section" id="{{ $section->name }}"
                                                                       aria-invalid="false">
                                                                <label for="{{ $section->name }}">{{ $section->name }}</label>
                                                            </div>
                                                        @endforeach


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif<br/>
                                    <div class="row">
                                        <div class="col-12">
                                            <label>Share Feedback
                                                <small class="text-muted">(Optional)</small>
                                            </label>
                                            <textarea class="form-control" name="rejectstatus" rows="2"></textarea>
                                        </div>
                                    </div>
                                        @if(!empty($rssids))
                                        <div class="row mb-4">
                                            <div class="col-12">
                                                <label>Rss
                                                    <small class="text-muted">(Optional)</small>
                                                </label>
                                                <select class="form-control" id="rssid" name="rssid">
                                                    <option value="0">Select option</option>
                                                    @foreach($rssids as $key => $rss)
                                                        <option value="{{ $rss }}">{{ $key}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        @endif
                                    <div class="row articlehideadmin mb-4">
                                        <div class="col-12">
                                            <label>Image Tokens
                                                <span class="text-danger">*</span>
                                            </label>

                                            <select class="form-control" id="imagetoken" required name="imagetoken">
                                                @foreach($imagetokens as $imagetoken)
                                                    <option value="{{ $imagetoken->id }}">{{ $imagetoken->tokens}}
                                                        Tokens
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="alert alert-info small mb-0">
                                                <h6 class="mb-2 pb-0">Token Awarding Guidelines for Image Posts</h6>
                                                <ul>
                                                    @foreach($imagetokens as $imagetoken)
                                                        <li><strong>{{ $imagetoken->tokens}} Tokens</strong>
                                                            - {{ $imagetoken->title}}</li>
                                                    @endforeach
                                                </ul>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row imagehideadmin  ">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Category
                                                    <small>(optional)</small>
                                                </label>
                                                <select class="form-control" id="category" required name="category">
                                                    <option value=""></option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <div class="m-t-10 sm-m-t-10">
                                            <button data-type='3' type="button"
                                                    class="btn postBtn btn-primary btn-block m-t-5">Publish
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
    @endif
@endsection
@section('script_extra')
    {{-- <script src="{{ asset('js/post.js') }}"></script> --}}
<script src="{{ asset('back/assets/libs/cropper/dist/cropper.min.js') }}"></script>
    <script src="{{ asset('back/dist/js/editor.js') }}"></script>
{{-- <script src="{{ asset('back/assets/libs/select2/dist/js/select2.full.min.js') }}"></script> --}}
    <script src="{{ asset('js/select2.full.min.js') }}"></script>
    <script>

        $(document).ready(function () {

                    @if(auth()->user()->type == returnConfig("admin"))

            var focusKeywordField = document.getElementById("focusKeyword");
            var contentField = document.getElementById("editor");


            var snippetPreview = new YoastSnippetPreview({
                targetElement: document.getElementById("snippet"),
                baseURL: "{{url('/')}}/article/",
                placeholder: {
                    urlPath: "slug goes here"
                },
                data: {
                    title: "{{ $content->meta_title ?? '' }}",
                    metaDesc: "{{ $content->meta_description ?? "" }}",
                    urlPath: "{{ substr(implode("",explode('-',$content->slug)),0,-6) ?? "" }}"
                }
            });


            var app = new YoastApp({
                snippetPreview: snippetPreview,
                targets: {
                    output: "output"
                },

                callbacks: {
                    getData: function () {
                        return {
                            keyword: focusKeywordField.value,
                            text: contentField.value
                        };
                    }
                }
            });

            app.refresh();

            focusKeywordField.addEventListener('change', app.refresh.bind(app));
            contentField.addEventListener('change', app.refresh.bind(app));


            $(document).on("click", ".approve", function (event) {
                if ($(".tabs__item--active").find("a").html() == "Article") {
                    $(".articlehideadmin").hide();
                }
                ;

                var $focusKeywordFieldvalue = document.getElementById("focusKeyword").value;
                var $seotitle = document.getElementById("snippet-editor-title").value;
                var $seoslug = document.getElementById("snippet-editor-slug").value;
                var $meta_description = document.getElementById("snippet-editor-meta-description").value;

                var file_data = $("#imgInp").prop("files")[0];

                var $imageCheck = $("#Picture").attr("src");
                var test = '';
                if ($(".tabs__item--active").find("a").html() == "Images") {

                    test = $focusKeywordFieldvalue == "" || $seotitle == "" || $seoslug == "" || $meta_description == "";
                    $('.imagehideadmin').addClass("d-none")
                }
                if ($(".tabs__item--active").find("a").html() == "Article") {
                    if ($(".imagehideadmin").hasClass("d-none")) {
                        $('.imagehideadmin').removeClass("d-none")
                    }
                    test = $focusKeywordFieldvalue == "" || $seotitle == "" || $seoslug == "" || $meta_description == "" || file_data == null && $imageCheck == "";
                    if (file_data == null && $imageCheck == "") {
                        swal({
                            title: "Error!",
                            text: "Feature image for your article is required",
                            type: "error",
                        })
                        $(".featuredImg").addClass("invalid")

                    } else {
                        $(".featuredImg").removeClass("invalid")
                    }
                }

                if (test) {


                    if ($focusKeywordFieldvalue == "" || $seotitle == "" || $seoslug == "" || $meta_description == "") {


                        swal(
                            'Error!',
                            'Please fill all fields!',
                            'error'
                        )


                        if ($focusKeywordFieldvalue == "") {
                            $("#focusKeyword").addClass("invalid");
                        }


                        if ($seotitle == "") {
                            $("#snippet-editor-title").addClass("invalid");

                        }
                        if ($seoslug == "") {
                            $("#snippet-editor-slug").addClass("invalid");

                        }
                        if ($meta_description == "") {
                            $("#snippet-editor-meta-description").addClass("invalid");
                        }

                        return;
                    } else {

                        $("#focusKeyword").removeClass("invalid");
                        $("#snippet-editor-title").removeClass("invalid");
                        $("#snippet-editor-slug").removeClass("invalid");
                        $("#snippet-editor-meta-description").removeClass("invalid");


                    }
                } else {

                    $("#modalSlideUp").modal("show");
                }


            });
            @endif

            @if(empty($edit))

            $("#draft").hide();

            @endif

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
                /*tags: true,*/
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

            var $select2 = $(".js-example-basic-single");


            $select2.select2("trigger", "select", {
                data: {id: "1"}
            });


            //  $select2.select2('val', ['brown','red','green']);

        });

        var editorinstance;
        ClassicEditor.create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: '{{ url("article-image-upload") }}?_token={{ csrf_token() }}'
            },
            mediaEmbed: {
                // configuration...
            }
        }).then(editor => {
            editorinstance = editor;

            editor.model.document.on('change', () => {

                document.querySelector('#counter').innerText = 'Length of the text in the document: ' + countCharacters(editor.model.document);


                var editorData = editorinstance.getData();

                $("#editor").html($(editorData).text());
                $("#editor").trigger("change");

            });
            //    editor.model.document.on( 'keyup', () => {
            //       	document.querySelector('#counter').innerText = 'Length of the text in the document: ' + countCharacters( editor.model.document );
            // 				} );
            // Update the counter when editor is ready.
            document.querySelector('#counter').innerText = 'Length of the text in the document: ' + countCharacters(editor.model.document);

            //editor.isReadOnly = true;
            //   var dataaaa = editor.getData();
            //  console.log(dataaaa)


        })
            .catch(error => {
                console.error(error);
            });

        //initSample();
        function countCharacters(document) {


            var editorData = editorinstance.getData();
            const rootElement = $(editorData).text();


            return countCharactersInElement(rootElement);

            // Returns length of the text in specified `node`
            //
            // @param {module:engine/model/node~Node} node
            // @returns {Number}
            function countCharactersInElement(node) {
                let chars = 50000;


                chars -= rootElement.length;
                wordcount = rootElement.length;
                // var max_characters =2000;
                // var remaining = max_characters - chars;
                // chars = remaining;
                // charsw = child.data;
                // console.log(charsw);
                if (wordcount >= 50000) {
                    // editor.isReadOnly = true;
                    // charssss = charsw.substr(0, 5);
                    // console.log(charssss);
                    // swal({
                    //     type: 'error',
                    //     title: 'Error!',
                    //     text: 'Your Character limit is reached'
                    // })
                } else {
                    //  console.log('no');
                }

                if (wordcount >= 5) {
                    $("#draft").show();
                } else if (wordcount <= 5) {
                    $("#draft").hide();
                }


                return chars;
            }
        }
    </script>



    <!-- dropdown with search jquery Start -->
    <script src="{{asset('js/chosen.jquery.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/init.js')}}" type="text/javascript" charset="utf-8"></script>
    <!-- dropdown with search jquery End  -->
    <!-- Cropper js-->
    {{--<script src="{{asset('js/cropper.js')}}"></script>--}}
    <script src="https://fengyuanchen.github.io/cropperjs/js/cropper.js"></script>
    {{--<script src="{{url('js/cropperfunction.js')}}"></script>--}}

    <script>


        $(document).ready(function () {

                    @if(auth()->user()->type == returnConfig("admin"))
                    @if($sportsgram->type ?? 0 == returnConfig("sportsgramtype"))
            var currentAttrValue = $("#secondtab a").attr('href');
            $('.tabs__content-trigger ' + currentAttrValue).stop().fadeIn(1000).siblings().hide();
            $("#secondtab a").parent('li').addClass('tabs__item--active').siblings().removeClass('tabs__item--active');
            $('.featuredImg').fadeOut()
            $('.salecttags').fadeOut()

            @endif
            @endif




            /*  var Cropper = window.Cropper;


              var canvas = $("#image");*/


            /*var cropper = canvas.cropper({
                aspectRatio: 3 / 2,
                viewMode: 1,
                guides: false,
                zoomable: false,
                highlight: false,
                autoCrop: false,
                cropBoxResizable: false,
                minCropBoxWidth: 900,
                minCropBoxHeight: 600

            });
            canvas.cropper();*/

            /*a = $('#image').cropper('getData');
            b = $('#image').cropper('getImageData');
            url = $('#image').cropper('getCanvasImage').attr('src');*/

            // Import image
            /* var $inputImage = $('#shareImage');
             var $image1 = $('#image');
             var $dataX = $('#dataX');
             var $dataY = $('#dataY');
             var $dataHeight = $('#dataHeight');
             var $dataWidth = $('#dataWidth');
             var $dataRotate = $('#dataRotate');
             var $dataScaleX = $('#dataScaleX');
             var $dataScaleY = $('#dataScaleY');
             var imageSrc = $('#image').attr('src');
             */
            var uploadedImageURL;
            var $options2 = {
                aspectRatio: 4 / 3,
                viewMode: 1,
                guides: false,
                zoomable: false,
                highlight: false,
                autoCrop: false,
                minCropBoxWidth: 1000,
                minCropBoxHeight: 750,
                //preview: '.img-preview',
                ready() {
                    this.cropper.crop();
                },
                crop: function (e) {
                    /* $dataX.val(Math.round(e.detail.x));
                     $dataY.val(Math.round(e.detail.y));
                     $dataHeight.val(Math.round(e.detail.height));
                     $dataWidth.val(Math.round(e.detail.width));
                     $dataRotate.val(e.detail.rotate);
                     $dataScaleX.val(e.detail.scaleX);
                     $dataScaleY.val(e.detail.scaleY);*/
                }
            };


            /*function toImport(importID) {

                var $inputImage = importID;

                if (URL) {
                    $inputImage.change(function () {

                        var files = this.files;
                        var file;

                        if (!$image1.data('cropper')) {

                            return;
                        }

                        if (files && files.length) {

                            file = files[0];
                            $(".overlay-cont").hide();
                            if (/^image\/\w+$/.test(file.type)) {


                                uploadedImageName = file.name;
                                uploadedImageType = file.type;

                                if (uploadedImageURL) {
                                    URL.revokeObjectURL(uploadedImageURL);
                                }

                                uploadedImageURL = URL.createObjectURL(file);
                                $image1.cropper('destroy').attr('src', uploadedImageURL).cropper(options);
                                $picture.src = uploadedImageURL = URL.createObjectURL(file);
                                cropper.destroy();
                                cropper = new Cropper($picture, $options);

                                //  $inputImage.val('');
                            } else {

                                window.alert('Please choose an image file.');
                            }
                        }
                    });
                } else {
                    $inputImage.prop('disabled', true).parent().addClass('disabled');
                }
            }

            $(document).on('click', '#shareImage', function () {
                var importID = $('#shareImage');


                toImport(importID);
            });*/


            $(function () {


                // Multiple images preview in browser
                $(document).on('click', '.imgcropbtn', function () {
                    cropper.destroy();
                    $(".btn-outer").remove();
                    $imageURl = $(this).parent().find("img").attr("src");
                    var imgid = $(this).attr("data-id");
                    var img = $('<img class="canvascropper d-none">'); //Equivalent: $(document.createElement('img'))
                    img.attr('src', $imageURl);
                    var cropbtn = $('<div class="btn-outer"><button type="button" data-imgID="' + imgid + '" class="btncropped btn btn-color">Crop</button><button type="button" data-imgID="' + imgid + '" class="deletecrop ml-3 btn btn-color">Cancel</button></div>');
                    /*$('.cropperimg-container').fadeIn();*/
                    $('.cropperimg-container').removeClass("d-none");
                    $('.cropperimg-container').html(img)
                    $('.cropperimg-container').after(cropbtn)
                    $('.img-container').addClass('d-none')
                    $('.uploadImage').addClass('d-none')
                    var $picture2 = document.querySelector('.canvascropper');
                    cropper = new Cropper($picture2, $options2);


                });


                $(document).on('click', '.btncropped', function () {
                    $(".btn-outer").remove();
                    //var croppersize = cropper.getCanvasData();
                    var form_data = new FormData();
                    var imgid = $(this).attr("data-imgid");
                    var pid = $('#secondtab a').attr("data-postid");

                    $imagesrc = $("#galleryImages li").find("[data-id='" + imgid + "']").parent().find('img');

                    var a = cropper.getData();
                    var b = cropper.getImageData();
                    //var url = cropper('getCanvasImage').attr('src');
                    var url = cropper.getCroppedCanvas().toDataURL();
                    form_data.append("cropimg", 1);
                    form_data.append("imgid", imgid);
                    form_data.append("type", "0");
                    form_data.append("pid", pid);
                    form_data.append("width", a.width);
                    form_data.append("height", a.height);
                    form_data.append("rotate", a.rotate);
                    form_data.append("x", a.x);
                    form_data.append("y", a.y);
                    form_data.append("ow", b.naturalWidth);
                    form_data.append("oh", b.naturalHeight);
                    form_data.append("_token", "{{ csrf_token() }}");
                    var $url = "{{  route('uploadSportsgramImage') }}";
                    $.ajax({
                        url: $url,
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,                         // Setting the data attribute of ajax with file_data
                        type: 'post',
                        success: function (response) {
                            if (response.status == 1) {
                                //d = new Date();
                                $($imagesrc).attr('src', response.imageurl + "?" + new Date().getTime());
                                //$($imageURl).removeAttr("src")
                                cropper.destroy();
                                $('.cropperimg-container').addClass("d-none");


                            }
                        }
                    });
                });

                $(document).on('click', '.deletecrop', function () {
                    cropper.destroy();
                    $(".btn-outer").remove();
                    $('.cropperimg-container').addClass("d-none");

                });

                $(document).on('click', '.deleteimg', function () {
                    $imageId = $(this).attr("data-id");
                    $p_Id = $(this).attr("data-pid");
                    var data = {
                        'imageid': $imageId,
                        'postId': $p_Id,
                    };
                    $.ajax({
                        url: "{{route('deleteSportsgramImage')}}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        data: data,
                        cache: false,
                        success: function (response) {
                            if (response.status == 1) {

                                @if(auth()->user()->type == returnConfig("admin"))
                                $("#admingallery li a[data-id =" + $imageId + "]").parent().parent().remove();
                                @else
                                $("#galleryImages li a[data-id =" + $imageId + "]").parent().parent().remove();
                                @endif

                                cropper.destroy();
                                $(".btn-outer").remove();
                                swal({
                                    title: "Success!",
                                    text: "Image Deleted",
                                    type: "success",
                                })

                            }
                        },
                        error: function (response) {
                            //console.log('error : ' + JSON.stringify(response));
                            if (response.status == 0) {
                                swal({
                                    title: "Error!",
                                    text: "Please Try Again!",
                                    type: "error",
                                })
                            }
                        }

                    });

                })


                var imagesPreview = function imagesPreview(input, placeToInsertImagePreview) {
                    if (input.files) {
                        /*$('.loader-mask').show();
                        $('.loader-mask .loader').show();*/


                        var filesAmount = input.files.length;
                        var reader = new FileReader();
                        /* */


                        sportsgramimageUpload(filesAmount);

                        //reader.readAsDataURL(input.files[0]);


                    }
                };

                function sportsgramimageUpload(filesAmount, i = 0) {
                    var fd = new FormData();
                    fd.append('file', document.getElementById('gallery-photo-add').files[i]);
                    var $firstImage = $("#secondtab a").attr('data-postid');

                    fd.append('postid', $firstImage);
                    $.ajax({
                        url: "{{route('uploadSportsgramImage')}}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        data: fd,
                        async: true,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            //swal.showLoading()
                            // swal.hideLoading()
                            if (response.status == 1) {

                                $("#insertbefore").removeClass("d-none")
                                var html = "<li class='square-box'><div class='inner-img-cont'> <a href='javascript:void(0);' title='Delete Image' data-pid='" + response.postid + "' data-id='" + response.imageId + "' class='deleteimg text-white p-2'><i class='fas fa-trash'></i> </a> <img class='cropperlargeimg' name='imagecropped' id='" + i + "' src='{{url("images/temp_sportsgram")}}/" + response.imageName + "'> <a href='javascript:void(0);' title='crop Image' data-pid='" + response.postid + "' data-id='" + response.imageId + "' class='imgcropbtn'><span><i class='fas fa-crop'></i> Crop</span></a></div></li>";
                                $(html).insertBefore("#insertbefore");
                                $("#secondtab a").attr('data-postid', response.postid)
                                $(".uploadImage,.img-container").addClass("d-none")
                                //swal.hideLoading();


                                if (i < (filesAmount - 1)) {
                                    swal.fire({
                                        html: '<i class="fa fa-spinner fa-spin mb-3" style="font-size:24px"></i>',
                                        title: "Please wait",
                                        showConfirmButton: false,
                                    })

                                    i++;
                                    sportsgramimageUpload(filesAmount, i);

                                } else {
                                    swal.close()
                                }


                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            var obj = jQuery.parseJSON(jqXHR.responseText);
                            console.log();
                            var $error = "";

                            if (obj.errors != []) {
                                $(".img-container").addClass("invalid")
                                $.each(obj.errors['file'], function (key, value) {


                                    $error += '<li><i class="fas fa-circle"></i>' + value + '</li>'
                                })

                            }

                            swal({
                                title: "Error!",
                                text: "Please fill all fields!",
                                type: "error",
                            }).then(function (isConfirm) {
                                if (isConfirm) {
                                    $('html, body').animate({
                                        scrollTop: $(".posterror").offset().top
                                    }, 500);
                                }
                            });

                            $(".sportsgramerror").show();
                            $(".sportsgramerror ul").html($error);

                        }
                    });
                }


                $('#triggerclick').on('click', function () {
                    $('#gallery-photo-add').trigger('click');
                });

                $('#gallery-photo-add').on('change', function () {

                    imagesPreview(this, 'div.gallery');
                });
            });


            var $picture = document.querySelector('#Picture');

            //$image.cropper();

            var $options = {
                aspectRatio: 16 / 9,
                viewMode: 1,
                guides: false,
                zoomable: false,
                highlight: false,
                autoCrop: false,
                cropBoxResizable: false,
                minCropBoxWidth: 800,
                minCropBoxHeight: 450,
                /*crop: function(event) {
                    // console.log(event.detail.x);
                    // console.log(event.detail.y);
                    // console.log(event.detail.width);
                    // console.log(event.detail.height);
                    // console.log(event.detail.rotate);
                    // console.log(event.detail.scaleX);
                    // console.log(event.detail.scaleY);

                },*/
                ready() {
                    this.cropper.crop();
                },
            };
            var cropper = new Cropper($picture, $options);


            // url =  $image.cropper('getCanvasImage').attr('src');


            //var currentSrc = $('#Picture').attr('src');
            // if (currentSrc == null || currentSrc == "") {
            //     $('#Picture').attr('src', '');
            //     $("#Picture").on('click', function () {
            //         $("#imgInp").trigger('click')
            //     })
            // }

            // function readURL(input) {
            //     if (input.files && input.files[0]) {
            //         var reader = new FileReader();
            //         reader.onload = function (e) {
            //             $('#Picture').attr('src', e.target.result);
            //         }

            //         reader.readAsDataURL(input.files[0]);
            //     }
            // }

            function toImport(importID) {
                var $inputImage = importID;
                //console.log($inputImage);

                if (URL) {
                    $inputImage.change(function () {

                        var files = this.files;
                        var file;

                        if (!$picture.src) {
                            return;
                        }

                        if (cropper && files && files.length) {
                            file = files[0];
                            // $(".overlay-cont").hide();
                            if (/^image\/\w+$/.test(file.type)) {
                                uploadedImageName = file.name;
                                uploadedImageType = file.type;

                                if (uploadedImageURL) {
                                    URL.revokeObjectURL(uploadedImageURL);
                                }

                                uploadedImageURL = URL.createObjectURL(file);
                                //$image.cropper.destroy();
                                //$image.cropper('destroy').attr('src', uploadedImageURL).cropper(options);
                                //$image.cropper('destroy').attr('src', uploadedImageURL).cropper(options);
                                $picture.src = uploadedImageURL = URL.createObjectURL(file);
                                cropper.destroy();
                                cropper = new Cropper($picture, $options);
                                //  $inputImage.val('');
                            } else {

                                window.alert('Please choose an image file.');
                            }
                        }
                    });
                } else {
                    $inputImage.prop('disabled', true).parent().addClass('disabled');
                }
            }

            $(document).on('click', '#imgInp', function () {

                var importID = $('#imgInp');


                toImport(importID);
            });


            // $("#imgInp").change(function () {
            //     readURL(this);
            // });

            @if(!empty($content->media_url))
                $picture.src = "{{ $content->media_url }}";
            cropper.destroy();
            cropper = new Cropper($picture, $options);

            @endif

            $('.tabs__list li:first-child').click(function () {
                $('.featuredImg').fadeIn()
                $('.salecttags').fadeIn()
            });

            $('.tabs__list li:nth-child(2)').click(function () {
                $('.featuredImg').fadeOut()
                $('.salecttags').fadeOut()
            });


            $(document).on("click", ".postBtn", function (event) {
                event.preventDefault();


                //console.log(cropperImageInitCanvas);

                if ($(".tabs__item--active").find("a").html() == "Images") {


                    var $title = $("input[name='sportsgramTitle']").val();
                    var $pId = $("#secondtab a").attr('data-postid');
                    var $type = $(this).data('type');
                    var $sports = $("select[name='sports']").val();
                    $error = "";

                    if (($title == "" || $sports == "") && $type == 1) {


                        if ($pId == 0) {
                            $(".img-container").addClass("invalid")
                            $error = '<li><i class="fas fa-circle"></i>Please Select images.</li>';
                        } else {
                            $(".img-container").removeClass("invalid")
                        }
                        console.log($title.length);

                        if ($title.length < 5) {
                            $("#images-section .articleTitle").addClass("invalid")
                            $error += '<li><i class="fas fa-circle"></i>Please enter a Title for your post - minimum 5 characters.</li>';

                        } else {
                            $(".articleTitle").removeClass("invalid")
                        }
                        if ($sports == "") {
                            $(".selectsports").addClass("invalid")
                            $error += "<li><i class=\"fas fa-circle\"></i>Please select a relevant Sport from the dropdown, as per your post.</li>";
                        } else (
                            $(".selectsports").removeClass("invalid")
                        )

                        swal({
                            title: "Error!",
                            text: "Please fill all fields!",
                            type: "error",
                        }).then(function (isConfirm) {
                            if (isConfirm) {
                                $('html, body').animate({
                                    scrollTop: $(".posterror").offset().top
                                }, 500);
                            }
                        });

                        $(".sportsgramerror").show();
                        $(".sportsgramerror ul").html($error);


                    } else {


                        var form_data = new FormData();

                        form_data.append("pid", $pId);
                        form_data.append("type", $type);
                        form_data.append("title", $title);
                        form_data.append("sports", $sports);
                        $("#insertbefore").removeClass("invalid")

                                @if(auth()->user()->type == returnConfig("admin"))

                        var $focusKeywordFieldvalue = document.getElementById("focusKeyword").value;
                        var $seotitle = document.getElementById("snippet-editor-title").value;
                        var $seoslug = document.getElementById("snippet-editor-slug").value;
                        var $meta_description = document.getElementById("snippet-editor-meta-description").value;
                        var $feedback = $("textarea[name='rejectstatus']").val();
                        var $imagetoken = $("select[name='imagetoken']").val();
                        var $cat = $("select[name='category']").val();



                        form_data.append("seotitle", $seotitle);
                        form_data.append("seoslug", $seoslug);
                        form_data.append("meta_description", $meta_description);
                        form_data.append("focusKeywordFieldvalue", $focusKeywordFieldvalue);
                        form_data.append("feedback", $feedback);
                        form_data.append("imagetoken", $imagetoken);
                        form_data.append("cat", $cat);


                        @if(empty($acceptpostedit))
                        form_data.append("acceptpostedit", "");
                        @else
                        form_data.append("acceptpostedit", 1);
                        @endif
                        @endif

                        swal({
                            title: 'Are you sure?',
                            confirmButtonText: "Confirm",
                            cancelButtonText: "Cancel",
                            showCancelButton: true,
                            showLoaderOnConfirm: true,
                            preConfirm: function () {
                                return new Promise(function (resolve) {

                                    $(".postBtn").attr("disabled", true);
                                    swal.fire({
                                        html: '<i class="fa fa-spinner fa-spin mb-3" style="font-size:24px"></i>',
                                        title: "Please wait, processing...",
                                        showConfirmButton: false,
                                    })
                                    $.ajax({
                                        url: "{{  url('/image-post') }}",
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        type: "POST",
                                        data: form_data,
                                        processData: false,
                                        contentType: false,
                                        success: function (response) {

                                            if (response.userfirstpost == 1) {
                                                ga('send', {
                                                    hitType: 'event',
                                                    eventCategory: 'User Referral',
                                                    eventAction: 'First Post Made',
                                                    eventLabel: 'User Referral First Post Made'
                                                });

                                            }

                                            if (response.status == 1) {

                                                swal({
                                                    title: "Success!",
                                                    text: "Post submitted for approval! Redirecting...",
                                                    type: "success",
                                                })

                                                @if(auth()->user()->type == returnConfig("user"))

                                                ga('send', {
                                                    hitType: 'event',
                                                    eventCategory: 'Publish',
                                                    eventAction: 'Post Image Submitted',
                                                    eventLabel: 'Publish Post Image Submitted'
                                                });

                                                if (response.firstarticlesubmitted == 1) {

                                                    ga('send', {
                                                        hitType: 'event',
                                                        eventCategory: 'Publish',
                                                        eventAction: 'First Post Image Submitted',
                                                        eventLabel: 'Publish First Post Image Submitted'
                                                    });

                                                }

                                                @endif

                                                setTimeout(function () {
                                                    @if(auth()->user()->type == returnConfig("admin"))

                                                    ga('send', {
                                                        hitType: 'event',
                                                        eventCategory: 'Publish',
                                                        eventAction: 'Post Image Approved',
                                                        eventLabel: 'Publish Post Image Approved'
                                                    });

                                                    if (response.firstarticleapproved == 1) {

                                                        ga('send', {
                                                            hitType: 'event',
                                                            eventCategory: 'Publish',
                                                            eventAction: 'First Post Image Approved',
                                                            eventLabel: 'Publish First Post Image Approved'
                                                        });

                                                    }

                                                    window.location.href = "{{ url("dashboard/post-pending") }}"
                                                    @else

                                                        window.location.href = "{{ url("profile") }}/{{ auth()->user()->nickname}}"

                                                    @endif

                                                }, 2000);


                                            }
                                            if (response.status == 2) {
                                                $("#insertbefore").addClass("invalid")
                                                $(".img-container").addClass("invalid")
                                                $error = '<li><i class="fas fa-circle"></i>Please Select images.</li>';
                                                $(".sportsgramerror").show();
                                                $(".sportsgramerror ul").html($error);
                                            }
                                        },
                                        error: function (jqXHR, textStatus, errorThrown) {
                                            $(".sportsgramerror").show();
                                            $("#modalSlideUp").modal("hide");
                                            $(".postBtn").attr("disabled", false);
                                            swal.close();
                                            var obj = jQuery.parseJSON(jqXHR.responseText);
                                            var $error = "";
                                            $.each(obj.errors, function (key, value) {
                                                if (key == "title") {

                                                    $(".articleTitle").addClass("invalid")
                                                    $error += '<li><i class="fas fa-circle"></i>' + value + '</li>'
                                                }
                                                if (key == "sport") {

                                                    $(".selectsports").addClass("invalid");
                                                    $error += '<li><i class="fas fa-circle"></i>' + value + '</li>'
                                                }

                                                swal({
                                                    title: "Error!",
                                                    text: "Please fill all fields!",
                                                    type: "error",
                                                }).then(function (isConfirm) {
                                                    if (isConfirm) {
                                                        $('html, body').animate({
                                                            scrollTop: $(".posterror").offset().top
                                                        }, 500);
                                                    }
                                                });

                                                $(".sportsgramerror ul").html($error);

                                            });
                                            //console.log('error : ' + JSON.stringify(response));
                                        }
                                    });
                                });
                            },

                        }).then(function () {

                            },
                            function (dismiss) {
                                if (dismiss === "cancel") {
                                    swal(
                                        "Cancelled",
                                        "Canceled Note",
                                        "error"
                                    )
                                }
                            });
                    }

                    //urlConversion();
                    //console.log(convertedUrl);
                }


                if ($(".tabs__item--active").find("a").html() == "Article") {


                    var $title = $("input[name='title']").val();

                    var $tags = $(".js-example-basic-single").val();
                    // var $tempTag = $('#taginput').val();


                    var $sports = $("select[name='sports']").val();

                    var $type = $(this).data('type');
                    var $dadmin = $(this).data('admin-id');


                    var $article = editorinstance.getData();


                    var $imageCheck = $("#Picture").attr("src");
                    $(".articleTitle").removeClass("invalid")
                    $(".tabCntnt").removeClass("invalid")
                    $(".selectsports").removeClass("invalid")
                    $(".featuredImg").removeClass("invalid")


                    if ($imageCheck != "") {

                        /*$('#Picture').cropper.destroy();*/
                        var a = cropper.getData();
                        var b = cropper.getImageData();
                        //var url = cropper('getCanvasImage').attr('src');
                        var url = cropper.getCroppedCanvas().toDataURL();


                    }
                    // console.log($article);


                    var file_data = $("#imgInp").prop("files")[0];

                    var form_data = new FormData();


                    @if(empty($edit))

                    form_data.append("img", file_data);
                    @elseif(empty($content->media_url))

                    //form_data.append("img", "");

                    @elseif(!empty($content->media_url))
                    /*form_data.append("img_done",1);*/
                    if (file_data == null) {
                        file_data = 'ggsg';
                    } else {
                        form_data.append("img", file_data);
                    }

                    @endif
                    // form_data.append("tempTag", $tempTag);


                    form_data.append("article", $article);
                    form_data.append("_token", "{{ csrf_token() }}");

                    if ($imageCheck != "") {


                        form_data.append("width", a.width);
                        form_data.append("height", a.height);
                        form_data.append("rotate", a.rotate);
                        form_data.append("x", a.x);
                        form_data.append("y", a.y);
                        form_data.append("ow", b.naturalWidth);
                        form_data.append("oh", b.naturalHeight);
                    }

                    form_data.append("title", $title);
                    form_data.append("tags", $tags);
                    form_data.append("sport", $sports);
                    form_data.append('type', $type);
                    $error = "";


                    /*if ($title == "") {*/
                    if (($article == '<p>&nbsp;</p>' || $title == "" || $sports == "") && $type == 1) {

                        if ($title.length == 0) {


                            $("#article .articleTitle").addClass("invalid")
                            $error = '<li><i class="fas fa-circle"></i>Please enter a Title for your post - minimum 5 characters.</li>';

                        } else {
                            $(".articleTitle").removeClass("invalid")
                        }


                        if ($article == '<p>&nbsp;</p>' || $article.length < 350) {

                            $("#article .tabCntnt").addClass("invalid")
                            //console.log("error");
                            $error += "<li><i class=\"fas fa-circle\"></i>Your post text should be a minimum of 300 characters.</li>";
                        } else {
                            $(".tabCntnt").removeClass("invalid")
                        }
                        if ($sports == "") {
                            $(".selectsports").addClass("invalid")
                            $error += "<li><i class=\"fas fa-circle\"></i>Please select a relevant Sport from the dropdown, as per your post.</li>";
                        } else (
                            $(".selectsports").removeClass("invalid")
                        )
                        /* if (file_data == null) {
                             $(".featuredImg").addClass("invalid")
                             $error += "<li><i class=\"fas fa-circle\"></i>A feature image for your article is required - minimum 800px  x 400px and less than 1 MB in size.</li>" ;

                         }
                         else{
                             $(".featuredImg").removeClass("invalid")
                         }*/

                        swal({
                            title: "Error!",
                            text: "Please fill all fields!",
                            type: "error",
                        }).then(function (isConfirm) {
                            if (isConfirm) {
                                $('html, body').animate({
                                    scrollTop: $(".posterror").offset().top
                                }, 500);
                            }
                        });

                        $(".posterror").show();
                        $(".posterror ul").html($error);
                    } else {

                        var $url = "{{  url('/post') }}";


                                @if(!empty($edit))

                        var $url = "";
                                @endif


                                @auth
                                @if(auth()->user()->type == returnConfig("admin"))

                        var $focusKeywordFieldvalue = document.getElementById("focusKeyword").value;
                        var $seotitle = document.getElementById("snippet-editor-title").value;
                        var $seoslug = document.getElementById("snippet-editor-slug").value;
                        var $meta_description = document.getElementById("snippet-editor-meta-description").value;
                        var $rssid = $("select[name='rssid']").val();
                                @if(empty($acceptpostedit))
                        var $cat = $("select[name='category']").val();
                        var $feedback = $("textarea[name='rejectstatus']").val();
                        var $section = $("input[name='section']:checked").val();
                        form_data.append("cat", $cat);
                        form_data.append("section", $section);
                        form_data.append("feedback", $feedback);
                        form_data.append("acceptpostedit", "");
                        @else
                        form_data.append("acceptpostedit", 1);
                        @endif

                        form_data.append("seotitle", $seotitle);
                        form_data.append("seoslug", $seoslug);
                        form_data.append("meta_description", $meta_description);
                        form_data.append("focusKeywordFieldvalue", $focusKeywordFieldvalue);
                        form_data.append("rssid", $rssid);


                        @if(empty($content->media_url))
                        form_data.append("img_done", 0);
                        @else
                        form_data.append("img_done", 1);
                        @endif

                        if (file_data == null) {
                            form_data.append("img", "");
                        } else {
                            form_data.append("img", file_data);


                        }

                        //var $valid = this.form.reportValidity();
                        @endif
                        @endauth


                        swal({
                            title: 'Are you sure?',
                            confirmButtonText: "Confirm",
                            cancelButtonText: "Cancel",
                            showCancelButton: true,
                            showLoaderOnConfirm: true,
                            preConfirm: function () {
                                return new Promise(function (resolve) {
                                        swal.fire({
                                            html: '<i class="fa fa-spinner fa-spin mb-3" style="font-size:24px"></i>',
                                            title: "Please wait, processing...",
                                            showConfirmButton: false,
                                        })

                                        $(".invalid-feedback").hide();
                                        $(".articleTitle").removeClass("invalid");
                                        $("#article .tabCntnt").removeClass("invalid");
                                        $('.postBtn').attr("disabled", true);


                                        $.ajax({
                                            url: $url,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            data: form_data,                         // Setting the data attribute of ajax with file_data
                                            type: 'post',
                                            success: function (response) {
                                                if (response.userfirstpost == 1) {

                                                    ga('send', {
                                                        hitType: 'event',
                                                        eventCategory: 'User Referral',
                                                        eventAction: 'First Post Made',
                                                        eventLabel: 'User Referral First Post Made'
                                                    });

                                                }
                                                if (response.status == 1) {

                                                    swal.close();

                                                            @if(auth()->user()->type == returnConfig("user"))
                                                    var $msg = "Post submitted for approval! Redirecting...";

                                                    ga('send', {
                                                        hitType: 'event',
                                                        eventCategory: 'Publish',
                                                        eventAction: 'Article Submitted',
                                                        eventLabel: 'Publish Article Submitted'
                                                    });
                                                    if (response.firstarticlesubmitted == 1) {

                                                        ga('send', {
                                                            hitType: 'event',
                                                            eventCategory: 'Publish',
                                                            eventAction: 'First Post Article Submitted',
                                                            eventLabel: 'Publish First Post Article Submitted'
                                                        });

                                                    }

                                                    @endif

                                                    if ($type == 2) {
                                                        $msg = "Post saved as draft! Redirecting..."

                                                        @if(auth()->user()->type == returnConfig("user"))
                                                        if (response.firstarticledrafted == 1) {
                                                            ga('send', {
                                                                hitType: 'event',
                                                                eventCategory: 'Publish',
                                                                eventAction: 'First Post Article Drafted',
                                                                eventLabel: 'Publish First Post Article Drafted'
                                                            });

                                                        }

                                                        ga('send', {
                                                            hitType: 'event',
                                                            eventCategory: 'Publish',
                                                            eventAction: 'Article Drafted',
                                                            eventLabel: 'Publish Article Drafted'
                                                        });

                                                        @endif

                                                    }


                                                    $("#modalSlideUp").modal("hide");

                                                    setTimeout(function () {
                                                        @if(auth()->user()->type == returnConfig("admin"))
                                                            $msg = "Approved! Redirecting...";

                                                        if (response.firstarticleapproved == 1) {

                                                            ga('send', {
                                                                hitType: 'event',
                                                                eventCategory: 'Publish',
                                                                eventAction: 'First Post Article Approved',
                                                                eventLabel: 'Publish First Post Article Approved'
                                                            });

                                                        }


                                                        ga('send', {
                                                            hitType: 'event',
                                                            eventCategory: 'Publish',
                                                            eventAction: 'Article Approved',
                                                            eventLabel: 'Publish Article Approved'
                                                        });

                                                        swal(
                                                            "Success!",
                                                            $msg,
                                                            "success"
                                                        );

                                                        window.location.href = "{{ url("dashboard/post-pending") }}"

                                                        @else

                                                            window.location.href = "{{ url("profile") }}/{{ auth()->user()->nickname}}"

                                                        @endif

                                                    }, 2000);


                                                    // if($dadmin == 3)
                                                    //     {

                                                    //         // setTimeout(function(){
                                                    //         // window.location.href = "{{ url("dashboard") }}"},2000);

                                                    //     }
                                                }

                                            },
                                            /* error: function (data, textStatus,jqXHR) {*/
                                            error: function (jqXHR, textStatus, errorThrown) {
                                                $(".posterror").show();
                                                swal.close();
                                                $(".postBtn").attr("disabled", false);
                                                $("#modalSlideUp").modal("hide");
                                                var obj = jQuery.parseJSON(jqXHR.responseText);
                                                /*if (jqXHR.status == 413) {
                                                    console.log("ddddddd");
                                                }*/


                                                var $html = "";
                                                var $error = "";
                                                if (jqXHR.status == 413) {
                                                    $(".featuredImg").addClass("invalid")
                                                    $error += '<li>The feature image should be less than 12 MB in size. Current image is greater than 12MB</li>'
                                                    $(".posterror ul").html($error);
                                                    $('html, body').animate({
                                                        scrollTop: $(".posterror").offset().top
                                                    }, 500);
                                                }
                                                $.each(obj.errors, function (key, value) {


                                                    if (key == "article") {
                                                        //key = "content";
                                                        $("#article .tabCntnt").addClass("invalid");
                                                        /*console.log(key + value);*/
                                                        $error += '<li><i class="fas fa-circle small mr-2"></i>' + value + '</li>'
                                                    }
                                                    if (key == "title") {

                                                        $("#article .articleTitle").addClass("invalid")
                                                        $error += '<li><i class="fas fa-circle"></i>' + value + '</li>'
                                                    }

                                                    if (key == "sport") {

                                                        $(".selectsports").addClass("invalid");
                                                        $error += '<li><i class="fas fa-circle"></i>' + value + '</li>'
                                                    }

                                                    if (key == "img") {


                                                        $(".featuredImg").addClass("invalid")
                                                        $.each(value, function (key, value) {
                                                            /*console.log(value);*/
                                                            $error += '<li><i class="fas fa-circle"></i>' + value + '</li>'
                                                        })


                                                    }


                                                    swal({
                                                        title: "Error!",
                                                        text: "Please fill all fields!",
                                                        type: "error",
                                                    }).then(function (isConfirm) {
                                                        if (isConfirm) {
                                                            $('html, body').animate({
                                                                scrollTop: $(".posterror").offset().top
                                                            }, 500);
                                                        }
                                                    });

                                                    $(".posterror ul").html($error);


                                                    /*var $html = "<ul class='fa-ul'>";

                                                    $html += "</ul>";*/

                                                    // $("[name='" + key + "']").prev().html($html);
                                                    //$("[name='" + key + "']").prev().show();
                                                    //$("[name='" + key + "']").addClass("invalid");

                                                    /*swal({
                                                        title: "Please check all the fields!",
                                                        showLoaderOnConfirm: false,
                                                        type: 'warning'
                                                    })*/

                                                    if (key == "img") {


                                                        $(".featuredImg .invalid-feedback").html($html);
                                                        $(".featuredImg").addClass("invalid");
                                                        $(".featuredImg .invalid-feedback").show();

                                                    }
                                                    if (key == "seotitle") {
                                                        $("#snippet-editor-title").after('<div class="invalid-feedback d-block">' + $html + '</div>');


                                                    }
                                                    if (key == "seoslug") {
                                                        $("#snippet-editor-slug").after('<div class="invalid-feedback d-block">' + $html + '</div>');
                                                    }
                                                    if (key == "meta_description") {
                                                        $("#snippet-editor-meta-description").after('<div class="invalid-feedback d-block">' + $html + '</div>');
                                                    }
                                                    if (key == "focusKeywordFieldvalue") {
                                                        $("#focusKeyword").after('<div class="invalid-feedback d-block">' + $html + '</div>');
                                                    }

                                                });
                                            }
                                        });


                                });
                            },
                        }).then(function (confirmed) {
                               // console.log(confirmed);

                            },
                            function (dismiss) {
                                if (dismiss === "cancel") {
                                    swal(
                                        "Cancelled",
                                        "Canceled Note",
                                        "error"
                                    )
                                }
                            });


                        // $.ajax({
                        //     url: "{{  url('/post') }}",
                        //     cache: false,
                        //     contentType: false,
                        //     processData: false,
                        //     data: form_data,                         // Setting the data attribute of ajax with file_data
                        //     type: 'post',
                        //     success: function(response) {

                        //         if(response.status == 1)
                        //         {

                        //             swal(
                        //                 'Success!',
                        //                 'Content has been submitted for approval',
                        //                 'success'
                        //             )

                        //         }

                        //     }
                        // });
                    }
                    return;
                } else {

                    //alert("WIP!");

                    return;

                }


            });


        });


    </script>

@endsection
