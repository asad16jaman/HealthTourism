<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title')</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <!-- company Favicon Icon -->
     <link rel="icon" type="image/png" href="{{ asset('storage').'/'.optional($company)->logo }}">

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/admin/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{ asset('assets/admin/css/fonts.min.css') }}"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/kaiadmin.min.css') }}" />


    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/demo.css') }}" />


    <style>
      .main-header .navbar-header {
            min-height: 45px;
        }
        .pl{
          padding-left:25px ;
        }
        
    </style>
    @yield('style')
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
        @yield('pageside')
        
      <!-- End Sidebar -->

      <div class="main-panel">


        <!-- main content header section start... -->
            @include('admin.layout.header')
        <!-- main content header section end... -->

        
        @yield('bodyContent')
        

        <!-- main content footer is start  -->
                @include('admin.layout.footer')
        <!-- main content footer is end  -->


      </div>

      
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/admin/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Chart JS -->
    <!-- <script src="{{ asset('assets/admin/js/plugin/chart.js/chart.min.js') }}"></script> -->

    <!-- jQuery Sparkline -->
    <script src="{{ asset('assets/admin/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>



    <!-- Bootstrap Notify -->
    <script src="{{ asset('assets/admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>



    <!-- Sweet Alert -->
    <script src="{{ asset('assets/admin/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('assets/admin/js/kaiadmin.min.js') }}"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{ asset('assets/admin/js/setting-demo.js') }}"></script>
    <script src="{{ asset('assets/admin/js/demo.js') }}"></script>

     @if(session()->exists('success') || session()->exists('info') || session()->exists('warning') || session()->exists('danger'))

     <script>

      //Notify

      let message = @json(session('success') ?? session('info') ?? session('warning') ?? session('danger'));
      let type = '{{ session()->has('success') ? 'success' : (session()->has('info') ? 'info' : (session()->has('danger') ? 'danger' : 'warning')) }}';
      let iconClass = {
        success: 'fa fa-check-circle',
        info: 'fa fa-info-circle',
        warning: 'fa fa-exclamation-triangle',
        danger: 'fa fa-times-circle'
    };
    
      
      $.notify({
        icon: iconClass[type],
        message
      },{
        type,
        placement: {
          from: "top",
          align: "right"
        },
        time: 1000,
      });

    </script>

      @endif
   
    
    @stack('script')
  </body>
</html>
