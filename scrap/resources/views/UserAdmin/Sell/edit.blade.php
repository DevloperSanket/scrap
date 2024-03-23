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
                            <form id="registerededit"  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $registered_edit->id }}" id="registeredId">
                                {{-- <div class="form-group mt-3">
                                    <input type="file" id="image-upload" class="form-control" accept="image/*"
                                    name="images[]">
                                <div id="image-preview"></div>
                                    <span class="text-danger image_error"></span>
                                </div> --}}
                                <div class="form-group mt-3">
                                    <input type="file" id="image-upload" class="form-control" accept="image/*" name="images[]" onchange="previewImage(event)">
                                    <div id="image-preview"></div>
                                    <span class="text-danger image_error"></span>
                                </div>
                                <div class="row mb-4">
                                    <div class="form-group col-md-6">
                                        <input type="date" class="form-control"  value="{{ $registered_edit->date }}" name="date">
                                        <span class="text-danger error-text date_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="time" class="form-control" name="time"  value="{{ $registered_edit->time }}">
                                        <span class="text-danger error-text time_error"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select name="category" class="form-select">
                                        <option selected value="">Open this select menu</option>
                                        @foreach ($categories as $category)
                                        <option {{ $registered_edit->category == $category->id ? 'selected' : '' }} value="{{$category->id}}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text category_error"></span>
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
<x-admin-footer/>

<script>
    $(document).ready(function() {
        $('#registerededit').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            var headers = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            };

            var id = $("#registeredId").val();
            $('.error-text').text('');

            $.ajax({
                type: "POST",
                url: "{{ route('scrap.update') }}",
                headers: headers,
                data: formData + '&id=' + id,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Updated successfully.'
                    }).then(() => {
                        window.location.href = "{{ route('scrap.index') }}";
                    });
                    $('#registerededit')[0].reset();
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


    // function previewImage() {
    //     var input = document.getElementById('image-input');
    //     var preview = document.getElementById('output');
    //     var file = input.files[0];
    //     var reader = new FileReader();
    //     reader.onload = function(e) {
    //         preview.src = e.target.result;
    //     };
    //     reader.readAsDataURL(file);
    // }


    function previewImage(event) {
    var input = event.target;
    var preview = document.getElementById('image-preview');
    var file = input.files[0];
    var reader = new FileReader();

    reader.onload = function(e) {
        // Clear previous content
        preview.innerHTML = '';

        // Create new image element and set attributes
        var img = document.createElement('img');
        img.src = e.target.result;
        img.style.maxWidth = '100%'; // Limit image width if needed
        img.style.height = 'auto';   // Auto-adjust height
        preview.appendChild(img);
    };

    if (file) {
        reader.readAsDataURL(file);
    }
}


</script>
