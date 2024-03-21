<x-admin-header />
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Change Password</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 mt-5">
                    <div class="card p-4 border border-3">
                        <div class="card-body">
                            <h4 class="text-center mb-5">Change Password</h4>
                            <form id="passwordedit" method="POST">
                                @csrf
                                <div class="row mb-4">
                                    <div class="form-group col-md-12">
                                        <input type="password" class="form-control" name="oldpassword" placeholder="Old Password">
                                        <span class="text-danger error-text oldpassword_error"></span>
                                    </div>
                                    <div class="form-group col-md-12 mt-3">
                                        <input type="password" class="form-control" name="newpassword" placeholder="New Password">
                                        <span class="text-danger error-text newpassword_error"></span>
                                    </div>
                                    <div class="form-group col-md-12 mt-3">
                                        <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password">
                                        <span class="text-danger error-text confirmpassword_error"></span>
                                    </div>
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
        $('#passwordedit').submit(function(e) {
            e.preventDefault();
            $('.error-text').text('');

            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{ route('scrap.store') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Edited Successfully.'
                    }).then(() => {
                        window.location.href = "{{ route('profile.index') }}";
                    });
                    $('#passwordedit')[0].reset();
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
