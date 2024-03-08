<x-frontend-header />
<div class="container">
    <div class="row">
        <div class="col-12 mt-4">
            <h3>Sell Your Scrap</h3>
        </div>

        <div class="row mt-3 mx-3 gradient-custom" style="margin-top:25px ;">
            <div class="col-md-3">
              <div style="margin-top: 50px; margin-left: 10px;" class="text-center">
                <img src="{{ asset('frontend/theam/assets/images/logo/logo.png') }}" height="90px" alt="Logo">
                <h3 class="mt-3 text-white">Welcome</h3>
                <p class="white-text">You are 30 seconds away from compleating your order!</p>
              </div>
              {{-- <div class="text-center">
                <button type="submit" class="btn btn-white btn-rounded back-button">Go back</button>
              </div> --}}
          
          
            </div>
            <div class="col-md-9 justify-content-center">
              <div class="card card-custom pb-4">
                <div class="card-body mt-0 mx-5">
                  <div class="text-center mb-3 pb-2 mt-3">
                    <h4 style="color: white ;">Scrap Details</h4>
                  </div>
          
                  <form class="mb-0">
          
                    <div class="row mb-4">
                      <div class="col">
                        <div class="form-outline">
                          <input type="text" id="form9Example1" class="form-control input-custom" />
                          <label class="form-label text-white" for="form9Example1">First name</label>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-outline">
                          <input type="text" id="form9Example2" class="form-control input-custom" />
                          <label class="form-label text-white" for="form9Example2">Last name</label>
                        </div>
                      </div>
                    </div>
                    <div class="row mb-4">
                      <div class="col">
                        <div class="form-outline">
                          <input type="text" id="form9Example3" class="form-control input-custom" />
                          <label class="form-label text-white" for="form9Example3">City</label>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-outline">
                          <input type="text" id="form9Example4" class="form-control input-custom" />
                          <label class="form-label text-white" for="form9Example4">Zip</label>
                        </div>
                      </div>
                    </div>
                    <div class="row mb-4">
                      <div class="col">
                        <div class="form-outline">
                          <input type="text" id="form9Example6" class="form-control input-custom" />
                          <label class="form-label text-white" for="form9Example6">Address</label>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-outline">
                          <input type="email" id="typeEmail" class="form-control input-custom" />
                          <label class="form-label text-white" for="typeEmail">Email</label>
                        </div>
                      </div>
                    </div>
          
                    <div class="float-end ">
                      <!-- Submit button -->
                      <button type="submit" class="btn text-white btn-rounded"
                        style="background-color: #7872ce;">Sell Scrap</button>
                    </div>
          
                  </form>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
<x-frontend-footer />