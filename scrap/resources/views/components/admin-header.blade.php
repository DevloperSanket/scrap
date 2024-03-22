<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>LaravelReady</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="{{ asset('admin/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('admin/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Vendor CSS Files -->

    <link href="{{ asset('admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('admin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('admin/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('admin/assets/css/style.css') }}" rel="stylesheet">

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="#" class="logo d-flex align-items-center">
                <img src="{{ asset('admin/assets/img/logo-small.png') }}" alt="">
                {{-- <span class="d-none d-lg-block"><b>Scarp</b> 24x7</span> --}}
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        {{-- <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div> --}}
        <!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li>
                <!-- End Search Icon-->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <img src="{{ 'admin/assets/img/profile-img.jpg' }}" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->name }}</h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('signout') }}">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->

    @if (Auth::user()->role == '1')
        <aside id="sidebar" class="sidebar">
            <ul class="sidebar-nav" id="sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('dashboard') }}">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li><!-- End Dashboard Nav -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('scrapcategory.index') }}">
                        <i class="bi bi-menu-button-wide"></i>
                        <span>Scrap Categories</span>
                        {{-- <i class="bi bi-chevron-down ms-auto"></i> --}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('pincode.index') }}">
                        <i class="bi bi-pin"></i><span>Pincode</span>
                    </a>
                </li><!-- End Pincode Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('card.index') }}">
                        <i class="bi bi-card-list"></i><span>Cards</span>
                    </a>
                </li><!-- End Card Nav -->


                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('driver.index') }}">
                        <i class="bi bi-car-front-fill"></i></i><span>Drivers</span>
                    </a>
                </li><!-- End driver Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('dashboard.showdirectsell') }}">
                        <i class="bi bi-box-arrow-in-right"></i><span>Direct Enquiry</span>
                    </a>
                </li><!-- End Direct Enquiry Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('dashboard.showregisteredsell')}}">
                        <i class="bi bi-journal-text"></i><span>Registerd Enquiry</span>
                    </a>
                </li><!-- End Direct Enquiry Nav -->

            
                
                <!-- End Icons Nav -->

            </ul>

        </aside><!-- End Sidebar-->
    @else
        <aside id="sidebar" class="sidebar">

            <ul class="sidebar-nav" id="sidebar-nav">

                <li class="nav-item">
                    <a class="nav-link " href="{{ route('user.dashboard') }}">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li><!-- End Dashboard Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('scrap.index') }}">
                        <i class="bi bi-menu-button-wide"></i>
                        <span>Sell Scrap</span>
                        {{-- <i class="bi bi-chevron-down ms-auto"></i> --}}
                    </a>

                </li><!-- End Components Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('profile.index') }}">
                        <i class="bi bi-person-square"></i><span>My Profile</span>
                    </a>
                </li>
                <!-- End Profile -->

            
            </ul>

        </aside><!-- End Sidebar-->
    @endif
