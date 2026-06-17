@extends('layouts.site')
@section('content')

<main id="main">
    <link href="{{ asset('Content/custom.min.css') }}" rel="stylesheet">
    <section class="about-us-mobile">
        <div class="container">
            <div class="row" data-aos="fade-up">
                <div class="col-lg-6 col-12">
                    <div class="hero-heading-style mt-60">
                        <h1 class="text-light11"> Best Mobile app development <br> company in India </h1>
                        <p class="text-light11" style="margin-top: 20px;"> We design the most reliable, quality, and robust mobile app development service for your business for both Android and iOS application services. </p>
                        <a href="{{ url('contact') }}" ><button type="button" class="thm-btn btn-primary reach-style pulse1" style="margin-top: 35px;width: 50%;">Contact Us </button></a>
                    </div>
                </div>
                <div class="col-lg-1 col-12"> </div>
                

            </div>
        </div>
    </section>
    <section class="your-custom-ecommerce-non-bg mobile-r-19">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-xl-5 col-md-6 col-12 order-xl-1 order-1 mb-3">
                    <h4 class="d-block d-xl-none mobile-title "> Mobile App Development Service </h4>
                    <img loading="lazy" style="width: -webkit-fill-available;" class="mobile-view-02" src="{{ asset('assetss/imgs/mobile-app/sucess-stories.png') }}">
                </div>
                <div class="col-xl-1 col-md-6 col-12 order-xl-2 order-2 mb-3"></div>
                <div class="col-xl-6 col-md-6 col-12 order-xl-2 order-2 mb-3">
                    <div class="best-ecommerce-heading">
                        <h2 class="mb-40 text-danger mobile-r-01 mobile-title"> Mobile App Development Service </h2>
                        <p> Wintech is the best mobile app development company in Chennai. We create top-grade, customer-focused mobile application developmentfor a variety of platforms.We have years of experience in designing and developing mobile apps, and we build fast and efficient applications with the expertise of our professional team. </p>
                        <div class="OurWorkingLft">
                            <h2> Our AppFeature </h2><br>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <p><i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> User-friendly website </p>
                                <p><i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Supports all platforms </p>
                                <p><i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Safe and secured </p>

                            </div>
                            <div class="col-md-6">
                                <p><i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Flexible </p>
                                <p><i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Fast loading </p>
                                <p><i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Cost-effective </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="best-ecommerce-section provide-top-section mt-50-01">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-md-12 col-12 mb-5 mobile-r-03 mobile-r-04" data-aos="fade-up">
                      <h4 class="d-block d-xl-none mobile-title "> Android App Development </h4>
                    <img loading="lazy" class="mobile-view-01 mobile-r-06" src="{{ asset('assetss/images/mobile-app-development/android.png') }}">
                </div>
                <div class="col-xl-6 col-md-12 col-12 d-flex align-items-center" data-aos="fade-up">
                    <div class="best-ecommerce-heading">
                        <h2 class="mb-40 text-danger mobile-r-05 mobile-r-01 mobile-title"> Android App Development </h2>
                        <p> Our app services are modular, efficient, and user-friendly for your business. We create customer-driven app development services using cutting-edge technology based on the needs of the customer's business and empower brand recognition.  </p>
                        <p> Our experienced Android app developers work in Java, C++, SQL, Linux, and Android Studio. With Wintech Android mobile app development services, you may differentiate yourself from the competition while increasing brand awareness and sales. </p>
                    </div>
                </div>
                <div class="col-xl-1"></div>
                <div class="col-xl-5 col-md-12 col-12 mb-5 mobile-r-01" data-aos="fade-up">
                    <img loading="lazy" class="mobile-view-01" src="{{ asset('assetss/images/mobile-app-development/android.png') }}">
                </div>
            </div>
        </div>
    </section>
    <section class="your-custom-ecommerce-non-bg mobile-r-19">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-xl-5 col-md-6 col-12 order-xl-1 order-1 mb-3">
                    <h4 class="text-danger d-block d-xl-none mobile-title"> iOS App Development </h4>
                    <img loading="lazy" class="mobile-view-02" src="{{ asset('assetss/images/mobile-app-development/iso.png') }}">
                </div>
                <div class="col-xl-1 col-md-6 col-12 order-xl-2 order-2 mb-3"></div>
                <div class="col-xl-6 col-md-6 col-12 order-xl-2 order-2 mb-3">
                    <div class="best-ecommerce-heading">
                        <h2 class="mb-40 text-danger mobile-r-01 mobile-title"> iOS App Development </h2>
                        <p> We have been successfully designing and developing engaging iOS software for all Apple devices. Our iOS software is flawless, high-quality, and tailored to the needs of the consumer, and it works flawlessly. </p>
                        <p>  Our experienced team will be in charge of app designing and maintenance on all Apple devices after the delivery of the application is developed. We design and develop full-stack iOS apps while adhering to all Apple device platform specifications. </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style="background-image: url(assetss/images/web-development/why-choose.jpg);" class="testimonial text-center">
        <div class="container">
            <div class="heading white-heading">
                Our procedures in dealing with clients
            </div>
            <div id="testimonial4" class="carousel slide testimonial4_indicators testimonial4_control_button thumb_scroll_x swipe_x" data-ride="carousel" data-pause="hover" data-interval="5000" data-duration="2000">
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <div class="testimonial4_slide">
                            <!--<img loading="lazy" src="assetss/images/mobile-app-development/testimonials/t-01.webp" class="img-circle img-responsive" /><br>-->
                            <h4>Clients, we serve</h4>
                            <p> We serve companies of all sizes from all key industries, as well as individuals and early-stage startups with on-time delivery and within-budget apps. </p>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-4">
                                        <p> <i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Startups </p>
                                        <p> <i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Small businesses </p>
                                        <p> <i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Enterprises </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p> <i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Non-profits </p>
                                        <p> <i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Governments </p>
                                        <p> <i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Solopreneurs </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="testimonial4_slide">
                            <!--<img loading="lazy" src="assetss/images/mobile-app-development/testimonials/t-02.webp" class="img-circle img-responsive" /><br>-->
                            <h4>Our Approach</h4>
                            <p> Our app development process includes information collecting, brainstorming, UX/UI designing, prototyping, quality testing, and launching from the beginning to the end. </p>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p> <i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Understanding client requirements & setting goals </p>
                                        <p> <i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Market research and idea generation </p>
                                        <p> <i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> UX design and prototyping </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p> <i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Deployment, Testing, Coding, and Review </p>
                                        <p> <i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Launching and promotion </p>
                                        <p> <i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Maintenance & updating </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#testimonial4" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#testimonial4" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>
    </section>
    <section class="our_service_section">
        <div class="container aos-init aos-animate" data-aos="fade-up">
            <div class="row">
                <h2 class="mb-5 application-text"> Types of APPs </h2>
                <div class="col-xl-4 col-12 mobile-view-03">
                    <div class="row">
                        <div class="col-xl-2 col-12">
                            <img loading="lazy" src="{{ asset('assetss/imgs/mobile-app/applications/1.png') }}" class="app-icm" alt="Voicebot">
                        </div>
                        <div class="col-xl-10 col-12">
                            <h3 class="app-text">E-commerce Apps</h3>
                            <p class="mobile-view-04"> We design outstanding mobile applications for your e-commerce business that give your customers a wonderful shopping experience. </p>
                        </div>
                    </div>
                </div>
              
                <div class="col-xl-4 col-12 mobile-view-03">
                    <div class="row">
                        <div class="col-xl-2 col-12">
                            <img loading="lazy" src="{{ asset('assetss/imgs/mobile-app/applications/3.png') }}" class="app-icm" alt="Voicebot">
                        </div>
                        <div class="col-xl-10 col-12">
                            <h3 class="app-text">Restaurant & Food delivery Apps </h3>
                            <p class="mobile-view-04"> For restaurants, fast food chains, and meal delivery services, we develop mobile apps that allow customers to order their preferred items on the go. </p>
                        </div>
                    </div>
                </div>
              
                <div class="col-xl-4 col-12 mobile-view-03">
                    <div class="row">
                        <div class="col-xl-2 col-12">
                            <img loading="lazy" src="{{ asset('assetss/imgs/mobile-app/applications/5.png') }}" class="app-icm" alt="Voicebot">
                        </div>
                        <div class="col-xl-10 col-12">
                            <h3 class="app-text"> Travel booking apps </h3>
                            <p class="mobile-view-04"> Build apps for booking flights, tours, lodging, and other types of travel so that travelers can book them effortlessly. </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-12 mobile-view-03">
                    <div class="row">
                        <div class="col-xl-2 col-12">
                            <img loading="lazy" src="{{ asset('assetss/imgs/mobile-app/applications/7.png') }}" class="app-icm" alt="Voicebot">
                        </div>
                        <div class="col-xl-10 col-12">
                            <h3 class="app-text"> Health & Fitness Apps </h3>
                            <p class="mobile-view-04"> We provide high-quality wellness apps that make life easier for users, such as calorie counters and apps for tracking nutrition, exercise, and meditation. </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-12 mobile-view-03">
                    <div class="row">
                        <div class="col-xl-2 col-12">
                            <img loading="lazy" src="{{ asset('assetss/imgs/mobile-app/applications/8.png') }}" class="app-icm" alt="Voicebot">
                        </div>
                        <div class="col-xl-10 col-12">
                            <h3 class="app-text"> Delivery management Apps </h3>
                            <p class="mobile-view-04"> To automate shipping processes for grocery, food delivery, and e-commerce enterprises, we develop pickup and delivery management apps. </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-12 mobile-view-03">
                    <div class="row">
                        <div class="col-xl-2 col-12">
                            <img loading="lazy" src="{{ asset('assetss/imgs/mobile-app/applications/9.png') }}" class="app-icm" alt="Voicebot">
                        </div>
                        <div class="col-xl-10 col-12">
                            <h3 class="app-text">News Apps </h3>
                            <p class="mobile-view-04"> We provide user-friendly news applications that enable consumers to catch up on the most recent news whenever and wherever they are. </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-12 mobile-view-03">
                    <div class="row">
                        <div class="col-xl-2 col-12">
                            <img loading="lazy" src="{{ asset('assetss/imgs/mobile-app/applications/10.png') }}" class="app-icm" alt="Voicebot">
                        </div>
                        <div class="col-xl-10 col-12">
                            <h3 class="app-text">Travel Booking App </h3>
                            <p class="mobile-view-04"> Develop on-demand taxi booking applications with necessary features like push notifications, different payment methods, and real-time tracking. </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-12 mobile-view-03">
                    <div class="row">
                        <div class="col-xl-2 col-12">
                            <img loading="lazy" src="{{ asset('assetss/imgs/mobile-app/applications/11.png') }}" class="app-icm" alt="Voicebot">
                        </div>
                        <div class="col-xl-10 col-12">
                            <h3 class="app-text">Finance Apps </h3>
                            <p class="mobile-view-04"> For each business need, we create perfect banking, personal loan, stock trading, expense monitoring, and other finance applications. </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-12 mobile-view-03">
                    <div class="row">
                        <div class="col-xl-2 col-12">
                            <img loading="lazy" src="{{ asset('assetss/imgs/mobile-app/applications/12.png') }}" class="app-icm" alt="Voicebot">
                        </div>
                        <div class="col-xl-10 col-12">
                            <h3 class="app-text"> Lifestyle Apps</h3>
                            <p class="mobile-view-04"> Engage with Wintech to build any lifestyle mobile apps, including those for productivity, health, wellness, fashion, food, and travel. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        @media (max-width:767px) {
            .testimonial4_slide {
                width: auto !important;
            }
        }

        .heading {
            text-align: center;
            font-family: 'oswald';
            color: #454343;
            font-size: 30px;
            font-weight: 700;
            position: relative;
            margin-bottom: 40px;
            text-transform: capitalize;
        }

        .white-heading {
            color: #ffffff;
        }

        .heading:after {
            content: ' ';
            position: absolute;
            top: 100%;
            left: 50%;
            height: 40px;
            width: 180px;
            border-radius: 4px;
            transform: translateX(-50%);
            background: url(img/heading-line.png);
            background-repeat: no-repeat;
            background-position: center;
        }

        .white-heading:after {
            /*background: url(../images/mobile-app-development/testimonials/bg.webp);*/
            background-repeat: no-repeat;
            background-position: center;
        }

        .heading span {
            font-size: 18px;
            display: block;
            font-weight: 500;
        }

        .white-heading span {
            color: #ffffff;
        }

        .testimonial:after {
            position: absolute;
            top: -0 !important;
            left: 0;
            content: " ";
            background: url(img/testimonial.bg-top.png);
            background-size: 100% 100px;
            width: 100%;
            height: 100px;
            float: left;
            z-index: 99;
        }

        .testimonial {
            min-height: 375px;
            position: relative;
            /*background-image: url(../images/mobile-app-development/testimonials/bg.webp);*/
            padding-top: 50px;
            padding-bottom: 0px;
            background-position: center;
            background-size: cover;
        }

        #testimonial4 .carousel-inner:hover {
            cursor: -moz-grab;
            cursor: -webkit-grab;
        }

        #testimonial4 .carousel-inner:active {
            cursor: -moz-grabbing;
            cursor: -webkit-grabbing;
        }

        #testimonial4 .carousel-inner .item {
            overflow: hidden;
        }

        .testimonial4_indicators .carousel-indicators {
            left: 0;
            margin: 0;
            width: 100%;
            font-size: 0;
            height: 20px;
            bottom: 15px;
            padding: 0 5px;
            cursor: e-resize;
            overflow-x: auto;
            overflow-y: hidden;
            position: absolute;
            text-align: center;
            white-space: nowrap;
        }

        .testimonial4_indicators .carousel-indicators li {
            padding: 0;
            width: 14px;
            height: 14px;
            border: none;
            text-indent: 0;
            margin: 2px 3px;
            cursor: pointer;
            display: inline-block;
            background: #ffffff;
            -webkit-border-radius: 100%;
            border-radius: 100%;
        }

        .testimonial4_indicators .carousel-indicators .active {
            padding: 0;
            width: 14px;
            height: 14px;
            border: none;
            margin: 2px 3px;
            background-color: #9dd3af;
            -webkit-border-radius: 100%;
            border-radius: 100%;
        }

        .testimonial4_indicators .carousel-indicators::-webkit-scrollbar {
            height: 3px;
        }

        .testimonial4_indicators .carousel-indicators::-webkit-scrollbar-thumb {
            background: #eeeeee;
            -webkit-border-radius: 0;
            border-radius: 0;
        }

        .testimonial4_control_button .carousel-control {
            top: 175px;
            opacity: 1;
            width: 40px;
            bottom: auto;
            height: 40px;
            font-size: 10px;
            cursor: pointer;
            font-weight: 700;
            overflow: hidden;
            line-height: 38px;
            text-shadow: none;
            text-align: center;
            position: absolute;
            background: transparent;
            border: 2px solid #ffffff;
            text-transform: uppercase;
            -webkit-border-radius: 100%;
            border-radius: 100%;
            -webkit-box-shadow: none;
            box-shadow: none;
            -webkit-transition: all 0.6s cubic-bezier(0.3, 1, 0, 1);
            transition: all 0.6s cubic-bezier(0.3, 1, 0, 1);
        }

        .testimonial4_control_button .carousel-control.left {
            left: 7%;
            top: 50%;
            right: auto;
        }

        .testimonial4_control_button .carousel-control.right {
            right: 7%;
            top: 50%;
            left: auto;
        }

        .testimonial4_control_button .carousel-control.left:hover,
        .testimonial4_control_button .carousel-control.right:hover {
            color: #000;
            background: #fff;
            border: 2px solid #fff;
        }

        .testimonial4_header {
            top: 0;
            left: 0;
            bottom: 0;
            width: 550px;
            display: block;
            margin: 30px auto;
            text-align: center;
            position: relative;
        }

        .testimonial4_header h4 {
            color: #ffffff;
            font-size: 30px;
            font-weight: 600;
            position: relative;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .testimonial4_slide {
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 70%;
            margin: auto;
            padding: 20px;
            position: relative;
            text-align: center;
        }

        .testimonial4_slide img {
            top: 0;
            left: 0;
            right: 0;
            width: 136px;
            height: 136px;
            margin: auto;
            display: block;
            color: #f2f2f2;
            font-size: 18px;
            line-height: 46px;
            text-align: center;
            position: relative;
            border-radius: 50%;
            box-shadow: -6px 6px 6px rgba(0, 0, 0, 0.23);
            -moz-box-shadow: -6px 6px 6px rgba(0, 0, 0, 0.23);
            -o-box-shadow: -6px 6px 6px rgba(0, 0, 0, 0.23);
            -webkit-box-shadow: -6px 6px 6px rgba(0, 0, 0, 0.23);
        }

        .testimonial4_slide p {
            color: #ffffff;
            font-size: 20px;
            line-height: 1.4;
            margin: 10px 0 10px 0;
        }

        .testimonial4_slide h4 {
            color: #ed1b24;
            font-size: 22px;
        }

        .testimonial .carousel {
            padding-bottom: 50px;
        }

        .testimonial .carousel-control-next-icon,
        .testimonial .carousel-control-prev-icon {
            width: 35px;
            height: 35px;
        }
    </style>

    <!--<section class="why-content-marketing-services">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col-xl-6 col-md-6 col-12 mb-4">-->
    <!--                <figure class="marketing-box" data-aos="zoom-in">-->
    <!--                    <img loading="lazy" src="{{ asset('assetss/images/mobile-app-development/client-accounts-img.png') }}" alt="Smart Salez">-->
    <!--                    <figcaption class="card clients">-->
    <!--                        <h3 class="">Clients, we serve</h3>-->
    <!--                        <p class="">We serve companies of all sizes from all key industries, as well as individuals and early-stage startups with on-time delivery and within-budget apps.</p>-->
    <!--                        <p> <i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Startups </p>-->
    <!--                        <p> <i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Small businesses </p>-->
    <!--                        <p> <i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Enterprises </p>-->
    <!--                        <p> <i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Non-profits </p>-->
    <!--                        <p> <i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Governments </p>-->
    <!--                        <p> <i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Solopreneurs </p>-->
    <!--                    </figcaption>-->
    <!--                </figure>-->
    <!--            </div>-->
    <!--            <div class="col-xl-6 col-md-6 col-12 mb-4">-->
    <!--                <figure class="marketing-box" data-aos="zoom-in">-->
    <!--                    <img loading="lazy" src="{{ asset('assetss/images/mobile-app-development/approach-img.png') }}" alt="Smart Salez">-->
    <!--                    <figcaption class="card clients">-->
    <!--                        <h3 class="">Our Approach</h3>-->
    <!--                        <p class="">Our app development process includes information collecting, brainstorming, UX/UI designing, prototyping, quality testing, and launching from the beginning to the end.</p>-->
    <!--                        <p> <i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Understanding client requirements & setting goals </p>-->
    <!--                        <p> <i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Market research and idea generation </p>-->
    <!--                        <p> <i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> UX design and prototyping </p>-->
    <!--                        <p> <i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Deployment, Testing, Coding, and Review </p>-->
    <!--                        <p> <i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Launching and promotion </p>-->
    <!--                        <p> <i class="fa fa-check-circle-o text-danger" aria-hidden="true"></i> Maintenance & updating </p>-->
    <!--                    </figcaption>-->
    <!--                </figure>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <section id="hero1" class="hero our_service_section">
        <div class="inner">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-12">
                        <div class="choose-heading-style" data-aos="zoom-in">
                            <h5 class="text-danger">Why Choose Wintech</h5>
                            <h2 class="text-white mt-3">Our data-driven methodology <br> enables you to conquer your industry </h2>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-12 col-12">
                        <div class="overlays">
                            <div class="row">
                                <div class="col-xl-2 col-md-6 col-6 mt-4 d-flex align-content-stretch">
                                    <div class="futuristic-box development-box" data-aos="zoom-in">
                                        <figure>
                                            <img loading="lazy" src="{{ asset('assetss/images/e-commerce-development/icons/platform-icons/team.png') }}" alt="" style="height: 60px !important;">
                                            <figcaption class=" ">
                                                <h6 class="text-white text-left mt-3">Highly <br> experienced team</h6>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-6 col-6 mt-4 d-flex align-content-stretch">
                                    <div class="futuristic-box development-box" data-aos="zoom-in">
                                        <figure>
                                            <img loading="lazy" src="{{ asset('assetss/img/transparenc.png') }}" alt="">
                                            <figcaption class=" ">
                                                <h6 class="text-white text-left mt-3">Full <br> transparency</h6>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-6 col-6 mt-4 d-flex align-content-stretch">
                                    <div class="futuristic-box development-box" data-aos="zoom-in">
                                        <figure>
                                            <img loading="lazy" src="{{ asset('assetss/img/satisfaction.png') }}" alt="">
                                            <figcaption class=" ">
                                                <h6 class="text-white text-left mt-3">100% Client <br> satisfaction</h6>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-6 col-6 mt-4 d-flex align-content-stretch">
                                    <div class="futuristic-box development-box" data-aos="zoom-in">
                                        <figure>
                                            <img loading="lazy" src="{{ asset('assetss/img/support.png') }}" alt="">
                                            <figcaption class=" ">
                                                <h6 class="text-white text-left mt-3">24/7 Friendly <br> Customer Support</h6>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-6 col-6 mt-4 d-flex align-content-stretch">
                                    <div class="futuristic-box development-box" data-aos="zoom-in">
                                        <figure>
                                            <img loading="lazy" src="{{ asset('assetss/img/agreement.png') }}" alt="">
                                            <figcaption class=" ">
                                                <h6 class="text-white text-left mt-3">Non-disclosure <br> agreement</h6>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-6 col-6 mt-4 d-flex align-content-stretch">
                                    <div class="futuristic-box development-box" data-aos="zoom-in">
                                        <figure>
                                            <img loading="lazy" src="{{ asset('assetss/img/reliable.png') }}" alt="">
                                            <figcaption class=" ">
                                                <h6 class="text-white text-left mt-3">Reliable & <br> affordable solution</h6>
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
    </section>
    <section class="frequently-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-md-12 col-12" data-aos="fade-up">
                    <div class="frequently-img">
                        <img loading="lazy" src="{{ asset('assetss/images/mobile-app-development/mad-frequently-img.png') }}" alt="Smart Salez">
                    </div>
                </div>
                <div class="col-xl-7 col-md-12 col-12" data-aos="fade-up">
                    <div class="questions-heading">
                        <h2 class="text-left">Frequently Asked <span class="text-danger">Questions</span></h2>
                    </div>
                    <div class="accordion mt-4" id="accordionExample">
                        <div class="accordion-item">
                            <h6 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    What is the importance of a mobile app?
                                </button>
                            </h6>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>80% of people worldwide use a mobile app for their needs. It has simple functionality and provides business services instantly, quickening your company's growth to new heights.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Can I update and customize my Mobile app?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Yes, you can modify your iOS or Android mobile app in accordance with the needs of your business. If necessary, we will additionally upgrade the mobile app development.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    What are the types of mobile apps you develop?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>We create mobile apps for both Android and iOS based on customer specifications and customizations.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                                    How much does it cost to build a mobile app?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p> The cost will vary depending on the project's requirements such as functionality, features, backend process, and platforms chosen by the customer. </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                                    Will you offer app maintenance service after the sale?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>We provide essential after-sales service to our loyal customers in order to ensure that they have a trouble-free experience while using the mobile app and expanding their business.</p>
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

