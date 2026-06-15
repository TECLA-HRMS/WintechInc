<header class="header--sticky header-one ">
        <div class="header-top header-top-one bg-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 d-xl-block d-none ">
                        <div class="left">
                            <div class="mail">
                                <a href="mailto:lochana@wintechinc.in"><i class="fal fa-envelope"></i> lochana@wintechinc.in</a>
                            </div>
                            <div class="working-time">
                                <p><i class="fal fa-phone"></i>99404 36371</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-xl-block d-none ">
                        <div class="right">
                            
                            <ul class="social-wrapper-one">
                                <li><a href="https://www.facebook.com/wintechincofficial/"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="https://www.instagram.com/wintechincofficial"><i class="fab fa-instagram"></i></a></li>
                               
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-main-one bg-white" style="height: 78px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3  col-md-3 col-sm-3 col-3 pt-4 pt-lg-0  d-flex flex-column justify-content-center">
                        <div class="thumbnail">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('logo.png') }}" alt="Wintech Inc" class="img-fluid" title="Wintech Inc" style=" width: 106px; ">
                            </a>
                        </div>
                    </div>
                    <div class=" col-xl-9  col-md-9 col-sm-9 col-9 pt-4 pt-lg-0  d-flex flex-column justify-content-center">
                        <div class="main-header">
                            <nav class="nav-main mainmenu-nav d-none d-xl-block">
                                <ul class="mainmenu">
                                    <li><a class="nav-item" href="{{ url('/') }}">HOME</a></li>
                                    <li><a class="nav-item" href="{{ url('about') }}">ABOUT US</a></li>
                                    <li class="has-droupdown">
                                        <a class="nav-link" href="#">SECTORS</a>
                                        <ul class="submenu">
                                            <li class="has-droupdown nested-dropdown">
                                                <a href="#">IT Sectors </a>
                                                <ul class="submenu">
                                                    <li><a href="{{ url('best-placement-services-for-candidate-in-chennai') }}">Placement Service(Candidate)</a></li>
                                                    <li><a href="{{ url('best-placement-service-for-employers-services-for-candidate-in-chennai') }}">Placement Service (For Employers)</a></li>
                                                    <li><a href="{{ url('best-placement-service-for-it-industry-in-chennai') }}">Placement Service for IT Industry</a></li>
                                                    <li><a href="{{ url('best-placement-placement-services-for-manpower-for-employer-in-chennai') }}">Placement  Service for Manpower  (Employers)</a></li>
                                                    <li><a href="{{ url('best-placement-services-for-manpower-for-candidate-in-chennai') }}">Placement  Service for Manpower  (Candidate)</a></li>
                                                </ul>
                                            </li>
                                            <li class="has-droupdown nested-dropdown">
                                                <a href="#">Non IT Sectors </a>
                                                <ul class="submenu">
                                                    <li><a href="{{ url('best-manpower-suppliers-services-for-candidate-in-chennai') }}">Manpower Suppliers</a></li>
                                                    <li><a href="{{ url('best-manpower-consultants-services-in-chennai') }}">Manpower Consultants</a></li>
                                                    <li><a href="{{ url('best-placement-service-for-accounts-candidate-in-chennai') }}">Placement Service for Accounts</a></li>
                                                    <li><a href="{{ url('best-placement-service-for-accounts-employers-in-chennai') }}">Placement Service for Accounts (Employers)</a></li>
                                                    <li><a href="{{ url('best-placement-service-for-hospital-in-chennai') }}">Placement  Service for Hospital</a></li>
                                                    <li><a href="{{ url('best-manpower-outsourcing-services-in-chennai') }}">Manpower Outsourcing Services</a></li>
                                                    <li><a href="{{ url('best-placement-service-for-banking-sector-in-chennai') }}">Placement Service for Banking Sector</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <style>
                                        @media (min-width: 992px) {
                                            /* Fix mainmenu overrides */
                                            ul.mainmenu li.has-droupdown.nested-dropdown {
                                                position: relative !important;
                                            }
                                            ul.mainmenu li.has-droupdown.nested-dropdown > a::after {
                                                display: none !important; /* Hide default down arrow */
                                            }
                                            /* Position the 3rd level submenu to the right */
                                            ul.mainmenu li.has-droupdown.nested-dropdown > .submenu {
                                                top: 0 !important;
                                                left: 100% !important;
                                                margin-top: -15px !important;
                                                opacity: 0 !important;
                                                visibility: hidden !important;
                                                pointer-events: none !important;
                                                display: block !important;
                                                transform: translateX(15px);
                                                transition: all 0.3s ease !important;
                                            }
                                            ul.mainmenu li.has-droupdown.nested-dropdown:hover > .submenu {
                                                opacity: 1 !important;
                                                visibility: visible !important;
                                                pointer-events: auto !important;
                                                margin-top: 0 !important;
                                                transform: translateX(0);
                                            }
                                        }
                                    </style>
									
                                    <!--<li><a class="nav-item" href="{{ url('why-choose-wintech-hr-consultancy') }}">WHY US</a></li>-->
                                    	<li class="has-droupdown">
                                        <a class="nav-link" href="#">SERVICES</a>
                                        <ul class="submenu">
                                            <li><a href="{{ url('digital-marketing') }}">Digital Marketing</a></li>
                                            <li><a href="{{ url('web-development') }}">Web Development</a></li>
										    <li><a href="{{ url('e-commerce-development') }}">E commerce Development</a></li>
											<li><a href="{{ url('mobile-app-development') }}">Mobile App Development</a></li>
										   </ul>
                                    </li>
									<li><a class="nav-item" href="{{ route('jobs.index') }}">JOBS</a></li>
									<li><a class="nav-item" href="{{ route('site.company') }}">COMPANY</a></li>
									<li><a class="nav-item" href="{{ url('blog') }}">BLOG</a></li>
									
                                    <li><a class="nav-item" href="{{ url('contact') }}">CONTACT US</a></li>
                                </ul>
                            </nav>
                            <div class="button-area" style="display: flex; align-items: center;">
                                <!-- Search Icon / Trigger Pill -->
                                <button id="search" class="search-trigger-pill ml--20 ml_sm--5 d-flex align-items-center gap-2" style="padding: 8px 16px; border-radius: 50px; border: 1px solid #e2e8f0; background: rgba(248, 250, 252, 0.8); cursor: pointer; transition: all 0.3s ease;">
                                    <i class="far fa-search" style="color: #64748b; font-size: 14px;"></i>
                                </button>
                                
                                <!-- User Auth Logic -->
                                @auth
                                    <div class="dropdown" style="margin-left: 12px; position: relative;">
                                        <button class="rts-btn btn-primary-alta profile-dropdown-btn d-flex align-items-center gap-2" type="button" id="userMenu" data-toggle="dropdown" data-bs-toggle="dropdown" data-display="static" data-bs-display="static" aria-haspopup="true" aria-expanded="false" style="padding: 6px 16px 6px 6px; border-radius: 50px; border: 1px solid #e2e8f0; background: #ffffff; box-shadow: 0 4px 10px rgba(0,0,0,0.05); color: #b11e24; transition: all 0.3s ease;">
                                            @if(Auth::user()->profile_picture)
                                                <img src="{{ asset('profile_pictures/' . Auth::user()->profile_picture) }}" alt="Profile" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">
                                            @else
                                                <div style="width: 32px; height: 32px; border-radius: 50%; background: #fff1f2; display: flex; align-items: center; justify-content: center; font-size: 14px; color: #b11e24;"><i class="fas fa-user"></i></div>
                                            @endif
                                            <span style="font-weight: 600; font-size: 14px; color: #1e293b; margin-left: 4px;">{{ explode(' ', Auth::user()->first_name ?? Auth::user()->name ?? 'User')[0] }}</span>
                                        </button>
                                        <ul class="dropdown-menu shadow custom-glass-dropdown" aria-labelledby="userMenu">
                                            <li class="dropdown-header-custom">
                                                <span class="user-greeting">Welcome back,</span>
                                                <span class="user-name">{{ Auth::user()->first_name ?? Auth::user()->name ?? 'User' }}</span>
                                            </li>
                                            <li><a class="dropdown-item profile-dropdown-item" href="{{ route('profile.show') }}">
                                                <div class="icon-wrap"><i class="far fa-user-circle"></i></div> My Profile
                                            </a></li>
                                            <li><a class="dropdown-item profile-dropdown-item" href="{{ route('job.my-applications') }}">
                                                <div class="icon-wrap"><i class="far fa-briefcase"></i></div> My Applications
                                            </a></li>
                                            <li><a class="dropdown-item profile-dropdown-item" href="{{ route('settings') }}">
                                                <div class="icon-wrap"><i class="far fa-cog"></i></div> Settings
                                            </a></li>
                                            <li><hr class="dropdown-divider" style="border-color: rgba(0,0,0,0.05); margin: 8px 0;"></li>
                                            <li>
                                                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item profile-dropdown-item text-danger logout-btn">
                                                        <div class="icon-wrap"><i class="far fa-sign-out-alt"></i></div> Sign Out
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    <style>
                                        /* Override Popper.js jumping & add animations */
                                        .custom-glass-dropdown {
                                            transform: translateY(12px) !important;
                                            top: 130% !important;
                                            right: 0 !important;
                                            left: auto !important;
                                            margin-top: 0 !important;
                                            opacity: 0;
                                            visibility: hidden;
                                            display: block !important; /* Force block to allow opacity transitions */
                                            transition: opacity 0.25s cubic-bezier(0.16, 1, 0.3, 1), transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.25s !important;
                                            
                                            /* Premium Glass Design */
                                            border: 1px solid rgba(0,0,0,0.06) !important;
                                            border-radius: 20px !important;
                                            padding: 15px 10px !important;
                                            min-width: 240px !important;
                                            background: rgba(255, 255, 255, 0.98) !important;
                                            backdrop-filter: blur(20px);
                                            -webkit-backdrop-filter: blur(20px);
                                            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08), 0 1px 3px rgba(15, 23, 42, 0.02) !important;
                                        }

                                        /* Active/Open State */
                                        .dropdown.show .custom-glass-dropdown,
                                        .dropdown-menu.show.custom-glass-dropdown {
                                            opacity: 1 !important;
                                            visibility: visible !important;
                                            transform: translateY(0) !important;
                                        }

                                        /* Caret Pointer pointing to profile button */
                                        .custom-glass-dropdown::before {
                                            content: "";
                                            position: absolute;
                                            top: -8px;
                                            right: 22px;
                                            border-width: 0 8px 8px 8px;
                                            border-style: solid;
                                            border-color: transparent transparent rgba(255, 255, 255, 0.98) transparent;
                                            z-index: 10;
                                        }
                                        .custom-glass-dropdown::after {
                                            content: "";
                                            position: absolute;
                                            top: -9px;
                                            right: 22px;
                                            border-width: 0 8px 8px 8px;
                                            border-style: solid;
                                            border-color: transparent transparent rgba(0,0,0,0.06) transparent;
                                            z-index: 9;
                                        }

                                        .dropdown-header-custom {
                                            padding: 5px 15px 15px 15px;
                                            border-bottom: 1px solid rgba(0,0,0,0.05);
                                            margin-bottom: 10px;
                                        }
                                        .user-greeting { display: block; font-size: 12px; color: #94a3b8; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 2px; }
                                        .user-name { display: block; font-size: 16px; color: #0f172a; font-weight: 700; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
                                        
                                        .profile-dropdown-btn {
                                            box-shadow: 0 4px 10px rgba(0,0,0,0.03);
                                            transition: all 0.25s ease;
                                        }
                                        .profile-dropdown-btn:hover { box-shadow: 0 6px 20px rgba(177,30,36,0.18) !important; transform: translateY(-1px); }
                                        
                                        .profile-dropdown-item { 
                                            display: flex !important; align-items: center; border-radius: 12px; 
                                            padding: 10px 15px 10px 20px !important; 
                                            font-size: 14px; font-weight: 600; color: #475569 !important; margin: 2px 0;
                                            position: relative;
                                            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
                                        }
                                        
                                        .profile-dropdown-item .icon-wrap { width: 28px; display: flex; align-items: center; color: #94a3b8; transition: color 0.2s; font-size: 16px; }
                                        
                                        /* Slide in indicator line */
                                        .profile-dropdown-item::before {
                                            content: "";
                                            position: absolute;
                                            left: 6px;
                                            top: 50%;
                                            transform: translateY(-50%) scaleY(0.4);
                                            width: 3px;
                                            height: 16px;
                                            background-color: #b11e24;
                                            border-radius: 4px;
                                            opacity: 0;
                                            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
                                        }

                                        .profile-dropdown-item:hover { 
                                            background-color: #fff1f2 !important; 
                                            color: #b11e24 !important; 
                                            transform: translateX(4px);
                                            padding-left: 26px !important;
                                        }
                                        .profile-dropdown-item:hover .icon-wrap { color: #b11e24; }
                                        .profile-dropdown-item:hover::before {
                                            opacity: 1;
                                            transform: translateY(-50%) scaleY(1);
                                        }

                                        /* Logout Specific Styling */
                                        .logout-btn::before {
                                            background-color: #ef4444;
                                        }
                                        .logout-btn:hover { background-color: #fef2f2 !important; color: #ef4444 !important; }
                                        .logout-btn:hover .icon-wrap { color: #ef4444; }
                                    </style>
                                @else
                                    <a href="{{ route('login') }}" class="rts-btn btn-primary ml--10 ml_sm--5 header-one-btn quote-btn" style="margin-left: 10px;">Login / Sign Up</a>
                                @endauth

                                <!-- Mobile Menu Button -->
                                <button id="menu-btn" class="menu rts-btn btn-primary-alta ml--10 ml_sm--5 d-block d-xl-none">
                                    <img class="menu-dark" src="{{ asset('assets/images/icon/menu.png') }}" alt="Menu-icon">
                                    <img class="menu-light" src="{{ asset('assets/images/icon/menu-light.png') }}" alt="Menu-icon">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <style>
         @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap');

         .header-top-one.bg-1 {
             background: #071056 !important;
             border-bottom: 1px solid rgba(255, 255, 255, 0.08);
         }
         .header-top-one .left a, 
         .header-top-one .left p {
             font-family: 'Plus Jakarta Sans', sans-serif;
             font-size: 13px !important;
             color: rgba(255, 255, 255, 0.8) !important;
         }
         .header-top-one .left a:hover {
             color: #b11e24 !important;
         }
         .header-main-one.bg-white {
             background: rgba(255, 255, 255, 0.95) !important;
             backdrop-filter: blur(15px);
             -webkit-backdrop-filter: blur(15px);
             border-bottom: 1px solid #f1f5f9;
         }
         ul.mainmenu li a.nav-item,
         ul.mainmenu li a.nav-link {
             font-family: 'Plus Jakarta Sans', sans-serif;
             font-size: 13.5px !important;
             font-weight: 700 !important;
             color: #0f172a !important;
             transition: color 0.25s ease;
             letter-spacing: 0.3px;
         }
         ul.mainmenu li:hover > a.nav-item,
         ul.mainmenu li:hover > a.nav-link {
             color: #b11e24 !important;
         }
         ul.mainmenu li .submenu {
             background: rgba(255, 255, 255, 0.98) !important;
             border-radius: 16px !important;
             box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08) !important;
             border: 1px solid rgba(0, 0, 0, 0.04) !important;
             padding: 16px 10px !important;
             min-width: 250px !important;
             backdrop-filter: blur(15px);
          ul.mainmenu li .submenu {
              background: rgba(255, 255, 255, 0.98) !important;
              border-radius: 16px !important;
              box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08), 0 1px 3px rgba(15, 23, 42, 0.02) !important;
              border: 1px solid rgba(0, 0, 0, 0.06) !important;
              border-top: 1px solid rgba(0, 0, 0, 0.06) !important; /* Override template border-top-color */
              padding: 12px 8px !important;
              min-width: 250px !important;
              backdrop-filter: blur(15px);
              -webkit-backdrop-filter: blur(15px);
              transform: translateY(12px);
              transition: opacity 0.3s cubic-bezier(0.16, 1, 0.3, 1), transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
          }
          
          ul.mainmenu li.has-droupdown:hover > .submenu {
              transform: translateY(0);
          }
          
          /* Modern white caret overlay */
          ul.mainmenu li.has-droupdown .submenu::after {
              border-bottom-color: rgba(255, 255, 255, 0.98) !important;
              top: -16px !important;
              border-width: 8px !important;
              left: 32px !important;
              transform: none !important;
          }

          ul.mainmenu li .submenu li {
          
          /* Slide in red indicator on hover */
          ul.mainmenu li .submenu li a::before {
              content: "";
              position: absolute;
              left: 6px;
              top: 50%;
              transform: translateY(-50%) scaleY(0.4);
              width: 3px;
              height: 16px;
              background-color: #b11e24;
              border-radius: 4px;
              opacity: 0;
              transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
          }
          
          ul.mainmenu li .submenu li a:hover {
              color: #b11e24 !important;
              background: #fff1f2 !important;
              transform: translateX(4px);
              padding-left: 24px !important;
          }
          
          ul.mainmenu li .submenu li a:hover::before {
              opacity: 1;
              transform: translateY(-50%) scaleY(1);
          }
         .header-one-btn.quote-btn {
             background: #b11e24 !important;
             color: #fff !important;
             border: none !important;
             border-radius: 50px !important;
             padding: 12px 28px !important;
             font-family: 'Plus Jakarta Sans', sans-serif;
             font-weight: 700 !important;
             box-shadow: 0 8px 16px rgba(177, 30, 36, 0.15) !important;
             transition: all 0.3s ease !important;
         }
         .header-one-btn.quote-btn:hover {
             transform: translateY(-2px);
             box-shadow: 0 12px 20px rgba(177, 30, 36, 0.25) !important;
         }
     </style>
    <!-- End header area -->

    <div id="side-bar" class="side-bar">
        <button class="close-icon-menu"><i class="far fa-times"></i></button>
        <!-- inner menu area desktop start -->
        <div class="rts-sidebar-menu-desktop">
            
            <div class="body d-none d-xl-block">
               
                <div class="get-in-touch">
                    <!-- title -->
                    <div class="h6 title">Get In Touch</div>
                    <!-- title End -->
                    <div class="wrapper">
                        <!-- single -->
                        <div class="single">
                            <i class="fas fa-phone-alt"></i>
                            <a href="#">+91 9940436371</a>
                        </div>
                        <!-- single ENd -->
                        <!-- single -->
                        <div class="single">
                            <i class="fas fa-envelope"></i>
                            <a href="mailto:lochana@wintechinc.in">lochana@wintechinc.in</a>
                        </div>
                        <!-- single ENd -->
                        <!-- single -->
                        <div class="single">
                            <i class="fas fa-globe"></i>
                            <a href="#">No 8/235, Pillaiyar Kovil St, Vasanth Vihar, Pozhichalur, Chennai 600074.</a>
                        </div>
                        <!-- single ENd -->
                       
                    </div>
                    <div class="social-wrapper-two menu">
                         <a href="https://www.facebook.com/wintechincofficial/"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/wintechincofficial"><i class="fab fa-instagram"></i></a>
                        <!-- <a href="#"><i class="fab fa-linkedin"></i></a> -->
                    </div>
                </div>
            </div>
			
            <div class="body-mobile d-block d-xl-none">
                <nav class="nav-main mainmenu-nav">
                    <ul class="mainmenu">
                       <li><a class="nav-item" href="{{ url('/') }}">Home</a></li>
                                    <li><a class="nav-item" href="{{ url('about') }}">About Us</a></li>
                                    <li class="has-droupdown">
                                        <a class="nav-link" href="#">SECTORS</a>
                                        <ul class="submenu">
                                            <li class="has-droupdown">
                                                <a href="#">IT Sectors</a>
                                                <ul class="submenu" style="padding-left: 15px;">
                                                    <li><a href="{{ url('best-placement-services-for-candidate-in-chennai') }}">Placement Service(Candidate)</a></li>
                                                    <li><a href="{{ url('best-placement-service-for-employers-services-for-candidate-in-chennai') }}">Placement Service (For Employers)</a></li>
                                                    <li><a href="{{ url('best-placement-service-for-it-industry-in-chennai') }}">Placement Service for IT Industry</a></li>
                                                    <li><a href="{{ url('best-placement-placement-services-for-manpower-for-employer-in-chennai') }}">Placement  Service for Manpower  (Employers)</a></li>
                                                    <li><a href="{{ url('best-placement-services-for-manpower-for-candidate-in-chennai') }}">Placement  Service for Manpower  (Candidate)</a></li>
                                                </ul>
                                            </li>
                                            <li class="has-droupdown">
                                                <a href="#">Non IT Sectors</a>
                                                <ul class="submenu" style="padding-left: 15px;">
                                                    <li><a href="{{ url('best-manpower-suppliers-services-for-candidate-in-chennai') }}">Manpower Suppliers</a></li>
                                                    <li><a href="{{ url('best-manpower-consultants-services-in-chennai') }}">Manpower Consultants</a></li>
                                                    <li><a href="{{ url('best-placement-service-for-accounts-candidate-in-chennai') }}">Placement Service for Accounts</a></li>
                                                    <li><a href="{{ url('best-placement-service-for-accounts-employers-in-chennai') }}">Placement Service for Accounts (Employers)</a></li>
                                                    <li><a href="{{ url('best-placement-service-for-hospital-in-chennai') }}">Placement  Service for Hospital</a></li>
                                                    <li><a href="{{ url('best-manpower-outsourcing-services-in-chennai') }}">Manpower Outsourcing Services</a></li>
                                                    <li><a href="{{ url('best-placement-service-for-banking-sector-in-chennai') }}">Placement Service for Banking Sector</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                   <li class="has-droupdown">
                                        <a class="nav-link" href="#">SERVICES</a>
                                        <ul class="submenu">
                                            <li><a href="{{ url('digital-marketing') }}">Digital Marketing</a></li>
                                            <li><a href="{{ url('web-development') }}">Web Development</a></li>
										    <li><a href="{{ url('e-commerce-development') }}">E commerce Development</a></li>
											<li><a href="{{ url('mobile-app-development') }}">Mobile App Development</a></li>
										   </ul>
                                    </li>
									<li><a class="nav-item" href="{{ route('jobs.index') }}">Jobs</a></li>
									<li><a class="nav-item" href="{{ route('site.company') }}">Company</a></li>
									<li><a class="nav-item" href="{{ url('blog') }}">Blog</a></li>
                                    <li><a class="nav-item" href="{{ url('contact') }}">Contact Us</a></li>
                    </ul>
                </nav>
                <div class="social-wrapper-two menu mobile-menu">
                     <a href="https://www.facebook.com/wintechincofficial/"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/wintechincofficial"><i class="fab fa-instagram"></i></a>
                    <!-- <a href="#"><i class="fab fa-linkedin"></i></a> -->
                </div>
                <a href="#" class="rts-btn btn-primary ml--20 ml_sm--5 header-one-btn quote-btnmenu">Get Quote</a>
            </div>
        </div>
        <!-- inner menu area desktop End -->
    </div>

    <!-- Spotlight Search Overlay -->
    <div class="search-input-area spotlight-modal-wrapper">
        <div class="spotlight-card" id="spotlightCard">
            <form action="{{ route('jobs.index') }}" method="GET" style="margin: 0;">
                <!-- Header bar of spotlight card -->
                <div class="spotlight-header">
                    <i class="far fa-search spotlight-search-icon"></i>
                    <input id="searchInput1" name="search" type="text" placeholder="Search jobs, companies, locations..." required autocomplete="off">
                    <div class="spotlight-header-actions">
                        <span class="spotlight-key-badge d-none d-md-inline-block">ESC</span>
                        <button type="button" id="closeSpotlight" class="spotlight-close-btn"><i class="far fa-times"></i></button>
                    </div>
                </div>
                
                <!-- Inner body of spotlight card -->
                <div class="spotlight-body">
                    <!-- Default Suggestions (Visible when input is empty) -->
                    <div class="spotlight-default-suggestions" id="spotlightDefaultSuggestions">
                        <div class="spotlight-section-title">
                            <i class="fas fa-bolt text-danger"></i> Popular Categories
                        </div>
                        <div class="spotlight-categories-grid">
                            <a href="{{ url('best-placement-service-for-it-industry-in-chennai') }}" class="spotlight-cat-item">
                                <i class="far fa-laptop-code"></i> IT Placement Services
                            </a>
                            <a href="{{ url('best-manpower-consultants-services-in-chennai') }}" class="spotlight-cat-item">
                                <i class="far fa-users-cog"></i> Manpower Consultants
                            </a>
                            <a href="{{ url('digital-marketing') }}" class="spotlight-cat-item">
                                <i class="far fa-bullhorn"></i> Digital Marketing
                            </a>
                            <a href="{{ url('web-development') }}" class="spotlight-cat-item">
                                <i class="far fa-browser"></i> Web Development
                            </a>
                        </div>

                        <div class="spotlight-section-title" style="margin-top: 24px;">
                            <i class="far fa-compass text-danger"></i> Quick Links
                        </div>
                        <div class="spotlight-quick-links">
                            <a href="{{ route('jobs.index') }}" class="quick-link-item"><i class="far fa-briefcase"></i> View All Open Jobs</a>
                            <a href="{{ url('about') }}" class="quick-link-item"><i class="far fa-info-circle"></i> About Wintech Inc</a>
                            <a href="{{ url('contact') }}" class="quick-link-item"><i class="far fa-envelope"></i> Get in Touch</a>
                        </div>
                    </div>

                    <!-- Ajax suggestions results list (Visible when typing) -->
                    <div class="spotlight-search-results" id="spotlightSearchResults" style="display: none;">
                        <div class="spotlight-section-title">
                            <i class="fas fa-briefcase text-danger"></i> Suggested Jobs
                        </div>
                        <div class="header-suggestions-list">
                            <!-- Populated dynamically via AJAX -->
                        </div>
                    </div>
                </div>

                <!-- Spotlight footer -->
                <div class="spotlight-footer d-none d-md-flex">
                    <span class="spotlight-footer-tip"><kbd>↵</kbd> to select</span>
                    <span class="spotlight-footer-tip"><kbd>↑↓</kbd> to navigate</span>
                    <span class="spotlight-footer-tip"><kbd>esc</kbd> to close</span>
                </div>
            </form>
        </div>
    </div>

    <style>
        /* Spotlight Modal Wrapper */
        .spotlight-modal-wrapper {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100vw !important;
            height: 100vh !important;
            background: rgba(15, 23, 42, 0.4) !important;
            backdrop-filter: blur(12px) !important;
            -webkit-backdrop-filter: blur(12px) !important;
            display: flex !important;
            align-items: flex-start !important;
            justify-content: center !important;
            padding-top: 10vh !important;
            z-index: 99999 !important;
            opacity: 0 !important;
            visibility: hidden !important;
            transform: scale(0.98) !important;
            transition: opacity 0.25s cubic-bezier(0.16, 1, 0.3, 1), transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.25s !important;
        }

        .spotlight-modal-wrapper.show {
            opacity: 1 !important;
            visibility: visible !important;
            transform: scale(1) !important;
        }

        /* Spotlight Card Container */
        .spotlight-card {
            background: rgba(255, 255, 255, 0.98);
            border: 1px solid rgba(255, 255, 255, 0.7);
            border-radius: 24px;
            width: 90%;
            max-width: 680px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25), 
                        0 0 0 1px rgba(0, 0, 0, 0.05),
                        inset 0 1px 0 rgba(255, 255, 255, 1);
            overflow: hidden;
            animation: spotlightEntry 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes spotlightEntry {
            from { transform: translateY(-20px) scale(0.96); opacity: 0; }
            to { transform: translateY(0) scale(1); opacity: 1; }
        }

        /* Spotlight Header */
        .spotlight-header {
            display: flex;
            align-items: center;
            padding: 18px 24px;
            border-bottom: 1px solid #f1f5f9;
            gap: 16px;
        }

        .spotlight-search-icon {
            font-size: 20px;
            color: #64748b;
        }

        .spotlight-header input {
            flex: 1;
            border: none !important;
            outline: none !important;
            background: transparent !important;
            font-size: 18px !important;
            font-weight: 500 !important;
            color: #0f172a !important;
            padding: 4px 0 !important;
            width: 100% !important;
        }

        .spotlight-header input::placeholder {
            color: #94a3b8;
        }

        .spotlight-header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .spotlight-key-badge {
            font-size: 11px;
            font-weight: 700;
            color: #94a3b8;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 3px 8px;
            letter-spacing: 0.5px;
            box-shadow: 0 1px 1px rgba(0,0,0,0.02);
        }

        .spotlight-close-btn {
            background: transparent;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            font-size: 16px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .spotlight-close-btn:hover {
            background: #f1f5f9;
            color: #0f172a;
        }

        /* Spotlight Body */
        .spotlight-body {
            max-height: 380px;
            overflow-y: auto;
            padding: 24px;
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 transparent;
        }

        .spotlight-body::-webkit-scrollbar {
            width: 6px;
        }
        .spotlight-body::-webkit-scrollbar-track {
            background: transparent;
        }
        .spotlight-body::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 20px;
        }

        .spotlight-section-title {
            font-size: 11px;
            font-weight: 800;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Default Suggestions & Grids */
        .spotlight-categories-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .spotlight-cat-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background: #f8fafc;
            border: 1px solid #f1f5f9;
            border-radius: 12px;
            color: #334155 !important;
            font-size: 13.5px;
            font-weight: 600;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .spotlight-cat-item i {
            color: #94a3b8;
            font-size: 15px;
            transition: color 0.2s;
        }

        .spotlight-cat-item:hover {
            background: #fff1f2 !important;
            border-color: #ffe4e6;
            color: #b11e24 !important;
            transform: translateY(-1px);
        }

        .spotlight-cat-item:hover i {
            color: #b11e24;
        }

        .spotlight-quick-links {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .quick-link-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 10px;
            color: #475569 !important;
            font-size: 13.5px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .quick-link-item i {
            color: #94a3b8;
            font-size: 14px;
        }

        .quick-link-item:hover {
            background: #f8fafc !important;
            color: #0f172a !important;
            transform: translateX(3px);
        }

        /* Result Items */
        .header-suggestions-list {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .spotlight-suggestion-item {
            display: flex;
            align-items: center;
            padding: 14px 18px;
            border-radius: 14px;
            background: #ffffff;
            border: 1px solid #f1f5f9;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            text-decoration: none !important;
        }

        .spotlight-suggestion-item.active-item,
        .spotlight-suggestion-item:hover {
            background: #fff1f2 !important;
            border-color: #ffe4e6 !important;
        }

        .spotlight-suggestion-item:hover .job-title-text,
        .spotlight-suggestion-item.active-item .job-title-text {
            color: #b11e24 !important;
        }

        /* Spotlight Footer */
        .spotlight-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 14px 24px;
            background: #f8fafc;
            border-top: 1px solid #f1f5f9;
            gap: 18px;
        }

        .spotlight-footer-tip {
            font-size: 11px;
            color: #64748b;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .spotlight-footer-tip kbd {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            padding: 1px 4px;
            color: #475569;
            font-size: 9px;
            box-shadow: 0 1px 0 rgba(0,0,0,0.05);
        }

        /* Mobile responsive drawer */
        @media (max-width: 576px) {
            .spotlight-modal-wrapper {
                padding-top: 0 !important;
                align-items: flex-end !important;
            }
            
            .spotlight-card {
                width: 100% !important;
                max-width: 100% !important;
                border-radius: 24px 24px 0 0 !important;
                border-bottom: none !important;
                animation: spotlightMobileEntry 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            }
            
            @keyframes spotlightMobileEntry {
                from { transform: translateY(100%); }
                to { transform: translateY(0); }
            }
            
            .spotlight-categories-grid {
                grid-template-columns: 1fr;
            }
            
            .spotlight-body {
                max-height: 60vh !important;
            }
        }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput1');
        const suggestionsDropdown = document.getElementById('spotlightSearchResults');
        const suggestionsList = suggestionsDropdown ? suggestionsDropdown.querySelector('.header-suggestions-list') : null;
        const defaultSuggestions = document.getElementById('spotlightDefaultSuggestions');
        const searchInputArea = document.querySelector('.search-input-area');
        const closeSpotlightBtn = document.getElementById('closeSpotlight');

        if (searchInput && suggestionsDropdown && suggestionsList && defaultSuggestions) {
            let debounceTimer;
            let selectedIndex = -1;

            const fetchSuggestions = (query) => {
                if (query.trim().length < 1) {
                    suggestionsDropdown.style.display = 'none';
                    defaultSuggestions.style.display = 'block';
                    return;
                }

                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    fetch(`{{ url('/job/search/suggestions') }}?q=${encodeURIComponent(query)}`)
                        .then(response => response.json())
                        .then(data => {
                            suggestionsList.innerHTML = '';
                            selectedIndex = -1;
                            
                            if (data.length === 0) {
                                suggestionsDropdown.style.display = 'none';
                                defaultSuggestions.style.display = 'block';
                                return;
                            }

                            data.forEach(job => {
                                const item = document.createElement('a');
                                item.href = `{{ url('/job') }}/${job.id}`;
                                item.className = 'spotlight-suggestion-item';
                                item.innerHTML = `
                                    <div style="display: flex; align-items: center; gap: 16px; width: 100%;">
                                        <div style="width: 40px; height: 40px; border-radius: 10px; background: #fff1f2; display: flex; align-items: center; justify-content: center; color: #b11e24; font-size: 16px; flex-shrink: 0;">
                                            <i class="far fa-briefcase"></i>
                                        </div>
                                        <div style="display: flex; flex-direction: column; flex: 1;">
                                            <span class="job-title-text" style="font-size: 14.5px; font-weight: 700; color: #1e293b; transition: color 0.2s; text-align: left;">${job.job_title}</span>
                                            <span style="font-size: 12px; color: #64748b; font-weight: 500; margin-top: 2px; display: flex; align-items: center; gap: 8px;">
                                                <span><i class="far fa-building" style="margin-right: 4px;"></i> ${job.company_name}</span>
                                                ${job.job_location ? `<span>• <i class="fas fa-map-marker-alt" style="margin-right: 2px;"></i> ${job.job_location}</span>` : ''}
                                            </span>
                                        </div>
                                        <i class="far fa-chevron-right" style="color: #cbd5e1; font-size: 12px; margin-left: auto;"></i>
                                    </div>
                                `;
                                suggestionsList.appendChild(item);
                            });

                            defaultSuggestions.style.display = 'none';
                            suggestionsDropdown.style.display = 'block';
                        })
                        .catch(err => {
                            console.error('Error fetching suggestions:', err);
                        });
                }, 200);
            };

            // Keyboard navigation in suggestions list
            searchInput.addEventListener('keydown', function(e) {
                const items = suggestionsList.querySelectorAll('.spotlight-suggestion-item');
                
                if (e.key === 'ArrowDown') {
                    if (items.length === 0) return;
                    e.preventDefault();
                    selectedIndex = (selectedIndex + 1) % items.length;
                    updateActiveItem(items);
                } else if (e.key === 'ArrowUp') {
                    if (items.length === 0) return;
                    e.preventDefault();
                    selectedIndex = (selectedIndex - 1 + items.length) % items.length;
                    updateActiveItem(items);
                } else if (e.key === 'Enter') {
                    if (selectedIndex > -1 && items[selectedIndex]) {
                        e.preventDefault();
                        items[selectedIndex].click();
                    }
                }
            });

            function updateActiveItem(items) {
                items.forEach((item, index) => {
                    if (index === selectedIndex) {
                        item.classList.add('active-item');
                        item.scrollIntoView({ block: 'nearest' });
                    } else {
                        item.classList.remove('active-item');
                    }
                });
            }

            // Dynamic filter as typing
            searchInput.addEventListener('input', function() {
                fetchSuggestions(this.value);
            });

            // Show suggestions on focus if there is value
            searchInput.addEventListener('focus', function() {
                if (this.value.trim().length > 0) {
                    fetchSuggestions(this.value);
                }
            });

            // Close suggestions on clicking outside
            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !suggestionsDropdown.contains(e.target) && !defaultSuggestions.contains(e.target)) {
                    suggestionsDropdown.style.display = 'none';
                }
            });
        }

        // Global shortcuts: Ctrl+K/Cmd+K to show, Esc to hide
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                if (searchInputArea) {
                    if (searchInputArea.classList.contains('show')) {
                        searchInputArea.classList.remove('show');
                        document.getElementById('anywhere-home')?.classList.remove('bgshow');
                    } else {
                        searchInputArea.classList.add('show');
                        document.getElementById('anywhere-home')?.classList.add('bgshow');
                        setTimeout(() => searchInput?.focus(), 80);
                    }
                }
            }
            if (e.key === 'Escape') {
                if (searchInputArea && searchInputArea.classList.contains('show')) {
                    searchInputArea.classList.remove('show');
                    document.getElementById('anywhere-home')?.classList.remove('bgshow');
                }
            }
        });

        // Close button click listener
        if (closeSpotlightBtn) {
            closeSpotlightBtn.addEventListener('click', function() {
                if (searchInputArea) {
                    searchInputArea.classList.remove('show');
                    document.getElementById('anywhere-home')?.classList.remove('bgshow');
                }
            });
        }
    });
    </script>

    <div id="anywhere-home">
    </div>
    <!-- ENd Header Area -->