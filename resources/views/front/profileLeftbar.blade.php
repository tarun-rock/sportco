<link rel="stylesheet" href="{{ asset('css/croppie.css') }}">
<style>
    label.cabinet {
        display: block;
        cursor: pointer;
    }

    label.cabinet input.file {
        position: relative;
        height: 100%;
        width: auto;
        opacity: 0;
        -moz-opacity: 0;
        filter: progid:DXImageTransform.Microsoft.Alpha(opacity=0);
        margin-top: -30px;
    }

    #upload-demo {
        width: 250px;
        height: 250px;
        padding-bottom: 25px;
    }

    figure figcaption {
        position: absolute;
        bottom: 0;
        color: #fff;
        width: 100%;
        padding-left: 9px;
        padding-bottom: 5px;
        text-shadow: 0 0 10px #000;
    }
    .count-container{
        height: 100%;
        padding: 2rem;
        text-align: center;
        color: #fff;
        background: #D3AD6A;
    }
    .count-container h3{
        color: #fff;
        font-size: 42px;
        font-weight: bold;

    }
    .count-container p{
        color: #fff;
        font-size: 22px;
        font-weight: bold;
        
    }
</style>
@php $currentUrl = url()->current(); @endphp
@php $time = dateTime() @endphp
<div class="content-box">
    <div class="widget widget_mc4wp_form_widget">
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-pic rounded-circle">
                            <img id="item-img-output" src="@if (empty($user->pic)){{url('images/no-image.png')}} @else{{$user->pic}} @endif" alt="avatar"
                                 class="gambar">
                            {{-- placehold.it/150 --}}
                            @if(auth()->id() == $user->id)
                                <p>Upload Image</p>
                                <label for="imgInp"></label>
                                <input type="file" accept="image/*" id="imgInp" name="" class="hidden-field item-img">
                            @endif
                        </div>
                        @if(false)
                            <h6 class="m-t-2">Upload a different photo</h6>
                            <label class="custom-file">
                                <input type="file" id="file" class="custom-file-input">
                                <span class="custom-file-control">Choose file</span>
                            </label>
                        @endif
                    </div>
                    <div class="d-block d-lg-none col-sm-12">
                        <br/>
                        <br/>
                    </div>

                    <div class="col-md-8 text-left">
                        <h3 class="nickname text-capitalize "><span>{{ $user->name }} </span>
                            {{-- @if(auth()->id() == $user->id)
                         <small><a href="#" class="small editnickname small" data-toggle="modal" data-target="#nickname"><i class="far fa-edit"></i></a></small>
                             @endif--}}
                        </h3>
                        <div class="">
                            <div class="border-top p-0 profinfotext">

                                <div class="d-flex justify-content-between mt-2 bg-light p-2">
                                    <div>
                                        <img src="{{url('images/post.svg')}}"/> Posts Published
                                    </div>
                                    <div class="align-self-center">
                                        {{ $posts->total()}}
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-2 bg-light p-2">
                                    <div>
                                        <img src="{{url('images/play.svg')}}"/> Games Played
                                    </div>
                                    <div class="align-self-center">
                                        {{ $games->total()}}
                                    </div>
                                </div>

                                <div class="bg-light">
                                    <div class="d-flex mt-2 p-2 border-bottom">
                                        <div class="mr-2"><img src="{{url('images/token.svg')}}"/></div>
                                        <div class="align-self-center">Tokens</div>

                                    </div>
                                    <div class="row text-center mt-2 pb-2">
                                        <div class="col-4">
                                            <h5 class="m-0 p-0">{{ userTokenDetails($user->id)['earned'] }}</h5>
                                            <small>Earned</small>
                                        </div>
                                        <div class="col-4">
                                            <h5 class="m-0 p-0">{{ userTokenDetails($user->id)['redeemed'] }}</h5>
                                            <small>Redeemed</small>
                                        </div>
                                        <div class="col-4">
                                            <h5 class="m-0 p-0">{{ userTokenDetails($user->id)['earned'] - userTokenDetails($user->id)['redeemed']}}</h5>
                                            <small>Available</small>
                                        </div>
                                    </div>

                                </div>


                            </div>

                        </div>
                        <br/>
                        @if(auth()->id() == $user->id)
                            @if($view  == 1)
                                <button type="button" class="btn btn-sm btn-primary btn-button" id="withdrawtoken">
                                    Withdraw Tokens
                                </button><br>
                                
                            @endif
                            @if($view  == 2)
                                <a href="{{ url('profile') }}/{{strtolower(auth()->user()->nickname)}}"
                                   class="btn btn-sm btn-primary btn-button">Profile</a>
                            @endif

                        @endif
                        <div class="col-6 px-2 py-4">
                            <h4 class="px-2">About</h4>
                            <p id="desc">
                            @if(auth()->id() == $user->id)
                                @if(empty($user->description))
                                    @if (Auth::check())
                                        <i class="small">Click on Update Profile button to update your bio.</i>
                                    @endif

                                @endif
                            {{ $user->description ?? "" }}</p>

                            @if($view  == 1)
                                <button type="button" class="btn btn-sm btn-color btn-button" data-toggle="modal"
                                        data-target="#profile-update1">Update Profile
                                </button>

                            @endif
                            @else
                                {{ $user->description ?? "" }}
                            @endif

                            @if(Auth::User()->email_verified_at == null)

                                <div class="py-3">
                                    <a href="{{ route('verification.notice') }}"  class="btn btn-sm btn-color btn-button">Verify Email</a>
                                </div>
                            @endif

                        </div>


                        

                    </div>
                    {{--@if(auth()->id() == $user->id)--}}

                </div>
            </div>
            <div class="d-block d-lg-none col-sm-12">
                <br/>
                <br/>
            </div>
            @if(!empty($paymentDetails))
                @php
                    // dd($paymentDetails);
                    $amount = $paymentDetails[0]->amount / 100; 

                    $date = date("d M Y H:ia", strtotime($paymentDetails[0]->end_time));
                    $startDate =  \Carbon\Carbon::now();

                    $datetime1 = new \DateTime($startDate);
                    $datetime2 = new \DateTime($paymentDetails[0]->end_time);

                    $interval = $datetime1->diff($datetime2);
                    $days = $interval->days;
                    

                @endphp
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-6">
                            <div class="count-container pb-4">
                                <h3>{{ $dayCount }}</h3>
                                <p>days left</p>
                            </div>        
                        </div>
                        <div class="col-6">
                            <h3>Current Plan</h3>
                            <p>${{ $amount }}/@if($amount == 6) year @else month @endif Starter Plan</p>
                            
                            <h3>Account expiration</h3>
                            <p>{{ $date }}</p>
                        </div>
                        @if($paymentDetails[0]->payment_status == 1)
                            <div class="col-6">
                                <a href="javascript:void(0);" id="Membership" class="btn btn-primary my-4 mx-2">
                                        Cancel Membership
                                </a>

                            </div>

                        @endif
                        {{-- <div class="col-6">
                            <form id="upgradePlan" method="post" action="{{ url('stripe') }}">
                                @csrf
                                @if($amount == 1) 
                                    <input type="submit" name="plan" value="Upgrade Plan" class="btn btn-primary my-4 mx-2">
                                @else
                                    <a href="{{ url('payment') }}" class="btn btn-primary my-4 mx-2">Renew Plan</a>
                                @endif
                            </form>
                        </div> --}}
                              
                    </div>
                </div>

            @else

{{--                 <div class="col-lg-6">
                    <h3 class="text-center">Membership Details</h3>
                    <p class="text-center py-4">No Transaction History Found</p>
                </div> --}}

            @endif
        </div>
        <br/>
        {{-- <h4><span class="badge  badge-primary">90 Point</span></h4>
        <h4><span class="badge  badge-success">43 Stakes</span></h4> --}}

    </div>
</div>
<br/>
<br/>


<div class="userlatestpost mb-4">
    <div class="row">
        @foreach($userlatestposts as $userlatestpost)
            <div class="col-md-6">
                <article class="entry card post-list l_post">


                    <div class="entry__img-holder post-list__img-holder card__img-holder lazy"
                         style="background-image: url('@if(empty($userlatestpost->sportsgram_url)){{$userlatestpost->media_url}}@else {{$userlatestpost->sportsgram_url}}@endif');">
                        @if($userlatestpost->type == returnConfig('sportsgramtype'))
                            <a href="{{ url("sportsgram") }}/{{$userlatestpost->slug}}" class="thumb-url"></a>
                        @else
                            <a href="{{ url("article") }}/{{$userlatestpost->slug}}" class="thumb-url"></a>
                        @endif
                        @if(empty($userlatestpost->sportsgram_url))
                            <img data-src="{{$userlatestpost->media_url}}" alt="" src="{{$userlatestpost->media_url}}"
                                 class="entry__img d-none">
                        @else
                            <img data-src="{{$userlatestpost->sportsgram_url}}" alt=""
                                 src="{{$userlatestpost->sportsgram_url}}" class="entry__img d-none">
                        @endif


                    </div>

                    <div class="entry__body post-list__body card__body">
                        <div class="entry__header">
                            <h2 class="entry__title">
                                @if($userlatestpost->type == returnConfig('sportsgramtype'))
                                    <a href="{{ url("sportsgram") }}/{{$userlatestpost->slug}}">{{$userlatestpost->title}}</a>
                                @else
                                    <a href="{{ url("article") }}/{{$userlatestpost->slug}}">{{$userlatestpost->title}}</a>
                                @endif
                            </h2>
                            <ul class="entry__meta">
                                <li class="entry__meta-author">
                                    <span>by</span>
                                    <a href="{{$userlatestpost->nickname}}">{{$userlatestpost->name}}</a>
                                </li>
                                <li class="entry__meta-date">{{$userlatestpost->date}}</li>
                            </ul>
                        </div>
                        <div class="entry__excerpt">
                            <p>{!! articleLimiter($userlatestpost->description) !!}</p>
                        </div>
                    </div>
                </article>
            </div>
        @endforeach
    </div>
</div>
@auth
    @if($user->id == Auth::user()->id)
        <div class="content-box p-0">
            <div class="copyouter row align-items-stretch ">
                <div class="col-md-6 col-lg-5 order-md-2 invite_frnd_banner">
                    <img src="{{url('images/invite.jpg')}}" width="490" height="180"/>
                    <div class="invitefrnd-text">


                        <h3>Invite a friend and get {{$ReferredTokenValue->value}} Sportco Tokens.
                            <small class="d-block">{{$masterRewardTokens[0]->tokens}} for registration
                                plus {{$masterRewardTokens[1]->tokens}} for an approved post
                            </small>
                        </h3>

                    </div>
                </div>
                <div class="col-md-6 col-lg-7">
                    <div class="p-4">
                        <h6 class="text-uppercase">Invite a Friend</h6>
                        <input id="referralcode" class="border-0 mb-2 bg-light" readonly type="text"
                               value="{{url('invite', $user->app_id)}}" style="color:#54555e"/>
                        <div class="">
                            <a href="javascript:void(0);" class=" btn btn-color btn-sm" id="referralcodebtn" class=""><i
                                        class="far fa-copy"></i> Copy</a>

                            <button type="button" class="btn btn-sm btn-color btn-button" data-toggle="modal"
                                    data-target="#sharelinks">
                                <i class="fas fa-share"></i> Share
                            </button>
                            <br/>
                            <div class="d-block mt-2">
                                <a href="{{url('/refer-terms')}}">Referral Terms & Conditions</a>
                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>

    @endif
@endauth
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="sharelinks" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Invite a Friend</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row p-4">
                <div class="col-md-6">
                    <a class="social social-facebook text-left pl-2 w-100"
                       href="http://www.facebook.com/sharer.php?u={{ $currentUrl }}"
                       title="facebook" target="_blank" aria-label="facebook">
                        <i class="ui-facebook"></i> <strong class="ml-2">Facebook</strong>
                    </a>
                </div>
                <div class="col-md-6">
                    <a class="social social-twitter text-left pl-2 w-100"
                       href="http://twitter.com/share?&url={{$currentUrl}}"
                       title="twitter" target="_blank" aria-label="twitter">
                        <i class="ui-twitter"></i> <strong class="ml-2">Twitter</strong>
                    </a>
                </div>
                <div class="col-md-6">
                    <a class="social social-google-plus text-left pl-2 w-100"
                       href="https://plus.google.com/share?url={{ $currentUrl }}"
                       title="google" target="_blank" aria-label="google">
                        <i class="ui-google"></i> <strong class="ml-2">Google</strong>
                    </a>
                </div>
                <div class="col-md-6">
                    <a class="social social-pinterest text-left pl-2 w-100"
                       href="//pinterest.com/pin/create/%20button?url=={{ $currentUrl }}&amp;media={{$mediaurl}}&amp;description={{$description}}"
                       data-pin-do="buttonPin" data-pin-custom="true" title="pinterest" target="_blank"
                       aria-label="pinterest">
                        <i class="ui-pinterest"></i> <strong class="ml-2">Pinterest</strong>
                    </a>
                </div>
            </div>


        </div>
    </div>
</div>
<div class="modal fade" id="profile-update1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">About</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="updateForm" method="POST">
                @csrf
                <div class="modal-body">

                    <label>Bio</label>
                    <textarea name="bio" class="form-control" rows="6" placeholder="Update your Bio"
                              required>{{ $user->description ?? "" }}</textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-lg btn-color btn-button">Update info</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- profile crop popup -->

<div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Photo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center mb-5">
                <div id="upload-demo" class="center-block"></div>

            </div>
            <div class="modal-footer">

                <button type="button" id="cropImageBtn" class="btn btn-lg btn-color btn-button">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- profile crop popup -->
@section('script_extra')
    <script src="{{ asset('js/croppie.js') }}"></script>
    <script src="{{asset('js/walletValidation.js')}}"></script>
    <script>
        /******* copy referral code ************/
            $("#referralcodebtn").click(function () {
                var copyText = document.getElementById("referralcode");
                copyText.select();
                document.execCommand("copy");
                swal("Copied", "", "success");
                //alert("Copied the text: " + copyText.value);

            })

            $("#Membership").click(function () {

                swal({
                    title: "Are you sure?",
                    text: "Are you sure you want to cancel this Membership",
                    icon: "warning", 
                    type: "error",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Proceed'
                })
                    .then((result) => {

                        if (result.value) {
                
                            $.ajax({
                                url: '{{ url("cancel_membership") }}',
                                type: "POST",
                                data: {
                                    '_token': "{{ csrf_token() }}"
                                },
                                success: function (response) {

                                    if (response.status == 1) {
                                        swal("Success", "Membership cancel successfully!", "success");
                                        setTimeout(function(){
                                            location.reload();
                                        }, 2000);
                                    }

                                }
                            })
                        }

                        
                    });

            })

        /********* profile picture upload ************/

        $("form#updateForm").submit(function (e) {
            e.preventDefault();
            var $data = $(this).serialize();
            $.ajax({
                url: '{{ url("update-profile") }}',
                type: "POST",
                data: {
                    "bio": $("textarea[name='bio']").val(),
                    '_token': "{{ csrf_token() }}"
                },
                success: function (response) {

                    $("#profile-update1").modal("hide");

                    if (response.status == 1) {

                        $("#desc").html(response.text);

                        swal("Success", "Bio updated successfully!", "success");
                    }

                }
            })

        });


        /********* profile picture upload ************/
// Start upload preview image
        var $uploadCrop,
            tempFilename,
            rawImg,
            imageId;

        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.upload-demo').addClass('ready');
                    $('#cropImagePop').modal('show');
                    rawImg = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                swal("Sorry - you're browser doesn't support the FileReader API");
            }
        }

        $uploadCrop = $('#upload-demo').croppie({

            viewport: {
                width: 150,
                height: 150,
                type: 'circle'
            },

            // enforceBoundary: true,
            enableExif: true
        });
        $('#cropImagePop').on('shown.bs.modal', function () {
            // alert('Shown pop');

            $uploadCrop.croppie('bind', {
                url: rawImg
            }).then(function () {
                //console.log('jQuery bind complete');
            });
        });

        $('.item-img').on('change', function () {
            imageId = $(this).data('id');
            tempFilename = $(this).val();
            $('#cancelCropBtn').data('id', imageId);
            readFile(this);
        });
        $('#cropImageBtn').on('click', function (ev) {
            $uploadCrop.croppie('result', {
                type: 'base64',
                format: 'jpeg',
                size: {width: 150, height: 150}
            }).then(function (resp) {

                var $image_data = resp;

                $.ajax({
                    url: '{{  url("/update-profile") }}',
                    type: 'post',
                    data: {"data": resp, "_token": "{{ csrf_token() }}", "type": 1},
                    success: function (data) {
                        $('#item-img-output').attr('src', resp);
                        // if (data.status == 1) {
                        //   console.log(data);
                        // }

                    }

                });
                $('#cropImagePop').modal('hide');
            });
        });


        $('body').on('click', '.c_nav li a', function (e) {

            e.preventDefault();

            //$('#load a').css('color', '#dfecf6');
            // $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="{{url('/images/loading.gif')}}" />');
            $('.c_nav li').removeClass('active');
            $(this).parent('li').addClass('active');


            var url = $(this).attr('href');

            window.history.pushState("", "", url);
            var $type = "";
            if (window.location.href.indexOf("?post") > 0) {
                $type = 'post';
            } else if (window.location.href.indexOf("?page") > 0) {
                $type = 'page';

            } else if (window.location.href.indexOf("?rfredusrs") > 0) {
                $type = 'rfredusrs';

            } else if (window.location.href.indexOf("?history") > 0) {
                $type = 'history';

            }
            getArticles(url, $type);

        });

        function getArticles(url, $type) {
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    '_token': '{{csrf_token()}}',
                    'type': $type
                }
            }).done(function (data) {
                if ($type == 'post') {
                    $('#postactivity').html(data);
                } else if ($type == 'page') {
                    $('#playactivity').html(data);
                } else if ($type == 'rfredusrs') {
                    $('#referredUsers').html(data);
                } else if ($type == 'history') {
                    $('#tokenHistory').html(data);
                }
            }).fail(function () {
                alert('Articles could not be loaded.');
            });
        }

        // End upload preview image

        function authorizationcode() {
            $.ajax({
                url: '{{  url("/otprequest" ) }}',
                type: 'get',
                success: function (data) {

                    if (data == 1) {
                        //swal.close()
                        //$('#optpopup').modal('show');
                        window.location.href = "{{url('/withdrawltoken')}}";

                    }
                },
                error: function (response) {
                    var err = jQuery.parseJSON(response.responseText);
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: err.message,
                    });
                }

            });
        }

        $('#withdrawtoken').on("click", function () {

            if ('{{  userTokens($user->id  ) }}' == 0) {
                swal({
                    type: 'error',
                    title: 'Low Balance',
                    html: '<p>You do not have sufficient tokens to withdraw.</p>',
                    showConfirmButton: false
                });
            } else {
                swal({
                    title: 'Please Wait',
                    html: '<p>Sending Authorization Code...</p><h1 class="mt-5 mb-5 fa fa-spinner fa-spin"></h1>',
                    showConfirmButton: false
                });
                authorizationcode();
            }
        });

        @if($view  == 2)

        /*$('input[name=token]').keyup(function(e) {
            var $token = $('input[name=token]').val();
            $("#value").html($token - "{{$min_token_value['ETH_token_Fee']}}");

            });*/
        $("input[name=token]").focusout(function () {
            var $token = $('input[name=token]').val();
            var $comparevalue = '{{$min_token_value['ETH_token_Fee']}}';
            var $receivableamt = ($token - '{{$min_token_value['ETH_token_Fee']}}').toFixed(4);


            if (parseFloat($token) < parseFloat($comparevalue)) {
                $("#value").show()
                $("#value").addClass('text-danger')
                $("#value").html("Amount is lower than transaction fee <strong>" + {{$min_token_value['ETH_token_Fee']}} +"</strong> (SPCO)");

            } else if ($token == "") {
                $("#value").hide()
            } else {
                $("#value").show()
                $("#value").removeClass('text-danger')
                $("#value").html("Tokens receivable *" + $receivableamt + "(SPCO)* after deduction of " + {{$min_token_value['ETH_token_Fee']}} +"(SPCO) transaction fee.");
            }


        })


        @endif



        $("form#tokenwithd").submit(function (e) {

            e.preventDefault();

            var $string = "";

            var $authorizationcode = $('input[name=otp]').val();

            var $walletaddress = $('input[name=wallet_address]').val();
            var $tokennumber = $('input[name=token]').val();

            if ($authorizationcode.length != 6) {

                $string += "<li id='auth_code'>Authorization Code must be 6 characters long</li>"

            }
            if ($tokennumber == 0) {

                $string += "<li>Amount to Withdraw cannot be <strong>0</strong></li>"

            }
            @if($view  == 2)
            if ($tokennumber < '{{$min_token_value['min_transaction_token']}}') {

                $string += "<li>Please enter value greater then {{$min_token_value['min_transaction_token']}} Token</li>"

            }
            @endif


            if ($walletaddress != "") {

                var valid = WAValidator.validate($("input[name='wallet_address']").val(), 'ETH');

                if (!valid) {

                    $string += "<li id='walletcheck '>Please Enter valid Wallet Address</li>"

                }
            }

            if ($string != "" && $string != null) {


                $("#formerror").html($string);
                $("#formerror").show();
                $('html, body').animate({
                    scrollTop: $("#formerror").offset().top
                }, 200);


                return;

            }

            var $data = $(this).serialize();
            $('#optpopup').modal('hide');
            /*$("#tokenerror").remove();*/
            swal({
                title: 'Please Wait',
                html: '<h1 class="mt-5 mb-5 fa fa-spinner fa-spin"></h1>',
                showConfirmButton: false
            });
            $.ajax({
                url: '{{url('/withdrawltoken')}}',
                type: 'POST',
                data: $data,
                success: function (data) {
                    if (data == 3) {

                        swal({
                            title: "Ops..",
                            text: "Your Authorization Code is Expired",
                            type: "error",
                            footer: '<a href="javascript:void(0)" class="regeneratecode">Regenerate Authorization Code</a>'
                        })
                        $(".regeneratecode").on("click", function () {
                            swal.close()
                            swal({
                                title: 'Please Wait',
                                html: '<h1 class="mt-5 mb-5 fa fa-spinner fa-spin"></h1>',
                                showConfirmButton: false
                            });
                            authorizationcode();
                        })

                    }
                    if (data == 1) {

                        swal({
                            title: "Success!",
                            text: "We have received your Withdrawal Token Request",
                            type: "success"
                        }).then((result) => {
                            if (result.value) {
                                $('#tokenwithd')[0].reset();
                                window.location.href = "{{ url("profile/".$user->u_name) }}"
                            }

                        })


                        $("#tokenerror").hide();

                    }
                },
                error: function (response) {

                    $('#optpopup').modal('hide');
                    var err = jQuery.parseJSON(response.responseText);
                    if (response.status === 422) {

                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: "Information is incorrect",
                        });

                        var otperror = err.errors;
                        var errorString = '<ul>';
                        $.each(otperror, function () {
                            $.each(this, function (key, val) {
                                /// do stuff
                                errorString += '<li>' + val + '</li>';
                            });
                        });

                        errorString += '</ul>';
                        $("#tokenerror").show();
                        $("#tokenerror").html(errorString);

                    } else if (err.message) {

                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: err.message,
                        });


                    }
                    /*$("#username strong").html(err.message);*/
                    /*swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong! Please try Again',
                    });*/
                }

            });

        });


    </script>
@endsection