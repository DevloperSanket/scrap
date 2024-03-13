<x-frontend-header />
<div class="container mb-5">
    <section class="border-bottom pb-5">
        <div class="container-fluid h-custom ">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5 pt-0">
                    <img src="{{ asset('frontend/theam/assets/images/logo/logo.png') }}" height="250px" width="280px"
                        class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 pt-5">
                    <span>
                        @if (session('success'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                    </span>
                    <h3 class="mb-3">Login Here..</h3>
                    <form method="post" action="{{ route('login') }}" id="loginId">
                        @csrf
                        <div class="form-outline mb-4">
                            <input type="email" id="form3Example3" name="email" class="form-control"
                                placeholder="Enter a valid email address" />
                            @error('email')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="form-outline mb-4">
                            <div class="input-group">
                                <input type="password" id="form3Example4" name="password" class="form-control"
                                    placeholder="Enter password" />
                                <span class="input-group-text toggle-password"><i
                                        class="fa-sharp fa-solid fa-eye-slash"></i></span>
                            </div>
                            @error('password')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="text-center text-lg-start mt-3 pt-2">
                            <button type="submit" class="btn btn-success"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a
                                    href="{{ route('register') }}" class="link-danger">Register</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
</div>
<x-frontend-footer/>
<script>
    $(document).ready(function(){
        $('#loginId').submit(function(e) {
            e.preventDefault();
            $('.error-text').text('');
            var formData = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "{{ route('scrapcategory.store') }}",
                data: formData,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Form submitted successfully.'
                    }).then(() => {
                        window.location.href = "{{ route('scrapcategory.index') }}";
                    });
                    $('#myForm')[0].reset();
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
