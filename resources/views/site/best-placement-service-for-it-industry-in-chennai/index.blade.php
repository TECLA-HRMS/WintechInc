@extends('layouts.site')
@section('content')

<div class="rts-breadcrumb-area breadcrumb-bg bg_image">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 breadcrumb-1">
                    <h1 class="title" style="font-size: 38px;">Placement Service for IT Industry For Candidates</h1>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="bread-tag">
                        <a href="{{ url('/') }}">Home</a>
                        <span> / </span>
                        <a href="#" class="active">Placement Service for IT Industry</a>
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
                            <img loading="lazy" src="{{ asset('image/consultancy5.jpeg') }}" alt="business-area">
                        </div>
                        <h4 class="title">Placement Service for IT Industry For Candidates</h4>
                        <p class="disc">
                            Welcome to our Placement Service for the IT Industry! We specialize in connecting skilled IT professionals with exciting job opportunities in the technology sector. Whether you are a candidate seeking IT positions or an employer looking for top talent in the IT field, our placement service is here to assist you. Partner with our Placement Service for the IT Industry and let us assist you in finding the right job opportunities or top IT talent. Contact us today to discuss your specific requirements and explore how our placement service can meet your needs in the dynamic IT industry.
                        </p>
                       
                        <div class="row g-5 mt--30 mb--40">
                            <div class="col-lg-6">
                                <!-- single service details card -->
                                <div class="service-details-card">
                                    <div class="thumbnail">
                                        <img loading="lazy" src="{{ asset('assets/images/service/icon/09.svg') }}" alt="" class="icon">
                                    </div>
                                    <div class="details">
                                        <h6 class="title">Extensive Network</h6>
                                        <p class="disc">Our placement service has a vast network of IT companies and employers in various sectors. We connect with organizations actively seeking IT professionals and have access to a wide range of job opportunities.  </p>
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
                                        <h6 class="title">Specialized IT Roles</h6>
                                        <p class="disc">  We understand the diverse nature of the IT industry and cater to various IT roles and specializations. Whether you are a software developer, network engineer, data analyst, cybersecurity specialist, or IT project manager, we can help you find positions that match your skills, qualifications, and career aspirations. </p>
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
                                        <h6 class="title">IT Industry Expertise</h6>
                                        <p class="disc">  Our team of placement specialists possesses in-depth knowledge of the IT industry. We stay updated on the latest trends, technologies, and skills in demand. This allows us to provide valuable insights and guidance throughout your job search, ensuring that you are well-prepared for interviews and aware of industry-specific requirements.  </p>
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
                                        <h6 class="title">Skill Assessment and Guidance</h6>
                                        <p class="disc"> We assess your technical skills, expertise, and experience to match you with suitable job opportunities. Our placement service also offers guidance and support to enhance your candidacy, such as resume writing tips, interview coaching, and career counseling.   </p>
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

    @include('includes.site.contact_section')
@endsection

