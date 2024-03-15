<x-admin-header />
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Create Categories</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 mt-5">
                    <div class="card p-4 border border-3">
                        <div class="card-body">
                            <h4 class="text-center">Create Pincode</h4>
                            <form id="pincodeform">
                                @csrf
                                <div class="form-group mt-3">
                                    <input type="text" name="city" class="form-control"
                                        placeholder="Enter City Name">
                                    <span class="text-danger error-text city_error"></span>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" name="area" class="form-control"
                                        placeholder="Enter Area Name">
                                    <span class="text-danger error-text area_error"></span>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" name="pincode" class="form-control"
                                        placeholder="Enter Pincode">
                                    <span class="text-danger error-text pincode_error"></span>
                                </div>
                                <div class="form-group mt-4 text-center">
                                    <button class="btn btn-primary">Submit</button>
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
        $('#pincodeform').submit(function(e) {
            e.preventDefault();
            $('.error-text').text('');
            var formData = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "{{ route('pincode.store') }}",
                data: formData,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Form submitted successfully.'
                    }).then(() => {
                        window.location.href = "{{ route('pincode.index') }}";
                    });
                    $('#pincodeform')[0].reset();
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