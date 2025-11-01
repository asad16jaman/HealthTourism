<header class="header_area">
        <div class="top_menu row m0">
            <div class="container">
                <div class="float-left">
                    <a class="dn_btn" href="mailto:{{ optional($company)->email }}"><i class="ti-email"></i>{{ optional($company)->email }}</a>
                    <span class="dn_btn"> 
                        <a href="{{ route('contact') }}" class="text-dark">
                            <i class="ti-location-pin"></i>Find our Location
                        </a>
                    </span>
                </div>
                <div class="float-right">
                    <ul class="list header_social">
                        <li><a href="{{ optional($company)->facebook }}" target="_blank"><i class="ti-facebook headerFontHilighter"></i></a></li>
                        <li><a href="{{ optional($company)->twiter }}"  target="_blank"><i class="ti-twitter-alt headerFontHilighter"></i></a></li>
                        <li><a href="{{ optional($company)->linkdin }}"  target="_blank"><i class="ti-linkedin headerFontHilighter"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg bg-blue overflow-lg-hidden" style="height:60px;">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="/">
                        <img class="img-fluid" style="width:auto;height:100%" src="{{ asset('storage/'.optional($company)->logo) }}"
                            alt="">
                            <div class="sitename" style="text-aligh:left" id="typewriter" data-text="{{ optional($company)->name ?? 'Demo Company' }}"></div>
                          
                        </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset sm-nav-color " id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item"><a class="nav-link {{ $page=='home' ? 'actives' : '' }}" href="/">Home</a></li>
                            <li class="nav-item"><a class="nav-link {{ $page=='about' ? 'actives' : '' }}" href="{{ route('about') }}">About</a></li>
                            <li class="nav-item"><a class="nav-link {{ $page=='service' ? 'actives' : '' }}" href="{{ route('service') }}">Services</a></li>
                            <li class="nav-item"><a class="nav-link {{ $page=='hospital' ? 'actives' : '' }}" href="{{ route('all_hospital') }}">Hospitals</a></li>
                            
                            <li class="nav-item"><a class="nav-link {{ $page=='contact' ? 'actives' : '' }}" href="{{ route('contact') }}">Contact</a></li>
                            <li class="nav-item"><a class="nav-link heilighter {{ $page=='apoint' ? 'actives' : '' }}" href="{{ route('apointment') }}">Take Appointment</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>