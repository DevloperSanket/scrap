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
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                    </span>
                    <h3 class="mb-3">Verify OTP</h3>
                    <form method="post" id="setotp">
                        @csrf
                        <div class="form-outline mb-1">
                        <div class="form-outline mb-2">
                            <input type="text" id="form3Example3" name="otp" class="form-control"
                                placeholder="Enter a valid OTP" />
                                <span class="text-danger error-text otp_error"></span>
                        </div>
                        <div class="text-center text-lg-start mt-1">
                            <button type="submit" class="btn text-center btn-success mr-1"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Submit</button>
                                <a href="#" class="link ml-20" >Resend OTP</a>
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
        $('#setotp').submit(function(e) {
            e.preventDefault();
            $('.error-text').text('');

            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{ route('verify') }}",
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
                    $('#setotp')[0].reset();
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