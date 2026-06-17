@extends('layouts.site')
@section('content')

<div class="rts-breadcrumb-area breadcrumb-bg bg_image">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 breadcrumb-1">
                    <h1 class="title" style="font-size: 38px;">Manpower Suppliers</h1>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="bread-tag">
                        <a href="{{ url('/') }}">Home</a>
                        <span> / </span>
                        <a href="#" class="active">Manpower Suppliers</a>
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
                            <img loading="lazy" src="{{ asset('image/consultancy2.jpg') }}" alt="business-area">
                        </div>
                        <h4 class="title">Manpower Suppliers</h4>
                        <p class="disc">
                            Welcome to our Manpower Suppliers Consultancy! We specialize in providing comprehensive solutions for your workforce needs. Whether you require temporary staffing, permanent placements, or project-based manpower, our consultancy is here to assist you. 
							Our consultancy believes in building long-term relationships with our clients. We provide ongoing support throughout the staffing process, ensuring a smooth transition for the hired candidates into your organization. We also offer post-placement assistance and follow-up to address any concerns or additional staffing needs that may arise.
                        </p>
                       
                        <div class="row g-5 mt--30 mb--40">
                            <div class="col-lg-6">
                                <!-- single service details card -->
                                <div class="service-details-card">
                                    <div class="thumbnail">
                                        <img loading="lazy" src="{{ asset('assets/images/service/icon/09.svg') }}" alt="" class="icon">
                                    </div>
                                    <div class="details">
                                        <h6 class="title">Tailored Workforce Solutions</h6>
                                        <p class="disc">We understand that every business has unique requirements when it comes to manpower. Our consultancy takes the time to understand your organization's specific needs, industry, and project demands. </p>
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
                                        <h6 class="title">Extensive Talent Network</h6>
                                        <p class="disc">Over the years, we have built an extensive network of qualified professionals across various industries. Our talent pool consists of skilled individuals from diverse backgrounds, including IT, finance, engineering, healthcare, and more.  </p>
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
                                        <h6 class="title">Streamlined Recruitment Process</h6>
                                        <p class="disc"> Finding the right talent can be a time-consuming and challenging task. Our consultancy streamlines the recruitment process for you. We handle the entire hiring process, from sourcing and screening candidates to conducting interviews and reference checks. </p>
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
                                        <h6 class="title">Cost-Effective Solutions</h6>
                                        <p class="disc">Managing workforce requirements can be costly, especially when it comes to recruitment, training, and retention. By partnering with our consultancy, you can save on recruitment costs, as we have the resources and expertise to efficiently identify and attract qualified candidates. </p>
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

    <!-- start header area -->

    @include('includes.site.contact_section')
@endsection

