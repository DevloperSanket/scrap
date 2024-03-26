<x-admin-header />
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 mt-5">
                    <div class="card p-4 border border-3">
                        <div class="card-body">
                            <h4 class="text-center">Edit Password</h4>


                            <form id="userpasswordedit">
                                @csrf
                                <input type="hidden" value="{{ $userpassword->id }}" id="userpasswordId">
                                <div class="form-group mt-3">
                                    <div class="input-group">
                                        <input type="password" name="oldpassword" class="form-control" placeholder="Enter Old Password" id="form3Example4">
                                        <div class="input-group-append">
                                            <span class="input-group-text toggle-password1"><i
                                                class="bi bi-eye-slash-fill"></i></span>
                                        </div>
                                    </div>
                                    <span class="text-danger error-text oldpassword_error"></span>
                                </div>
                                <div class="form-group mt-3">
                                    <div class="input-group">
                                        <input type="password" name="newpassword" class="form-control" placeholder="New Password" id="form3Example5">
                                        <div class="input-group-append">
                                            <span class="input-group-text toggle-password2"><i
                                                class="bi bi-eye-slash-fill"></i></span>
                                        </div>
                                    </div>
                                    <span class="text-danger error-text newpassword_error"></span>
                                </div>
                                <div class="form-group mt-3">
                                    <div class="input-group">
                                        <input type="password" name="newpassword_confirmation" class="form-control" placeholder="Confirm Password" id="form3Example6">
                                        <div class="input-group-append">
                                            <span class="input-group-text toggle-password3"><i
                                                class="bi bi-eye-slash-fill"></i></span>
                                        </div>
                                    </div>
                                    <span class="text-danger error-text newpassword_confirmation_error"></span>
                                </div>
                                <div class="form-group mt-4 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<x-admin-footer />
<script>
    $(document).ready(function() {
        // Function to toggle password visibility for old password field
        $('.toggle-password1').click(function() {
            const $passwordField = $('#form3Example4');
            const type = $passwordField.attr('type') === 'password' ? 'text' : 'password';
            $passwordField.attr('type', type);
            $(this).find('i').toggleClass('bi-eye-slash-fill bi-eye-fill');
        });

        // Function to toggle password visibility for new password field
        $('.toggle-password2').click(function() {
            const $passwordField = $('#form3Example5');
            const type = $passwordField.attr('type') === 'password' ? 'text' : 'password';
            $passwordField.attr('type', type);
            $(this).find('i').toggleClass('bi-eye-slash-fill bi-eye-fill');
        });

        // Function to toggle password visibility for confirm password field
        $('.toggle-password3').click(function() {
            const $passwordField = $('#form3Example6');
            const type = $passwordField.attr('type') === 'password' ? 'text' : 'password';
            $passwordField.attr('type', type);
            $(this).find('i').toggleClass('bi-eye-slash-fill bi-eye-fill');
        });

        // Form submission handling
        $('#userpasswordedit').submit(function(e) {
            e.preventDefault();
            var newPassword = $('#form3Example5').val();
            var confirmPassword = $('#form3Example6').val();

            $('.confirmpassword_error').text('');

            if (newPassword !== confirmPassword) {
                $('.confirmpassword_error').text('The new password confirmation does not match.');
                return;
            }

            var formData = $(this).serialize(); // Serialize form data
            var id = $("#userpasswordId").val();
            $('.error-text').text('');
            $.ajax({
                type: 'POST',
                url: "{{ route('profile.updatepassword') }}",
                data: formData + '&id=' + id,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Password Updated successfully.'
                    }).then(() => {
                        window.location.href = "{{ route('profile.index') }}";
                    });
                    $('#userpasswordedit')[0].reset();
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON;
                        if (errors.message) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: errors.message
                            });
                        } else {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('.' + key + '_error').text(value[0]);
                            });
                        }
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

