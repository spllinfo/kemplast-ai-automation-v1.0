<!DOCTYPE html>

{{-- <html lang="en" loader="disable" data-page-style="regular" data-menu-styles="dark" data-bg-img="bgimg2" data-nav-layout="vertical"  data-header-styles="light" data-theme-mode="light" data-toggled="" style="--primary-rgb: 63, 75, 236;" > --}}
<html lang="en"
      loader="disable"
      data-page-style="regular"
      data-menu-styles="color"
      data-nav-layout="vertical"
      data-header-styles="transparent"
      data-theme-mode="light"
      dir="ltr"
      data-width="fullwidth"
      data-bg-img="bgimg2"
      style="--primary-rgb: 63, 75, 236;">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <meta name="csrf-token"
          content="{{ csrf_token() }}">
    <meta name="_token"
          content="{{ csrf_token() }}">

  <!-- include jQuery once globally -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Choices JS -->
    <script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.20/dist/sweetalert2.min.css"
          rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Main Theme Js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Bootstrap Css -->
    <link id="style"
          href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}"
          rel="stylesheet">

    <!-- Style Css -->
    <link href="{{ asset('assets/css/styles.css') }}"
          rel="stylesheet">

    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.css') }}"
          rel="stylesheet">

    <!-- Node Waves Css -->
    <link href="{{ asset('assets/libs/node-waves/waves.min.css') }}"
          rel="stylesheet">

    <!-- Simplebar Css -->
    <link href="{{ asset('assets/libs/simplebar/simplebar.min.css') }}"
          rel="stylesheet">

    <!-- Color Picker Css -->
    <link rel="stylesheet"
          href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('assets/libs/@simonwep/pickr/themes/nano.min.css') }}">

    <!-- Choices Css -->
    <link rel="stylesheet"
          href="{{ asset('assets/libs/choices.js/public/assets/styles/choices.min.css') }}">

    <!-- Auto Complete CSS -->
    <link rel="stylesheet"
          href="{{ asset('assets/libs/@tarekraafat/autocomplete.js/css/autoComplete.css') }}">

    <!-- Quill Editor CSS -->
    <link rel="stylesheet"
          href="{{ asset('assets/libs/quill/quill.snow.css') }}">
    <link rel="stylesheet"
          href="{{ asset('assets/libs/quill/quill.bubble.css') }}">

    <!-- Filepond CSS -->
    <link rel="stylesheet"
          href="{{ asset('assets/libs/filepond/filepond.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('assets/libs/filepond-plugin-image-edit/filepond-plugin-image-edit.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
          rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>




    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css"
          rel="stylesheet">

</head>

<body>

    <!-- Start Switcher -->
    <div class="offcanvas offcanvas-end"
         tabindex="-1"
         id="switcher-canvas"
         aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header border-bottom d-block p-0">
            <div class="d-flex align-items-center justify-content-between p-3">
                <h5 class="offcanvas-title text-default"
                    id="offcanvasRightLabel">Switcher</h5>
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
            </div>
            <nav class="border-top border-block-start-dashed">
                <div class="nav nav-tabs nav-justified"
                     id="switcher-main-tab"
                     role="tablist">
                    <button class="nav-link active"
                            id="switcher-home-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#switcher-home"
                            type="button"
                            role="tab"
                            aria-controls="switcher-home"
                            aria-selected="true">Theme Styles</button>
                    <button class="nav-link"
                            id="switcher-profile-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#switcher-profile"
                            type="button"
                            role="tab"
                            aria-controls="switcher-profile"
                            aria-selected="false">Theme Colors</button>
                </div>
            </nav>
        </div>
        <div class="offcanvas-body">
            <div class="tab-content"
                 id="nav-tabContent">
                <div class="tab-pane fade show active border-0"
                     id="switcher-home"
                     role="tabpanel"
                     aria-labelledby="switcher-home-tab"
                     tabindex="0">
                    <div class="">
                        <p class="switcher-style-head">Theme Color Mode:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-light-theme">
                                        Light
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="theme-style"
                                           id="switcher-light-theme"
                                           checked>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-dark-theme">
                                        Dark
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="theme-style"
                                           id="switcher-dark-theme">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Directions:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-ltr">
                                        LTR
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="direction"
                                           id="switcher-ltr"
                                           checked>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-rtl">
                                        RTL
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="direction"
                                           id="switcher-rtl">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Navigation Styles:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-vertical">
                                        Vertical
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="navigation-style"
                                           id="switcher-vertical"
                                           checked>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-horizontal">
                                        Horizontal
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="navigation-style"
                                           id="switcher-horizontal">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="navigation-menu-styles">
                        <p class="switcher-style-head">Vertical & Horizontal Menu Styles:</p>
                        <div class="row switcher-style gx-0 gy-2 pb-2">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-menu-click">
                                        Menu Click
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="navigation-menu-styles"
                                           id="switcher-menu-click">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-menu-hover">
                                        Menu Hover
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="navigation-menu-styles"
                                           id="switcher-menu-hover">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-icon-click">
                                        Icon Click
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="navigation-menu-styles"
                                           id="switcher-icon-click">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-icon-hover">
                                        Icon Hover
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="navigation-menu-styles"
                                           id="switcher-icon-hover">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidemenu-layout-styles">
                        <p class="switcher-style-head">Sidemenu Layout Styles:</p>
                        <div class="row switcher-style gx-0 gy-2 pb-2">
                            <div class="col-sm-6">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-default-menu">
                                        Default Menu
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="sidemenu-layout-styles"
                                           id="switcher-default-menu"
                                           checked>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-closed-menu">
                                        Closed Menu
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="sidemenu-layout-styles"
                                           id="switcher-closed-menu">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-icontext-menu">
                                        Icon Text
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="sidemenu-layout-styles"
                                           id="switcher-icontext-menu">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-icon-overlay">
                                        Icon Overlay
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="sidemenu-layout-styles"
                                           id="switcher-icon-overlay">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-detached">
                                        Detached
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="sidemenu-layout-styles"
                                           id="switcher-detached">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-double-menu">
                                        Double Menu
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="sidemenu-layout-styles"
                                           id="switcher-double-menu">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Page Styles:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-regular">
                                        Regular
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="page-styles"
                                           id="switcher-regular"
                                           checked>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-classic">
                                        Classic
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="page-styles"
                                           id="switcher-classic">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-modern">
                                        Modern
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="page-styles"
                                           id="switcher-modern">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Layout Width Styles:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-sm-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-full-width">
                                        Full Width
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="layout-width"
                                           id="switcher-full-width"
                                           checked>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-boxed">
                                        Boxed
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="layout-width"
                                           id="switcher-boxed">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Menu Positions:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-menu-fixed">
                                        Fixed
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="menu-positions"
                                           id="switcher-menu-fixed"
                                           checked>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-menu-scroll">
                                        Scrollable
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="menu-positions"
                                           id="switcher-menu-scroll">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Header Positions:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-header-fixed">
                                        Fixed
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="header-positions"
                                           id="switcher-header-fixed"
                                           checked>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-header-scroll">
                                        Scrollable
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="header-positions"
                                           id="switcher-header-scroll">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Loader:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-loader-enable">
                                        Enable
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="page-loader"
                                           id="switcher-loader-enable">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label"
                                           for="switcher-loader-disable">
                                        Disable
                                    </label>
                                    <input class="form-check-input"
                                           type="radio"
                                           name="page-loader"
                                           id="switcher-loader-disable"
                                           checked>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade border-0"
                     id="switcher-profile"
                     role="tabpanel"
                     aria-labelledby="switcher-profile-tab"
                     tabindex="0">
                    <div>
                        <div class="theme-colors">
                            <p class="switcher-style-head">Menu Colors:</p>
                            <div class="d-flex switcher-style pb-2">
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-white"
                                           data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="Light Menu"
                                           type="radio"
                                           name="menu-colors"
                                           id="switcher-menu-light">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-dark"
                                           data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="Dark Menu"
                                           type="radio"
                                           name="menu-colors"
                                           id="switcher-menu-dark"
                                           checked>
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary"
                                           data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="Color Menu"
                                           type="radio"
                                           name="menu-colors"
                                           id="switcher-menu-primary">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-gradient"
                                           data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="Gradient Menu"
                                           type="radio"
                                           name="menu-colors"
                                           id="switcher-menu-gradient">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-transparent"
                                           data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="Transparent Menu"
                                           type="radio"
                                           name="menu-colors"
                                           id="switcher-menu-transparent">
                                </div>
                            </div>
                            <div class="text-muted fs-11 px-4 pb-3">Note:If you want to change color Menu dynamically
                                change from below Theme Primary color picker</div>
                        </div>
                        <div class="theme-colors">
                            <p class="switcher-style-head">Header Colors:</p>
                            <div class="d-flex switcher-style pb-2">
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-white"
                                           data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="Light Header"
                                           type="radio"
                                           name="header-colors"
                                           id="switcher-header-light"
                                           checked>
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-dark"
                                           data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="Dark Header"
                                           type="radio"
                                           name="header-colors"
                                           id="switcher-header-dark">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary"
                                           data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="Color Header"
                                           type="radio"
                                           name="header-colors"
                                           id="switcher-header-primary">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-gradient"
                                           data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="Gradient Header"
                                           type="radio"
                                           name="header-colors"
                                           id="switcher-header-gradient">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-transparent"
                                           data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="Transparent Header"
                                           type="radio"
                                           name="header-colors"
                                           id="switcher-header-transparent">
                                </div>
                            </div>
                            <div class="text-muted fs-11 px-4 pb-3">Note:If you want to change color Header dynamically
                                change from below Theme Primary color picker</div>
                        </div>
                        <div class="theme-colors">
                            <p class="switcher-style-head">Theme Primary:</p>
                            <div class="d-flex align-items-center switcher-style flex-wrap">
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary-1"
                                           type="radio"
                                           name="theme-primary"
                                           id="switcher-primary">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary-2"
                                           type="radio"
                                           name="theme-primary"
                                           id="switcher-primary1">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary-3"
                                           type="radio"
                                           name="theme-primary"
                                           id="switcher-primary2">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary-4"
                                           type="radio"
                                           name="theme-primary"
                                           id="switcher-primary3">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary-5"
                                           type="radio"
                                           name="theme-primary"
                                           id="switcher-primary4">
                                </div>
                                <div class="form-check switch-select color-primary-light mt-1 ps-0">
                                    <div class="theme-container-primary"></div>
                                    <div class="pickr-container-primary"
                                         onchange="updateChartColor(this.value)"></div>
                                </div>
                            </div>
                        </div>
                        <div class="theme-colors">
                            <p class="switcher-style-head">Theme Background:</p>
                            <div class="d-flex align-items-center switcher-style flex-wrap">
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-bg-1"
                                           type="radio"
                                           name="theme-background"
                                           id="switcher-background">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-bg-2"
                                           type="radio"
                                           name="theme-background"
                                           id="switcher-background1">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-bg-3"
                                           type="radio"
                                           name="theme-background"
                                           id="switcher-background2">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-bg-4"
                                           type="radio"
                                           name="theme-background"
                                           id="switcher-background3">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-bg-5"
                                           type="radio"
                                           name="theme-background"
                                           id="switcher-background4">
                                </div>
                                <div
                                     class="form-check switch-select tooltip-static-demo color-bg-transparent mt-1 ps-0">
                                    <div class="theme-container-background"></div>
                                    <div class="pickr-container-background"></div>
                                </div>
                            </div>
                        </div>
                        <div class="menu-image mb-3">
                            <p class="switcher-style-head">Menu With Background Image:</p>
                            <div class="d-flex align-items-center switcher-style flex-wrap">
                                <div class="form-check switch-select m-2">
                                    <input class="form-check-input bgimage-input bg-img1"
                                           type="radio"
                                           name="menu-background"
                                           id="switcher-bg-img">
                                </div>
                                <div class="form-check switch-select m-2">
                                    <input class="form-check-input bgimage-input bg-img2"
                                           type="radio"
                                           name="menu-background"
                                           id="switcher-bg-img1">
                                </div>
                                <div class="form-check switch-select m-2">
                                    <input class="form-check-input bgimage-input bg-img3"
                                           type="radio"
                                           name="menu-background"
                                           id="switcher-bg-img2">
                                </div>
                                <div class="form-check switch-select m-2">
                                    <input class="form-check-input bgimage-input bg-img4"
                                           type="radio"
                                           name="menu-background"
                                           id="switcher-bg-img3">
                                </div>
                                <div class="form-check switch-select m-2">
                                    <input class="form-check-input bgimage-input bg-img5"
                                           type="radio"
                                           name="menu-background"
                                           id="switcher-bg-img4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center canvas-footer flex-nowrap gap-2">
                    <a href="javascript:void(0);"
                       id="reset-all"
                       class="btn btn-danger text-nowrap">Reset</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Switcher -->


    <!-- Loader -->
    <div id="loader">
        <img src="{{ asset('assets/images/media/loader.svg') }}"
             alt="">
    </div>
    <!-- Loader -->

    <div class="page">
        <!-- app-header -->
        <header class="app-header sticky"
                id="header">

            <!-- Start::main-header-container -->
            <div class="main-header-container container-fluid">

                <!-- Start::header-content-left -->
                <div class="header-content-left">

                    <!-- Start::header-element -->
                    <div class="header-element">
                        <div class="horizontal-logo">
                            <a href="{{ url('/home') }}"
                               class="header-logo">
                                <img src="{{ asset('assets/images/brand-logos/desktop-logo.png') }}"
                                     alt="logo"
                                     class="desktop-logo">
                                <img src="{{ asset('assets/images/brand-logos/toggle-dark.png') }}"
                                     alt="logo"
                                     class="toggle-dark">
                                <img src="{{ asset('assets/images/brand-logos/desktop-dark.png') }}"
                                     alt="logo"
                                     class="desktop-dark">
                                <img src="{{ asset('assets/images/brand-logos/toggle-logo.png') }}"
                                     alt="logo"
                                     class="toggle-logo">
                                <img src="{{ asset('assets/images/brand-logos/toggle-white.png') }}"
                                     alt="logo"
                                     class="toggle-white">
                                <img src="{{ asset('assets/images/brand-logos/desktop-white.png') }}"
                                     alt="logo"
                                     class="desktop-white">
                            </a>
                        </div>
                    </div>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <div class="header-element mx-lg-0 mx-2">
                        <a aria-label="Hide Sidebar"
                           class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle"
                           data-bs-toggle="sidebar"
                           href="javascript:void(0);"><span></span></a>
                    </div>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <div class="header-element header-search d-md-block d-none auto-complete-search my-auto">
                        <!-- Start::header-link -->
                        <input type="text"
                               class="header-search-bar form-control"
                               id="header-search"
                               placeholder="Search anything here ..."
                               spellcheck=false
                               autocomplete="off"
                               autocapitalize="off">
                        <a href="javascript:void(0);"
                           class="header-search-icon border-0">
                            <i class="ri-search-line"></i>
                        </a>

                        <!-- End::header-link -->
                    </div>
                    &nbsp;&nbsp;&nbsp;<button type="button"
                            class="btn btn-outline-primary my-1 me-2"
                            data-bs-toggle="modal"
                            data-bs-target="#create-job">
                        Add Job <span class="badge ms-2">New</span>
                    </button>

                    &nbsp;&nbsp;&nbsp; <a href="{{ url('processing-jobs') }}"
                       type="button"
                       class="btn btn-outline-primary2 my-1 me-2">
                        Processing <span class="badge ms-2">26</span>
                    </a>
                    &nbsp;&nbsp;&nbsp; <a href="{{ url('dispatch') }}"type="button"
                       class="btn btn-outline-success my-1 me-2">
                        Dispatched <span class="badge ms-2">42</span>
                    </a>

                    <!-- End::header-element -->

                </div>
                <!-- End::header-content-left -->

                <!-- Start::header-content-right -->
                <ul class="header-content-right">

                    <!-- Start::header-element -->
                    <li class="header-element d-md-none d-block">
                        <a href="javascript:void(0);"
                           class="header-link"
                           data-bs-toggle="modal"
                           data-bs-target="#header-responsive-search">
                            <!-- Start::header-link-icon -->
                            <i class="bi bi-search header-link-icon"></i>
                            <!-- End::header-link-icon -->
                        </a>
                    </li>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <li class="header-element country-selector dropdown">
                        <!-- Start::header-link|dropdown-toggle -->
                        <a href="javascript:void(0);"
                           class="header-link dropdown-toggle"
                           data-bs-auto-close="outside"
                           data-bs-toggle="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="header-link-icon h-6 w-6"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802" />
                            </svg>

                        </a>
                        <!-- End::header-link|dropdown-toggle -->
                        <ul class="main-header-dropdown dropdown-menu dropdown-menu-end"
                            data-popper-placement="none">
                            <li>
                                <a class="dropdown-item d-flex align-items-center"
                                   href="javascript:void(0);">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <span class="avatar avatar-rounded avatar-xs lh-1 me-2">
                                                <img src="{{ asset('assets/images/flags/us_flag.jpg') }}"
                                                     alt="img">
                                            </span>
                                            English
                                        </div>
                                    </div>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <li class="header-element header-theme-mode">
                        <!-- Start::header-link|layout-setting -->
                        <a href="javascript:void(0);"
                           class="header-link layout-setting">
                            <span class="light-layout">
                                <!-- Start::header-link-icon -->
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="header-link-icon h-6 w-6"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                                </svg>
                                <!-- End::header-link-icon -->
                            </span>
                            <span class="dark-layout">
                                <!-- Start::header-link-icon -->
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="header-link-icon h-6 w-6"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                                </svg>
                                <!-- End::header-link-icon -->
                            </span>
                        </a>
                        <!-- End::header-link|layout-setting -->
                    </li>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <li class="header-element cart-dropdown dropdown">
                        <!-- Start::header-link|dropdown-toggle -->
                        <a href="javascript:void(0);"
                           class="header-link dropdown-toggle"
                           data-bs-auto-close="outside"
                           data-bs-toggle="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="header-link-icon h-6 w-6"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M3.75 3h16.5M3.75 9h16.5m-16.5 6h16.5M3.75 21h16.5" />
                            </svg>
                            <span class="badge bg-secondary rounded-pill header-icon-badge"
                                  id="job-icon-badge">4</span>
                        </a>
                        <!-- End::header-link|dropdown-toggle -->
                        <!-- Start::main-header-dropdown -->
                        <div class="main-header-dropdown dropdown-menu dropdown-menu-end"
                             data-popper-placement="none">
                            <div class="p-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="fs-15 fw-medium mb-0">Job Plans <span
                                              class="badge bg-primary2 text-fixed-white fs-12 rounded-circle ms-1"
                                              id="job-data">4</span></p>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="fs-12 fw-medium text-muted">Due Soon: </span>
                                        <h6 class="text-danger mb-0">2</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <ul class="list-unstyled mb-0"
                                id="header-job-items-scroll">
                                <!-- Ongoing Job -->
                                <li class="dropdown-item">
                                    <div class="d-flex align-items-center cart-dropdown-item gap-3">
                                        <div class="lh-1">
                                            <span class="avatar avatar-xl bg-primary-transparent">
                                                <img src="{{ asset('assets/images/media/ongoing.png') }}"
                                                     alt="Ongoing Job">
                                            </span>
                                        </div>
                                        <div class="flex-fill">
                                            <div class="d-flex align-items-center justify-content-between mb-0">
                                                <div class="fs-14 fw-medium mb-0">
                                                    <a href="job-details.html">PP Plain Bags - Ongoing</a>
                                                    <div class="text-truncate">
                                                        <p
                                                           class="header-cart-text text-truncate fs-11 text-muted mb-0">
                                                            Priority: High</p>
                                                        <h6 class="fw-medium mb-0 mt-1"><span
                                                                  class="text-success fw-normal fs-11 d-inline-block me-1">(Plan
                                                                ID: 101)</span>Due: 15th Dec</h6>
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    <a href="javascript:void(0);"
                                                       class="header-cart-remove dropdown-item-close"><i
                                                           class="ri-close-line"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!-- Pending Job -->
                                <li class="dropdown-item">
                                    <div class="d-flex align-items-center cart-dropdown-item gap-3">
                                        <div class="lh-1">
                                            <span class="avatar avatar-xl bg-primary-transparent">
                                                <img src="{{ asset('assets/images/media/pending.png') }}"
                                                     alt="Pending Job">
                                            </span>
                                        </div>
                                        <div class="flex-fill">
                                            <div class="d-flex align-items-center justify-content-between mb-0">
                                                <div class="fs-14 fw-medium mb-0">
                                                    <a href="job-details.html">LD Plain Bags - Pending</a>
                                                    <div class="text-truncate">
                                                        <p
                                                           class="header-cart-text text-truncate fs-11 text-muted mb-0">
                                                            Priority: Medium</p>
                                                        <h6 class="fw-medium mb-0 mt-1"><span
                                                                  class="text-warning fw-normal fs-11 d-inline-block me-1">(Plan
                                                                ID: 102)</span>Due: 18th Dec</h6>
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    <a href="javascript:void(0);"
                                                       class="header-cart-remove dropdown-item-close"><i
                                                           class="ri-close-line"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!-- Urgent Job -->
                                <li class="dropdown-item">
                                    <div class="d-flex align-items-center cart-dropdown-item gap-3">
                                        <div class="lh-1">
                                            <span class="avatar avatar-xl bg-primary-transparent">
                                                <img src="{{ asset('assets/images/media/urgent.png') }}"
                                                     alt="Urgent Job">
                                            </span>
                                        </div>
                                        <div class="flex-fill">
                                            <div class="d-flex align-items-center justify-content-between mb-0">
                                                <div class="fs-14 fw-medium mb-0">
                                                    <a href="job-details.html">HM Printed Bags - Urgent</a>
                                                    <div class="text-truncate">
                                                        <p
                                                           class="header-cart-text text-truncate fs-11 text-danger mb-0">
                                                            Priority: Critical</p>
                                                        <h6 class="fw-medium mb-0 mt-1"><span
                                                                  class="text-danger fw-normal fs-11 d-inline-block me-1">(Plan
                                                                ID: 103)</span>Due: 10th Dec</h6>
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    <a href="javascript:void(0);"
                                                       class="header-cart-remove dropdown-item-close"><i
                                                           class="ri-close-line"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="empty-header-item border-top d-flex align-items-center gap-2 p-3">
                                <a href="job-plans.html"
                                   class="btn flex-fill btn-primary btn-wave">View All Plans</a>
                            </div>
                        </div>
                        <!-- End::main-header-dropdown -->
                    </li>
                    <!-- End::header-element -->


                    <!-- Start::header-element -->
                    <li class="header-element notifications-dropdown d-xl-block d-none dropdown">
                        <!-- Start::header-link|dropdown-toggle -->
                        <a href="javascript:void(0);"
                           class="header-link dropdown-toggle"
                           data-bs-toggle="dropdown"
                           data-bs-auto-close="outside"
                           id="messageDropdown"
                           aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="header-link-icon h-6 w-6"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                            </svg>
                            <span class="header-icon-pulse bg-primary2 pulse pulse-secondary rounded"></span>
                        </a>
                        <!-- End::header-link|dropdown-toggle -->
                        <!-- Start::main-header-dropdown -->
                        <div class="main-header-dropdown dropdown-menu dropdown-menu-end"
                             data-popper-placement="none">
                            <div class="p-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="fs-15 fw-medium mb-0">Notifications</p>
                                    <span class="badge bg-secondary text-fixed-white"
                                          id="notifiation-data">5 Unread</span>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <ul class="list-unstyled mb-0"
                                id="header-notification-scroll">
                                <!-- New Order Received -->
                                <li class="dropdown-item">
                                    <div class="d-flex align-items-center">
                                        <div class="lh-1 pe-2">
                                            <span class="avatar avatar-md avatar-rounded bg-primary">
                                                <i class="fe fe-box lh-1"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                            <div>
                                                <p class="fw-medium mb-0"><a href="orders.html">New Order Received</a>
                                                </p>
                                                <div
                                                     class="text-muted fw-normal fs-12 header-notification-text text-truncate">
                                                    A new order has been placed by <span class="text-primary1">TVS
                                                        Motors</span>.</div>
                                                <div class="fw-normal fs-10 text-muted op-8">Now</div>
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);"
                                                   class="min-w-fit-content dropdown-item-close1">
                                                    <i class="ri-close-line"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!-- Inventory Update -->
                                <li class="dropdown-item">
                                    <div class="d-flex align-items-center">
                                        <div class="lh-1 pe-2">
                                            <span class="avatar avatar-md avatar-rounded bg-success">
                                                <i class="fe fe-refresh-ccw lh-1"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                            <div>
                                                <p class="fw-medium mb-0"><a href="inventory.html">Inventory
                                                        Update</a></p>
                                                <div
                                                     class="text-muted fw-normal fs-12 header-notification-text text-truncate">
                                                    Product <span class="text-primary1">LLD</span> has been restocked.
                                                </div>
                                                <div class="fw-normal fs-10 text-muted op-8">2 hours ago</div>
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);"
                                                   class="min-w-fit-content dropdown-item-close1">
                                                    <i class="ri-close-line"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <!-- New Supplier Request -->
                                <li class="dropdown-item">
                                    <div class="d-flex align-items-center">
                                        <div class="lh-1 pe-2">
                                            <span class="avatar avatar-md avatar-rounded bg-info">
                                                <i class="fe fe-truck lh-1"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                            <div>
                                                <p class="fw-medium mb-0"><a href="suppliers.html">New Supplier
                                                        Request</a></p>
                                                <div
                                                     class="text-muted fw-normal fs-12 header-notification-text text-truncate">
                                                    New request from <span class="text-primary3">Global
                                                        Supplies</span>.</div>
                                                <div class="fw-normal fs-10 text-muted op-8">1 Day ago</div>
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);"
                                                   class="min-w-fit-content dropdown-item-close1">
                                                    <i class="ri-close-line"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!-- Customer Feedback -->
                                <li class="dropdown-item">
                                    <div class="d-flex align-items-center">
                                        <div class="lh-1 pe-2">
                                            <span class="avatar avatar-md bg-warning avatar-rounded">
                                                <i class="fe fe-message-square lh-1"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                            <div>
                                                <p class="fw-medium mb-0"><a href="feedback.html">Customer
                                                        Feedback</a></p>
                                                <div
                                                     class="text-muted fw-normal fs-12 header-notification-text text-truncate">
                                                    Feedback received from <span
                                                          class="text-primary3">Ravichandran</span>.</div>
                                                <div class="fw-normal fs-10 text-muted op-8">5 hours ago</div>
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);"
                                                   class="min-w-fit-content dropdown-item-close1">
                                                    <i class="ri-close-line"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!-- Order Shipped -->
                                <li class="dropdown-item">
                                    <div class="d-flex align-items-center">
                                        <div class="lh-1 pe-2">
                                            <span class="avatar avatar-md bg-primary avatar-rounded">
                                                <i class="fe fe-truck lh-1"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                            <div>
                                                <p class="fw-medium mb-0"><a href="orders.html">Order Dispatched</a>
                                                </p>
                                                <div
                                                     class="text-muted fw-normal fs-12 header-notification-text text-truncate">
                                                    Order <span class="text-primary1">#54321</span> has been
                                                    Dispatched.</div>
                                                <div class="fw-normal fs-10 text-muted op-8">2 hours ago</div>
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);"
                                                   class="min-w-fit-content dropdown-item-close1">
                                                    <i class="ri-close-line"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <div class="empty-header-item1 border-top p-3">
                                <div class="d-grid">
                                    <a href="javascript:void(0);"
                                       class="btn btn-primary btn-wave">View All</a>
                                </div>
                            </div>
                            <div class="empty-item1 d-none p-5">
                                <div class="text-center">
                                    <span class="avatar avatar-xl avatar-rounded bg-secondary-transparent">
                                        <i class="ri-notification-off-line fs-2"></i>
                                    </span>
                                    <h6 class="fw-medium mt-3">No New Notifications</h6>
                                </div>
                            </div>
                        </div>
                        <!-- End::main-header-dropdown -->

                    </li>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <li class="header-element header-fullscreen">
                        <!-- Start::header-link -->
                        <a onclick="openFullscreen();"
                           href="javascript:void(0);"
                           class="header-link">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="full-screen-open header-link-icon h-6 w-6"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="full-screen-close header-link-icon d-none h-6 w-6"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M9 9V4.5M9 9H4.5M9 9 3.75 3.75M9 15v4.5M9 15H4.5M9 15l-5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5 5.25 5.25" />
                            </svg>
                        </a>
                        <!-- End::header-link -->
                    </li>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <li class="header-element dropdown">
                        <!-- Start::header-link|dropdown-toggle -->
                        <a href="javascript:void(0);"
                           class="header-link dropdown-toggle"
                           id="mainHeaderProfile"
                           data-bs-toggle="dropdown"
                           data-bs-auto-close="outside"
                           aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div>
                                    <img src="{{ asset('assets/images/faces/15.jpg') }}"
                                         alt="img"
                                         class="avatar avatar-sm">
                                </div>
                            </div>
                        </a>
                        <!-- End::header-link|dropdown-toggle -->
                        <ul class="main-header-dropdown dropdown-menu header-profile-dropdown dropdown-menu-end overflow-hidden pt-0"
                            aria-labelledby="mainHeaderProfile">
                            <li>
                                <div class="dropdown-item border-bottom text-center">
                                    <span>
                                        Mr. Mano Ranjith
                                    </span>
                                    <span class="d-block fs-12 text-muted">UI/UX Designer</span>
                                </div>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center"
                                   href="{{ url('profile-settings') }}"><i
                                       class="fe fe-user rounded-circle bg-primary-transparent fs-16 me-2 p-1"></i>Profile</a>
                            </li>
                            <!-- <li><a class="dropdown-item d-flex align-items-center" href="mail.html"><i class="fe fe-mail rounded-circle bg-primary-transparent fs-16 me-2 p-1"></i>Mail Inbox</a></li>
                    <li><a class="dropdown-item d-flex align-items-center" href="file-manager.html"><i class="fe fe-database rounded-circle bg-primary-transparent klist fs-16 me-2 p-1"></i>File Manger<span class="badge bg-primary1 text-fixed-white fs-9 ms-auto">2</span></a></li> -->
                            <li><a class="dropdown-item d-flex align-items-center"
                                   href="{{ url('settings/website') }}"><i
                                       class="fe fe-settings rounded-circle bg-primary-transparent ings fs-16 me-2 p-1"></i>Settings</a>
                            </li>
                            <li class="border-top bg-light"><a class="dropdown-item d-flex align-items-center"
                                   href="{{ url('settings/website') }}"><i
                                       class="fe fe-help-circle rounded-circle bg-primary-transparent set fs-16 me-2 p-1"></i>Help</a>
                            </li>
                            <li>
                                <form method="POST"
                                      action="{{ route('logout') }}"
                                      class="d-flex align-items-center w-100">
                                    @csrf
                                    <button type="submit"
                                            class="dropdown-item d-flex align-items-center w-100 text-start">
                                        <i
                                           class="fe fe-lock rounded-circle bg-primary-transparent ut fs-16 me-2 p-1"></i>
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            </li>

                        </ul>
                    </li>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <li class="header-element">
                        <!-- Start::header-link|switcher-icon -->
                        <a href="javascript:void(0);"
                           class="header-link switcher-icon"
                           data-bs-toggle="offcanvas"
                           data-bs-target="#switcher-canvas">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="header-link-icon h-6 w-6"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </a>
                        <!-- End::header-link|switcher-icon -->
                    </li>
                    <!-- End::header-element -->

                </ul>
                <!-- End::header-content-right -->

            </div>
            <!-- End::main-header-container -->

        </header>
        <!-- /app-header -->
        <!-- Start::app-sidebar -->
        <aside class="app-sidebar sticky"
               id="sidebar">

            <!-- Start::main-sidebar-header -->
            <div class="main-sidebar-header">
                <a href="{{ url('/home') }}"
                   class="header-logo">
                    <img src="{{ asset('assets/images/brand-logos/desktop-logo.png') }}"
                         alt="logo"
                         class="desktop-logo">
                    <img src="{{ asset('assets/images/brand-logos/toggle-dark.png') }}"
                         alt="logo"
                         class="toggle-dark">
                    <img src="{{ asset('assets/images/brand-logos/desktop-dark.png') }}"
                         alt="logo"
                         class="desktop-dark">
                    <img src="{{ asset('assets/images/brand-logos/toggle-logo.png') }}"
                         alt="logo"
                         class="toggle-logo">
                    <img src="{{ asset('assets/images/brand-logos/toggle-white.png') }}"
                         alt="logo"
                         class="toggle-white">
                    <img src="{{ asset('assets/images/brand-logos/desktop-white.png') }}"
                         alt="logo"
                         class="desktop-white">
                </a>
            </div>
            <!-- End::main-sidebar-header -->

            <!-- Start::main-sidebar -->
            <div class="main-sidebar"
                 id="sidebar-scroll">

                <!-- Start::nav -->
                <nav class="main-menu-container nav nav-pills flex-column sub-open">
                    <div class="slide-left"
                         id="slide-left">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="#7b8191"
                             width="24"
                             height="24"
                             viewBox="0 0 24 24">
                            <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                        </svg>
                    </div>
                    <ul class="main-menu">
                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">Main</span></li>
                        <!-- End::slide__category -->

                        <!-- Start::slide -->
                        <li class="slide {{ request()->is('home') ? 'active' : '' }}">
                            <a href="{{ url('/home') }}"
                               class="side-menu__item">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="side-menu__icon h-6 w-6"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor">jobparts
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                                <span class="side-menu__label">Dashboard</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        <li class="slide {{ request()->is('productionplans') ? 'active' : '' }}">
                            <a href="{{ url('/productionplans') }}"
                               class="side-menu__item">
                                <i class="ti ti-calendar-event side-menu__icon"></i>
                                <span class="side-menu__label">Production Plan</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        <li class="slide {{ request()->is('jobparts') ? 'active' : '' }}">
                            <a href="{{ url('/jobparts') }}"
                               class="side-menu__item">
                                <i class="ti ti-briefcase side-menu__icon"></i>
                                <span class="side-menu__label">Production Jobs</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        <li class="slide {{ request()->is('processing-jobs') ? 'active' : '' }}">
                            <a href="{{ url('/processing-jobs') }}"
                               class="side-menu__item">
                                <i class="ti ti-settings side-menu__icon"></i>
                                <span class="side-menu__label">Jobs Processing</span>
                            </a>
                        </li>
                        <!-- End::slide -->


                        <!-- Start::slide -->
                        <li class="slide {{ request()->is('extrusion') ? 'active' : '' }}">
                            <a href="{{ url('/extrusion') }}"
                               class="side-menu__item">
                                <i class="ti ti-list side-menu__icon"></i>
                                <span class="side-menu__label">Extrusion</span>
                            </a>
                        </li>
                        <!-- End::slide -->
                        <!-- Start::slide -->
                        <li class="slide {{ request()->is('printing') ? 'active' : '' }}">
                            <a href="{{ url('/printing') }}"
                               class="side-menu__item">
                                <i class="ti ti-printer side-menu__icon"></i>
                                <span class="side-menu__label">Printing</span>
                            </a>
                        </li>
                        <!-- End::slide -->
                        <!-- Start::slide -->
                        <li class="slide {{ request()->is('pasting') ? 'active' : '' }}">
                            <a href="{{ url('/pasting') }}"
                               class="side-menu__item">
                                <i class="ti ti-scissors side-menu__icon"></i>
                                <span class="side-menu__label">Pasting</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        <li class="slide {{ request()->is('slitting') ? 'active' : '' }}">
                            <a href="{{ url('/slitting') }}"
                               class="side-menu__item">
                                <i class="ti ti-scissors side-menu__icon"></i>
                                <span class="side-menu__label">Slitting</span>
                            </a>
                        </li>
                        <!-- End::slide -->
                        <!-- Start::slide -->
                        <li class="slide {{ request()->is('cutting') ? 'active' : '' }}">
                            <a href="{{ url('/cutting') }}"
                               class="side-menu__item">
                                <i class="ti ti-scissors side-menu__icon"></i>
                                <span class="side-menu__label">Cutting</span>
                            </a>
                        </li>
                        <!-- End::slide -->



                        <!-- Start::slide -->
                        <li class="slide {{ request()->is('finish') ? 'active' : '' }}">
                            <a href="{{ url('/finish') }}"
                               class="side-menu__item">
                                <i class="ti ti-checklist side-menu__icon"></i>
                                <span class="side-menu__label">Finished</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        <li class="slide {{ request()->is('dispatch') ? 'active' : '' }}">
                            <a href="{{ url('/dispatch') }}"
                               class="side-menu__item">
                                <i class="ti ti-truck side-menu__icon"></i>
                                <span class="side-menu__label">Dispatch</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        <li class="slide__category"><span class="category-name">Inventory</span></li>
                        <!-- End::slide__category -->

                        <!-- Start::slide -->
                        <li class="slide {{ request()->is('parts') ? 'active' : '' }}">
                            <a href="{{ url('/parts') }}"
                               class="side-menu__item">
                                <i class="ti ti-package side-menu__icon"></i>
                                <span class="side-menu__label">Parts Items</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        <li class="slide {{ request()->is('materialstocks') ? 'active' : '' }}">
                            <a href="{{ url('/materialstocks') }}"
                               class="side-menu__item">
                                <i class="ti ti-box side-menu__icon"></i>
                                <span class="side-menu__label">Material In-Stocks</span>
                            </a>
                        </li>
                        <!-- End::slide -->
                        <!-- Start::slide -->
                        <li class="slide {{ request()->is('parts-stocks') ? 'active' : '' }}">
                            <a href="{{ url('/parts-stocks') }}"
                               class="side-menu__item">
                                <i class="ti ti-robot side-menu__icon"></i>
                                <span class="side-menu__label">Parts Stocks</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        <li class="slide {{ request()->is('machines') ? 'active' : '' }}">
                            <a href="{{ url('/machines') }}"
                               class="side-menu__item">
                                <i class="ti ti-robot side-menu__icon"></i>
                                <span class="side-menu__label">All Machines</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        <li class="slide {{ request()->is('branches') ? 'active' : '' }}">
                            <a href="{{ url('/branches') }}"
                               class="side-menu__item">
                                <i class="ti ti-building side-menu__icon"></i>
                                <span class="side-menu__label">All Branches</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        <li class="slide {{ request()->is('warehouse') ? 'active' : '' }}">
                            <a href="{{ url('/warehouse') }}"
                               class="side-menu__item">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="side-menu__icon h-6 w-6"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                                </svg>
                                <span class="side-menu__label">All Warehouses</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        <li class="slide {{ request()->is('suppliers') ? 'active' : '' }}">
                            <a href="{{ url('/suppliers') }}"
                               class="side-menu__item">
                                <i class="ti ti-truck side-menu__icon"></i>
                                <span class="side-menu__label">Suppliers</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        <li class="slide {{ request()->is('customers') ? 'active' : '' }}">
                            <a href="{{ url('/customers') }}"
                               class="side-menu__item">
                                <i class="ti ti-users side-menu__icon"></i>
                                <span class="side-menu__label">Customers</span>
                            </a>
                        </li>
                        <!-- End::slide -->
                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">Authentication</span></li>
                        <!-- End::slide__category -->

                        <!-- Start::slide -->
                        <li class="slide {{ request()->is('staffs') ? 'active' : '' }}">
                            <a href="{{ url('/staffs') }}"
                               class="side-menu__item">
                                <i class="ti ti-user-check side-menu__icon"></i>
                                <span class="side-menu__label">Staffs</span>
                            </a>
                        </li>
                        <!-- End::slide -->
                        <!-- Start::slide -->
                        <li class="slide {{ request()->is('settings') ? 'active' : '' }}">
                            <a href="{{ url('/settings/website') }}"
                               class="side-menu__item">
                                <i class="ti ti-settings side-menu__icon"></i>
                                <span class="side-menu__label">Settings</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                    </ul>
                    <div class="slide-right"
                         id="slide-right"><svg xmlns="http://www.w3.org/2000/svg"
                             fill="#7b8191"
                             width="24"
                             height="24"
                             viewBox="0 0 24 24">
                            <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                        </svg></div>
                </nav>
                <!-- End::nav -->

            </div>
            <!-- End::main-sidebar -->

        </aside>
        <!-- End::app-sidebar -->

        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">


                @yield('content')

            </div>
        </div>
        <!-- End::app-content -->



        <!-- Start::add job modal -->
        <div class="modal fade"
             id="create-job"
             tabindex="-1"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Add Job</h6>
                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row gy-2">
                            <div class="col-xl-6">
                                <label for="part-id"
                                       class="form-label">Part ID</label>
                                <input type="text"
                                       class="form-control"
                                       id="part-id"
                                       placeholder="Enter Part ID">
                            </div>
                            <div class="col-xl-6">
                                <label for="product-name-add"
                                       class="form-label">Part Name</label>
                                <input type="text"
                                       class="form-control"
                                       id="product-name-add"
                                       placeholder="Name">
                            </div>
                            <div class="col-xl-6">

                                <label for="product-brand-add"
                                       class="form-label">Customer Code</label>
                                <select class="form-control"
                                        data-trigger
                                        name="product-brand-add"
                                        id="product-brand-add">
                                    <option value="">Select</option>
                                    <option value="C021224 - TVS Motors">C021224 - TVS Motors</option>
                                    <option value="C032645 - Yamaha Engines">C032645 - Yamaha Engines</option>
                                    <option value="C045678 - Puma">C045678 - Puma</option>
                                    <option value="C054321 - Spykar">C054321 - Spykar</option>
                                    <option value="C067890 - Mufti">C067890 - Mufti</option>
                                    <option value="C078902 - Home Town">C078902 - Home Town</option>
                                    <option value="C089123 - Arrabi">C089123 - Arrabi</option>
                                </select>
                            </div>
                            <div class="col-xl-6">
                                <label for="qty"
                                       class="form-label">Quantity</label>
                                <input type="number"
                                       class="form-control"
                                       id="qty"
                                       placeholder="Enter Quantity">
                            </div>
                            <div class="col-xl-6">
                                <label for="instock-qty"
                                       class="form-label">In-stock Quantity</label>
                                <input type="number"
                                       class="form-control"
                                       id="instock-qty"
                                       placeholder="Enter In-stock Quantity">
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Start Date</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-text text-muted"><i class="ri-calendar-line"></i>
                                        </div>
                                        <input type="date"
                                               class="form-control"
                                               id="start-date"
                                               placeholder="Choose start date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Due Date</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-text text-muted"><i class="ri-calendar-line"></i>
                                        </div>
                                        <input type="date"
                                               class="form-control"
                                               id="due-date"
                                               placeholder="Choose due date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Material Ratio</label>
                                <input type="text"
                                       class="form-control"
                                       id="material-ratio"
                                       placeholder="Enter Material Ratio">
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Status</label>
                                <select class="form-control"
                                        data-trigger
                                        name="choices-single-default"
                                        id="status">
                                    <option value="New">New</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Inprogress">In-progress</option>
                                    <option value="Pending">Pending</option>
                                </select>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Priority</label>
                                <select class="form-control"
                                        data-trigger
                                        name="choices-single-default"
                                        id="priority">
                                    <option value="High">High</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Low">Low</option>
                                </select>
                            </div>
                            <div class="col-xl-12">
                                <label class="form-label">Assigned To</label>
                                <select class="form-control"
                                        name="choices-multiple-remove-button"
                                        id="assigned-to"
                                        multiple>
                                    <option value="Angelina May">Branch Goa</option>
                                    <option value="Branch Honda">Branch Honda</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-light"
                                data-bs-dismiss="modal">Cancel</button>
                        <button type="button"
                                class="btn btn-primary">Add Job</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End::add job modal -->




        <!-- Footer Start -->
        <footer class="footer mt-auto bg-white py-3 text-center">
            <div class="container">
                <span class="text-muted"> Copyright © <span id="year"></span> <a href="javascript:void(0);"
                       class="text-dark fw-medium">Kemplast Systems</a>.
                    Designed with <span class="bi bi-heart-fill text-danger"></span> by <a
                       href="https://spellinfo.com/">
                        <span class="fw-medium text-primary">Spellinfo Technologies</span>
                    </a> All
                    rights
                    reserved
                </span>
            </div>
        </footer>
        <!-- Footer End -->
        <div class="modal fade"
             id="header-responsive-search"
             tabindex="-1"
             aria-labelledby="header-responsive-search"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="input-group">
                            <input type="text"
                                   class="form-control border-end-0"
                                   placeholder="Search Anything ..."
                                   aria-label="Search Anything ..."
                                   aria-describedby="button-addon2">
                            <button class="btn btn-primary"
                                    type="button"
                                    id="button-addon2"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- Scroll To Top -->
    <div class="scrollToTop">
        <span class="arrow"><i class="ti ti-arrow-narrow-up fs-20"></i></span>
    </div>

    <div id="responsive-overlay"></div>


    {{-- TEST --}}

    <!-- jQuery (must be loaded BEFORE Bootstrap and your custom script) -->


    {{-- TEST --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables -->

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
          rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



    <script>
        $(document).ready(function() {
            // Initialize Select2 for elements inside modals
            $('.modal .select2-basic-single').each(function() {
                const modalParent = $(this).closest('.modal');

                $(this).select2({
                    width: '100%',
                    dropdownParent: modalParent // Dynamically set the dropdown parent
                    // Add more options as needed
                });
            });
        });
    </script>

    <!-- Choices JS -->
    <script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

    <!-- Main Theme Js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Popper JS -->
    <script src="{{ asset('assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById('addDataModal'));
            myModal.show();
        });
    </script>


    <!-- Defaultmenu JS -->
    <script src="{{ asset('assets/js/defaultmenu.min.js') }}"></script>

    <!-- Node Waves JS -->
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- Sticky JS -->
    <script src="{{ asset('assets/js/sticky.js') }}"></script>

    <!-- Simplebar JS -->
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.js') }}"></script>

    <!-- Auto Complete JS -->
    <script src="{{ asset('assets/libs/@tarekraafat/autocomplete.js/autoComplete.min.js') }}"></script>

    <!-- Color Picker JS -->
    <script src="{{ asset('assets/libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>

    <!-- Date & Time Picker JS -->
    <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>



    <!-- Custom JS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Custom-Switcher JS -->
    <script src="{{ asset('assets/js/custom-switcher.min.js') }}"></script>

    <!-- Quill Editor JS -->
    <script src="{{ asset('assets/libs/quill/quill.js') }}"></script>

    <!-- Filepond JS -->
    <script src="{{ asset('assets/libs/filepond/filepond.min.js') }}"></script>
    <script src="{{ asset('assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}"></script>
    <script
            src="{{ asset('assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}">
    </script>
    <script src="{{ asset('assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}">
    </script>
    <script src="{{ asset('assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js') }}"></script>
    <script src="{{ asset('assets/libs/filepond-plugin-image-edit/filepond-plugin-image-edit.min.js') }}"></script>
    <script src="{{ asset('assets/libs/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js') }}">
    </script>
    <script src="{{ asset('assets/libs/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js') }}"></script>
    <script src="{{ asset('assets/libs/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js') }}"></script>
    <script src="{{ asset('assets/libs/filepond-plugin-image-transform/filepond-plugin-image-transform.min.js') }}">
    </script>

    <script src="{{ asset('assets/js/add-products.js') }}"></script>

</body>

</html>
