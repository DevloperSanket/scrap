<x-frontend-header />
<div class="container">
    <div class="row">
        <div class="col-12 mt-4">
            <h3 class="text-decoration-underline">All Scrap</h3>
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
            <div class="card m-1" style="width: 18rem;">
                <img src="{{ asset('frontend/theam/assets/images/scrap-type/cotton.jpg') }}" height="120px" class="card-img-top"
                    alt="...">

                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-center">Cotton Clothes</h5>
                </div>
            </div>
            <div class="card m-1" style="width: 18rem;">
                <img src="{{ asset('frontend/theam/assets/images/scrap-type/mpl-plastic.jpg') }}" height="120px" class="card-img-top"
                    alt="...">

                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-center">MLP - Plastic</h5>
                </div>
            </div>

            <div class="card m-1" style="width: 18rem;">
                <img src="{{ asset('frontend/theam/assets/images/scrap-type/newspaper.jpg') }}" height="120px" class="card-img-top"
                    alt="...">

                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-center">Newspaper</h5>
                </div>
            </div>
            <div class="card m-1" style="width: 18rem;">
                <img src="{{ asset('frontend/theam/assets/images/scrap-type/Carton-box.jpg') }}" height="120px" class="card-img-top"
                    alt="...">

                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-center">Carton (Corrugated Box)</h5>
                </div>
            </div>
            <div class="card m-1" style="width: 18rem;">
                <img src="{{ asset('frontend/theam/assets/images/scrap-type/oil-dabba.jpg') }}" height="120px" class="card-img-top"
                    alt="...">

                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-center">Oil Daba (Maximum Qty-5)</h5>
                </div>
            </div>
            <div class="card m-1" style="width: 18rem;">
                <img src="{{ asset('frontend/theam/assets/images/scrap-type/notebooks.jpg') }}" height="120px" class="card-img-top"
                    alt="...">

                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-center">Notebooks / Books</h5>
                </div>
            </div>
            
        </div>
    </div>
</div>
<x-frontend-footer />
