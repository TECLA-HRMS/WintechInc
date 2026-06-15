<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template" data-style="light"> 
{{-- Head --}}
@include('includes.admin.head')

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
        
        <!-- sidebar -->
        @include('includes.admin.sidebar')
        <!-- / sidebar -->

        <!-- Layout container -->
        <div class="layout-page">

            <!-- Navbar -->
            @include('includes.admin.header')
            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">

            @yield('adminContent')

            <!-- Footer -->
            @include('includes.admin.footer')
            <!-- / Footer -->

            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
        </div>
    </div>
    <!-- / Layout wrapper -->

  {{-- Scripts --}}
  @include('includes.admin.scripts')

</body>
</html>
