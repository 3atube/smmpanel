<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{{url('/')}}" />
    @include('frontend.layouts.seo')
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="/assets/client/1/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="/assets/client/1/plugins/global/plugins.dark.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/client/1/css/style.dark.bundle.css" rel="stylesheet" type="text/css" />
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-0Z9F9S1856"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-0Z9F9S1856');
</script>
    <style>
        td:not(.wrap) {
            white-space: nowrap
        }

        .social-service {
            color: #fff;
            font-size: 20px;
            font-weight: bold;
            font-style: italic;
        }

        .language-html {
            margin: 0
        }

        .tr-hidden {
            visibility: collapse
        }

        .dataTables_wrapper>.row {
            padding: 0 2.25rem !important
        }

    </style>
    </style>
    <script type="text/javascript">
        var TIME_ZONE = 0,
            NEWS = 1;
    </script>
    <!--end::Global Stylesheets Bundle-->
</head>
<body class="dark-mode">
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Aside-->
            <div id="kt_aside" class="aside pt-7 pb-4 pb-lg-7 pt-lg-17" data-kt-drawer="true" data-kt-drawer-name="aside"
                data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
                data-kt-drawer-toggle="#kt_aside_toggle">
                <!--begin::Brand-->
                <div class="aside-logo flex-column-auto px-9 mb-9 mb-lg-17 mx-auto" id="kt_aside_logo">
                    <!--begin::Logo-->
                    <a href="/" class="social-service">
                    toolv3.com
                    </a>
                    <!--end::Logo-->
                </div>
                <!--end::Brand-->

                <!--end::Aside user-->
                <!--begin::Aside menu-->
                <div class="menu menu-column menu-rounded fw-bold" data-kt-menu="true">
                <div class="menu-item show">
                        <a class="menu-link" href="/order">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black"></path>
                                        <path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z"
                                            fill="black"></path>
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">Order</span>
                        </a>
                    </div>
                    <div class="menu-item show">
                        <a class="menu-link" href="/list-api">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black"></path>
                                        <path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z"
                                            fill="black"></path>
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">API</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="/services">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black"></path>
                                        <path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z"
                                            fill="black"></path>
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">Services</span>
                        </a>
                    </div>
                </div>
                <!--end::Aside menu-->
                <!--begin::Footer-->
                <div class="aside-footer flex-column-auto px-6 px-lg-9" id="kt_aside_footer">
                    <!--begin::User panel-->
                    <div class="d-flex flex-stack ms-7">

                        <!--begin::Link-->

                        <!--end::Link-->
                        <!--begin::User menu-->
                        <div class="ms-1">

                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                                data-kt-menu="true" style="">
                                <!--begin::Menu item-->
                                <div class="menu-item px-2">
                                    <div class="menu-content">
                                        <label class="form-check form-switch form-check-custom form-check-solid"
                                            for="kt_user_menu_dark_mode_toggle">
                                            <input class="form-check-input w-30px h-20px cb-change-theme"
                                                type="checkbox" checked
                                                onclick="app._on.change.changeTheme(this.checked)">
                                            <span class="form-check-label text-gray-600 fs-7">Dark Mode</span>
                                        </label>
                                    </div>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu separator-->
                                <div class="separator my-2"></div>
                                <!--end::Menu separator-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-5">
                                    <div id="google_translate_element"></div>
                                </div>
                                <!--end::Menu item-->
                            </div>
                        </div>
                        <!--end::User menu-->
                    </div>
                    <!--end::User panel-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
    <!--begin::Header-->
    <div id="kt_header" class="header">
        <!--begin::Container-->
        <div class="container-fluid d-flex align-items-center flex-wrap justify-content-between" id="kt_header_container">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-2 pb-5 pb-lg-0 pt-7 pt-lg-0" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
                <!--begin::Heading-->
                <!--end::Heading-->
            </div>
            <!--end::Page title=-->
            <!--begin::Wrapper-->
            <div class="d-flex d-lg-none align-items-center ms-n3 me-2">
                <!--begin::Aside mobile toggle-->
                <div class="btn btn-icon btn-active-icon-primary" id="kt_aside_toggle">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                    <span class="svg-icon svg-icon-1 mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black"></path>
                            <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Aside mobile toggle-->
                <!--begin::Logo-->
                <a href="/" class="d-flex align-items-center ms-2">
                    <img alt="Logo" src="/assets/images/logo-tool.png?1649908796" class="h-25px">
                </a>
                <!--end::Logo-->
            </div>
        </div>
        <!--end::Container-->
    </div>