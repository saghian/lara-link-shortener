<!DOCTYPE html>
<html lang="fa" class="light-style layout-navbar-fixed layout-menu-fixed" dir="rtl" data-theme="theme-default"
    data-assets-path="/panel/" data-template="vertical-menu-template-starter">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>@yield('title')</title>

    <meta name="description" content="">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/panel/img/favicon/favicon.ico') }}">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('/panel/vendor/fonts/boxicons.css') }}">
    <!-- <link rel="stylesheet" href="../../assets/vendor/fonts/fontawesome.css" /> -->
    <!-- <link rel="stylesheet" href="../../assets/vendor/fonts/flag-icons.css" /> -->

    <!-- Core CSS -->
    <link rel="stylesheet" href="/panel/vendor/css/rtl/core.css" class="template-customizer-core-css">
    <link rel="stylesheet" href="/panel/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css">

    {{-- <link rel="stylesheet" href="{{ asset('/panel/vendor/css/rtl/core.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('/panel/vendor/css/rtl/theme-default.css') }}" "> --}}
    <link rel="stylesheet" href="{{ asset('/panel/css/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('/panel/vendor/css/rtl/rtl.css') }}">

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('/panel/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('/panel/vendor/libs/typeahead-js/typeahead.css') }}">
    <link rel="stylesheet" href="{{ asset('/panel/vendor/libs/flatpickr/flatpickr.css') }}">
    <link rel="stylesheet" href="{{ asset('/panel/vendor/libs/select2/select2.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('/panel/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('/panel/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('/panel/vendor/libs/jquery-timepicker/jquery-timepicker.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('/panel/vendor/libs/pickr/pickr-themes.css') }}"> --}}

    <!-- Page CSS Libs -->
    @yield('css-libs')


    @yield('style')
    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('/panel/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('/panel/vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('/panel/js/config.js') }}"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('panel.sections.sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @include('panel.sections.navbar')

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    @include('panel.layouts.footer')
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('/panel/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/panel/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/panel/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/panel/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('/panel/vendor/libs/hammer/hammer.js') }}"></script>

    {{-- <script src="{{ asset('/panel/vendor/libs/i18n/i18n.js') }}"></script> --}}
    <script src="{{ asset('/panel/vendor/libs/typeahead-js/typeahead.js') }}"></script>

    <script src="{{ asset('/panel/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('/panel/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('/panel/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('/panel/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('/panel/vendor/libs/jdate/jdate.js') }}"></script>
    <script src="{{ asset('/panel/vendor/libs/flatpickr/flatpickr-jdate.js') }}"></script>
    <script src="{{ asset('/panel/vendor/libs/flatpickr/l10n/fa-jdate.js') }}"></script>
    <script src="{{ asset('/panel/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('/panel/vendor/libs/select2/i18n/fa.js') }}"></script>

    @yield('js-libs')

    <!-- Main JS -->
    <script src="{{ asset('/panel/js/main.js') }}"></script>
    <script>
        // Select2 
        var select2 = $('.select2');
        if (select2.length) {
            select2.each(function() {
                var $this = $(this);
                $this.wrap('<div class="position-relative"></div>').select2({
                    placeholder: 'انتخاب',
                    dropdownParent: $this.parent()
                });
            });
        }
    </script>
    <script>
        @yield('script')
    </script>

</body>

</html>
