@extends('layouts.site')
@section('content')

<div class="rts-breadcrumb-area breadcrumb-bg bg_image">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 breadcrumb-1">
                    <h1 class="title" style="font-size: 38px;">Placement Service for Accounts (Employers)</h1>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="bread-tag">
                        <a href="{{ url('/') }}">Home</a>
                        <span> / </span>
                        <a href="#" class="active">Placement Service for Accounts (Employers)</a>
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
                            <img src="{{ asset('image/consultancy7.jpg') }}" alt="business-area">
                        </div>
                        <h4 class="title">Placement Service for Accounts (Employers)</h4>
                        <p class="disc">
                           Welcome to our Placement Service for Accounts Employers! We specialize in connecting employers with highly skilled and qualified accounting professionals to meet your organization's financial and accounting needs. Our placement service is designed to streamline the recruitment process and ensure that you find the right candidates for your accounting positions.
                        </p>
                       
                        <div class="row g-5 mt--30 mb--40">
                            <div class="col-lg-6">
                                <!-- single service details card -->
                                <div class="service-details-card">
                                    <div class="thumbnail">
                                        <img src="{{ asset('assets/images/service/icon/09.svg') }}" alt="" class="icon">
                                    </div>
                                    <div class="details">
                                        <h6 class="title">Extensive Candidate Pool</h6>
                                        <p class="disc">Our placement service maintains a diverse pool of talented accounting professionals. We have access to a wide network of candidates with various accounting specializations, including general accounting, financial analysis, taxation, auditing, and more.  </p>
                                    </div>
                                </div>
                                <!-- single service details card End -->
                            </div>
                            
                            <div class="col-lg-6">
                                <!-- single service details card -->
                                <div class="service-details-card">
                                    <div class="thumbnail">
                                        <img src="{{ asset('assets/images/service/icon/11.svg') }}" alt="" class="icon">
                                    </div>
                                    <div class="details">
                                        <h6 class="title">Long-Term Partnership</h6>
                                        <p class="disc">  Our goal is to build long-term partnerships with our clients. We strive to understand your organization's culture, values, and long-term staffing goals. By developing a deep understanding of your needs, we can provide ongoing support and assistance, even after the placement is made.</p>
                                    </div>
                                </div>
                                <!-- single service details card End -->
                            </div>
                            <div class="col-lg-6">
                                <!-- single service details card -->
                                <div class="service-details-card">
                                    <div class="thumbnail">
                                        <img src="{{ asset('assets/images/service/icon/12.svg') }}" alt="" class="icon">
                                    </div>
                                    <div class="details">
                                        <h6 class="title">Confidentiality and Privacy</h6>
                                        <p class="disc">  We understand the importance of confidentiality in the hiring process. Our placement service maintains strict confidentiality protocols to ensure that your job openings and company information are treated with the utmost privacy. We respect your organizational needs and prioritize confidentiality throughout the recruitment process. </p>
                                    </div>
                                </div>
                                <!-- single service details card End -->
                            </div>
							<div class="col-lg-6">
                                <!-- single service details card -->
                                <div class="service-details-card">
                                    <div class="thumbnail">
                                        <img src="{{ asset('assets/images/service/icon/10.svg') }}" alt="" class="icon">
                                    </div>
                                    <div class="details">
                                        <h6 class="title">Streamlined Recruitment Process</h6>
                                        <p class="disc"> We streamline the recruitment process, saving you time and effort. Our placement service handles candidate sourcing, pre-screening, and initial assessments, presenting you with a shortlist of qualified candidates.</p>
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

@endsection
