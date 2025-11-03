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
    {{--
    <link rel="stylesheet" href="{{asset('assets/css/fontawesome.css')}}"> --}}
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
                            <a href="{{ route('home') }}" class="header-logo">
                                <img src="{{asset('assets/images/brand-logos/school.jpeg')}}" alt="logo"
                                    class="desktop-logo">
                                <img src="{{asset('assets/images/brand-logos/school.jpeg')}}" alt="logo"
                                    class="toggle-logo">
                                <img src="{{asset('assets/images/brand-logos/school.jpeg')}}" alt="logo"
                                    class="desktop-dark">
                                <img src="{{asset('assets/images/brand-logos/school.jpeg')}}" alt="logo"
                                    class="toggle-dark">
                                <img src="{{asset('assets/images/brand-logos/school.jpeg')}}" alt="logo"
                                    class="desktop-white">
                                <img src="{{asset('assets/images/brand-logos/school.jpeg')}}" alt="logo"
                                    class="toggle-white">
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
                    {{-- <div class="header-element header-search">
                        <!-- Start::header-link -->
                        <a href="javascript:void(0);" class="header-link" data-bs-toggle="modal"
                            data-bs-target="#searchModal">
                            <i class="bx bx-search-alt-2 header-link-icon"></i>
                        </a>
                        <!-- End::header-link -->
                    </div> --}}
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




                   
                                <x-notifications />
                               
                            





                    <!-- Start::header-element -->
                    <div class="header-element">
                        <!-- Start::header-link|dropdown-toggle -->
                        <a href="#" class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div class="me-sm-2 me-0">
                                    @if (Auth::user()->image)
                                    <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="img" width="32" height="32"
                                        class="rounded-circle">
                                    @else    
                                    <img src="{{ asset('assets/images/image.jpeg') }}" alt="img" width="32" height="32"
                                        class="rounded-circle">
                                    @endif    
                                </div>
                                <div class="d-sm-block d-none">
                                    <p class="fw-semibold mb-0 lh-1"> {{Auth::user()->first_name}}
                                        {{Auth::user()->last_name}} </p>
                                    <span class="op-7 fw-normal d-block mt-1" style="text-align: center">
                                        {{Auth::user()->type}}</span>
                                </div>
                            </div>
                        </a>
                        <!-- End::header-link|dropdown-toggle -->
                        <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                            aria-labelledby="mainHeaderProfile">
                            <li><a class="dropdown-item d-flex" href="{{ route('users.edit', auth()->user()) }}"><i
                                        class="ti ti-user-circle fs-18 me-2 op-7"></i>Profile</a></li>
                            <li><a class="dropdown-item d-flex" id="logout" style="cursor: pointer;" onclick="logout()">
                                    <i class="ti ti-logout fs-18 me-2 op-7"></i>
                                    logout
                                </a></li>
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
                <a href="{{ route('home') }}" class="header-logo">
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
                    <ul class="main-menu">
                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">{{ __('dashboard.main') }}</span></li>
                        <!-- End::slide__category -->

                        <!-- Start::slide -->
                        @if (Auth::user()->type == 'admin' or Auth::user()->type == 'secretary')
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <i class="fa-solid fa-user m-1"></i>
                                <span class="side-menu__label"> {{__('Users')}} </span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">

                                <li class="slide has-sub">
                                    <a href="{{route('users.index')}}" class="side-menu__item">
                                        <i class="bi bi-house-add-fill"></i>
                                        {{-- <i class="fa-solid fa-person-circle-plus"></i> --}}
                                        <span class="p-1">{{__('All Users')}}</span>
                                    </a>

                                </li>
                                <li class="slide">
                                    <a href="{{route('users.create')}}" class="side-menu__item">

                                        <span class="p-1"> {{__('dashboard.add_user')}} </span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endif
                        @if (Auth::user()->type == 'secretary')
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <i class="bi bi-house-add-fill"></i>
                                <i class="fa-solid fa-book-medical m-1"></i>
                                <span class="side-menu__label"> {{__('dashboard.grade')}} </span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">

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
                        @endif
                        @if (Auth::user()->type == 'secretary')
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <i class="bi bi-house-add-fill"></i>
                                <i class="fa-solid fa-book-medical m-1"></i>
                                <span class="side-menu__label"> {{__('dashboard.classroom')}} </span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">

                                <li class="slide has-sub">
                                    <a href="{{route('classrooms.index')}}" class="side-menu__item">
                                        <i class="bi bi-house-add-fill"></i>
                                        {{-- <i class="fa-solid fa-person-circle-plus"></i> --}}
                                        <span class="p-1">{{__('dashboard.all_classroom')}}</span>
                                    </a>

                                </li>
                                <li class="slide">
                                    <a href="{{route('classrooms.create')}}" class="side-menu__item">

                                        <span class="p-1"> {{__('dashboard.add_class')}} </span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endif
                        @if (Auth::user()->type == 'secretary')
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <i class="bi bi-house-add-fill"></i>
                                <i class="fa-solid fa-book-medical m-1"></i>
                                <span class="side-menu__label"> Subjects </span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">

                                <li class="slide has-sub">
                                    <a href="{{route('subjects.index')}}" class="side-menu__item">
                                        <i class="bi bi-house-add-fill"></i>
                                        {{-- <i class="fa-solid fa-person-circle-plus"></i> --}}
                                        <span class="p-1">All Subjects</span>
                                    </a>

                                </li>
                                <li class="slide">
                                    <a href="{{route('subjects.create')}}" class="side-menu__item">

                                        <span class="p-1"> Add Subject </span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endif
                        @if (Auth::user()->type == 'secretary')
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <i class="bi bi-house-add-fill"></i>
                                <i class="fa-solid fa-book-medical m-1"></i>
                                <span class="side-menu__label"> Sub_teacher_class </span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">

                                <li class="slide has-sub">
                                    <a href="{{route('sub_teachers.index')}}" class="side-menu__item">
                                        <i class="bi bi-house-add-fill"></i>
                                        {{-- <i class="fa-solid fa-person-circle-plus"></i> --}}
                                        <span class="p-1">All sub_teachers</span>
                                    </a>

                                </li>
                                <li class="slide">
                                    <a href="{{route('sub_teachers.create')}}" class="side-menu__item">

                                        <span class="p-1"> Add sub_teachers </span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endif
                        @if (Auth::user()->type == 'teacher')
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <i class="bi bi-house-add-fill"></i>
                                <i class="fa-solid fa-book-medical m-1"></i>
                                <span class="side-menu__label"> Lectures </span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">

                                <li class="slide has-sub">
                                    <a href="{{route('lectures.index')}}" class="side-menu__item">
                                        <i class="bi bi-house-add-fill"></i>
                                        {{-- <i class="fa-solid fa-person-circle-plus"></i> --}}
                                        <span class="p-1">All Lectures</span>
                                    </a>

                                </li>
                                <li class="slide">
                                    <a href="{{route('lectures.create')}}" class="side-menu__item">

                                        <span class="p-1"> Add Lecture </span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endif
                        @if (Auth::user()->type !== 'student')
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <i class="bi bi-house-add-fill"></i>
                                <i class="fa-solid fa-book-medical m-1"></i>
                                <span class="side-menu__label">add Student to Class</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">

                                <li class="slide has-sub">
                                    <a href="{{route('class_students.index')}}" class="side-menu__item">
                                        <i class="bi bi-house-add-fill"></i>
                                        {{-- <i class="fa-solid fa-person-circle-plus"></i> --}}
                                        <span class="p-1 fs-11">All Student into Class</span>
                                    </a>

                                </li>
                                <li class="slide">
                                    <a href="{{route('class_students.create')}}" class="side-menu__item">

                                        <span class="p-1 fs-12"> Add Student to Class </span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endif
                        @if (Auth::user()->type == 'teacher')
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <i class="bi bi-house-add-fill"></i>
                                <i class="fa-solid fa-book-medical m-1"></i>
                                <span class="side-menu__label">Exams</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">

                                <li class="slide has-sub">
                                    <a href="{{route('exams.index')}}" class="side-menu__item">
                                        <i class="bi bi-house-add-fill"></i>
                                        {{-- <i class="fa-solid fa-person-circle-plus"></i> --}}
                                        <span class="p-1">All Exams</span>
                                    </a>

                                </li>
                                <li class="slide">
                                    <a href="{{route('exams.create')}}" class="side-menu__item">

                                        <span class="p-1"> Add Exam </span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endif
                        @if (Auth::user()->type == 'student')
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <i class="bi bi-house-add-fill"></i>
                                <i class="fa-solid fa-book-medical m-1"></i>
                                <span class="side-menu__label">Class</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">

                                <li class="slide has-sub">
                                    <a href="{{route('students.index')}}" class="side-menu__item">
                                        <i class="bi bi-house-add-fill"></i>
                                        {{-- <i class="fa-solid fa-person-circle-plus"></i> --}}
                                        <span class="p-1">Class</span>
                                    </a>

                                </li>


                            </ul>
                        </li>
                        @endif
                        @if (Auth::user()->type == 'admin')
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <i class="bi bi-house-add-fill"></i>
                                <i class="fa-solid fa-book-medical m-1"></i>
                                <span class="side-menu__label">History</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">

                                <li class="slide has-sub">
                                    <a href="{{route('history')}}" class="side-menu__item">
                                        <i class="bi bi-house-add-fill"></i>
                                        {{-- <i class="fa-solid fa-person-circle-plus"></i> --}}
                                        <span class="p-1">History</span>
                                    </a>

                                </li>


                            </ul>
                        </li>
                        @endif 
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

        {{-- <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModal" aria-hidden="true">
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
        </div> --}}
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
    <script>
        function logout(){

        $.ajax({
        url:"{{route('logout') }}",
        type:"POST",
        data: { _token:"{{ csrf_token() }}"},
        
        })
        location="/";
       }
    </script>
</body>

</html>