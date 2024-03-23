<x-admin-header />
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">User Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-md-12">
                <div class="row">
                    <!-- Sales Card -->
                    <div class="col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body pb-0">
                                <h5 class="card-title">Total Scrap<span></span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-trash2-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $allScrap }}</h6>
                                    </div>
                                </div>
                                <a class="dashboard-record" href="{{ route('scrap.index') }}">All Records</a>
                            </div>
                        </div>

                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body pb-4">
                                <h5 class="card-title">Pending Request<span></span></h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-arrow-counterclockwise"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $pendingScrap }}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-md-4">

                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Inproccess Request<span></span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-check"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $acceptedScrap }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- End Customers Card -->
                    <div class="col-md-4 ">
                        <div class="card info-card revenue-card">
                            <div class="card-body pb-4">
                                <h5 class="card-title">Completed Request<span></span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $completedScrap }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- End Customers Card -->
                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>

</main><!-- End #main -->
<x-admin-footer />
