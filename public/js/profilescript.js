$(function(){
    // $('#optpopup').modal('show');

    /********* profile picture upload ************/
// Start upload preview image
    var $uploadCrop,
        tempFilename,
        rawImg,
        imageId;

    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
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
    $('#cropImagePop').on('shown.bs.modal', function() {
        // alert('Shown pop');

        $uploadCrop.croppie('bind', {
            url: rawImg
        }).then(function() {
            //console.log('jQuery bind complete');
        });
    });

    $('.item-img').on('change', function() {
        imageId = $(this).data('id');
        tempFilename = $(this).val();
        $('#cancelCropBtn').data('id', imageId);
        readFile(this);
    });
    $('#cropImageBtn').on('click', function(ev) {
        $uploadCrop.croppie('result', {
            type: 'base64',
            format: 'jpeg',
            size: { width: 150, height: 150 }
        }).then(function(resp) {

            var $image_data = resp;

            $.ajax({
                url: '{{  url("/update-profile") }}',
                type: 'post',
                data: {"data": resp, "_token": "{{ csrf_token() }}", "type" : 1},
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

// End upload preview image




    /*$("form#n_nameupdate").submit(function(e){
        e.preventDefault();
        var $data = $(this).serialize();
        $.ajax({
            url: '{{ url("update-profile") }}',
            type: "POST",
            data: $data,
            success: function (response) {
                console.log($data);
                $("#nickname").modal("hide");
                if(response.status == 1)
                {
                    swal({
                        title: "Success!",
                        text: "Updated Successfully",
                        type: "success"
                    }).then(function() {
                        location.reload();
                    });


                }

            }
        })

    });*/

    $(function() {
        $('body').on('click', '#c_nav li a', function(e) {
            e.preventDefault();

            //$('#load a').css('color', '#dfecf6');
            // $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="{{url('/images/loading.gif')}}" />');
            $('#c_nav li').removeClass( 'active' );
            $( this ).parent('li').addClass( 'active' );



            var url = $(this).attr('href');

            window.history.pushState("", "", url);
            var $type = "";
            if (window.location.href.indexOf("?post") > 0) {
                $type = 'post';
            }
            else if (window.location.href.indexOf("?page") > 0) {
                $type = 'page';

            }
            getArticles(url,$type);

        });

        function getArticles(url,$type) {



            $.ajax({
                url : url,
                type: "POST",
                data:{
                    '_token':'{{csrf_token()}}',
                    'type': $type
                }
            }).done(function (data) {
                if ($type=='post'){
                    $('#postactivity').html(data);
                }
                else if ($type=='page'){
                    $('#playactivity').html(data);
                }



            }).fail(function () {
                alert('Articles could not be loaded.');
            });
        }
    });



});