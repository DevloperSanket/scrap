<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devgren - Gardening and Landscaping HTML Template</title>
    <!-- Favicon img -->
    <link rel="shortcut icon" href="{{asset('frontend/theam/assets/images/favicon.png')}}">
    <!-- Bootstarp min css -->
    <link rel="stylesheet" href="{{asset('frontend/theam/assets/css/bootstrap.min.css')}}">
    <!-- All min css -->
    <link rel="stylesheet" href="{{asset('frontend/theam/assets/css/all.min.css')}}">
    <!-- Swiper bundle min css -->
    <link rel="stylesheet" href="{{asset('frontend/theam/assets/css/swiper-bundle.min.css')}}">
    <!-- Magnigic popup css -->
    <link rel="stylesheet" href="{{asset('frontend/theam/assets/css/magnific-popup.css')}}">
    <!-- Animate css -->
    <link rel="stylesheet" href="{{asset('frontend/theam/assets/css/animate.css')}}">
    <!-- Nice select css -->
    <link rel="stylesheet" href="{{asset('frontend/theam/frontend/theam/assets/css/nice-select.css')}}">
    <!-- Style css -->
    <link rel="stylesheet" href="{{asset('frontend/theam/assets/css/style.css')}}">
</head>

<body>

    <!-- Preloader area start -->
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="loading-icon text-center d-flex flex-column align-items-center justify-content-center">
                    <img class="loading-logo" src="{{asset('frontend/theam/assets/images/preloader.svg')}}" alt="icon">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader area end -->

    <!-- Header area start here -->
    <header class="header header-five">
        <div class="header-top d-none d-lg-block">
            <div class="container">
                <div class="header-top-wrp">
                    <div class="logo-menu">
                        <a href="index.html" class="logo">
                            <img src="{{asset('frontend/theam/assets/images/logo/logo.jpg')}}" height="50px" alt="logo">
                        </a>
                    </div>
                    <div class="d-flex align-items-center">
                        <ul class="info">
                            <li><i class="fa-solid fa-paper-plane"></i> <a href="#0">info.company@gmail.com</a></li>
                            <li class="bor-left ms-4 ps-4"><i class="fa-solid fa-location-dot"></i> <a href="#0">85
                                    Ketch
                                    Harbour RoadBensalem, PA 19020</a>
                            </li>
                        </ul>
                        <ul class="link-info ml-65">
                            <li class="bor-right"><a href="#0"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li class="bor-right"><a href="#0"><i class="fa-brands fa-twitter"></i></a></li>
                            <li class="bor-right"><a href="#0"><i class="fa-brands fa-linkedin-in"></i></a></li>
                            <li><a href="#0"><i class="fa-brands fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-section">
            <div class="container">
                <div class="header-wrapper">
                    <div class="side-bars d-none d-xl-block">
                        <i id="openButton" class="text-white fa-light fa-bars-sort"></i>
                    </div>
                    <div class="logo-menu d-block d-xl-none">
                        <a href="index.html" class="logo">
                            <img src="{{asset('frontend/theam/assets/images/logo/logo-light.svg')}}" alt="logo">
                        </a>
                    </div>
                    <div class="header-bar d-xl-none">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <ul class="main-menu">
                        <li>
                            <a class="text-white" href="#">Home <i class="fas fa-chevron-down"></i></a>
                            <ul class="sub-menu">
                                <li><a href="index.html">Home One</a></li>
                                <li><a href="index-2.html">Home Two</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="text-white" href="#">About Us <i class="fas fa-chevron-down"></i></a>
                            <ul class="sub-menu">
                                <li><a href="about.html">About One</a></li>
                                <li><a href="about-2.html">About Two</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="text-white" href="#">Services <i class="fas fa-chevron-down"></i></a>
                            <ul class="sub-menu">
                                <li><a href="service.html">Service One</a></li>
                                <li><a href="service-2.html">Service Two</a></li>
                                <li><a href="service-single.html">Service Details</a></li>
                            </ul>
                        </li>
                        <li>
                            <a id="mega-menu-btn" class="text-white" href="#">Pages <i
                                    class="fas fa-chevron-down"></i></a>
                            <ul class="sub-menu">
                                <li class="d-block d-xl-none"><a href="project.html">Our Project 01</a></li>
                                <li class="d-block d-xl-none"><a href="project-2.html">Our Project 02</a></li>
                                <li class="d-block d-xl-none"><a href="project-single.html">Project Details</a></li>
                                <li class="d-block d-xl-none"><a href="donation.html">Donation 01</a></li>
                                <li class="d-block d-xl-none"><a href="donation-2.html">Donation 02</a></li>
                                <li class="d-block d-xl-none"><a href="donation-single.html">Donation Details</a></li>
                                <li class="d-block d-xl-none"><a href="event.html">Events 01</a></li>
                                <li class="d-block d-xl-none"><a href="event-2.html">Events 01</a></li>
                                <li class="d-block d-xl-none"><a href="event-single.html">Events Details</a></li>
                                <li class="d-block d-xl-none"><a href="team.html">Our Teams 01</a></li>
                                <li class="d-block d-xl-none"><a href="team-2.html">Our Teams 02</a></li>
                                <li class="d-block d-xl-none"><a href="team-single.html">Our Teams Details</a></li>
                                <li class="d-block d-xl-none"><a href="faq.html">FAQ</a></li>
                                <li class="d-block d-xl-none"><a href="login.html">Login / Register</a></li>
                                <li class="d-block d-xl-none"><a href="error.html">404 Error</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="text-white" href="#">Blog <i class="fas fa-chevron-down"></i></a>
                            <ul class="sub-menu">
                                <li class="sub_menu_wrp d-none d-xl-block"><a href="#">Blog Grid <i
                                            class="fas fa-chevron-right float-end"></i></a>
                                    <ul class="sub_sub_menu">
                                        <li><a href="blog-2.html">2 Columns</a></li>
                                        <li><a href="blog-3.html">3 Columns</a></li>
                                    </ul>
                                </li>
                                <li class="d-block d-xl-none"><a href="blog-2.html">Blog Grid One</a></li>
                                <li class="d-block d-xl-none"><a href="blog-3.html">Blog Grid Two</a></li>
                                <li class="sub_menu_wrp d-none d-xl-block"><a href="#">Blog Standard <i
                                            class="fas fa-chevron-right float-end"></i></a>
                                    <ul class="sub_sub_menu">
                                        <li><a href="blog-left.html">Left SideBar</a></li>
                                        <li><a href="blog.html">Right SideBar</a></li>
                                    </ul>
                                </li>
                                <li class="d-block d-xl-none"><a href="blog.html">Blog Standard One</a></li>
                                <li class="d-block d-xl-none"><a href="blog-left.html">Blog Standard Two</a></li>
                                <li class="sub_menu_wrp d-none d-xl-block"><a href="#">Blog Details <i
                                            class="fas fa-chevron-right float-end"></i></a>
                                    <ul class="sub_sub_menu">
                                        <li><a href="blog-single-left.html">Left SideBar</a></li>
                                        <li><a href="blog-single.html">Right SideBar</a></li>
                                    </ul>
                                </li>
                                <li class="d-block d-xl-none"><a href="blog-single.html">Blog Details</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="text-white" href="contact.html">Contact Us</a>
                        </li>
                        <li class="menu-btn">
                            <a href="contact.html"><span>Get a quote</span> <i class="fa-solid fa-angles-right"></i></a>
                        </li>
                        <li class="menu_info ms-0">
                            <i class="fa-solid call_ico fa-phone-volume"></i>
                            <div class="call_info">
                                <span>Call Any Time</span>
                                <a class="d-block p-0" href="tel:+022659302003">+02 2659 302 003</a>
                            </div>
                        </li>
                    </ul>
                    <!-- Mega menu area start here -->
                    <div class="mega-menu-area d-none d-xl-block">
                        <div class="container">
                            <div class="mega-menu">
                                <div class="row g-4 justify-content-between">
                                    <div class="col-md-2">
                                        <div class="mega-menu__item">
                                            <h5 class="primary-color">Our Project</h5>
                                            <ul>
                                                <li><a href="project.html">Our Project 01</a></li>
                                                <li><a href="project-2.html">Our Project 02</a></li>
                                                <li><a href="project-single.html">Project Details</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mega-menu__item">
                                            <h5 class="primary-color">Donation</h5>
                                            <ul>
                                                <li><a href="donation.html">Donation 01</a></li>
                                                <li><a href="donation-2.html">Donation 02</a></li>
                                                <li><a href="donation-single.html">Donation Details</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mega-menu__item">
                                            <h5 class="primary-color">Our Events</h5>
                                            <ul>
                                                <li><a href="event.html">Events 01</a></li>
                                                <li><a href="event-2.html">Events 02</a></li>
                                                <li><a href="event-single.html">Events Details</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mega-menu__item">
                                            <h5 class="primary-color">Team Members</h5>
                                            <ul>
                                                <li><a href="team.html">Our Teams 01</a></li>
                                                <li><a href="team-2.html">Our Teams 02</a></li>
                                                <li><a href="team-single.html">Team Details</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mega-menu__item float-end">
                                            <h5 class="primary-color">More Pages</h5>
                                            <ul>
                                                <li><a href="faq.html">FAQ</a></li>
                                                <li><a href="login.html">Login / Register</a></li>
                                                <li><a href="error.html">404 Error</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Mega menu area end here -->
                </div>
            </div>
        </div>
    </header>
    <!-- Header area end here -->

    <!-- Sidebar area start here -->
    <div id="targetElement" class="side_bar slideInRight side_bar_hidden">
        <div class="side_bar_overlay"></div>
        <div class="logo mb-30">
            <img src="{{asset('frontend/theam/assets/images/logo/logo-mix.svg')}}" alt="logo">
        </div>
        <p class="text-justify">The foundation of any road is the subgrade, which provides a stable base for the road
            layers above. Proper compaction of
            the subgrade is crucial to prevent settling and ensure long-term road stability.</p>
        <ul class="info py-4 mt-65 bor-top bor-bottom">
            <li><i class="fa-solid primary-color fa-location-dot"></i> <a href="#0">example@example.com</a>
            </li>
            <li class="py-4"><i class="fa-solid primary-color fa-phone-volume"></i> <a href="tel:+022659302003">+02 2659
                    302 003</a>
            </li>
            <li><i class="fa-solid primary-color fa-paper-plane"></i> <a href="#0">info.company@gmail.com</a></li>
        </ul>
        <div class="social-icon mt-65">
            <a href="#0"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#0"><i class="fa-brands fa-twitter"></i></a>
            <a href="#0"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="#0"><i class="fa-brands fa-instagram"></i></a>
        </div>
        <button id="closeButton" class="text-white"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <!-- Sidebar area end here -->



   