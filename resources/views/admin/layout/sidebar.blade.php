<div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="" style="background:#6861ce;">
            <a href="{{ route('admin') }}" class="logo">
              <img
                src="{{$company ? asset('storage/'.$company->logo) : asset('assets/admin/img/demoProfile.png') }}"
                alt="navbar brand"
                class="navbar-brand"
                height="40px"
                width="60px"
                
              />
              <!-- <span style="color:#fff;font-size:10px"></span> -->
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">

                <li class="nav-item {{ ($page=='home') ? 'active' : '' }}">
                <a href="/admin">
                  <i class="fas fa-home"></i>
                   <p>Dashboard</p>
                </a>
              </li>

              <li class="nav-item {{ ($page == 'slider' || $page == 'management' || $page == 'users' || $page == 'client' || $page == 'wellcome') ? 'active' : "" }}">
                <a data-bs-toggle="collapse" href="#web">
                  <i class="fas fa-globe"></i> 
                  <p>Web Content</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="web">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="{{ route('admin.slider') }}" style="padding: 5px 24px !important">
                        <p class="{{ ($page == 'slider') ? 'sub-item' : 'pl' }}">Slider</p>
                      
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('admin.wellcome') }}" style="padding: 5px 24px !important">
                        <p class="{{($page == 'wellcome') ? 'sub-item' : "pl" }}">Welcome</p>
                      </a>
                    </li>

                    <!-- <li>
                      <a href=" route('admin.management') }}" style="padding: 5px 24px !important">
                        <p class=" ($page == 'management') ? 'sub-item' : "pl" }}">Management</p>
                      </a>
                    </li> -->

                    {{-- 
                      <li>
                      <a href="{{ route('admin.client') }}" style="padding: 5px 24px !important">
                        <p class="{{ ($page == 'client') ? 'sub-item' : "pl" }}">Client</p>
                      </a>
                    </li>
                    --}}

                    @can('viewAny' ,Auth()->user()) 
                    <li class="" >
                      <a href="{{ route('admin.users') }}" style="padding: 5px 24px !important">
                        <p class="{{ ($page == 'users') ? 'sub-item' : "pl" }}">Users</p>
                      </a>
                    </li>
                    @endcan
                  </ul>
                </div>
              </li>

              <li class="nav-item {{ ($page == 'service' || $page == 's-message') ? 'active' : "" }}">
                <a data-bs-toggle="collapse" href="#productss">
                  <i class="fas fa-project-diagram"></i>
                  <p>Service</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="productss">
                  <ul class="nav nav-collapse">
                    
                    <li>
                      <a href="{{ route('admin.service') }}" style="padding: 5px 24px !important">
                        <p class="{{ ($page == 'service') ? 'sub-item' : 'pl' }}">Service</p>
                      </a>
                    </li>

                    <li>
                      <a href="{{ route('admin.service.message') }}" style="padding: 5px 24px !important">
                        <p class="{{ ($page == 's-message') ? 'sub-item' : 'pl' }}">Service Message</p>
                      </a>
                    </li>
                    
                  </ul>
                </div>
              </li>
              
              
              {{-- 
              
                <li class="nav-item {{ ($page=='service') ? 'active' : '' }}">
                <a href="{{ route('admin.service') }}">
                  <i class="fas fa-wrench"></i>
                  <p>Service</p>
                </a>
              </li>

              <li class="nav-item {{ ($page=='s-message') ? 'active' : '' }}">
                <a href="{{ route('admin.service.message') }}">
                  <i class="fas fa-comment"></i>
                  <p>Service Message</p>
                </a>
              </li>

              --}}

              

             {{-- 
               <li class="nav-item {{ ($page=='ch') ? 'active' : '' }}">
                <a href="{{ route('admin.ch-message') }}">
                  <i class="fas fa-feather-alt"></i>
                  <p>Chairman-message</p>
                  
                </a>
              </li>
             --}}
             <li class="nav-item {{ ($page=='report') ? 'active' : '' }}">
                <a href="{{ route('admin.report') }}">
                  <i class="fas fa-feather-alt"></i>
                  <p>Report</p>
                </a>
              </li>

              <li class="nav-item {{ ($page=='booking') ? 'active' : '' }}">
                <a href="{{ route('admin.apoint') }}">
                  <i class="fas fa-check-circle"></i>
                  <p>Booking</p>
                </a>
              </li>
              
              <li class="nav-item {{ $page == 'hospital' || $page == 'country' ? 'active' : "" }}">
                <a data-bs-toggle="collapse" href="#hospital">
                  <i class="fas fa-project-diagram"></i>
                  <p>Hospital</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="hospital">
                  <ul class="nav nav-collapse">
                    
                    <li>
                      <a href="{{ route('admin.country') }}" style="padding: 5px 24px !important">
                        <p class="{{ ($page == 'country') ? 'sub-item' : 'pl' }}">Country</p>
                      </a>
                    </li>

                    <li>
                      <a href="{{ route('admin.client') }}" style="padding: 5px 24px !important">
                        <p class="{{ ($page == 'hospital') ? 'sub-item' : "pl" }}">Hospital</p>
                      </a>
                    </li>
                    
                  </ul>
                </div>
              </li>
               
               
              

              <li class="nav-item {{ ($page=='about') ? 'active' : '' }}">
                <a href="{{ route('admin.about') }}">
                  <i class="fas fa-info-circle"></i>
                  <p>About Us</p>
                </a>
              </li>
              <!-- <li class="nav-item ">
                <a href=" route('admin.feedback') }}">
                  <i class="fas fa-map"></i> 
                  <p>Feedback</p>
                
                </a>
              </li> -->
              <li class="nav-item  {{ ($page=='faq') ? 'active' : '' }}">
                <a href="{{ route('admin.faq') }}">
                  <i class="fas fa-question-circle"></i> 
                  <p>Faq</p>
                </a>
              </li>

              <li class="nav-item  {{ ($page=='feedback') ? 'active' : '' }}">
                <a href="{{ route('admin.feedback') }}">
                 <i class="fas fa-comments"></i> 
                  <p>Feedback</p>
                </a>
              </li>

              <li class="nav-item {{ ($page=='contact') ? 'active' : '' }}">
                <a href="{{ route('admin.message') }}">
                  <i class="fas fa-envelope"></i>
                  <p>Contact</p>
                </a>
              </li>

              <li class="nav-item {{ ($page=='company') ? 'active' : '' }}">
                <a href="{{ route('admin.company') }}">
                  <i class="fas fa-building"></i>
                  <p>Company</p>
                  
                </a>
              </li>
              
            </ul>
          </div>
        </div>
      </div>