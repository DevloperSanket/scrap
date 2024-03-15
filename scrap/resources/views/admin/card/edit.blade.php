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
                            <h4 class="text-center">Edit Cards</h4>
                            <form id="myForm" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $card_edit->id }}" id="editID">
                                <select class="form-select" name="categoryName" aria-label="Default select example">
                                    <option selected disabled>Select Category</option>
                                    @foreach ($category as $categories)
                                        <option value="{{ $categories->id }}"
                                            {{ $card_edit->category_id == $categories->id ? 'selected' : '' }}>
                                            {{ $categories->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-group mt-3">
                                    <input type="file" name="image" id="fileUpload" value="{{ $card_edit->image }}"
                                        class="form-control">
                                    <div id="image-holder"></div>
                                    <span class="text-danger error-text image_error"></span>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" name="price" class="form-control"
                                        value="{{ $card_edit->price }}" placeholder="Enter Price">
                                    <span class="text-danger error-text price_error"></span>
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

            // Include CSRF token in the headers
            var headers = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            };

            var id = $("#editID").val();
            $('.error-text').text('');

            $.ajax({
                type: "POST",
                url: "{{ route('card.update') }}",
                headers: headers, // Include CSRF token
                data: formData + '&id=' + id, // Include ID in serialized form data
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Updated successfully.'
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


    //  


    function previewImage(input, imageHolder) {
        if (typeof FileReader != "undefined") {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(imageHolder).empty();
                    $("<img />", {
                        "src": e.target.result,
                        "class": "thumb-image",
                        "style": "height:120px;width:145px;margin-10px 0px 0px 10px;"
                    }).appendTo(imageHolder);
                };
                reader.readAsDataURL(input.files[0]);
            }
        } else {
            alert("This browser does not support FileReader.");
        }
    }

    // Call the previewImage function on change of file input
    $(document).ready(function() {
        $("#fileUpload").on('change', function() {
            var image_holder = $("#image-holder");
            previewImage(this, image_holder);
        });
    });
</script>
