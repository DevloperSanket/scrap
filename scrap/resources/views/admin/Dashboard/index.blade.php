<x-admin-header />
<main id="main" class="main">
    <section class="section dashboard">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="row">

            <!-- Left side columns -->
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body pb-0">
                                <h5 class="card-title">Total Register Users<span></span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $allregisterUser }}</h6>
                                    </div>
                                </div>
                                <a class="dashboard-record" href="{{ route('dashboard.show') }}">All Records</a>
                            </div>
                        </div>

                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-md-4 ">
                        <div class="card info-card revenue-card">
                            <div class="card-body pb-4">
                                <h5 class="card-title">Active Users<span></span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $activeUser }}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-md-4">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Deactive Users <span></span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $deactiveUser }}</h6>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>



    {{-- Direct Enquiry --}}
    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-md-12">
                <div class="row">
                    <h2>Direct Sell Enquiries</h2>
                    <div class="col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body pb-0">
                                <h5 class="card-title">New Enquiry<span></span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-box-arrow-right"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $directSellPending }}</h6>
                                    </div>
                                </div>
                                <a class="dashboard-record" href="{{ route('dashboard.showdirectsell') }}">All Scraps</a>
                            </div>
                        </div>

                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-md-4 ">
                        <div class="card info-card revenue-card">
                            <div class="card-body pb-4">
                                <h5 class="card-title">Accepted<span></span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-check"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $directSellAccepted }}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="card info-card revenue-card">
                            <div class="card-body pb-4">
                                <h5 class="card-title">Completed<span></span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $directSellCompleted }}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </section>



    {{-- Registered Enquiry --}}
    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-md-12">
                <div class="row">
                    <h2>Registered Sell Enquiries</h2>
                    <div class="col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body pb-0">
                                <h5 class="card-title">New Enquiry<span></span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-box-arrow-right"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $registeredSellPending }}</h6>
                                    </div>
                                </div>
                                <a class="dashboard-record" href="{{ route('dashboard.showregisteredsell') }}">All Scraps</a>
                            </div>
                        </div>

                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-md-4 ">
                        <div class="card info-card revenue-card">
                            <div class="card-body pb-4">
                                <h5 class="card-title">Accepted<span></span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-check"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $registeredSellAccepted }}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="card info-card revenue-card">
                            <div class="card-body pb-4">
                                <h5 class="card-title">Completed<span></span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $registeredSellCompleted }}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </section>

</main>
<x-admin-footer />
