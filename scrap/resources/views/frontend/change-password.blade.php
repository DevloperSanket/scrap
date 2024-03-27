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
                    <h3 class="mb-3">Forget Password</h3>
                    <form method="post" id="setpassword">
                        @csrf
                        <div class="form-outline mb-1">

                            <div class="form-outline mb-2">
                                <div class="input-group">
                                    <input type="password" id="form3Example4" name="password" class="form-control"
                                        placeholder="Enter password" />
                                    <span class="input-group-text toggle-password"><i
                                            class="fa-sharp fa-solid fa-eye-slash"></i></span>
                                </div>
                                <span class="text-danger error-text password_error"></span>
                            </div>

                            <div class="form-outline mb-2">
                                <div class="input-group">
                                    <input type="password" id="form3Example5" name="password-confirm"
                                        class="form-control" placeholder="Enter confirm password" />
                                    <span class="input-group-text toggle-password-icon"><i
                                            class="fa-sharp fa-solid fa-eye-slash"></i></span>
                                </div>
                                <span class="text-danger error-text password-confirm_error"></span>
                            </div>
                            <div class="text-center text-lg-start mt-1">
                                <button type="submit" class="btn text-center btn-success mr-1"
                                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Submit</button>
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
        $('#setpassword').submit(function(e) {
            e.preventDefault();
            $('.error-text').text('');

            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{ route('resetpassword') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    }).then(() => {
                        window.location.href = "{{ route('login') }}";
                    });
                    $('#setpassword')[0].reset();
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
