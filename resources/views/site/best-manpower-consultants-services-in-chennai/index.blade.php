@extends('layouts.site')
@section('content')

<div class="rts-breadcrumb-area breadcrumb-bg bg_image">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 breadcrumb-1">
                    <h1 class="title" style="font-size: 38px;">Manpower Consultants</h1>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="bread-tag">
                        <a href="{{ url('/') }}">Home</a>
                        <span> / </span>
                        <a href="#" class="active">Manpower Consultants</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->

    <!-- start service details area -->
    <div class="rts-service-details-area rts-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-md-12 col-sm-12 col-12">
                    <!-- service details left area start -->
                    <div class="service-detials-step-1">
                        <div class="thumbnail">
                            <img loading="lazy" src="{{ asset('image/consultancy4.jpeg') }}" alt="business-area">
                        </div>
                        <h4 class="title">Manpower Consultants</h4>
                        <p class="disc">
                            Welcome to our Manpower Consultants Service! We are dedicated to providing comprehensive manpower solutions to meet your organization's staffing needs. Our consultancy specializes in assisting businesses in identifying, acquiring, and managing the right talent for their specific requirements. Partner with our Manpower Consultants Service and let us help you build a skilled and reliable workforce. Our experienced team is committed to delivering tailored solutions that align with your organization's objectives and contribute to its success. Contact us today to discuss your manpower needs and explore how our consultancy can assist your organization in achieving its staffing goals.
                        </p>
                       
                        <div class="row g-5 mt--30 mb--40">
                            <div class="col-lg-6">
                                <!-- single service details card -->
                                <div class="service-details-card">
                                    <div class="thumbnail">
                                        <img loading="lazy" src="{{ asset('assets/images/service/icon/09.svg') }}" alt="" class="icon">
                                    </div>
                                    <div class="details">
                                        <h6 class="title">Manpower Planning and Strategy</h6>
                                        <p class="disc">We work closely with your organization to understand your manpower requirements and align them with your overall business goals. Our consultants assist in developing effective manpower plans and strategies that address your immediate and long-term staffing needs. </p>
                                    </div>
                                </div>
                                <!-- single service details card End -->
                            </div>
                            
                            <div class="col-lg-6">
                                <!-- single service details card -->
                                <div class="service-details-card">
                                    <div class="thumbnail">
                                        <img loading="lazy" src="{{ asset('assets/images/service/icon/11.svg') }}" alt="" class="icon">
                                    </div>
                                    <div class="details">
                                        <h6 class="title">Skills Assessment and Evaluation</h6>
                                        <p class="disc">  Our consultants have experience in assessing candidate skills and evaluating their suitability for specific roles. We employ a range of assessment methods, such as interviews, technical tests, and psychometric evaluations, to thoroughly evaluate candidates' capabilities.  </p>
                                    </div>
                                </div>
                                <!-- single service details card End -->
                            </div>
                            <div class="col-lg-6">
                                <!-- single service details card -->
                                <div class="service-details-card">
                                    <div class="thumbnail">
                                        <img loading="lazy" src="{{ asset('assets/images/service/icon/12.svg') }}" alt="" class="icon">
                                    </div>
                                    <div class="details">
                                        <h6 class="title">Market Insights and Trends</h6>
                                        <p class="disc">  Staying updated on market insights and trends is essential for effective manpower planning. Our consultants possess in-depth knowledge of the job market, industry-specific requirements, and emerging trends.   </p>
                                    </div>
                                </div>
                                <!-- single service details card End -->
                            </div>
							<div class="col-lg-6">
                                <!-- single service details card -->
                                <div class="service-details-card">
                                    <div class="thumbnail">
                                        <img loading="lazy" src="{{ asset('assets/images/service/icon/10.svg') }}" alt="" class="icon">
                                    </div>
                                    <div class="details">
                                        <h6 class="title">Talent Acquisition and Recruitment</h6>
                                        <p class="disc"> Finding qualified candidates can be a challenging and time-consuming task. Our consultancy streamlines the recruitment process by leveraging our extensive network and expertise in candidate sourcing.   </p>
                                    </div>
                                </div>
                                <!-- single service details card End -->
                            </div>
                        </div>
                       
                    </div>
                    
                    
                </div>
                <!--rts blog wizered area -->
                <div class="col-xl-5 col-md-12 col-sm-12 col-12 mt_lg--60 pl--50 pl_md--0 pl-lg-controler pl_sm--0">
                    <!-- single wizered start -->
                    <div class="rts-single-wized Categories service">
                        <div class="wized-header">
                            <h5 class="title">
                                Quick Links
                            </h5>
                        </div>
                        <div class="wized-body">
                            <!-- single categoris -->
                            <ul class="single-categories">
                                <li><a href="{{ url('best-placement-services-for-candidate-in-chennai') }}">Placement Service(Candidate) <i class="far fa-long-arrow-right"></i></a></li>
                            </ul>
                            <!-- single categoris End -->
                            <!-- single categoris -->
                            <ul class="single-categories">
                                <li><a href="{{ url('best-manpower-suppliers-services-for-candidate-in-chennai') }}">  Manpower Suppliers <i class="far fa-long-arrow-right"></i></a></li>
                            </ul>
                            <!-- single categoris End -->
                            <!-- single categoris -->
                            <ul class="single-categories">
                                <li><a href="{{ url('best-placement-service-for-employers-services-for-candidate-in-chennai') }}">  Placement Service (For Employers)<i class="far fa-long-arrow-right"></i></a></li>
                            </ul>
                            <!-- single categoris End -->
                            <!-- single categoris -->
                            <ul class="single-categories">
                                <li><a href="{{ url('best-manpower-consultants-services-in-chennai') }}"> Manpower Consultants <i class="far fa-long-arrow-right"></i> </a></li>
                            </ul>
                            <!-- single categoris End -->
                            <!-- single categoris -->
                            <ul class="single-categories">
							<li><a href="{{ url('best-placement-service-for-it-industry-in-chennai') }}">  Placement Service for IT Industry <i class="far fa-long-arrow-right"></i></a></li>
                            </ul>
                            <!-- single categoris End -->
							<!-- single categoris -->
                            <ul class="single-categories">
							<li><a href="{{ url('best-placement-service-for-accounts-candidate-in-chennai') }}">Placement Service for Accounts <i class="far fa-long-arrow-right"></i></a></li>
                            </ul>
                            <!-- single categoris End -->
							<!-- single categoris -->
                            <ul class="single-categories">
							<li><a href="{{ url('best-placement-service-for-accounts-employers-in-chennai') }}">Placement Service for Accounts (Employers) <i class="far fa-long-arrow-right"></i></a></li>
                            </ul>
                            <!-- single categoris End -->
							<!-- single categoris -->
                            <ul class="single-categories">
							 <li><a href="{{ url('best-placement-service-for-hospital-in-chennai') }}">Placement  Service for Hospital <i class="far fa-long-arrow-right"></i></a> </li>
                            </ul>
                            <!-- single categoris End -->
							<!-- single categoris -->
                            <ul class="single-categories">
							<li><a href="{{ url('best-placement-placement-services-for-manpower-for-employer-in-chennai') }}">Placement  Service for Manpower  (Employers) <i class="far fa-long-arrow-right"></i></a></li>
                            </ul>
                            <!-- single categoris End -->
							<!-- single categoris -->
                            <ul class="single-categories">
							<li><a href="{{ url('best-placement-services-for-manpower-for-candidate-in-chennai') }}">Placement  Service for Manpower  (Candidate) <i class="far fa-long-arrow-right"></i></a></li>
                            </ul>
                            <!-- single categoris End -->
							<!-- single categoris -->
                            <ul class="single-categories">
							<li><a href="{{ url('best-manpower-outsourcing-services-in-chennai') }}">Manpower Outsourcing Services <i class="far fa-long-arrow-right"></i> </a></li>
                            </ul>
                            <!-- single categoris End -->
							<!-- single categoris -->
                            <ul class="single-categories">
							<li><a href="{{ url('best-placement-service-for-banking-sector-in-chennai') }}">Placement Service for Banking Sector <i class="far fa-long-arrow-right"></i> </a></li>
                            </ul>
                            <!-- single categoris End -->
                        </div>
                    </div>
                    <!-- single wizered End -->
                   
                    <!-- single wizered start -->
                    <div class="rts-single-wized contact service">
                        
                        <div class="wized-body">
                            <h5 class="title">Need Help? We Are Here
                                To Help You</h5>
                            <a class="rts-btn btn-primary" href="{{ url('contact') }}">Contact Us</a>
                        </div>
                    </div>
                    <!-- single wizered End -->
                </div>
                <!-- rts- blog wizered end area -->
            </div>
        </div>
    </div>
    <!-- End service details area -->

        @include('includes.site.contact_section')
@endsection

