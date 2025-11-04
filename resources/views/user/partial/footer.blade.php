<footer class="footer-area area-padding-top bg-blue">
    <div class="container">
        <div class="row px-xl-5 pt-3">
            <div class=" col-md-4 mb-5 col-12 pr-3 pr-xl-5">
                <p class="mb-2 text-white"><i class="fa fa-map-marker-alt text-white mr-3"></i>{{ optional($company)->address }}
                </p>
                <p class="mb-2 text-white"><i class="fa fa-envelope text-white mr-3"></i>{{ optional($company)->email }}</p>
                <p class="mb-0 text-white"><i class="ti-tablet text-white mr-3"></i>{{ optional($company)->phone }}</p>

                <h6 class="text-white text-uppercase mt-4 mb-3">Follow Us</h6>
                <div class="d-flex">
                    <a target="_blank" class="btn btn-primary btn-square mr-2" href="{{ optional($company)->twiter }}"><i
                            class="fab fa-twitter"></i></a>
                    <a target="_blank" class="btn btn-primary btn-square mr-2" href="{{ optional($company)->facebook }}"><i
                            class="fab fa-facebook-f"></i></a>
                    <a target="_blank" class="btn btn-primary btn-square mr-2" href="{{ optional($company)->linkdin }}"><i
                            class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-md-8 col-12">
                <div class="row">
                    <div class="col-lg-2 d-none d-lg-block">

                    </div>
                    <div class="col-md-5 col-lg-4 mb-2">
                        <h5 class="text-white text-uppercase mb-4">Important Link</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-white mb-2" href="{{ route('home') }}"><i
                                    class="fa fa-angle-right mr-2"></i>Home</a>
                            
                            <a class="text-white mb-2" href="{{ route('about') }}"><i
                                    class="fa fa-angle-right mr-2"></i>About</a>
                            
                            <a class="text-white mb-2" href="{{ route('all_hospital') }}"><i class="fa fa-angle-right mr-2"></i>Hospital</a>
                            <a class="text-white mb-2" href="{{ route('contact') }}"><i
                                    class="fa fa-angle-right mr-2"></i>Contact</a>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-2">
                        <h5 class="text-white text-uppercase mb-4">Get In Touch</h5>
                        <p class="mb-4 text-white">{{ optional($company)->footer_text }}</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container footer-bottom d-flex justify-content-between">
        <p class=" col-sm-12 footer-text m-0 text-white text-center">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;
            <script>document.write(new Date().getFullYear());</script> All rights reserved | Designed & Developed by  <a href="https://linktechbd.com" class="text-white">Link-Up Technology</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        </p>
        
    </div>

</footer>