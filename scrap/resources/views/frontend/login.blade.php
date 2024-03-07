<x-frontend-header />
<div class="container">
    {{-- <div class="row">
        <div class="col-6 offset-md-3 mt-5">
            <span>
                @if (session('success'))
                <div class="alert alert-danger" role="alert">
                    {{ session('success') }}
                </div>
                @endif
            </span>
            <form action="{{route('login')}}" method="post">
                @csrf
                <div class="card ">
                    <h6 class="h5 card-title text-center">Login Here..</h6>
                    <div class="card-body">
                        <div class="form-group mt-3">
                            <input type="email" name="email" class="form-control" placeholder="Enter Email">
                            @error('email')
                            <div class="alert alert-danger" style="margin-bottom: 0px;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <input type="password" name="password" class="form-control" placeholder="Enter Password">
                            @error('password')
                            <div class="alert alert-danger" style="margin-bottom: 0px;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <a href="{{route('register')}}" class="text-success nav-link mt-2">Create Account</a>

                        <div class="form-group mt-3 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div> --}}
    <section class="border-bottom pb-5">
        <div class="container-fluid h-custom ">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5 pt-0">
                    <img src="{{ asset('frontend/theam/assets/images/logo/logo.png') }}"
                        class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 pt-5">
                    <form>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="form3Example3" class="form-control form-control-lg"
                                placeholder="Enter a valid email address" />
                            <label class="form-label" for="form3Example3">Email address</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <input type="password" id="form3Example4" class="form-control form-control-lg"
                                placeholder="Enter password" />
                            <label class="form-label" for="form3Example4">Password</label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value=""
                                    id="form2Example3" />
                                <label class="form-check-label" for="form2Example3">
                                    Remember me
                                </label>
                            </div>
                            <a href="#!" class="text-body">Forgot password?</a>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="button" class="btn btn-success btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="#!"
                                    class="link-danger">Register</a></p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        
    </section>
</div>
<x-frontend-footer />
