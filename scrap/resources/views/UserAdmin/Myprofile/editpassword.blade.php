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
                            {{-- <form id="userpasswordedit">
                                @csrf
                                <input type="hidden" value="{{ $userpassword->id }}" id="userpasswordId">
                                <div class="form-group mt-3">
                                    <input type="password" name="oldpassword" class="form-control"
                                        placeholder="Enter Old Password">
                                    <span class="text-danger error-text oldpassword_error"></span>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="password" name="newpassword" class="form-control" value=""
                                        placeholder="New Password">
                                    <span class="text-danger error-text newpassword_error"></span>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="password" name="newpassword_confirmation" class="form-control"
                                        value="" placeholder="Confirm Password">
                                    <span class="text-danger error-text newpassword_confirmation_error"></span>
                                </div>
                                <div class="form-group mt-4 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form> --}}

                            <form id="userpasswordedit">
                                @csrf
                                <input type="hidden" value="{{ $userpassword->id }}" id="userpasswordId">
                                <div class="form-group mt-3">
                                    <div class="input-group">
                                        <input type="password" name="oldpassword" class="form-control" placeholder="Enter Old Password">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        </div>
                                    </div>
                                    <span class="text-danger error-text oldpassword_error"></span>
                                </div>
                                <div class="form-group mt-3">
                                    <div class="input-group">
                                        <input type="password" name="newpassword" class="form-control" value="" placeholder="New Password">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="bi bi-eye-slash-fill"></i></span>
                                        </div>
                                    </div>
                                    <span class="text-danger error-text newpassword_error"></span>
                                </div>
                                <div class="form-group mt-3">
                                    <div class="input-group">
                                        <input type="password" name="newpassword_confirmation" class="form-control" value="" placeholder="Confirm Password">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="bi bi-eye-slash-fill"></i></span>
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
        $('#userpasswordedit').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var id = $("#userpasswordId").val();
            $('.error-text').text('');
            $.ajax({
                type: "POST",
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
