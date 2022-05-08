<!DOCTYPE html>
<html>
 @include("front.master.head")
<body class="bg-light style-default style-rounded">
    <!-- Preloader -->
  <div class="loader-mask">
        <div class="loader">
          <div>ss</div>
        </div>
      </div>
  <!-- Bg Overlay -->
  <div class="content-overlay"></div>
@include("front.master.left-sidebar")
@include("front.master.header")
@yield("content")
@include("front.master.footer")
@include("front.master.script")
</body>
</html>