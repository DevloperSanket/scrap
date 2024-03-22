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
                            <h4 class="text-center">Edit Details</h4>
                            <form id="useredit">
                                @csrf
                                <input type="hidden" value="{{ $user->id }}" id="userId">
                                <div class="form-group mt-3">
                                    <input type="text" name="name" class="form-control"
                                        value="{{ $user->name }}" placeholder="Enter Name">
                                    <span class="text-danger name_error"></span>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="email" name="email" class="form-control"
                                        value="{{ $user->email }}" placeholder="Enter Email">
                                    <span class="text-danger error-text email_error"></span>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" name="mobile" class="form-control"
                                        value="{{ $user->mobile }}" placeholder="Enter Mobile no.">
                                    <span class="text-danger error-text mobile_error"></span>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" name="city" class="form-control"
                                        value="{{ $user->city }}" placeholder="Enter Name">
                                    <span class="text-danger error-text city_error"></span>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" name="pincode" class="form-control"
                                        value="{{ $user->pincode }}" placeholder="Enter Pincode">
                                    <span class="text-danger error-text pincode_error"></span>
                                </div>
                                <div class="form-group mt-3">
                                    <textarea name="address" class="form-control" placeholder="Enter Address">{{ $user->address }}</textarea>
                                    <span class="text-danger error-text address_error"></span>
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
        $('#useredit').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            var headers = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            };

            var id = $("#userId").val();
            $('.error-text').text('');

            $.ajax({
                type: "POST",
                url: "{{ route('profile.update') }}",
                headers: headers,
                data: formData + '&id=' + id,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Updated successfully.'
                    }).then(() => {
                        window.location.href = "{{ route('profile.index') }}";
                    });
                    $('#useredit')[0].reset();
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('.' + key + '_error').text(value[
                                0]);
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
