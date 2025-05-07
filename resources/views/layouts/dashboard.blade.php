<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-menu-styles="dark" data-toggled="close">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=no'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> @yield('title')</title>
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="">

    <!-- Favicon -->
    <link rel="icon" href="{{asset('assets/images/brand-logos/school.jpeg')}}" type="image/x-icon">
    {{-- <link rel="stylesheet" href="{{asset('assets/css/fontawesome.css')}}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Choices JS -->
    <script src="{{asset('assets/libs/choices.js/public/assets/scripts/choices.min.js')}}"></script>

    <!-- Main Theme Js -->
    <script src="{{asset('assets/js/main.js')}}"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="{{asset('assets/libs/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Style Css -->
    <link href="{{asset('assets/css/styles.min.css')}}" rel="stylesheet">

    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">

    <!-- Node Waves Css -->
    <link href="{{asset('assets/libs/node-waves/waves.min.css')}}" rel="stylesheet">

    <!-- Simplebar Css -->
    <link href="{{asset('assets/libs/simplebar/simplebar.min.css')}}" rel="stylesheet">

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/libs/@simonwep/pickr/themes/nano.min.css')}}">

    <!-- Choices Css -->
    <link rel="stylesheet" href="{{asset('assets/libs/choices.js/public/assets/styles/choices.min.css')}}">


    <link rel="stylesheet" href="{{asset('assets/libs/jsvectormap/css/jsvectormap.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/libs/swiper/swiper-bundle.min.css')}}">
    <!-- jQuery -->
    <script src="{{asset('js/jquery3.6.0.js')}}"></script>
    {{-- Tostar css --}}
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
    @yield('styles')
</head>

<body>




    <!-- Loader -->
    <div id="loader">
        <img src="{{asset('assets/images/media/loader.svg')}}" alt="">
    </div>
    <!-- Loader -->

    <div class="page">
        <!-- app-header -->
        <header class="app-header">

            <!-- Start::main-header-container -->
            <div class="main-header-container container-fluid">

                <!-- Start::header-content-left -->
                <div class="header-content-left">

                    <!-- Start::header-element -->
                    <div class="header-element">
                        <div class="horizontal-logo">
                            <a href="index.html" class="header-logo">
                                <img src="{{asset('assets/images/brand-logos/school.jpeg')}}" alt="logo" class="desktop-logo">
                                <img src="{{asset('assets/images/brand-logos/school.jpeg')}}" alt="logo" class="toggle-logo">
                                <img src="{{asset('assets/images/brand-logos/school.jpeg')}}" alt="logo" class="desktop-dark">
                                <img src="{{asset('assets/images/brand-logos/school.jpeg')}}" alt="logo" class="toggle-dark">
                                <img src="{{asset('assets/images/brand-logos/school.jpeg')}}" alt="logo" class="desktop-white">
                                <img src="{{asset('assets/images/brand-logos/school.jpeg')}}" alt="logo" class="toggle-white">
                            </a>
                        </div>
                    </div>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <div class="header-element">
                        <!-- Start::header-link -->
                        <a aria-label="Hide Sidebar"
                            class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle"
                            data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
                        <!-- End::header-link -->
                    </div>
                    <!-- End::header-element -->

                </div>
                <!-- End::header-content-left -->

                <!-- Start::header-content-right -->
                <div class="header-content-right">

                    <!-- Start::header-element -->
                    <div class="header-element header-search">
                        <!-- Start::header-link -->
                        <a href="javascript:void(0);" class="header-link" data-bs-toggle="modal"
                            data-bs-target="#searchModal">
                            <i class="bx bx-search-alt-2 header-link-icon"></i>
                        </a>
                        <!-- End::header-link -->
                    </div>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <div class="header-element country-selector">
                        <!-- Start::header-link|dropdown-toggle -->
                        <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-auto-close="outside"
                            data-bs-toggle="dropdown">
                            <img src="{{asset('assets/images/flags/us_flag.jpg')}}" alt="img" class="rounded-circle">
                        </a>
                        <!-- End::header-link|dropdown-toggle -->
                        <ul class="main-header-dropdown dropdown-menu dropdown-menu-end" data-popper-placement="none">
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
                                    <span class="avatar avatar-xs lh-1 me-2">
                                        <img src="{{asset('assets/images/flags/us_flag.jpg')}}" alt="img">
                                    </span>
                                    English
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
                                    <span class="avatar avatar-xs lh-1 me-2">
                                        <img src="{{asset('assets/images/flags/russia_flag.jpg')}}" alt="img">
                                    </span>
                                    Russian
                                </a>
                            </li>
                        </ul>
                    </div>
               



                    <!-- Start::header-element -->
                    <div class="header-element notifications-dropdown">
                        <!-- Start::header-link|dropdown-toggle -->
                        <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" id="messageDropdown" aria-expanded="false">
                            <i class="bx bx-bell header-link-icon"></i>
                            <span class="badge bg-secondary rounded-pill header-icon-badge pulse pulse-secondary"
                                id="notification-icon-badge">5</span>
                        </a>
                        <!-- End::header-link|dropdown-toggle -->
                        <!-- Start::main-header-dropdown -->
                        <div class="main-header-dropdown dropdown-menu dropdown-menu-end" data-popper-placement="none">
                            <div class="p-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="mb-0 fs-17 fw-semibold">Notifications</p>
                                    <span class="badge bg-secondary-transparent" id="notifiation-data">5 Unread</span>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <ul class="list-unstyled mb-0" id="header-notification-scroll">
                                <li class="dropdown-item">
                                    <div class="d-flex align-items-start">
                                        <div class="pe-2">
                                            <span class="avatar avatar-md bg-primary-transparent avatar-rounded"><i
                                                    class="ti ti-gift fs-18"></i></span>
                                        </div>
                                        <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                            <div>
                                                <p class="mb-0 fw-semibold"><a href="notifications.html">Your Order Has
                                                        Been Shipped</a></p>
                                                <span class="text-muted fw-normal fs-12 header-notification-text">Order
                                                    No: 123456 Has Shipped To Your Delivery Address</span>
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i
                                                        class="ti ti-x fs-16"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-item">
                                    <div class="d-flex align-items-start">
                                        <div class="pe-2">
                                            <span class="avatar avatar-md bg-secondary-transparent avatar-rounded"><i
                                                    class="ti ti-discount-2 fs-18"></i></span>
                                        </div>
                                        <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                            <div>
                                                <p class="mb-0 fw-semibold"><a href="notifications.html">Discount
                                                        Available</a></p>
                                                <span
                                                    class="text-muted fw-normal fs-12 header-notification-text">Discount
                                                    Available On Selected Products</span>
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i
                                                        class="ti ti-x fs-16"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-item">
                                    <div class="d-flex align-items-start">
                                        <div class="pe-2">
                                            <span class="avatar avatar-md bg-pink-transparent avatar-rounded"><i
                                                    class="ti ti-user-check fs-18"></i></span>
                                        </div>
                                        <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                            <div>
                                                <p class="mb-0 fw-semibold"><a href="notifications.html">Account Has
                                                        Been Verified</a></p>
                                                <span class="text-muted fw-normal fs-12 header-notification-text">Your
                                                    Account Has Been Verified Sucessfully</span>
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i
                                                        class="ti ti-x fs-16"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-item">
                                    <div class="d-flex align-items-start">
                                        <div class="pe-2">
                                            <span class="avatar avatar-md bg-warning-transparent avatar-rounded"><i
                                                    class="ti ti-circle-check fs-18"></i></span>
                                        </div>
                                        <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                            <div>
                                                <p class="mb-0 fw-semibold"><a href="notifications.html">Order Placed
                                                        <span class="text-warning">ID: #1116773</span></a></p>
                                                <span class="text-muted fw-normal fs-12 header-notification-text">Order
                                                    Placed Successfully</span>
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i
                                                        class="ti ti-x fs-16"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-item">
                                    <div class="d-flex align-items-start">
                                        <div class="pe-2">
                                            <span class="avatar avatar-md bg-success-transparent avatar-rounded"><i
                                                    class="ti ti-clock fs-18"></i></span>
                                        </div>
                                        <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                            <div>
                                                <p class="mb-0 fw-semibold"><a href="notifications.html">Order Delayed
                                                        <span class="text-success">ID: 7731116</span></a></p>
                                                <span class="text-muted fw-normal fs-12 header-notification-text">Order
                                                    Delayed Unfortunately</span>
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i
                                                        class="ti ti-x fs-16"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="p-3 empty-header-item1 border-top">
                                <div class="d-grid">
                                    <a href="notifications.html" class="btn btn-primary">View All</a>
                                </div>
                            </div>
                            <div class="p-5 empty-item1 d-none">
                                <div class="text-center">
                                    <span class="avatar avatar-xl avatar-rounded bg-secondary-transparent">
                                        <i class="ri-notification-off-line fs-2"></i>
                                    </span>
                                    <h6 class="fw-semibold mt-3">No New Notifications</h6>
                                </div>
                            </div>
                        </div>
                        <!-- End::main-header-dropdown -->
                    </div>
                    <!-- End::header-element -->





                    <!-- Start::header-element -->
                    <div class="header-element">
                        <!-- Start::header-link|dropdown-toggle -->
                        <a href="#" class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div class="me-sm-2 me-0">
                                    <img src="{{asset('assets/images/faces/9.jpg')}}" alt="img" width="32" height="32"
                                        class="rounded-circle">
                                </div>
                                <div class="d-sm-block d-none">
                                    <p class="fw-semibold mb-0 lh-1">Json Taylor</p>
                                    <span class="op-7 fw-normal d-block fs-11">Web Designer</span>
                                </div>
                            </div>
                        </a>
                        <!-- End::header-link|dropdown-toggle -->
                        <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                            aria-labelledby="mainHeaderProfile">
                            <li><a class="dropdown-item d-flex" href="profile.html"><i
                                        class="ti ti-user-circle fs-18 me-2 op-7"></i>Profile</a></li>
                            <li><a class="dropdown-item d-flex" href="mail.html"><i
                                        class="ti ti-inbox fs-18 me-2 op-7"></i>Inbox <span
                                        class="badge bg-success-transparent ms-auto">25</span></a></li>
                            <li><a class="dropdown-item d-flex border-block-end" href="to-do-list.html"><i
                                        class="ti ti-clipboard-check fs-18 me-2 op-7"></i>Task Manager</a></li>
                            <li><a class="dropdown-item d-flex" href="mail-settings.html"><i
                                        class="ti ti-adjustments-horizontal fs-18 me-2 op-7"></i>Settings</a></li>
                            <li><a class="dropdown-item d-flex border-block-end" href="javascript:void(0);"><i
                                        class="ti ti-wallet fs-18 me-2 op-7"></i>Bal: $7,12,950</a></li>
                            <li><a class="dropdown-item d-flex" href="chat.html"><i
                                        class="ti ti-headset fs-18 me-2 op-7"></i>Support</a></li>
                            <li><a class="dropdown-item d-flex" href="sign-in-cover.html"><i
                                        class="ti ti-logout fs-18 me-2 op-7"></i>Log Out</a></li>
                        </ul>
                    </div>
                    <!-- End::header-element -->



                </div>
                <!-- End::header-content-right -->

            </div>
            <!-- End::main-header-container -->

        </header>
        <!-- /app-header -->
        <!-- Start::app-sidebar -->
        <aside class="app-sidebar sticky" id="sidebar">

            <!-- Start::main-sidebar-header -->
            <div class="main-sidebar-header">
                <a href="index.html" class="header-logo">
                    <img src="{{asset('assets/images/brand-logos/school.jpeg')}}" alt="logo" class="desktop-logo">
                    <img src="{{asset('assets/images/brand-logos/school.jpeg')}}" alt="logo" class="toggle-logo">
                    <img src="{{asset('assets/images/brand-logos/school.jpeg')}}" alt="logo" class="desktop-dark">
                    <img src="{{asset('assets/images/brand-logos/school.jpeg')}}" alt="logo" class="toggle-dark">
                    <img src="{{asset('assets/images/brand-logos/school.jpeg')}}" alt="logo" class="desktop-white">
                    <img src="{{asset('assets/images/brand-logos/school.jpeg')}}" alt="logo" class="toggle-white">
                </a>
            </div>
            <!-- End::main-sidebar-header -->

            <!-- Start::main-sidebar -->
            <div class="main-sidebar" id="sidebar-scroll">

                <!-- Start::nav -->
                <nav class="main-menu-container nav nav-pills flex-column sub-open">
                    <div class="slide-left" id="slide-left">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                        </svg>
                    </div>
                    <ul class="main-menu" >
                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">{{ __('dashboard.main') }}</span></li>
                        <!-- End::slide__category -->
                    
                        <!-- Start::slide -->
                       
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <i class="fa-solid fa-user m-1"></i>
                                <span class="side-menu__label"> {{__('Users')}} </span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1" >
                                
                                <li class="slide has-sub">
                                    <a href="{{route('grades.index')}}" class="side-menu__item"> 
                                        <i class="bi bi-house-add-fill"></i>
                                        {{-- <i class="fa-solid fa-person-circle-plus"></i> --}}
                                        <span class="p-1">{{__('All Grade')}}</span>
                                        </a>
                                        
                                </li>
                                <li class="slide">
                                    <a href="{{route('grades.create')}}" class="side-menu__item">
                                        
                                      <span class="p-1"> {{__('dashboard.add_grade')}} </span>  
                                    </a>
                                </li>
                               
                            </ul>
                        </li>
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <i class="bi bi-house-add-fill"></i>
                                <i class="fa-solid fa-book-medical m-1"></i>
                                <span class="side-menu__label"> {{__('dashboard.grade')}} </span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1" >
                                
                                <li class="slide has-sub">
                                    <a href="{{route('grades.index')}}" class="side-menu__item"> 
                                        <i class="bi bi-house-add-fill"></i>
                                        {{-- <i class="fa-solid fa-person-circle-plus"></i> --}}
                                        <span class="p-1">{{__('dashboard.all_grade')}}</span>
                                        </a>
                                        
                                </li>
                                <li class="slide">
                                    <a href="{{route('grades.create')}}" class="side-menu__item">
                                        
                                      <span class="p-1"> {{__('dashboard.add_grade')}} </span>  
                                    </a>
                                </li>
                               
                            </ul>
                        </li>
                    </ul>
                    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                            width="24" height="24" viewBox="0 0 24 24">
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

        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="input-group">
                            <a href="javascript:void(0);" class="input-group-text" id="Search-Grid"><i
                                    class="fe fe-search header-link-icon fs-18"></i></a>
                            <input type="search" class="form-control border-0 px-2" placeholder="Search"
                                aria-label="Username">
                            <a href="javascript:void(0);" class="input-group-text" id="voice-search"><i
                                    class="fe fe-mic header-link-icon"></i></a>
                            <a href="javascript:void(0);" class="btn btn-light btn-icon" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fe fe-more-vertical"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Separated link</a></li>
                            </ul>
                        </div>
                        <div class="mt-4">
                            <p class="font-weight-semibold text-muted mb-2">Are You Looking For...</p>
                            <span class="search-tags"><i class="fe fe-user me-2"></i>People<a href="javascript:void(0)"
                                    class="tag-addon"><i class="fe fe-x"></i></a></span>
                            <span class="search-tags"><i class="fe fe-file-text me-2"></i>Pages<a
                                    href="javascript:void(0)" class="tag-addon"><i class="fe fe-x"></i></a></span>
                            <span class="search-tags"><i class="fe fe-align-left me-2"></i>Articles<a
                                    href="javascript:void(0)" class="tag-addon"><i class="fe fe-x"></i></a></span>
                            <span class="search-tags"><i class="fe fe-server me-2"></i>Tags<a href="javascript:void(0)"
                                    class="tag-addon"><i class="fe fe-x"></i></a></span>
                        </div>
                        <div class="my-4">
                            <p class="font-weight-semibold text-muted mb-2">Recent Search :</p>
                            <div class="p-2 border br-5 d-flex align-items-center text-muted mb-2 alert">
                                <a href="notifications.html"><span>Notifications</span></a>
                                <a class="ms-auto lh-1" href="javascript:void(0);" data-bs-dismiss="alert"
                                    aria-label="Close"><i class="fe fe-x text-muted"></i></a>
                            </div>
                            <div class="p-2 border br-5 d-flex align-items-center text-muted mb-2 alert">
                                <a href="alerts.html"><span>Alerts</span></a>
                                <a class="ms-auto lh-1" href="javascript:void(0);" data-bs-dismiss="alert"
                                    aria-label="Close"><i class="fe fe-x text-muted"></i></a>
                            </div>
                            <div class="p-2 border br-5 d-flex align-items-center text-muted mb-0 alert">
                                <a href="mail.html"><span>Mail</span></a>
                                <a class="ms-auto lh-1" href="javascript:void(0);" data-bs-dismiss="alert"
                                    aria-label="Close"><i class="fe fe-x text-muted"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group ms-auto">
                            <button class="btn btn-sm btn-primary-light">Search</button>
                            <button class="btn btn-sm btn-primary">Clear Recents</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Start -->
        <footer class="footer mt-auto py-3 bg-white text-center">
            <div class="container">
                <span class="text-muted"> Copyright ©
                </span>
            </div>
        </footer>
        <!-- Footer End -->

    </div>


    <!-- Scroll To Top -->
    <div class="scrollToTop">
        <span class="arrow"><i class="ri-arrow-up-s-fill fs-20"></i></span>
    </div>
    <div id="responsive-overlay"></div>
    <!-- Scroll To Top -->

    <!-- Popper JS -->
    <script src="{{asset('assets/libs/@popperjs/core/umd/popper.min.js')}}"></script>

    <!-- Bootstrap JS -->
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Defaultmenu JS -->
    <script src="{{asset('assets/js/defaultmenu.min.js')}}"></script>

    <!-- Node Waves JS-->
    <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

    <!-- Sticky JS -->
    <script src="{{asset('assets/js/sticky.js')}}"></script>

    <!-- Simplebar JS -->
    <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/js/simplebar.js')}}"></script>

    <!-- Color Picker JS -->
    <script src="{{asset('assets/libs/@simonwep/pickr/pickr.es5.min.js')}}"></script>



     <!-- JSVector Maps JS -->
    <script src="{{asset('assets/libs/jsvectormap/js/jsvectormap.min.js')}}"></script>

    <!-- JSVector Maps MapsJS -->
    <script src="{{asset('assets/libs/jsvectormap/maps/world-merc.js')}}"></script>

    <!-- Apex Charts JS -->
    <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>

    <!-- Chartjs Chart JS -->
    <script src="{{asset('assets/libs/chart.js/chart.min.js')}}"></script> 

    <!-- CRM-Dashboard -->
     {{-- <script src="{{asset('assets/js/crm-dashboard.js')}}"></script> --}}

    <script src="{{asset('js/axios.js')}}"></script>
    <!-- Toastr -->
    <script src="{{asset('js/toastr.min.js')}}"></script>
    <!-- Custom-Switcher JS -->
    <script src="{{asset('assets/js/custom-switcher.min.js')}}"></script>

    <!-- Custom JS -->
    <script src="{{asset('assets/js/custom.js')}}"></script> 
    @yield('scripts')
    
</body>

</html>