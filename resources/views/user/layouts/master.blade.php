
<!DOCTYPE html>
<html lang="en">
<head>
  @include('user.layouts.head')
</head>

<body>

  <!-- start loader -->
  {{-- <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner"><div class="loader"></div></div></div></div> --}}
  <!-- end loader -->

<!-- Start wrapper-->
<div id="wrapper">

  @include('user.layouts.sidebar')

  @include('user.layouts.topbar')

  <div class="clearfix"></div>
  
  <div class="content-wrapper">
    <div class="container-fluid">

      @section('content')

      @show
      
    </div>
    <!-- End container-fluid-->
  </div><!--End content-wrapper-->

  <!--Start Back To Top Button-->
  <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
  <!--End Back To Top Button-->
  
  @include('user.layouts.footer')
</div><!--End wrapper-->
  

  @include('user.layouts.script')

</body>
</html>
