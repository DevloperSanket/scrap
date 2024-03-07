<x-frontend-header />
<div class="container">
    <div class="row">
        <div class="col-12 mt-4">
            <h3>All Scrap</h3>
        </div>

        {{-- <div class="card col-3 m-1">
            <img src="{{ asset('frontend/theam/assets/images/scrap-type/cotton.jpg') }}" class="card-img-top img-fluid"
                height="150px" width="100%" alt="...">
            <div class="card-body">
                <h5 class="card-title text-center">Cotton Clothes</h5>
            </div>
        </div>

        <div class="card col-3 m-1">
            <img src="{{ asset('frontend/theam/assets/images/scrap-type/cotton.jpg') }}" class="card-img-top img-fluid"
                height="150px" width="100%" alt="...">
            <div class="card-body">
                <h5 class="card-title text-center">Cotton Clothes</h5>
            </div>
        </div>
        <div class="card col-3 m-1">
            <img src="{{ asset('frontend/theam/assets/images/scrap-type/cotton.jpg') }}" class="card-img-top img-fluid"
                height="150px" width="100%" alt="...">
            <div class="card-body">
                <h5 class="card-title text-center">Cotton Clothes</h5>
            </div>
        </div>
        <div class="card col-3 m-1">
            <img src="{{ asset('frontend/theam/assets/images/scrap-type/cotton.jpg') }}" class="card-img-top img-fluid"
                height="150px" width="100%" alt="...">
            <div class="card-body">
                <h5 class="card-title text-center">Cotton Clothes</h5>
            </div>
        </div> --}}

        <div class="container d-flex">
            <section class=" mx-2" style="max-width: 15rem;">
                <div class="card">
                    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                        <img src="{{asset('frontend/theam/assets/images/scrap-type/cotton.jpg')}}"
                            class="img-fluid" width="100%" />
                        <a href="#!">
                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold text-center"><a>Cotton Clothes</a></h5>
                    </div>
                </div>
            </section>
            <section class=" mx-2" style="max-width: 15rem;">
                <div class="card">
                    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                        <img src="{{asset('frontend/theam/assets/images/scrap-type/cotton.jpg')}}"
                            class="img-fluid" width="100%" />
                        <a href="#!">
                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold text-center"><a>Cotton Clothes</a></h5>
                    </div>
                </div>
            </section>
        </div>

    </div>
</div>
<x-frontend-footer />
