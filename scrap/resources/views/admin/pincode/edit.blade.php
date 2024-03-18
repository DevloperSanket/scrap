<x-admin-header />
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Add Pincode</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 mt-5">
                    <div class="card p-4 border border-3">
                        <div class="card-body">
                            <h4 class="text-center">Edit Pincode</h4>
                            <form id="pincodeedit">
                                @csrf
            
                                <input type="hidden" value="{{$pincode_edit->id}}" id="pincodeId">
                                <div class="form-group mt-3">
                                    <input type="text" name="city" class="form-control"  value="{{ $pincode_edit->city }}"
                                        placeholder="Enter City Name">
                                    <span class="text-danger error-text city_error"></span>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" name="pincode" class="form-control" value="{{ $pincode_edit->pincode }}"
                                        placeholder="Enter Pincode">
                                    <span class="text-danger error-text pincode_error"></span>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" name="area" class="form-control" value="{{ $pincode_edit->area }}"
                                        placeholder="Enter Area Name">
                                    <span class="text-danger error-text area_error"></span>
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
    $('#pincodeedit').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize(); // Serialize form data

        // Include CSRF token in the headers
        var headers = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        };

        var id = $("#pincodeId").val();
        $('.error-text').text('');

        $.ajax({
            type: "POST",
            url: "{{ route('pincode.update') }}",
            headers: headers, // Include CSRF token
            data: formData + '&id=' + id, // Include ID in serialized form data
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Updated successfully.'
                }).then(() => {
                    window.location.href = "{{ route('pincode.index') }}";
                });
                $('#pincodeedit')[0].reset();
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