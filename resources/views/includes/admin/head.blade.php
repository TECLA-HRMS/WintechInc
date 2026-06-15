<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel</title>
        <!-- Favicon -->
        <link href="{{ asset(\App\Models\AdminSetting::get('site_favicon', 'frontend/images/fav.png')) }}" rel="icon">

    <!-- DNS Prefetch for external CDNs -->
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="//cdn.datatables.net">
    <link rel="dns-prefetch" href="//cdn.ckeditor.com">
    <link rel="dns-prefetch" href="//translate.google.com">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>

    <!-- Google Translate -->
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
            setTimeout(() => {
                const translateCombo = document.querySelector('.goog-te-combo');
                const pageLang = document.documentElement.lang || 'en';
                if (translateCombo) {
                    translateCombo.value = pageLang;
                    const event = new Event('change');
                    translateCombo.dispatchEvent(event);
                }
            }, 1000);
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/dashboard.css') }}" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.14.0/tabler-icons.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" href="{{asset('assets/admin/vendor/fonts/flag-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/vendor/libs/bootstrap/css/bootstrap-icons.css')}}">

    <!-- Fonts -->
    <link rel="stylesheet" href="{{asset('assets/admin/fonts/sans.css')}}">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/summernote/css/summernote.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/%40form-validation/form-validation.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/css/bootstrap-iconpicker.min.css">

    

    <style>
        .error { color: red; }
        /* Fix dropdown clipping caused by layout-page overflow constraints */
        .layout-page, .layout-wrapper, .layout-container, .content-wrapper { overflow: visible !important; }
        #layout-navbar { overflow: visible !important; }
    </style>
</head>

