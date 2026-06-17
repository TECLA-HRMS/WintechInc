@extends('layouts.site')
@section('content')
    <link rel="stylesheet" href="{{ asset('assetss/css/style.css') }}">

<main id="main">
    <link href="{{ asset('Content/custom.min.css') }}" rel="stylesheet">
    <section class="about-us-digi">
        <div class="container">
            <div class="row" data-aos="fade-up">
                <div class="col-lg-6 col-12">
                    <div class="hero-heading-style mt-60">
                        <h1 style="color:white"> Top Web Development Company in India </h1>
                        <p class="text-light11" style="margin-top: 30px; color:white"; > We create efficient, futuristic, and responsive websites to help your organization establish a strong online presence and to grow your business. </p>
                        <a href="{{ url('contact') }}" ><button type="button" class="thm-btn btn-primary reach-style pulse1" style="margin-top: 35px;width: 50%;">Contact Us </button></a>
                    </div>
                </div>
                <div class="col-lg-1 col-12"> </div>
                

            </div>  
        </div> 
    </section>
    <section class="services-area uk-services uk-section our_service_section">
        <div class="container">
            <div class="row other-solutions-title">
                <h2 class="text-center">Our Web Development Services </h2>
            </div>
            <div class="uk-grid uk-grid-match uk-grid-medium uk-child-width-1-3@m uk-child-width-1-2@s">
                <div class="row">
                    <div class="col-md-4">
                        <div class="item">
                            <div class="single-services-box wd-ser">
                                <div class="icon">
                                    <i class="flaticon-plan"></i>
                                </div>
                                <h3><a href="#">Static Website</a></h3>
                                <div class="bar"></div>
                                <p> Wintech provides the finest and most affordable static website for small business services based on your requirements. Our highly skilled professional team creates one-of-a-kind and suitable static websites for your business, with high quality and fast download timings. </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="item">
                            <div class="single-services-box wd-ser">
                                <div class="icon">
                                    <i class="flaticon-think"></i>
                                </div>
                                <h3><a href="#">Dynamic Website</a></h3>
                                <div class="bar"></div>
                                <p> With the help of our technological expertise, we create websites that are user-friendly and have complete dynamic functionality for a better business experience. Our dynamic websites are fully personalized, and versatile, and have a sophisticated UX interface that responds to clients effectively. </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="item">
                            <div class="single-services-box wd-ser">
                                <div class="icon">
                                    <i class="flaticon-shout"></i>
                                </div>
                                <h3><a href="#">Saas</a></h3>
                                <div class="bar"></div>
                                <p> Software as a Service (SaaS) is a way of sharing software with a large number of consumers and the application can be shared among several users. With our SaaS solution, you can easily handle data from any networked device while maintaining excellent scalability and uptime performance. </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="item">
                            <div class="single-services-box wd-ser">
                                <div class="icon">
                                    <i class="flaticon-analytics-1"></i>
                                </div>
                                <h3><a href="#">Portals</a></h3>
                                <div class="bar"></div>
                                <p> We create the most comprehensive and sophisticated web-based portal for your company, with a unified digital experience. We create the most optimal and tailored complete portal development services for all of your business requirements. </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="item">
                            <div class="single-services-box wd-ser">
                                <div class="icon">
                                    <i class="flaticon-ux-design"></i>
                                </div>
                                <h3><a href="#">CMS</a></h3>
                                <div class="bar"></div>
                                <p> We are experts in creating and managing content with the most robust content management system (CMS) service at an affordable price. We provide reliable, flexible, scalable, and cutting-edge content-based CMS for multiple CMS platforms for all businesses and third-party integration. </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="item">
                            <div class="single-services-box wd-ser">
                                <div class="icon">
                                    <i class="flaticon-camera"></i>
                                </div>
                                <h3><a href="#">Hosting Services</a></h3>
                                <div class="bar"></div>
                                <p> We maintain and manage hosting services for your website online with our hosting services to our valuable clients. Our hosting services are fast, stable, and secure with high page speed and we have a customized stand package for web hosting services in Chennai. </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="services-section margin-top">
        <div class="pattern-layer" style="background-image: url(assetss/images/web-development/pattern-2.png)"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="section-title">
                        <h4 class="serve-f text-danger text-center"> We Serve All </h4>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="service-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="icon-box">
                            <img loading="lazy" class="serves-img-sec" src="{{ asset('assetss/images/web-development/2-sec/startups.png') }}" alt="">
                        </div>
                        <div class="wd-platforms">
                            <h5><a>Startups</a></h5>
                            <div class="text"> We develop the best website development applications service for your business to stay ahead of your competitors and succeed digitally in your business. </div>
                        </div>
                    </div>
                </div>
                <div class="service-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="icon-box">
                            <img loading="lazy" class="serves-img-sec" src="{{ asset('assetss/images/web-development/2-sec/enterprises-bg.png') }}" alt="">
                        </div>
                        <div class="wd-platforms">
                            <h5><a>Enterprises</a></h5>
                            <div class="text"> Our experienced web development team significantly aids in the management of your business and captures the attention of the public with our services. </div>
                        </div>
                    </div>
                </div>
                <div class="service-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="icon-box">
                            <img loading="lazy" class="serves-img-sec" src="{{ asset('assetss/images/web-development/2-sec/non-profits.png') }}" alt="">
                        </div>
                        <div class="wd-platforms">
                            <h5><a>Non-profits</a></h5>
                            <div class="text"> We serve non-profit organizations such as NGOs, charities, and other non-profit organizations. We digitize their website requirements and create the appropriate development service. </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        .technology-section {
            position: relative;
            padding: 110px 0px 70px;
        }

        .technology-section .title-column {
            position: relative;
        }

        .technology-section .title-column .inner-column {
            position: relative;
            padding-top: 30px;
        }

        .technology-section:before {
            position: absolute;
            content: '';
            left: 0px;
            top: 0px;
            right: 0px;
            bottom: 0px;
            background-color: rgba(20, 29, 56, 0.95);
        }

        .technology-section .pattern-layer-one {
            position: absolute;
            left: 0px;
            top: 0px;
            width: 50%;
            height: 100%;
            background-position: left top;
            background-repeat: no-repeat;
        }

        .technology-section .pattern-layer-two {
            position: absolute;
            right: 0px;
            top: 0px;
            width: 50%;
            height: 100%;
            background-position: right top;
            background-repeat: no-repeat;
        }

        .technology-section .blocks-column {
            position: relative;
        }

        .technology-section .blocks-column .inner-column {
            position: relative;
        }

        .technology-section .blocks-column .inner-column .technology-block:nth-child(4) {
            margin-left: -100px;
        }

        .technology-block {
            position: relative;
            margin-bottom: 30px;
        }

        .technology-block .inner-box {
            position: relative;
            padding: 15px 15px;
            text-align: center;
            border-radius: 10px;
            border: 1px dashed #DF0A0A;
            transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -webkit-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
        }

        .technology-block .inner-box:hover {
            position: relative;
            padding: 15px 15px;
            text-align: center;
            border-radius: 10px;
            border: 1px dashed rgb(223 71 37);
            transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -webkit-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
        }

        .technology-block .inner-box .overlay-link {
            position: absolute;
            left: 0px;
            top: 0px;
            right: 0px;
            bottom: 0px;
            display: block;
            z-index: 1;
        }

        .technology-block .inner-box .icon-box {
            position: relative;
            color: #0060ff;
            font-size: 64px;
            line-height: 1em;
            transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -webkit-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
        }

        .technology-block .inner-box:hover .icon-box {
            transform: rotateY(180deg);
        }

        .technology-block .inner-box h6 {
            position: relative;
            color: #2d4368;
            font-weight: 600;
            margin-top: 18px;
            text-transform: capitalize;
            transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -webkit-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
        }

        .technology-block .inner-box:hover {
            border: 1px dashed rgb(223 71 37);
            background-color: #ffffff;
        }

        .technology-block .inner-box:hover .icon-box {
            color: #0060ff;
        }

        .technology-block .inner-box:hover h6 {
            color: #df4725;
        }

        .technology-section.style-two .technology-block {
            width: 20%;
            padding: 0px 15px;
        }

        .technology-section.style-two .technology-block h6 {
            text-transform: capitalize;
        }

        .inner-column h2 {
            color: #fff;
            font-size: 20px;
        }

        .inner-column h1 {
            color: #fff;
            font-weight: 800;
            font-size: 30px;
            margin-bottom: 20px;
        }
    </style>
    <section class="dm-our-services-process process-section-01">
        <div class="container" data-aos="fade-up">
            <div class="smartsalez process-section-02">
                <h1 class="text-center"> We Cater All Industries </h1>
            </div>
            <div class="blocks-column col-lg-12 col-md-12 col-sm-12">
                <div class="inner-column">
                    <div class="row clearfix">
                        <div class="technology-block col-lg-3 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <a class="overlay-link"></a>
                                <div class="icon-box">
                                    <img loading="lazy" src="{{ asset('assetss/imgs/web/industries/1.png') }}" class="content-img">
                                </div>
                                <h6 style="font-size: 15px;">Retail</h6>
                            </div>
                        </div>
                        <div class="technology-block col-lg-3 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <a class="overlay-link"></a>
                                <div class="icon-box">
                                    <img loading="lazy" src="{{ asset('assetss/imgs/web/industries/2.png') }}" class="content-img">
                                </div>
                                <h6  style="font-size: 15px;">Real Estate</h6>
                            </div>
                        </div>
                        <div class="technology-block col-lg-3 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <a class="overlay-link"></a>
                                <div class="icon-box">
                                    <img loading="lazy" src="{{ asset('assetss/imgs/web/industries/3.png') }}" class="content-img">
                                </div>
                                <h6 style="font-size: 15px;">Automobile</h6>
                            </div>
                        </div>
                        <div class="technology-block col-lg-3 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <a class="overlay-link"></a>
                                <div class="icon-box">
                                    <img loading="lazy" src="{{ asset('assetss/imgs/web/industries/4.png') }}" class="content-img">
                                </div>
                                <h6 style="font-size: 15px;"> Travel & Hospitality</h6>
                            </div>
                        </div>
                        <div class="technology-block col-lg-3 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <a class="overlay-link"></a>
                                <div class="icon-box">
                                    <img loading="lazy" src="{{ asset('assetss/imgs/web/industries/5.png') }}" class="content-img">
                                </div>
                                <h6 style="font-size: 15px;">Healthcare</h6>
                            </div>
                        </div>
                        <div class="technology-block col-lg-3 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <a class="overlay-link"></a>
                                <div class="icon-box">
                                    <img loading="lazy" src="{{ asset('assetss/imgs/web/industries/6.png') }}" class="content-img">
                                </div>
                                <h6 style="font-size: 15px;">Education</h6>
                            </div>
                        </div>
                        <div class="technology-block col-lg-3 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <a class="overlay-link"></a>
                                <div class="icon-box">
                                    <img loading="lazy" src="{{ asset('assetss/imgs/web/industries/7.png') }}" class="content-img">
                                </div>
                                <h6 style="font-size: 15px;">Finance</h6>
                            </div>
                        </div>
                        <div class="technology-block col-lg-3 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <a class="overlay-link"></a>
                                <div class="icon-box">
                                    <img loading="lazy" src="{{ asset('assetss/imgs/web/industries/8.png') }}" class="content-img">
                                </div>
                                <h6 style="font-size: 15px;">Logistics</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="hero1" class="hero our_service_section">
        <div class="inner">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-12">
                        <div class="choose-heading-style" data-aos="zoom-in">
                            <h5 class="text-danger">Why Hire Wintech</h5>
                            <h2 class="text-white mt-3"> At Wintech, we impress our clients by delivering high standard <br> web applications that suit their vision. </h2>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-12 col-12">
                        <div class="overlays">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <div class="row">

                                        <div class="col-xl-4 col-md-6 col-6 mt-4 d-flex align-content-stretch">
                                            <div class="futuristic-box development-box" data-aos="zoom-in">
                                                <figure>
                                                    <img loading="lazy" src="{{ asset('assetss/images/web-development/hire/1.png') }}" alt="">
                                                    <figcaption class=" ">
                                                        <h6 class="text-white text-left mt-3"style="font-size: 15px;"> Professionals with extensive knowledge </h6>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-6 mt-4 d-flex align-content-stretch">
                                            <div class="futuristic-box development-box" data-aos="zoom-in">
                                                <figure>
                                                    <img loading="lazy" src="{{ asset('assetss/images/web-development/hire/2.png') }}" alt="">
                                                    <figcaption class=" ">
                                                        <h6 class="text-white text-left mt-3"style="font-size: 15px;"> Quick response times </h6>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-6 mt-4 d-flex align-content-stretch">
                                            <div class="futuristic-box development-box" data-aos="zoom-in">
                                                <figure>
                                                    <img loading="lazy" src="{{ asset('assetss/images/web-development/hire/3.png') }}" alt="">
                                                    <figcaption class=" ">
                                                        <h6 class="text-white text-left mt-3"style="font-size: 15px;"> Cost-effective service </h6>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-6 mt-4 d-flex align-content-stretch">
                                            <div class="futuristic-box development-box" data-aos="zoom-in">
                                                <figure>
                                                    <img loading="lazy" src="{{ asset('assetss/images/web-development/hire/4.png') }}" alt="">
                                                    <figcaption class=" ">
                                                        <h6 class="text-white text-left mt-3"style="font-size: 15px;"> Assist with maintenance and support </h6>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-6 mt-4 d-flex align-content-stretch">
                                            <div class="futuristic-box development-box" data-aos="zoom-in">
                                                <figure>
                                                    <img loading="lazy" src="{{ asset('assetss/images/web-development/hire/5.png') }}" alt="">
                                                    <figcaption class=" ">
                                                        <h6 class="text-white text-left mt-3"style="font-size: 15px;"> Full transparency </h6>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-6 mt-4 d-flex align-content-stretch">
                                            <div class="futuristic-box development-box" data-aos="zoom-in">
                                                <figure>
                                                    <img loading="lazy" src="{{ asset('assetss/images/web-development/hire/6.png') }}" alt="">
                                                    <figcaption class=" ">
                                                        <h6 class="text-white text-left mt-3"style="font-size: 15px;"> Innovative approach </h6>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="cta-one our_service_section" id="4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="choose-heading-style c_align aos-init aos-animate" data-aos="zoom-in">
                        <p class="c_align">How it works</p>
                        <h5 class="text-danger"> Our Website Development process </h5>
                    </div>
                </div>
            </div>
            <img loading="lazy" src="{{ asset('assets/image/shapes/10.png') }}" class="cta-one__bg-shape-1" alt="">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="timeline">
                        <li>
                            <img loading="lazy" class="our-process" src="{{ asset('assets/imgs/web/process/5.png') }}" alt="">
                            <div class="direction-r">
                                <div class="flag-wrapper">
                                    <span class="flag">Discovery & Research </span>
                                </div>
                                <div class="desc"> We understand your visions, ideas, and website needs. And create a plan by gathering information and trends related to your industry. </div>
                            </div>
                        </li>
                        <li>
                            <img loading="lazy" class="our-process1" src="{{ asset('assets/imgs/web/process/4.png') }}" alt="">
                            <div class="direction-l">
                                <div class="flag-wrapper">
                                    <span class="flag">Design & Wireframing </span>
                                </div>
                                <div class="desc l_side_timeline"> We create the best layout for your website and don't deploy any code until you approve the layout and design. </div>
                            </div>
                        </li>
                        <li>
                            <img loading="lazy" class="our-process" src="{{ asset('assets/imgs/web/process/1.png') }}" alt="">
                            <div class="direction-r">
                                <div class="flag-wrapper">
                                    <span class="flag">Coding </span>
                                </div>
                                <div class="desc"> As soon as the layout design is finalized we deploy the code by our professional developers for the ideal website based on the customer’s requirement. </div>
                            </div>
                        </li>
                        <li>
                            <img loading="lazy" class="our-process1" src="{{ asset('assets/imgs/web/process/2.png') }}" alt="">
                            <div class="direction-l">
                                <div class="flag-wrapper">
                                    <span class="flag">Testing </span>
                                </div>
                                <div class="desc l_side_timeline"> We perform out compatibility checks, user testing, and quality checks to ensure that your website is error-free. </div>
                            </div>
                        </li>
                        <li>
                            <img loading="lazy" class="our-process" src="{{ asset('assets/imgs/web/process/3.png') }}" alt="">
                            <div class="direction-r">
                                <div class="flag-wrapper">
                                    <span class="flag">Launch </span>
                                </div>
                                <div class="desc"> Your website will be ready to launch online once it has been built and will draw in new business opportunities. </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css') }}" rel="stylesheet">
    <section class="language-logo-bg our_service_section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="container">
                        <div class="smartsalez">
                            <h1 class="tech-text-n text-center text-light"> Technologies we use</h1>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="brand-carousel section-padding owl-carousel">
                                    <div class="single-logo"><img loading="lazy" alt="" class="tech-logo-size" src="{{ asset('assetss/images/web-development/technology/1.png') }}"></div>
                                    <div class="single-logo"><img loading="lazy" alt="" class="tech-logo-size" src="{{ asset('assetss/images/web-development/technology/2.png') }}"></div>
                                    <div class="single-logo"><img loading="lazy" alt="" class="tech-logo-size" src="{{ asset('assetss/images/web-development/technology/3.png') }}"></div>
                                    <div class="single-logo"><img loading="lazy" alt="" class="tech-logo-size" src="{{ asset('assetss/images/web-development/technology/4.png') }}"></div>
                                    <div class="single-logo"><img loading="lazy" alt="" class="tech-logo-size" src="{{ asset('assetss/images/web-development/technology/5.png') }}"></div>
                                    <div class="single-logo"><img loading="lazy" alt="" class="tech-logo-size" src="{{ asset('assetss/images/web-development/technology/6.png') }}"></div>
                                    <div class="single-logo"><img loading="lazy" alt="" class="tech-logo-size" src="{{ asset('assetss/images/web-development/technology/7.png') }}"></div>
                                    <div class="single-logo"><img loading="lazy" alt="" class="tech-logo-size" src="{{ asset('assetss/images/web-development/technology/8.png') }}"></div>
                                    <div class="single-logo"><img loading="lazy" alt="" class="tech-logo-size" src="{{ asset('assetss/images/web-development/technology/9.png') }}"></div>
                                    <div class="single-logo"><img loading="lazy" alt="" class="tech-logo-size" src="{{ asset('assetss/images/web-development/technology/10.png') }}"></div>
                                    <div class="single-logo"><img loading="lazy" alt="" class="tech-logo-size" src="{{ asset('assetss/images/web-development/technology/11.png') }}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .tech-text-n {
            padding-bottom: 40px;
        }

        .brand-carousel {
            background: #0b2653;
            /* margin-top: 15%; */
            padding-bottom: 0px;
            padding-top: 0px;
        }

        .owl-dots {
            text-align: center;
            /* margin-top: 4%; */
        }

        .owl-dot {
            /*display: inline-block;*/
            display: none;
            height: 15px !important;
            width: 15px !important;
            background-color: #878787 !important;
            opacity: 0.8;
            border-radius: 50%;
            margin: 0 5px;
        }

        .owl-dot.active {
            background-color: #000 !important;
        }
    </style>
    <section class="frequently-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-md-12 col-12" data-aos="fade-up">
                    <div class="frequently-img">
                        <img loading="lazy" src="assetss/images/web-development/faq.webp" alt="Wintech" class="">
                    </div>
                </div>
                <div class="col-xl-7 col-md-12 col-12" data-aos="fade-up">
                    <div class="questions-heading">
                        <h2 class="text-left">Frequently Asked <br /><span class="text-danger">Questions</span></h2>
                    </div>
                    <div class="accordion mt-4" id="accordionExample">
                        <div class="accordion-item">
                            <h4 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Do I get maintenance services after my website development?
                                </button>
                            </h4>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p> Yes, we provide full maintenance and support services to keep your website secure and updated. We take on all of your responsibilities and continuously maintain your website for your business growth. </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h4 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    How long it will take to complete my website?
                                </button>
                            </h4>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p> The website's completion is determined by the project's functionality requirements. We will complete the website within a week. </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h4 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Will you provide maintenance service?
                                </button>
                            </h4>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p> Yes, we assist you with proper website maintenance while also ensuring website security and safety for our clients. </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h4 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                                    Will my website be mobile-friendly?
                                </button>
                            </h4>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p> Yes, we create a responsive website that works on all devices to provide customers with a better viewing experience. </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h4 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                                    Do you revamp the old website?
                                </button>
                            </h4>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p> Yes, we convert your old website into a new upgraded website based on your customization and business requirements. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--<section class="contact section-bg form-height-1" id="contact-footer">-->
    <!--    <div class="container" data-aos="fade-up">-->
    <!--        

-->
    <!--    </div>-->
    <!--</section>-->
</main>

@endsection

