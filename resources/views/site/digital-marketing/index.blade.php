@extends('layouts.site')
@section('content')
    <link rel="stylesheet" href="{{ asset('assetss/css/style.css') }}">

<main id="main">
    <link href="{{ asset('Content/custom.min.css') }}" rel="stylesheet">
    <section class="first-section"></section>
    <section class="about-us-banner">
        <div class="container">
            <div class="row" data-aos="fade-up">
                <div class="col-lg-6 col-12">
                    <div class="hero-heading-style mt-60">
                        <h1> Digital Marketing Service in India </h1>
                        <p class="text-light" style="margin-top: 30px;"> Wintech is the best digital marketing company in India. They assist clients to achieve their goals for business growth by providing them with enthusiastic, creative, and diverse digital marketing services. </p>
                        <a href="{{ url('contact') }}" ><button type="button" class="thm-btn btn-primary reach-style pulse1" style="margin-top: 35px;width: 50%;">Contact Us </button></a>
                    </div>
                </div>
                <div class="col-lg-1 col-12"> </div>
              
            </div>
        </div>
    </section>
    <section class="our-services-process product-sec our_service_section">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="section-title">
                    <h4 class="text-danger text-center">Our Digital Marketing Services</h4>
                </div>
                <div class="col-xl-4 col-md-4 col-12 mb-4 text-center" data-aos="fade-up">
                    <div class="box-shadow-product">
                        <a href="#">
                            <div class="">
                                <img src="{{ asset('assetss/imgs/dm/01.png') }}" alt="Voicebot" class="text-center img-fluid">
                            </div>
                            <h3 class="voicebot-style mt-3 mb-3">Search Engine Optimization </h3>
                            <p> We conduct in-depth keyword research, on-page SEO, and off-page SEO for your business to get a top-ranking position in the search engine and generate high-quality leads to boost your business. </p>
                            
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 col-12 mb-4 text-center" data-aos="fade-up">
                    <div class="box-shadow-product">
                        <a href="#">
                            <div class="">
                                <img src="{{ asset('assetss/imgs/dm/02.png') }}" alt="Voicebot" class="text-center img-fluid">
                            </div>
                            <h3 class="voicebot-style mt-3 mb-3">Search Engine Marketing</h3>
                            <p> We offer SEM and PPC marketing solution services and work to drive the right amount of quick and targeted traffic to your website, which raises your brand awareness. </p>
                            
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 col-12 mb-4 text-center" data-aos="fade-up">
                    <div class="box-shadow-product">
                        <a href="#">
                            <div class="">
                                <img src="{{ asset('assetss/imgs/dm/03.png') }}" alt="Voicebot" class="text-center img-fluid">
                            </div>
                            <h3 class="voicebot-style mt-3 mb-3">Social Media Marketing</h3>
                            <p> With the aid of our service, you can witness a boost in consumer engagement, which drives business expansion and increases sales owing to a unique brand identity. </p>
                            
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 col-12 mb-4 text-center" data-aos="fade-up">
                    <div class="box-shadow-product">
                        <a href="#">
                            <div class="">
                                <img src="{{ asset('assetss/imgs/dm/04.png') }}" alt="Voicebot" class="text-center img-fluid">
                            </div>
                            <h3 class="voicebot-style mt-3 mb-3">E-Mail Marketing</h3>
                            <p> Our email marketing services can be utilized to build marketing campaigns to promote your business or its products to increase sales. </p>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 col-12 mb-4 text-center" data-aos="fade-up">
                    <div class="box-shadow-product">
                        <a href="#">
                            <div class="">
                                <img src="{{ asset('assetss/imgs/dm/05.png') }}" alt="Voicebot" class="text-center img-fluid">
                            </div>
                            <h3 class="voicebot-style mt-3 mb-3">Content Marketing</h3>
                            <p> We create focused content to promote your company's online brand recognition and support a consistent rise in site traffic, revenue, and conversions. </p>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 col-12 mb-4 text-center" data-aos="fade-up">
                    <div class="box-shadow-product">
                        <a href="#">
                            <div class="">
                                <img src="{{ asset('assetss/imgs/dm/06.png') }}" alt="Voicebot" class="text-center img-fluid">
                            </div>
                            <h3 class="voicebot-style mt-3 mb-3">Performance Marketing </h3>
                            <p> Our performance marketing solution is a result-driven process and the customers can pay when they see measurable outcomes. </p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8 text-center">
                    <!--<a href="{{ url('contact') }}"> <button type="button" class="btn btn-primary mt-3 reach-style w-20 pulse1">Let's Talk </button>&nbsp;&nbsp; </a>-->
                   <a href="{{ url('contact') }}" ><button type="button" class="thm-btn btn-primary reach-style pulse1" style="margin-top: 35px;width: 40%;" >Let's Talk </button></a>

                </div>
                <div class="col-md-4"> </div>
            </div>
        </div>
    </section>
    <section id="hero1" class="hero our_service_section">
        <div class="inner">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-12">
                        <div class="choose-heading-style" data-aos="zoom-in">
                            <h5 class="text-danger"> We Accomplish your Marketing Goals </h5>
                            <h2 class="text-white mt-3">Our data-driven methodology <br> enables you to conquer your industry </h2> <br>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-12 col-12">
                        <div class="">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-2"> </div>
                                        <div class="col-xl-2 col-md-6 col-6 mt-4 d-flex align-content-stretch">
                                            <div class="futuristic-box development-box" data-aos="zoom-in">
                                                <figure>
                                                    <img src="{{ asset('assetss/imgs/goals/icons/1.png') }}" alt="">
                                                    <figcaption class=" ">
                                                        <h6 class="marketing-text mt-3"> Lead <br> Generation </h6>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-6 col-6 mt-4 d-flex align-content-stretch">
                                            <div class="futuristic-box development-box" data-aos="zoom-in">
                                                <figure>
                                                    <img src="{{ asset('assetss/imgs/goals/icons/2.png') }}" alt="">
                                                    <figcaption class=" ">
                                                        <h6 class="marketing-text mt-3"> Brand <br> Awareness </h6>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-6 col-6 mt-4 d-flex align-content-stretch">
                                            <div class="futuristic-box development-box" data-aos="zoom-in">
                                                <figure>
                                                    <img src="{{ asset('assetss/imgs/goals/icons/3.png') }}" alt="">
                                                    <figcaption class=" ">
                                                        <h6 class="marketing-text mt-3"> Higher <br> Returns </h6>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-6 col-6 mt-4 d-flex align-content-stretch">
                                            <div class="futuristic-box development-box" data-aos="zoom-in">
                                                <figure>
                                                    <img src="{{ asset('assetss/imgs/goals/icons/4.png') }}" alt="">
                                                    <figcaption class=" ">
                                                        <h6 class="marketing-text mt-3"> Increased <br> Sales </h6>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="col-md-1"> </div>
                                        <div class="col-md-2"> </div>
                                        <div class="col-xl-2 col-md-6 col-6 mt-4 d-flex align-content-stretch">
                                            <div class="futuristic-box development-box" data-aos="zoom-in">
                                                <figure>
                                                    <img src="{{ asset('assetss/imgs/goals/icons/5.png') }}" alt="">
                                                    <figcaption class=" ">
                                                        <h6 class="marketing-text mt-3"> Brand <br> Engagement </h6>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-6 col-6 mt-4 d-flex align-content-stretch">
                                            <div class="futuristic-box development-box" data-aos="zoom-in">
                                                <figure>
                                                    <img src="{{ asset('assetss/imgs/goals/icons/6.png') }}" alt="">
                                                    <figcaption class=" ">
                                                        <h6 class="marketing-text mt-3"> Customer <br> Acquisition </h6>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-6 col-6 mt-4 d-flex align-content-stretch">
                                            <div class="futuristic-box development-box" data-aos="zoom-in">
                                                <figure>
                                                    <img src="{{ asset('assetss/imgs/goals/icons/7.png') }}" alt="">
                                                    <figcaption class=" ">
                                                        <h6 class="marketing-text mt-3"> Higher <br> Traffic </h6>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-6 col-6 mt-4 d-flex align-content-stretch">
                                            <div class="futuristic-box development-box" data-aos="zoom-in">
                                                <figure>
                                                    <img src="{{ asset('assetss/imgs/goals/icons/8.png') }}" alt="">
                                                    <figcaption class=" ">
                                                        <h6 class="marketing-text mt-3"> Brand Trust & <br> Recognition </h6>
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
                    <p class="c_align">How It Works</p>
                    <h5 class="text-danger">Our Digital Marketing Process</h5>
                </div>
            </div>
        </div>
        <!--<img src="{{ asset('assetss/images/web-development/technology/10.png') }}" class="cta-one__bg-shape-1" alt="">-->
        <div class="row">
            <div class="col-lg-12">
                <ul class="timeline">
                    <li>
                        <img class="our-process" src="{{ asset('assetss/imgs/process/01.png') }}" alt="Research">
                        <div class="direction-r">
                            <div class="flag-wrapper">
                                <span class="flag">Research</span>
                            </div>
                            <div class="desc">To drive your business growth, we conduct comprehensive research on your product, target audience, and competitors. This enables us to craft a marketing strategy that positions you ahead of the competition.</div>
                        </div>
                    </li>
                    <li>
                        <img class="our-process1" src="{{ asset('assetss/imgs/process/02.png') }}" alt="Create">
                        <div class="direction-l">
                            <div class="flag-wrapper">
                                <span class="flag">Create</span>
                            </div>
                            <div class="desc l_side_timeline">After gathering insights from the research phase, we implement marketing strategies designed to meet your business goals effectively and build a strong online presence.</div>
                        </div>
                    </li>
                    <li>
                        <img class="our-process" src="{{ asset('assetss/imgs/process/03.png') }}" alt="Promote">
                        <div class="direction-r">
                            <div class="flag-wrapper">
                                <span class="flag">Promote</span>
                            </div>
                            <div class="desc">With research completed and marketing objectives set, we launch targeted online campaigns to attract the right customers and outperform your competition.</div>
                        </div>
                    </li>
                    <li>
                        <img class="our-process1" src="{{ asset('assetss/imgs/process/04.png') }}" alt="Analyze">
                        <div class="direction-l">
                            <div class="flag-wrapper">
                                <span class="flag">Analyze</span>
                            </div>
                            <div class="desc l_side_timeline">We continuously analyze and monitor the performance of your campaigns, optimizing underperforming ads to enhance overall campaign effectiveness.</div>
                        </div>
                    </li>
                    <li>
                        <img class="our-process" src="{{ asset('assetss/imgs/process/05.png') }}" alt="Optimize">
                        <div class="direction-r">
                            <div class="flag-wrapper">
                                <span class="flag">Optimize</span>
                            </div>
                            <div class="desc">We fine-tune your marketing efforts through testing and experimentation, identifying high-performing campaigns that maximize your return on investment.</div>
                        </div>
                    </li>
                </ul>
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
            border: 1px dashed rgb(192 187 187);
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
            border: 1px dashed rgb(192 187 187);
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
                font-size: 18px;
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

        .process-section-01 {
            background-color: #f2eeeecc;
        }
    </style>
    <section class="dm-our-services-process process-section-01">
        <div class="container" data-aos="fade-up">
            <div class="smartsalez process-section-02">
                <h1 class="text-center"> Why hire Wintech as your digital marketing agency </h1>
            </div>
            <div class="blocks-column col-lg-12 col-md-12 col-sm-12">
                <div class="inner-column">
                    <div class="row clearfix">
                        <div class="technology-block col-lg-3 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <a class="overlay-link"></a>
                                <div class="icon-box">
                                    <img src="{{ asset('assetss/imgs/hire/1.png') }}" class="content-img">
                                </div>
                                <h6>Full Transparency</h6>
                            </div>
                        </div>
                        <div class="technology-block col-lg-3 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <a class="overlay-link"></a>
                                <div class="icon-box">
                                    <img src="{{ asset('assetss/imgs/hire/2.png') }}" class="content-img">
                                </div>
                                <h6>Dedicated Account Manager</h6>
                            </div>
                        </div>
                        <div class="technology-block col-lg-3 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <a class="overlay-link"></a>
                                <div class="icon-box">
                                    <img src="{{ asset('assetss/imgs/hire/3.png') }}" class="content-img">
                                </div>
                                <h6>Highly Experienced Team</h6>
                            </div>
                        </div>
                        <div class="technology-block col-lg-3 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <a class="overlay-link"></a>
                                <div class="icon-box">
                                    <img src="{{ asset('assetss/imgs/hire/4.png') }}" class="content-img">
                                </div>
                                <h6>Regular Reporting</h6>
                            </div>
                        </div>
                        <div class="technology-block col-lg-3 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <a class="overlay-link"></a>
                                <div class="icon-box">
                                    <img src="{{ asset('assetss/imgs/hire/5.png') }}" class="content-img">
                                </div>
                                <h6>Customer Support</h6>
                            </div>
                        </div>
                        <div class="technology-block col-lg-3 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <a class="overlay-link"></a>
                                <div class="icon-box">
                                    <img src="{{ asset('assetss/imgs/hire/6.png') }}" class="content-img">
                                </div>
                                <h6>No Contracts</h6>
                            </div>
                        </div>
                        <div class="technology-block col-lg-3 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <a class="overlay-link"></a>
                                <div class="icon-box">
                                    <img src="{{ asset('assetss/imgs/hire/7.png') }}" class="content-img">
                                </div>
                                <h6>Safe & Reliable</h6>
                            </div>
                        </div>
                        <div class="technology-block col-lg-3 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <a class="overlay-link"></a>
                                <div class="icon-box">
                                    <img src="{{ asset('assetss/imgs/hire/8.png') }}" class="content-img">
                                </div>
                                <h6>Low cost & Affordable</h6>
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
                        <img src="assetss/images/digital-marketing/faq.webp" class="">
                    </div>
                </div>
                <div class="col-xl-7 col-md-12 col-12" data-aos="fade-up">
                    <div class="questions-heading">
                        <h2 class="text-left">Frequently Asked <br /><span class="text-danger">Questions</span></h2>
                    </div>
                    <div class="accordion mt-4" id="accordionExample">
                        <div class="accordion-item">
                            <h6 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    What is digital marketing?
                                </button>
                            </h6>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p> Digital marketing is also known as an online marketing service. The primary goal of a digital marketing service is to promote a brand or product to potential customers worldwide via the digital medium. </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Why is digital marketing Important for my business?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p> Digital marketing is crucial for all businesses since it boosts their online visibility on a global scale. It is an economical way to advertise your brand or company to a larger audience quickly and in a measurable way. </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    What are the benefits of digital marketing?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ul>
                                        <li> <i class="fa fa-check" aria-hidden="true"></i> Increases your brand reach</li>
                                        <li> <i class="fa fa-check" aria-hidden="true"></i> Global targeted audiences</li>
                                        <li> <i class="fa fa-check" aria-hidden="true"></i> Cost-effective method</li>
                                        <li> <i class="fa fa-check" aria-hidden="true"></i> Increases in conversion rate</li>
                                        <li> <i class="fa fa-check" aria-hidden="true"></i> Measurable result</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                                    How digital marketing helps my business?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p> Digital marketing services aid in promoting and engaging brands or products through marketing strategies to increase brand value and boost business through digital communication and stay ahead of the competition. </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                                    Do I need to sign a long-term contract?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p> Our digital marketing services are all performed on a monthly basis. You have complete freedom to discontinue our digital marketing services at any time you are not required with prior information. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--<section class="contact section-bg our_service_section" id="contact.php">-->
    <!--    <div class="container" data-aos="fade-up">-->
    <!--        

-->
    <!--    </div>-->
    <!--</section>-->
</main>

@endsection
