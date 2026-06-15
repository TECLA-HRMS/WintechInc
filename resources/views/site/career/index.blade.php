@extends('layouts.site')
@section('content')

<div class="rts-breadcrumb-area breadcrumb-bg bg_image">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 breadcrumb-1">
                    <h1 class="title">Career</h1>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="bread-tag">
                        <a href="{{ url('/') }}">Home</a>
                        <span> / </span>
                        <a href="#" class="active">Career</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->
 <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        section {
            background-color: #ffffff;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
        }
        h2 {
            text-align: center;
            color: #333333;
        }
        iframe {
            width: 100%;
            height: 600px;
            border: none;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<section>
    <h2>Active Job Listings</h2>
    <iframe src="https://wintechinc.vybog.com/ajax/active-jobs?code=$2y$10$a9t2Nl2L.EoFrUp36rv/2.iAhiEBhyZwoXcfirMWMQ1IOQMEbHQUG"></iframe>
</section>
<!-- progress Back to top End -->
<!-- scripts start form hear -->

@endsection
