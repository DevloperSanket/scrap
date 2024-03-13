<x-frontend-header />
<section class="py-5" >
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 10px;">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold">Sell <span style="color:rgb(52, 170, 52)">Scrap</span></p>

                                <form class="mx-1 mx-md-4">
                                    <div class="d-flex flex-row align-items-center mb-3">
                                        <div class="form-outline flex-fill">
                                            <input type="text" id="form3Example1c" class="form-control"
                                                name="name" placeholder="Enter Name" />
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-3">
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="email" id="form3Example3c" class="form-control"
                                                name="email" placeholder="Enter Email">
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-3">

                                        <div class="form-outline flex-fill mb-0">
                                            <input type="city" id="form3Example4c" class="form-control"
                                                name="city" placeholder="Enter City" />
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-3">
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="form3Example4c" class="form-control"
                                                name="pincode" placeholder="Enter Pincode" />
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-3">
                                        <div class="form-outline flex-fill">
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected>Select Scrap Type</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-3">
                                        <div class="form-outline flex-fill mb-0">
                                          <label class="form-label" for="form3Example4cd">Select Scrap Images (Optional) </label>
                                            <input type="file" id="form3Example4c" class="form-control"
                                                name="file[]" placeholder="Enter Pincode" />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-3">
                                      <div class="form-outline flex-fill mb-0">
                                          <textarea name="address" class="form-control" placeholder="Enter Address"></textarea>
                                      </div>
                                  </div>

                                    <div class="d-flex justify-content-center mx-4">
                                        <button type="button" class="btn btn-success">Submit</button>
                                    </div>
                                </form>

                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                <img src="{{ asset('frontend/theam/assets/images/logo/scrap2.jpg') }}" class="img-fluid"
                                    alt="Sample image" style="height: 400px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<x-frontend-footer />
