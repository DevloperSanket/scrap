<x-admin-header />
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success text-dark">Create New</div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="" id="myForm">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="name">Enter Name <sub>*</sub></label>
                        <input type="text" name="name" placeholder="Enter Full Name" class="form-control">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Enter Email <sub>*</sub></label>
                        <input type="text" name="email" placeholder="Enter Email" class="form-control">
                        <span class="text-danger error-text email_error"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="contact">Enter Contact <sub>*</sub></label>
                        <input type="text" name="contact" placeholder="Enter Contact" class="form-control">
                        <span class="text-danger error-text contact_error"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="contact">Enter City <sub>*</sub></label>
                        <input type="text" name="city" placeholder="Enter City" class="form-control">
                        <span class="text-danger error-text city_error"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="contact">Enter Pincode <sub>*</sub></label>
                        <input type="text" name="pincode" placeholder="Enter Pincode" class="form-control">
                        <span class="text-danger error-text city_error"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="contact">Enter Address <sub>*</sub></label>
                        <textarea name="address" class="form-control" placeholder="Enter Address"></textarea>
                        <span class="text-danger error-text address_error"></span>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="contact">Add Description <sub>*</sub></label>
                        <textarea name="description" class="form-control" placeholder="Enter Description"></textarea>
                        <span class="text-danger error-text description_error"></span>
                    </div>

                    <div class="form-group col-md-12  text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<x-admin-footer />
<script>
    $(document).ready(function() {
        $('#myForm').submit(function(e) {
            e.preventDefault();
            $('.error-text').text('');
            var formData = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "{{ route('doctore.store') }}",
                data: formData,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Form submitted successfully.'
                    }).then(() => {
                        window.location.href = "{{ route('doctor.index') }}";
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
