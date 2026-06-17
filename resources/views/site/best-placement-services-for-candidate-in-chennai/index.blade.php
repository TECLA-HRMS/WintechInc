@extends('layouts.site')
@section('content')

<div class="rts-breadcrumb-area breadcrumb-bg bg_image">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 breadcrumb-1">
                    <h1 class="title" style="font-size: 38px;">Placement Service(Candidate)</h1>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="bread-tag">
                        <a href="{{ url('/') }}">Home</a>
                        <span> / </span>
                        <a href="#" class="active">Placement Service(Candidate)</a>
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
                            <img loading="lazy" src="{{ asset('image/consultancy1.jpg') }}" alt="business-area">
                        </div>
                        <h4 class="title">Placement Service(Candidate)</h4>
                        <p class="disc">
                            Welcome to our candidate placement service! We are here to assist you in finding the right employment opportunities that align with your skills, qualifications, and career goals. Our mission is to connect talented individuals like you with reputable employers who are seeking top-notch candidates. Searching for employment can be a time-consuming process. As a candidate, you may need to navigate multiple job boards, submit numerous applications, and go through multiple rounds of interviews. Our placement service streamlines this process by presenting you with pre-screened opportunities that closely align with your qualifications. This saves you valuable time and effort.

                        </p>
                       
                        <div class="row g-5 mt--30 mb--40">
                            <div class="col-lg-6">
                                <!-- single service details card -->
                                <div class="service-details-card">
                                    <div class="thumbnail">
                                        <img loading="lazy" src="{{ asset('assets/images/service/icon/09.svg') }}" alt="" class="icon">
                                    </div>
                                    <div class="details">
                                        <h6 class="title">Personalized Approach</h6>
                                        <p class="disc">We understand that each candidate is unique, with specific aspirations and strengths. Our dedicated team takes the time to get to know you, assess your skills, and understand your career objectives.</p>
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
                                        <h6 class="title">Extensive Network</h6>
                                        <p class="disc">Over the years, we have built a vast network of employers across various industries. Our connections and partnerships enable us to access a wide range of job opportunities that may not be advertised elsewhere. </p>
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
                                        <h6 class="title">Access to Hidden Opportunities</h6>
                                        <p class="disc">Not all job openings are publicly advertised. Many employers prefer to work with placement services to find qualified candidates. By being part of our candidate pool, you gain exclusive access.</p>
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
                                        <h6 class="title">Guidance and Support:</h6>
                                        <p class="disc">Our placement service goes beyond simply matching candidates with job openings. We offer comprehensive guidance and support throughout the entire job search process. </p>
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

