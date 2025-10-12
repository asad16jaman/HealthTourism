<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ asset('storage/'.optional($company)->logo) }}" type="image/png">
    <title>@yield('title',optional($company)->name)</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/vendors/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/vendors/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/vendors/animate-css/animate.css') }}">
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/custom.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        .nav-item:hover .nav-item > a{
            color: yellow!important;
        }
        .actives{
            color:yellow!important
        }
        .heilighter{
          background: #b20506;
          padding: 0px 13px!important;
          font-weight: 900!important;
          }

          .headerFontHilighter{
            background: #b20506;
            padding: 10px 9px;
            color: #fff;
          }
          @media screen and (min-width:992px){
            .overflow-lg-hidden{
                overflow: hidden!important;
            }
          }

          @media screen and (max-width:991px){
            .sm-nav-color{
                background: rgb(0, 123, 255);
                text-align: center;
            }
          }

    </style>
    @stack('style')
</head>

<body>

    @yield('content')

<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('assets/user/js/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/popper.js') }}"></script>
    <script src="{{ asset('assets/user/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/stellar.js') }}"></script>
    <script src="{{ asset('assets/user/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/mail-script.js') }}"></script>
    <script src="{{ asset('assets/user/js/contact.js') }}"></script>
    <script src="{{ asset('assets/user/js/jquery.form.js') }}"></script>
    <script src="{{ asset('assets/user/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/mail-script.js') }}"></script>
    <script src="{{ asset('assets/user/js/theme.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const el = document.getElementById("typewriter");
            const text = el.getAttribute("data-text");
            let i = 0;
            let isDeleting = false;

            function typeLoop() {
                if (isDeleting) {
                    el.textContent = text.substring(0, i--);
                } else {
                    el.textContent = text.substring(0, i++);
                }

                if (!isDeleting && i === text.length + 1) {
                    isDeleting = true;
                    setTimeout(typeLoop, 2000);
                    return;
                }

                if (isDeleting && i === 0) {
                    isDeleting = false;
                }

                const speed = isDeleting ? 100 : 200;
                setTimeout(typeLoop, speed);
            }

            typeLoop();
        });
    </script>

    @stack('script')
    

</body>

</html>