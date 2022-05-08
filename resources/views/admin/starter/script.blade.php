<!-- BEGIN VENDOR JS -->
<script src="{{ asset("admin/assets/plugins/pace/pace.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("admin/assets/plugins/jquery/jquery-3.2.1.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("admin/assets/plugins/modernizr.custom.js") }}" type="text/javascript"></script>
<script src="{{ asset("admin/assets/plugins/jquery-ui/jquery-ui.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("admin/assets/plugins/popper/umd/popper.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("admin/assets/plugins/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("admin/assets/plugins/jquery/jquery-easy.js") }}" type="text/javascript"></script>
<script src="{{ asset("admin/assets/plugins/jquery-unveil/jquery.unveil.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("admin/assets/plugins/jquery-ios-list/jquery.ioslist.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("admin/assets/plugins/jquery-actual/jquery.actual.min.js") }}"></script>
<script src="{{ asset("admin/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js") }}"></script>
<script type="text/javascript" src="{{ asset("admin/assets/plugins/select2/js/select2.full.min.js") }}"></script>
<script type="text/javascript" src="{{ asset("admin/assets/plugins/classie/classie.js") }}"></script>
<script src="{{ asset("admin/assets/plugins/switchery/js/switchery.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("admin/assets/plugins/nvd3/lib/d3.v3.js") }}" type="text/javascript"></script>
<script src="{{ asset("admin/assets/plugins/nvd3/nv.d3.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("admin/assets/plugins/nvd3/src/utils.js") }}" type="text/javascript"></script>
<script src="{{ asset("admin/assets/plugins/nvd3/src/tooltip.js") }}" type="text/javascript"></script>
<script src="{{ asset("admin/assets/plugins/nvd3/src/interactiveLayer.js") }}" type="text/javascript"></script>
<script src="{{ asset("admin/assets/plugins/nvd3/src/models/axis.js") }}" type="text/javascript"></script>
<script src="{{ asset("admin/assets/plugins/nvd3/src/models/line.js") }}" type="text/javascript"></script>
<script src="{{ asset("admin/assets/plugins/nvd3/src/models/lineWithFocusChart.js") }}" type="text/javascript"></script>
<script src="{{ asset("admin/assets/plugins/mapplic/js/hammer.min.js") }}"></script>
<script src="{{ asset("admin/assets/plugins/mapplic/js/jquery.mousewheel.js") }}"></script>
<script src="{{ asset("admin/assets/plugins/mapplic/js/mapplic.js") }}"></script>
{{-- <script src="{{ asset("admin/assets/plugins/rickshaw/rickshaw.min.js") }}"></script> --}}
<script src="{{ asset("admin/assets/plugins/jquery-sparkline/jquery.sparkline.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("admin/assets/plugins/skycons/skycons.js") }}" type="text/javascript"></script>
<!-- END VENDOR JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<script src="{{ asset("admin/pages/js/pages.js") }}"></script>
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="{{ asset("admin/assets/js/scripts.js") }}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="{{ asset("admin/assets/js/dashboard.js") }}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->
<script>
    {{--$(document).ready(function () {--}}
        {{--var $url = "{{  url('/dashboard/notification') }}";--}}
        {{--var items = $('div.notification-item');--}}
        {{--function notification(){--}}
            {{--var dataList = $(items).map(function () {--}}
                {{--//return $(this).attr("data-id");--}}
                {{--return $(this).data('id');--}}
            {{--});--}}
            {{--return dataList;--}}
            {{--console.log(dataList);--}}


        {{--}--}}

        {{--$("#notification-center").click(function () {--}}


           {{--var notificationsData =  notification();--}}
           {{--//console.log(notificationsData)--}}






            {{--var jsonString = JSON.stringify(notificationsData);--}}
            {{--//console.log(notificationsData)--}}
            {{--//--}}


            {{--$.ajax({--}}
                {{--url:$url,--}}
                {{--method: "POST",--}}
                {{--dataType: "json",--}}
                {{--data:{--}}
                    {{--_token: '{{ csrf_token() }}',--}}
                     {{--data : jsonString--}}
                {{--},--}}

                {{--success:function(data){--}}
                    {{--//alert('success!');--}}
                   {{--// console.log(data);--}}



                    {{--},--}}
                {{--error: function (){--}}
                    {{--//alert('error');--}}
                    {{--},--}}
            {{--})--}}
        {{--});--}}
    {{--})--}}
</script>
@yield("script_extra")