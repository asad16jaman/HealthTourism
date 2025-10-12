<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title')</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="{{ asset('assets/admin/img/kaiadmin/favicon.ico') }}"
      type="image/x-icon"
    />

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
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <div class="container w-100 h-100 d-flex justify-content-center align-items-center">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Admin Login</h2>
                </div>
                <div class="card-body ">
                    <form action="" method="post">
                        @csrf
                        <div class="form-group">
                          <label for="email2">User Name</label>
                          <input type="text" class="form-control" id="" name="username" placeholder="Enter Username">
                          
                        </div>
                        <div class="form-group">
                          <label for="email2">User Email</label>
                          <input type="email" name="email" class="form-control" id="" placeholder="Enter Email">
                          
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Submit" class="btn btn-primary me-2">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.login') }}">Login</a>
                </div>
            </div>
        </div>
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

    <!-- Chart Circle -->
    <script src="{{ asset('assets/admin/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('assets/admin/js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('assets/admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('assets/admin/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugin/jsvectormap/world.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('assets/admin/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('assets/admin/js/kaiadmin.min.js') }}"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{ asset('assets/admin/js/setting-demo.js') }}"></script>
    <script src="{{ asset('assets/admin/js/demo.js') }}"></script>
    <script>
      

      

      
    </script>
  </body>
</html>
