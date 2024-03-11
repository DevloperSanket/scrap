<x-frontend-header />
<div class="container">
    <section class="border-bottom pb-5">
        <div class="container-fluid h-custom ">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="{{ asset('frontend/theam/assets/images/logo/logo.png') }}" class="img-fluid"
                        alt="Sample image" style="height: 280px;">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 pt-1">
                    <span>
                        @if (session('success'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                    </span>
                    <h3 class="mb-3">Create Account</h3>
                    <form method="post" action="{{ route('register') }}">
                        @csrf
                        <!-- Name input -->
                        <div class="form-outline mb-3">
                            {{-- <label class="form-label" for="form3Example3">Name</label> --}}
                            <input type="text" id="form3Example3" name="name" class="form-control"
                                placeholder="Enter your name" />
                            @error('name')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="form-outline mb-3">
                            {{-- <label class="form-label" for="form3Example3">Email</label> --}}
                            <input type="email" id="form3Example3" name="email" class="form-control"
                                placeholder="Enter your email address" />
                            @error('email')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="form-outline mb-3">
                            {{-- <label class="form-label" for="form3Example3">City</label> --}}
                            <input type="text" id="form3Example3" name="city" class="form-control"
                                placeholder="Enter your city" />
                            @error('city')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="form-outline mb-3">
                            {{-- <label class="form-label" for="form3Example3">Pin Code</label> --}}
                            <input type="text" id="form3Example3" name="pincode" class="form-control"
                                placeholder="Enter your pincode" />
                            @error('pincode')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="form-outline mb-3">
                            {{-- <label class="form-label" for="form3Example3">Address</label> --}}
                            <textarea name="address" class="form-control" placeholder="Enter Address"></textarea>
                            @error('address')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="form-outline mb-3">
                            <div class="input-group">
                                <input type="password" id="form3Example4" name="password" class="form-control"
                                    placeholder="Enter password" />
                                <span class="input-group-text toggle-password"><i class="fa-sharp fa-solid fa-eye-slash"></i></span>
                            </div>
                            @error('password')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="text-center text-lg-start mt-4">
                            <button type="submit" class="btn btn-success"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                            <p class="small fw-bold mt-1 pt-1 mb-0">Allready have an account? <a
                                    href="{{ route('login') }}" class="link-danger">Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<x-frontend-footer />
