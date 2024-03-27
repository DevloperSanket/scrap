<x-admin-header />
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Create Cards</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 mt-5">
                    <div class="card p-4 border border-3">
                        <div class="card-body">
                            <h4 class="text-center">Create Cards</h4>
                            <form id="myForm" enctype="multipart/form-data">
                                @csrf
                                <select class="form-select" name="categoryName" aria-label="Default select example">
                                    <option selected disabled>Select Category</option>
                                    @foreach ($category_id as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="form-group mt-3">
                                    <input class="form-control" name="image" type="file" id="image-upload-card">
                                    <div id="image-preview-card"></div>
                                    <span class="text-danger error-text image_error"></span>
                                </div>

                                <div class="form-group mt-3">
                                    <input type="text" name="price" class="form-control" placeholder="Enter Price">
                                    <span class="text-danger error-text price_error"></span>
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
        $('#myForm').submit(function(e) {
            e.preventDefault();
            $('.error-text').text('');

            var formData = new FormData(this); // Create FormData object to handle file uploads
            $.ajax({
                type: "POST",
                url: "{{ route('card.store') }}",
                data: formData,
                processData: false, // Prevent jQuery from automatically processing the data
                contentType: false, // Prevent jQuery from automatically setting the content type
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Form submitted successfully.'
                    }).then(() => {
                        window.location.href = "{{ route('card.index') }}";
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

    // image preview 
    $('#image-upload-card').change(function() {
        $('#image-preview-card').empty();
        var reader = new FileReader();
        reader.onload = function(e) {
            var img = $('<img>').addClass('preview-image').attr('src', e.target.result);
            $('#image-preview-card').append(img);
        }
        reader.readAsDataURL(this.files[0]);
    });
</script>
