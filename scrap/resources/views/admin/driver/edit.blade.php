<x-admin-header />
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Edit Drivers</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 mt-5">
                    <div class="card p-4 border border-3">
                        <div class="card-body">
                            <h4 class="text-center">Edit Drivers</h4>
                            <form id="myForm">
                                @csrf
                                <input type= "hidden" value="{{ $driver_edit->id }}" id= "editId">
                                <div class="form-group mt-3">
                                    <input type="text" name="name" value="{{ $driver_edit->name }}" class="form-control"
                                        placeholder="Enter Scrap Name">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" name="mobile" value="{{ $driver_edit->mobile }}" class="form-control"
                                        placeholder="Enter Mobile no.">
                                    <span class="text-danger error-text name_error"></span>
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
    $('#myForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize(); // Serialize form data
        var headers = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        };

        var id = $("#editId").val();
        $('.error-text').text('');

        $.ajax({
            type: "POST",
            url: "{{ route('driver.update') }}",
            headers: headers,
            data: formData + '&id=' + id,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Updated successfully.'
                }).then(() => {
                    window.location.href = "{{ route('driver.index') }}";
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