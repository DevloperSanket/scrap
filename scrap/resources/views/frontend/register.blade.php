<x-frontend-header />
<div class="container">
    {{-- <div class="row">
        <div class="col-6 offset-md-3 mt-5">
            <form action="{{route('register')}}" method="post">
                @csrf
                <div class="card">
                    <h6 class="h5 card-title text-center">Register Here..</h6>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Enter Name">
                            @error('name')
                            <div class="alert alert-danger" style="margin-bottom: 0px;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
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
                        <a href="{{route('login')}}" class="text-success nav-link mt-2">Allready have account</a>

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
                    <img src="{{ asset('frontend/theam/assets/images/logo/logo.png') }}" height="250px" width="300px" class="img-fluid"
                        alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 pt-5">
                    <span>
                        @if (session('success'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                    </span>
                    <form method="post" action="{{ route('register') }}">
                        @csrf
                        <!-- Name input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3">Name</label>
                            <input type="text" id="form3Example3" name="name" class="form-control form-control-lg"
                                placeholder="Enter your name" />
                            @error('name')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3">Email</label>
                            <input type="email" id="form3Example3" name="email" class="form-control form-control-lg"
                                placeholder="Enter your email address" />
                            @error('email')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="form3Example4">Password</label>
                            <input type="password" id="form3Example4" name="password"
                                class="form-control form-control-lg" placeholder="Enter password" />
                            @error('password')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-success btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Allready have an account? <a
                                    href="{{ route('login') }}" class="link-danger">Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
</div>
<x-frontend-footer />