<x-frontend-header />
<div class="container mb-5">
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
                    <form method="post" action="{{ route('register') }}" id="registerId">
                        @csrf
                        <!-- Name input -->
                        <div class="form-outline ">
                            <input type="text" id="form3Example3" name="name" class="form-control"
                                placeholder="Enter your name" />
                                <span class="text-danger error-text name_error"></span>
                        </div>
                        <div class="form-outline">
                            <input type="email" id="form3Example3" name="email" class="form-control"
                                placeholder="Enter your email address" />
                                <span class="text-danger error-text email_error"></span>
                        </div>
                        <div class="form-outline ">
                            <input type="text" id="form3Example3" name="city" class="form-control"
                                placeholder="Enter your city" />
                                <span class="text-danger error-text city_error"></span>
                        </div>
                        <div class="form-outline ">
                            <input type="text" id="form3Example3" name="pincode" class="form-control"
                                placeholder="Enter your pincode" />
                                <span class="text-danger error-text pincode_error"></span>
                        </div>
                        <div class="form-outline">
                            <textarea name="address" class="form-control" placeholder="Enter Address"></textarea>
                            <span class="text-danger error-text address_error"></span>
                        </div>
                        <div class="form-outline">
                            <div class="input-group">
                                <input type="password" id="form3Example4" name="password" class="form-control"
                                    placeholder="Enter password" />
                                <span class="input-group-text toggle-password"><i class="fa-sharp fa-solid fa-eye-slash"></i></span>
                            </div>
                            <span class="text-danger error-text password_error"></span>
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
<script>
    $(document).ready(function() {
        $('#registerId').submit(function(e) {
            e.preventDefault();
            $('.error-text').text('');
            var formData = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "{{ route('register') }}",
                data: formData,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Form submitted successfully.'
                    })
                    .then(() => {
                        window.location.href = "{{ route('dashboard') }}";
                    });
                    $('#registerId')[0].reset();
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('.' + key + '_error').text(value[0]);
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong! Please try again later.'
                        });
                    }
                }
            });
        });
    });
</script>
