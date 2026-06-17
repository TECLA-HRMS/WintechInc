@extends('layouts.site')
@section('content')


    <!-- start header area -->
    <!-- start header area -->
    <!--<header class="header--sticky header-one ">-->
    <!--    <div class="header-top header-top-one bg-1">-->
    <!--        <div class="container">-->
    <!--            <div class="row">-->
    <!--                <div class="col-lg-6 d-xl-block d-none pt-4 pt-lg-0 content d-flex flex-column justify-content-center">-->
    <!--                    <div class="left">-->
    <!--                        <div class="mail">-->
    <!--                            <a href="mailto:lochana@wintechinc.in"><i class="fal fa-envelope"></i> lochana@wintechinc.in</a>-->
    <!--                        </div>-->
    <!--                        <div class="working-time">-->
    <!--                            <p><i class="fal fa-phone"></i>99404 36371</p>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="col-lg-6 d-xl-block d-none pt-4 pt-lg-0 content d-flex flex-column justify-content-center">-->
    <!--                    <div class="right">-->
                            
    <!--                        <ul class="social-wrapper-one">-->
    <!--                            <li><a href="https://www.facebook.com/wintechincofficial/"><i class="fab fa-facebook-f"></i></a></li>-->
    <!--                            <li><a href="https://www.instagram.com/wintechincofficial"><i class="fab fa-instagram"></i></a></li>-->
                               
    <!--                        </ul>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <div class="header-main-one bg-white" style="height: 78px;">-->
    <!--        <div class="container-fluid">-->
    <!--            <div class="row">-->
    <!--                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3 pt-4 pt-lg-0 content d-flex flex-column justify-content-center">-->
    <!--                    <div class="thumbnail">-->
    <!--                        <a href="{{ url('/') }}">-->
    <!--                            <img loading="lazy" src="{{ asset('logo.png') }}" alt="Wintech Inc" class="img-fluid" title="Wintech Inc" style=" width: 106px; ">-->
    <!--                        </a>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class=" col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 pt-4 pt-lg-0 content d-flex flex-column justify-content-center">-->
    <!--                    <div class="main-header">-->
    <!--                        <nav class="nav-main mainmenu-nav d-none d-xl-block">-->
    <!--                            <ul class="mainmenu">-->
    <!--                                <li><a class="nav-item" href="{{ url('/') }}">HOME</a></li>-->
    <!--                                <li><a class="nav-item" href="{{ url('about') }}">ABOUT US</a></li>-->
    <!--                                <li class="has-droupdown">-->
    <!--                                    <a class="nav-link" href="#">IT SECTORS</a>-->
    <!--                                    <ul class="submenu">-->
    <!--                                        <li><a href="{{ url('best-placement-services-for-candidate-in-chennai') }}">Placement Service(Candidate)</a></li>-->
    <!--                                        <li><a href="{{ url('best-placement-service-for-employers-services-for-candidate-in-chennai') }}">Placement Service (For Employers)</a></li>-->
				<!--							<li><a href="{{ url('best-placement-service-for-it-industry-in-chennai') }}">Placement Service for IT Industry</a></li>-->
				<!--							<li><a href="{{ url('best-placement-placement-services-for-manpower-for-employer-in-chennai') }}">Placement  Service for Manpower  (Employers)</a></li>-->
				<!--							<li><a href="{{ url('best-placement-services-for-manpower-for-candidate-in-chennai') }}">Placement  Service for Manpower  (Candidate)</a></li>-->
										    
											
    <!--                                    </ul>-->
    <!--                                </li>-->
				<!--					<li class="has-droupdown">-->
    <!--                                    <a class="nav-link" href="#">NON IT SECTORS</a>-->
    <!--                                    <ul class="submenu">-->
    <!--                                        <li><a href="{{ url('best-manpower-suppliers-services-for-candidate-in-chennai') }}">Manpower Suppliers</a></li>-->
    <!--                                        <li><a href="{{ url('best-manpower-consultants-services-in-chennai') }}">Manpower Consultants</a></li>-->
				<!--						    <li><a href="{{ url('best-placement-service-for-accounts-candidate-in-chennai') }}">Placement Service for Accounts</a></li>-->
				<!--							<li><a href="{{ url('best-placement-service-for-accounts-employers-in-chennai') }}">Placement Service for Accounts (Employers)</a></li>-->
				<!--						    <li><a href="{{ url('best-placement-service-for-hospital-in-chennai') }}">Placement  Service for Hospital</a></li>-->
				<!--							<li><a href="{{ url('best-manpower-outsourcing-services-in-chennai') }}">Manpower Outsourcing Services</a></li>-->
				<!--							<li><a href="{{ url('best-placement-service-for-banking-sector-in-chennai') }}">Placement Service for Banking Sector</a></li>-->
    <!--                                    </ul>-->
    <!--                                </li>-->
									
                                    <!--<li><a class="nav-item" href="{{ url('why-choose-wintech-hr-consultancy') }}">WHY US</a></li>-->
    <!--                                	<li class="has-droupdown">-->
    <!--                                    <a class="nav-link" href="#">SERVICES</a>-->
    <!--                                    <ul class="submenu">-->
    <!--                                        <li><a href="{{ url('digital-marketing') }}">Digital Marketing</a></li>-->
    <!--                                        <li><a href="{{ url('web-development') }}">Web Development</a></li>-->
				<!--						    <li><a href="{{ url('e-commerce-development') }}">E commerce Development</a></li>-->
				<!--							<li><a href="{{ url('mobile-app-development') }}">Mobile App Development</a></li>-->
				<!--						   </ul>-->
    <!--                                </li>-->
				<!--					<li><a class="nav-item" href="#">CAREER</a></li>-->
				<!--					<li><a class="nav-item" href="{{ url('blog') }}">BLOG</a></li>-->
									
    <!--                                <li><a class="nav-item" href="{{ url('contact') }}">CONTACT US</a></li>-->
    <!--                            </ul>-->
    <!--                        </nav>-->
    <!--                        <div class="button-area">-->
    <!--                            <a href="{{ url('contact') }}" class="rts-btn btn-primary ml--20 ml_sm--5 header-one-btn quote-btn">REACH US</a>-->
    <!--                            <button id="menu-btn" class="menu rts-btn btn-primary-alta ml--20 ml_sm--5">-->
    <!--                                <img loading="lazy" class="menu-dark" src="{{ asset('assets/images/icon/menu.png') }}" alt="Menu-icon">-->
    <!--                                <img loading="lazy" class="menu-light" src="{{ asset('assets/images/icon/menu-light.png') }}" alt="Menu-icon">-->
    <!--                            </button>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</header>-->
    <!-- End header area -->

    <!--<div id="side-bar" class="side-bar">-->
    <!--    <button class="close-icon-menu"><i class="far fa-times"></i></button>-->
        <!-- inner menu area desktop start -->
    <!--    <div class="rts-sidebar-menu-desktop">-->
            
    <!--        <div class="body d-none d-xl-block">-->
               
    <!--            <div class="get-in-touch">-->
                    <!-- title -->
    <!--                <div class="h6 title">Get In Touch</div>-->
                    <!-- title End -->
    <!--                <div class="wrapper">-->
                        <!-- single -->
    <!--                    <div class="single">-->
    <!--                        <i class="fas fa-phone-alt"></i>-->
    <!--                        <a href="#">+91 9940436371</a>-->
    <!--                    </div>-->
                        <!-- single ENd -->
                        <!-- single -->
    <!--                    <div class="single">-->
    <!--                        <i class="fas fa-envelope"></i>-->
    <!--                        <a href="mailto:lochana@wintechinc.in">lochana@wintechinc.in</a>-->
    <!--                    </div>-->
                        <!-- single ENd -->
                        <!-- single -->
    <!--                    <div class="single">-->
    <!--                        <i class="fas fa-globe"></i>-->
    <!--                        <a href="#">No 8/235, Pillaiyar Kovil St, Vasanth Vihar, Pozhichalur, Chennai 600074.</a>-->
    <!--                    </div>-->
                        <!-- single ENd -->
                       
    <!--                </div>-->
    <!--                <div class="social-wrapper-two menu">-->
    <!--                     <a href="https://www.facebook.com/wintechincofficial/"><i class="fab fa-facebook-f"></i></a>-->
    <!--                    <a href="https://www.instagram.com/wintechincofficial"><i class="fab fa-instagram"></i></a>-->
                        <!-- <a href="#"><i class="fab fa-linkedin"></i></a> -->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
			
    <!--        <div class="body-mobile d-block d-xl-none">-->
    <!--            <nav class="nav-main mainmenu-nav">-->
    <!--                <ul class="mainmenu">-->
    <!--                   <li><a class="nav-item" href="{{ url('/') }}">Home</a></li>-->
    <!--                                <li><a class="nav-item" href="{{ url('about') }}">About Us</a></li>-->
    <!--                                <li class="has-droupdown">-->
    <!--                                    <a class="nav-link" href="#">IT Sectors</a>-->
    <!--                                    <ul class="submenu">-->
    <!--                                        <li><a href="{{ url('best-placement-services-for-candidate-in-chennai') }}">Placement Service(Candidate)</a></li>-->
    <!--                                        <li><a href="{{ url('best-placement-service-for-employers-services-for-candidate-in-chennai') }}">Placement Service (For Employers)</a></li>-->
				<!--							<li><a href="{{ url('best-placement-service-for-it-industry-in-chennai') }}">Placement Service for IT Industry</a></li>-->
				<!--							<li><a href="{{ url('best-placement-placement-services-for-manpower-for-employer-in-chennai') }}">Placement  Service for Manpower  (Employers)</a></li>-->
				<!--							<li><a href="{{ url('best-placement-services-for-manpower-for-candidate-in-chennai') }}">Placement  Service for Manpower  (Candidate)</a></li>-->
										    
											
    <!--                                    </ul>-->
    <!--                                </li>-->
				<!--					<li class="has-droupdown">-->
    <!--                                    <a class="nav-link" href="#">Non IT Sectors</a>-->
    <!--                                    <ul class="submenu">-->
    <!--                                        <li><a href="{{ url('best-manpower-suppliers-services-for-candidate-in-chennai') }}">Manpower Suppliers</a></li>-->
    <!--                                        <li><a href="{{ url('best-manpower-consultants-services-in-chennai') }}">Manpower Consultants</a></li>-->
				<!--						    <li><a href="{{ url('best-placement-service-for-accounts-candidate-in-chennai') }}">Placement Service for Accounts</a></li>-->
				<!--							<li><a href="{{ url('best-placement-service-for-accounts-employers-in-chennai') }}">Placement Service for Accounts (Employers)</a></li>-->
				<!--						    <li><a href="{{ url('best-placement-service-for-hospital-in-chennai') }}">Placement  Service for Hospital</a></li>-->
				<!--							<li><a href="{{ url('best-manpower-outsourcing-services-in-chennai') }}">Manpower Outsourcing Services</a></li>-->
				<!--							<li><a href="{{ url('best-placement-service-for-banking-sector-in-chennai') }}">Placement Service for Banking Sector</a></li>-->
											
    <!--                                    </ul>-->
    <!--                                </li>-->
    <!--                               <li class="has-droupdown">-->
    <!--                                    <a class="nav-link" href="#">SERVICES</a>-->
    <!--                                    <ul class="submenu">-->
    <!--                                        <li><a href="{{ url('digital-marketing') }}">Digital Marketing</a></li>-->
    <!--                                        <li><a href="{{ url('web-development') }}">Web Development</a></li>-->
				<!--						    <li><a href="{{ url('e-commerce-development') }}">E commerce Development</a></li>-->
				<!--							<li><a href="{{ url('mobile-app-development') }}">Mobile App Development</a></li>-->
				<!--						   </ul>-->
    <!--                                </li>-->
				<!--					<li><a class="nav-item" href="#">Career</a></li>-->
				<!--					<li><a class="nav-item" href="{{ url('blog') }}">Blog</a></li>-->
    <!--                                <li><a class="nav-item" href="{{ url('contact') }}">Contact Us</a></li>-->
    <!--                </ul>-->
    <!--            </nav>-->
    <!--            <div class="social-wrapper-two menu mobile-menu">-->
    <!--                 <a href="https://www.facebook.com/wintechincofficial/"><i class="fab fa-facebook-f"></i></a>-->
    <!--                    <a href="https://www.instagram.com/wintechincofficial"><i class="fab fa-instagram"></i></a>-->
                    <!-- <a href="#"><i class="fab fa-linkedin"></i></a> -->
    <!--            </div>-->
    <!--            <a href="#" class="rts-btn btn-primary ml--20 ml_sm--5 header-one-btn quote-btnmenu">Get Quote</a>-->
    <!--        </div>-->
    <!--    </div>-->
        <!-- inner menu area desktop End -->
    <!--</div>-->

    <!--<div class="search-input-area">-->
    <!--    <div class="container">-->
    <!--        <div class="search-input-inner">-->
    <!--            <div class="input-div">-->
    <!--                <input id="searchInput1" class="search-input" type="text" placeholder="Search by keyword or #">-->
    <!--                <button><i class="far fa-search"></i></button>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <div id="close" class="search-close-icon"><i class="far fa-times"></i></div>-->
    <!--</div>-->

    <!--<div id="anywhere-home">-->
    <!--</div>-->
    <!-- ENd Header Area --><!-- banner blank space area -->
<div class="rts-banner-area rts-banner-one">
   <div class="swiper mySwiper banner-one">
      <div class="swiper-wrapper">
         <div class="swiper-slide">
            <!-- banner single content -->
            <div class="banner-one-inner text-start">
               <p class="pre-title">
                  <span>Welcome!</span> Wintech Inc
               </p>
               <h1 class="title ">Boost your team's potential with <span>our expert recruitment services.  </span> 
               </h1>
               <p class="disc banner-para">
                 We are dedicated to understanding our clients' unique needs and collaborating closely with them to deliver the finest recruitment solutions in Chennai.
               </p>
               <a href="{{ url('contact') }}" class="rts-btn btn-primary color-h-black">Get Consultant</a>
               <img loading="lazy" class="shape-img one" src="{{ asset('assets/images/banner/shape/01.png') }}" alt="banner_business">
            </div>
            <!-- banner single content end -->
         </div>
         <div class="swiper-slide two">
            <!-- banner single content -->
            <div class="banner-one-inner text-start">
               <p class="pre-title">
                  <span>Welcome!</span> Wintech Inc
               </p>
               <h1 class="title ">Trust  Our Placement <br><span> Service    </span> for Your Career Success! </h1>
               <p class="disc banner-para">
                  We always stay focused on fulfilling the client’s necessities and work with them closely, <br>in order to provide the best recruitment service in Chennai.
               </p>
               <a href="{{ url('contact') }}" class="rts-btn btn-primary color-h-black">Get Consultant</a>
               <img loading="lazy" class="shape-img one" src="{{ asset('assets/images/banner/shape/01.png') }}" alt="banner_business">
            </div>
            <!-- banner single content end -->
         </div>
         <div class="swiper-slide three">
            <!-- banner single content -->
            <div class="banner-one-inner text-start">
               <p class="pre-title">
                  <span>Welcome!</span> Wintech Inc
               </p>
               <h1 class="title "> Dream Job with Our  <br class="mob-hide"><span> Cutting Edge </span> <br class="mob-hide"> Placement Service!  </h1>
               <p class="disc banner-para">
                  We always stay focused on fulfilling the client’s necessities and work with them closely, <br>in order to provide the best recruitment service in Chennai.
               </p>
               <a href="{{ url('contact') }}" class="rts-btn btn-primary color-h-black">Get Consultant</a>
               <img loading="lazy" class="shape-img one" src="{{ asset('assets/images/banner/shape/01.png') }}" alt="banner_business">
            </div>
            <!-- banner single content end -->
         </div>
          <div class="swiper-slide four">
            <!-- banner single content -->
            <div class="banner-one-inner text-start">
               <p class="pre-title">
                  <span>Welcome!</span> Wintech Inc
               </p>
               <h1 class="title ">Spark Your Growth with <br><span>Digital Marketing Power</span> <br></h1>
               <p class="disc banner-para">
                 
Transform your brand's online presence with our dynamic digital marketing strategies               </p>
               <a href="{{ url('contact') }}" class="rts-btn btn-primary color-h-black">Get Consultant</a>
               <img loading="lazy" class="shape-img one" src="{{ asset('assets/images/banner/shape/01.png') }}" alt="banner_business">
            </div>
            <!-- banner single content end -->
         </div>
      </div>
      <div class="swiper-pagination"></div>
   </div>
   <div class="animation-img">
      <img loading="lazy" class="shape-img two" src="{{ asset('assets/images/banner/shape/02.png') }}" alt="banner_business">
      <img loading="lazy" class="shape-img three" src="{{ asset('assets/images/banner/shape/03.png') }}" alt="banner_business">
   </div>
</div>
<!-- banner blank space area end -->
<!-- rts about us section start -->
<div class="rts-about-area rts-section-gap bg-about-sm-shape">
   <div class="container">
      <div class="row g-5 align-items-center">
         <!-- about left -->
         <div class="col-lg-6 col-md-12 col-sm-12 col-12 order-lg-1 order-md-2 order-sm-2 order-2 mt_md--50 mt_sm--50">
            <div class="rts-title-area">
               <p class="pre-title">
                  More About Us
               </p>
               <h2 class="title">Experience a World of Possibilities </h2>
            </div>
            <div class="about-inner">
               <p class="disc">
                  Wintech Inc is a renowned and reputable human resources consulting firm that provides comprehensive HR solutions to organizations of all sizes and industries. With our extensive experience and expertise in the field, we offer a wide range of services that cater to the unique HR needs of our clients. Partnering with Wintech Inc means gaining access to top-notch HR expertise, personalized solutions, and a trusted partner who is committed to your organization's success.
               </p>
               <!-- start about success area -->
               <div class="row about-success-wrapper">
                  <!-- left wrapper start -->
                  <div class="col-lg-6 col-md-6">
                     <div class="single">
                        <i class="far fa-check"></i>
                        <p class="details">24/7 Call Services Available</p>
                     </div>
                     <div class="single">
                        <i class="far fa-check"></i>
                        <p class="details">Skilled Consultant</p>
                     </div>
                     <div class="single">
                        <i class="far fa-check"></i>
                        <p class="details">Expert Team Members</p>
                     </div>
                  </div>
                  <!-- left wrapper end -->
                  <div class="col-lg-6 col-md-6">
                     <div class="single">
                        <i class="far fa-check"></i>
                        <p class="details">How to improve business
                        </p>
                     </div>
                     <div class="single">
                        <i class="far fa-check"></i>
                        <p class="details">Business is the best plan</p>
                     </div>
                     <div class="single">
                        <i class="far fa-check"></i>
                        <p class="details">Services we provide</p>
                     </div>
                  </div>
               </div>
               <!-- start about success area -->
            </div>
         </div>
         <!-- about right -->
         <!-- about-right Start-->
         <div class="col-lg-6 col-md-12 col-sm-12 col-12 order-lg-2 order-md-1 order-sm-1 order-1">
            <div class="about-one-thumbnail">
               <img loading="lazy" src="{{ asset('image/about.png') }}" alt="about-finbiz">
               <div class="experience">
                  <div class="left single">
                     <h2 class="title">5+</h2>
                     <p class="time">Years</p>
                  </div>
                  <div class="right single">
                     <p class="disc">
                        Of experience
                        in consulting
                        service
                     </p>
                  </div>
               </div>
            </div>
         </div>
         <!-- about-right end -->
      </div>
   </div>
</div>
<!-- rts about us section end -->
<!-- rts service post area  Start-->
<div class="rts-service-area rts-section-gapBottom">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div class="rts-title-area service text-center">
               <!--<p class="pre-title">-->
               <!--   Our Services-->
               <!--</p>-->
               <h2 class="title"> Our High Quality Services</h2>
            </div>
         </div>
      </div>
   </div>
   <div class="container-fluid service-main plr--120-service mt--50 plr_md--0 pl_sm--0 pr_sm--0">
      <div class="background-service row">
         <!-- start single Service -->
         <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="service-one-inner one">
               <div class="thumbnail">
                  <img loading="lazy" src="{{ asset('assets/images/service/icon/01.svg') }}" alt="finbiz_service">
               </div>
               <div class="service-details">
                  <a href="#">
                     <h5 class="title" style="text-align: center;">Executive Search</h5>
                  </a>
                  <p class="disc" style="text-align: center;">
                     Each member that you hire for your business matters. Our key approach is to create ownership. 
                  </p>
               </div>
            </div>
         </div>
         <!-- end single Services -->
         <!-- start single Service -->
         <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="service-one-inner two">
               <div class="thumbnail">
                  <img loading="lazy" src="{{ asset('assets/images/service/icon/02.svg') }}" alt="finbiz_service">
               </div>
               <div class="service-details">
                  <a href="#">
                     <h5 class="title" style="text-align: center;">Permanent Staffing</h5>
                  </a>
                  <p class="disc" style="text-align: center;">
                     Staffing is an integral process for any firm and an organization.
                  </p>
               </div>
            </div>
         </div>
         <!-- end single Services -->
         <!-- start single Service -->
         <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="service-one-inner three">
               <div class="thumbnail">
                  <img loading="lazy" src="{{ asset('assets/images/service/icon/03.svg') }}" alt="finbiz_service">
               </div>
               <div class="service-details">
                  <a href="#">
                     <h5 class="title" style="text-align: center;">Recruitment Process</h5>
                  </a>
                  <p class="disc" style="text-align: center;">
                     Wintech Inc also provides Recruitment Process Outsourcing (RPO) solutions.
                  </p>
               </div>
            </div>
         </div>
         <!-- end single Services -->
         <!-- start single Service -->
         <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="service-one-inner four">
               <div class="thumbnail">
                  <img loading="lazy" src="{{ asset('assets/images/service/icon/04.svg') }}" alt="finbiz_service">
               </div>
               <div class="service-details">
                  <a href="#">
                     <h5 class="title" style="text-align: center;">Bulk Hiring</h5>
                  </a>
                  <p class="disc" style="text-align: center;">
                     We also provide mass-hiring services for companies requiring many people.
                  </p>
               </div>
            </div>
         </div>
         <!-- end single Services -->
         <!-- start single Service -->
         <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="service-one-inner five">
               <div class="thumbnail">
                  <img loading="lazy" src="{{ asset('assets/images/service/icon/05.svg') }}" alt="finbiz_service">
               </div>
               <div class="service-details">
                  <a href="#">
                     <h5 class="title" style="text-align: center;">Contract Hiring</h5>
                  </a>
                  <p class="disc" style="text-align: center;">
                     Along with other hiring services, Wintech Inc has also stepped in contractual hiring.
                  </p>
               </div>
            </div>
         </div>
         <!-- end single Services -->
         <!-- start single Service -->
         <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="service-one-inner six">
               <div class="thumbnail">
                  <img loading="lazy" src="{{ asset('assets/images/service/icon/06.svg') }}" alt="finbiz_service">
               </div>
               <div class="service-details">
                  <a href="#">
                     <h5 class="title" style="text-align: center;">Approach</h5>
                  </a>
                  <p class="disc" style="text-align: center;">
                     Client satisfaction is our priority at Wintech Inc. We value relationship with our clients. 
                  </p>
               </div>
            </div>
         </div>
         <!-- end single Services -->
      </div>
      <br><br><br>
          <section class="services-section-two margin-top our_service_section" id="our-service">
        <div class="container">
            <div class="section-title"> 
                <h3 class="text-danger text-center">Our Exclusive Services</h3>
                <h5 class="text-center"> We Provide End-to-End Solutions to Help Your Business Succeed Online. </h5>
            </div>
            <div class="inner-container">
                <div class="row clearfix">
                    <div class="service-block-two col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-box">
                            <div class="shape-one"></div>
                            <div class="shape-two"></div>
                            <div class="icon-box pb-3">
                                <img loading="lazy" src="{{ asset('assetss/imgs/home/services/02.png') }}" class="content-img service_icons1" alt="Digital Marketing">
                            </div>
                            <h5><a href="{{ url('digital-marketing') }}"> Digital Marketing </a></h5>
                            <div class="text"> With our digital marketing services, we help to establish your business brand value and help in revenue-increasing business branding strategy solutions. <br><br>  <a class="more-title" href="{{ url('digital-marketing') }}"> Read More <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> </a> </div>
                           
                        </div> 
                        
                    </div>
                     <div class="service-block-two col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-box">
                            <div class="shape-one"></div>
                            <div class="shape-two"></div>
                            <div class="icon-box pb-3">
                                <img loading="lazy" src="{{ asset('assetss/imgs/home/services/05.png') }}" class="content-img service_icons1" alt="Digital Marketing">
                            </div>
                            <h5><a href="{{ url('e-commerce-development') }}">E commerce Development</a></h5>
                            <div class="text">Based on the needs of the clients, we create a unique and fully functional responsive website development for your online E-commerce store. <br><br>  <a class="more-title" href="{{ url('digital-marketing') }}"> Read More <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> </a> </div>
                           
                        </div> 
                        
                    </div>
                   
                </div>
            </div>
        </div>
    </section>
     <section class="services-section-two margin-top our_service_section" id="our-service">
        <div class="container">
            
            <div class="inner-container">
                <div class="row clearfix">
                  
                    <div class="service-block-two col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-box">
                            <div class="shape-one"></div>
                            <div class="shape-two"></div>
                            <div class="icon-box pb-3">
                                <img loading="lazy" src="{{ asset('assetss/imgs/home/services/03.png') }}" class="content-img service_icons1" alt="">
                            </div>
                            <h5><a href="{{ url('web-development') }}"> Web Development </a></h5>
                            <div class="text"> We build and design the website based on your specifications in order to establish your company's reputation and convert visitors into customers.<br><br>  <a class="more-title" href="{{ url('graphic-design') }}"> Read More <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> </a> </div>
                        </div>
                    </div>
                    <div class="service-block-two col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-box">
                            <div class="shape-one"></div>
                            <div class="shape-two"></div>
                            <div class="icon-box pb-3">
                                <img loading="lazy" src="{{ asset('assetss/imgs/home/services/04.png') }}" class="content-img service_icons1" alt="Web Development">
                            </div>
                            <h5><a>Mobile App Development</a></h5>
                            <div class="text">We provide consistent Android and iOS responsive mobile app development services for your company to enhance sales growth.<br><br>  <a class="more-title" href="{{ url('mobile-app-development') }}"> Read More <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> </a> </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </section>
<br><br><br>
      
      <div class="row">
         <div class="cta-one-bg col-12">
            <div class="cta-one-inner">
               <div class="cta-left">
                  <h3 class="title">Let’s Discuss About How We Can Help Make Your Career Better</h3>
               </div>
               <div class="cta-right">
                  <a class="rts-btn btn-white" href="{{ url('contact') }}">Lets Work Together</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- rts service post area ENd -->
<!-- rts-counter up area start -->
<div class="rts-counter-up-area rts-section-gap counter-bg">
   <div class="container">
      <div class="row">
         <!-- counter up area -->
         <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="single-counter">
               <img loading="lazy" src="{{ asset('assets/images/counterup/icon/01.svg') }}" alt="Business_counter">
               <div class="counter-details">
                  <h2 class="title"><span class="counter animated fadeInDownBig">858</span></h2>
                  <p class="disc">Successful Projects</p>
               </div>
            </div>
         </div>
         <!-- counter up area -->
         <!-- counter up area -->
         <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="single-counter pl--10 justify-content-center two pl--30">
               <img loading="lazy" src="{{ asset('assets/images/counterup/icon/02.svg') }}" alt="Business_counter">
               <div class="counter-details">
                  <h2 class="title"><span class="counter animated fadeInDownBig">650</span></h2>
                  <p class="disc">Media Activities</p>
               </div>
            </div>
         </div>
         <!-- counter up area -->
         <!-- counter up area -->
         <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="single-counter pl--10 justify-content-center three pl--50">
               <img loading="lazy" src="{{ asset('assets/images/counterup/icon/03.svg') }}" alt="Business_counter">
               <div class="counter-details">
                  <h2 class="title"><span class="counter animated fadeInDownBig">20</span></h2>
                  <p class="disc">Skilled Experts</p>
               </div>
            </div>
         </div>
         <!-- counter up area -->
         <!-- counter up area -->
         <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="single-counter pl--10 justify-content-end four">
               <img loading="lazy" src="{{ asset('assets/images/counterup/icon/04.svg') }}" alt="Business_counter">
               <div class="counter-details">
                  <h2 class="title happy"><span class="counter animated fadeInDownBig">50</span></h2>
                  <p class="disc">Happy Clients</p>
               </div>
            </div>
         </div>
         <!-- counter up area -->
      </div>
   </div>
</div>
<!-- rts-counter up area end -->

<!-- start gallery section -->
<div class="rts-gallery-area rts-section-gap gallery-bg bg_image">
   <div class="container">
      <div class="row">
         <div class="rts-title-area gallery text-start pl_sm--20">
            <p class="pre-title">
               Popular Industries
            </p>
            <h2 class="title">Industries We Served</h2>
         </div>
      </div>
      <div class="row mt--45 mob-s">
         <div class="col-12">
            <div class="swiper mygallery mySwipers">
               <div class="swiper-wrapper gallery">
                  <div class="swiper-slide">
                     <div class="row g-5 w-g-100">
                        <div class="col-lg-7 col-md-12 col-sm-12 col-12">
                           <div class="thumbnail-gallery">
                              <img loading="lazy" src="{{ asset('assets/images/gallery/industry.jpg') }}" alt="business-images">
                           </div>
                        </div>
                        <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                           <div class="bg-right-gallery">
                              <h4 class="title"> Industrial </h4>
                              <p class="disc">At WinTech Inc, we offer tailored financial services to streamline asset management and drive business growth. Our expert team provides customized strategies for cash flow optimization, investment planning, and risk management. With a focus on clear insights and personalized solutions, we help you navigate financial complexities and achieve long-term success.
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="swiper-slide">
                     <div class="row g-5 w-g-100">
                        <div class="col-lg-7">
                           <div class="thumbnail-gallery">
                              <img loading="lazy" src="{{ asset('assets/images/gallery/finance.jpg') }}" alt="business-images">
                           </div>
                        </div>
                        <div class="col-lg-5">
                           <div class="bg-right-gallery">
                              <h4 class="title">Financial Services</h4>
                              <p class="disc">Wintech Inc helps you to connect with a range of skilled and highly professional candidates in the financial service industry. Our flexible services allow your firm to find the right talent required to navigate the progressing financial market. We help you to hire skilled staff ranging from investment specialists, mortgage originators.</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="swiper-slide">
                     <div class="row g-5 w-g-100">
                        <div class="col-lg-7">
                           <div class="thumbnail-gallery">
                              <img loading="lazy" src="{{ asset('assets/images/gallery/software_developemnt.jpg') }}" alt="business-images">
                           </div>
                        </div>
                        <div class="col-lg-5">
                           <div class="bg-right-gallery">
                              <h4 class="title">Software Development</h4>
                              <p class="disc">At WinTech Inc, we bring your business ideas to life with innovative software solutions. From custom software to mobile apps, our expert team delivers secure, scalable, and user-friendly products tailored to your needs. Whether you're a startup or an enterprise, we’re here to help you succeed in the digital world. Let’s build the future together.
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="swiper-button-next"></div>
               <div class="swiper-button-prev"></div>
               <div class="swiper-pagination"></div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- start gallery section -->



<!-- latest service area -->
<div class="rts-service-area rts-section-gap bg-service-h2">
   <div class="container">
      <div class="row">
         <div class="title-area service-h2">
            <span>Our Latest Services</span>
            <h2 class="title">Service We Provide</h2>
         </div>
      </div>
      <div class="row g-5 mt--10">
         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <!-- single service start -->
            <div class="rts-single-service-h2">
               <a href="{{ url('best-placement-services-for-candidate-in-chennai') }}" class="thumbnail">
               <img loading="lazy" src="{{ asset('image/placement-service1.jpg') }}" alt="Service_image">
               </a>
               <div class="body">
                  <a href="{{ url('best-placement-services-for-candidate-in-chennai') }}">
                     <h5 class="title">PLACEMENT SERVICE</h5>
                  </a>
               </div>
            </div>
            <!-- single service End -->
         </div>
         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <!-- single service start -->
            <div class="rts-single-service-h2">
               <a href="{{ url('best-manpower-suppliers-services-for-candidate-in-chennai') }}" class="thumbnail">
               <img loading="lazy" src="{{ asset('image/placement-service2.jpg') }}" alt="Service_image">
               </a>
               <div class="body">
                  <a href="{{ url('best-manpower-suppliers-services-for-candidate-in-chennai') }}">
                     <h5 class="title">MANPOWER SUPPLIERS</h5>
                  </a>
               </div>
            </div>
            <!-- single service End -->
         </div>
         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <!-- single service start -->
            <div class="rts-single-service-h2">
               <a href="{{ url('best-placement-service-for-employers-services-for-candidate-in-chennai') }}" class="thumbnail">
               <img loading="lazy" src="{{ asset('image/placement-service3.jpg') }}" alt="Service_image">
               </a>
               <div class="body">
                  <a href="{{ url('best-placement-service-for-employers-services-for-candidate-in-chennai') }}">
                     <h5 class="title">PLACEMENT SERVICE (FOR EMPLOYERS)</h5>
                  </a>
               </div>
            </div>
            <!-- single service End -->
         </div>
         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <!-- single service start -->
            <div class="rts-single-service-h2">
               <a href="{{ url('best-manpower-consultants-services-in-chennai') }}" class="thumbnail">
               <img loading="lazy" src="{{ asset('image/placement-service4.jpg') }}" alt="Service_image">
               </a>
               <div class="body">
                  <a href="{{ url('best-manpower-consultants-services-in-chennai') }}">
                     <h5 class="title">MANPOWER CONSULTANTS</h5>
                  </a>
               </div>
            </div>
            <!-- single service End -->
         </div>
         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <!-- single service start -->
            <div class="rts-single-service-h2">
               <a href="{{ url('best-placement-service-for-it-industry-in-chennai') }}" class="thumbnail">
               <img loading="lazy" src="{{ asset('image/placement-service5.jpg') }}" alt="Service_image">
               </a>
               <div class="body">
                  <a href="{{ url('best-placement-service-for-it-industry-in-chennai') }}">
                     <h5 class="title"> IT INDUSTRY PLACEMENT</h5>
                  </a>
               </div>
            </div>
            <!-- single service End -->
         </div>
         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <!-- single service start -->
            <div class="rts-single-service-h2">
               <a href="{{ url('best-placement-service-for-accounts-candidate-in-chennai') }}" class="thumbnail">
               <img loading="lazy" src="{{ asset('image/placement-service6.jpg') }}" alt="Service_image">
               </a>
               <div class="body">
                  <a href="{{ url('best-placement-service-for-accounts-candidate-in-chennai') }}">
                     <h5 class="title">PLACEMENT FOR ACCOUNTS</h5>
                  </a>
               </div>
            </div>
            <!-- single service End -->
         </div>
         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <!-- single service start -->
            <div class="rts-single-service-h2">
               <a href="{{ url('best-placement-service-for-hospital-in-chennai') }}" class="thumbnail">
               <img loading="lazy" src="{{ asset('image/placement-service9.jpg') }}" alt="Service_image">
               </a>
               <div class="body">
                  <a href="{{ url('best-placement-service-for-hospital-in-chennai') }}">
                     <h5 class="title">PLACEMENT FOR HOSPITAL</h5>
                  </a>
               </div>
            </div>
            <!-- single service End -->
         </div>
         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
            <!-- single service start -->
            <div class="rts-single-service-h2">
               <a href="{{ url('best-placement-placement-services-for-manpower-for-employer-in-chennai') }}" class="thumbnail">
               <img loading="lazy" src="{{ asset('image/placement-service8.jpg') }}" alt="Service_image">
               </a>
               <div class="body">
                  <a href="{{ url('best-placement-placement-services-for-manpower-for-employer-in-chennai') }}">
                     <h5 class="title">PLACEMENT FOR MANPOWER</h5>
                  </a>
               </div>
            </div>
            <!-- single service End -->
         </div>
      </div>
   </div>
</div>
<!-- latest service area End -->



<!-- end trusted client section -->
<div class="rts-service-area  bg-service-h2">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div class="title-area-client text-center">
               <p class="client-title">Leading IT Companies</p>
            </div>
         </div>
      </div>
      <div class="row g-5 mt--10">
         <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <div class="rts-single-service-h2">
              <img loading="lazy" src="{{ asset('image/client1.png') }}" alt="Service_image">
             </div>
         </div>
		 <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <div class="rts-single-service-h2">
              <img loading="lazy" src="{{ asset('image/client2.png') }}" alt="Service_image">
             </div>
         </div>
		 
		 <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <div class="rts-single-service-h2">
              <img loading="lazy" src="{{ asset('image/client3.png') }}" alt="Service_image">
             </div>
         </div>
		 <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <div class="rts-single-service-h2">
              <img loading="lazy" src="{{ asset('image/client4.png') }}" alt="Service_image">
             </div>
         </div>
		 <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <div class="rts-single-service-h2">
              <img loading="lazy" src="{{ asset('image/client5.png') }}" alt="Service_image">
             </div>
         </div>
         <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <div class="rts-single-service-h2">
              <img loading="lazy" src="{{ asset('image/client6.png') }}" alt="Service_image">
             </div>
         </div>
		 
		 <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <div class="rts-single-service-h2">
              <img loading="lazy" src="{{ asset('image/client7.png') }}" alt="Service_image">
             </div>
         </div>
		 <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <div class="rts-single-service-h2">
              <img loading="lazy" src="{{ asset('image/client8.png') }}" alt="Service_image">
             </div>
         </div>
		 
		 <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <div class="rts-single-service-h2">
              <img loading="lazy" src="{{ asset('image/client9.png') }}" alt="Service_image">
             </div>
         </div>
		 <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <div class="rts-single-service-h2">
              <img loading="lazy" src="{{ asset('image/client10.png') }}" alt="Service_image">
             </div>
         </div>
		 <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <div class="rts-single-service-h2">
              <img loading="lazy" src="{{ asset('image/client11.png') }}" alt="Service_image">
             </div>
         </div>
         <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <div class="rts-single-service-h2">
              <img loading="lazy" src="{{ asset('image/client12.png') }}" alt="Service_image">
             </div>
         </div>
		 
      </div>
   </div>
</div>

<!-- end trusted client section -->
<div class="rts-service-area  bg-service-h2">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div class="title-area-client text-center">
               <p class="client-title">Non Leading IT Companies</p>
            </div>
         </div>
      </div>
      <div class="row g-5 mt--10">
         <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <div class="rts-single-service-h2">
              <img loading="lazy" src="{{ asset('image/nclient1.png') }}" alt="Service_image">
             </div>
         </div>
		 <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <div class="rts-single-service-h2">
              <img loading="lazy" src="{{ asset('image/nclient2.png') }}" alt="Service_image">
             </div>
         </div>
		 
		 <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <div class="rts-single-service-h2">
              <img loading="lazy" src="{{ asset('image/nclient3.png') }}" alt="Service_image">
             </div>
         </div>
		 <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <div class="rts-single-service-h2">
              <img loading="lazy" src="{{ asset('image/nclient4.png') }}" alt="Service_image">
             </div>
         </div>
		 <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <div class="rts-single-service-h2">
              <img loading="lazy" src="{{ asset('image/nclient5.png') }}" alt="Service_image">
             </div>
         </div>
         <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <div class="rts-single-service-h2">
              <img loading="lazy" src="{{ asset('image/nclient6.png') }}" alt="Service_image">
             </div>
         </div>
		 
		 <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <div class="rts-single-service-h2">
              <img loading="lazy" src="{{ asset('image/nclient7.png') }}" alt="Service_image">
             </div>
         </div>
		 <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <div class="rts-single-service-h2">
              <img loading="lazy" src="{{ asset('image/nclient8.png') }}" alt="Service_image">
             </div>
         </div>
		 
		 <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <div class="rts-single-service-h2">
              <img loading="lazy" src="{{ asset('image/nclient9.png') }}" alt="Service_image">
             </div>
         </div>
		 <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <div class="rts-single-service-h2">
              <img loading="lazy" src="{{ asset('image/nclient10.png') }}" alt="Service_image">
             </div>
         </div>
		 <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <div class="rts-single-service-h2">
              <img loading="lazy" src="{{ asset('image/nclient11.png') }}" alt="Service_image">
             </div>
         </div>
         <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <div class="rts-single-service-h2">
              <img loading="lazy" src="{{ asset('image/nclient12.png') }}" alt="Service_image">
             </div>
         </div>
		 
      </div>
   </div>
</div>
<br>

@endsection

