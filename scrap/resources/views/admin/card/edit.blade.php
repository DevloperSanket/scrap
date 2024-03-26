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
                            <form id="editCard" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="cardId" name="cardId" value="{{ $card->id }}">
                                <div class="form-group">
                                    <select class="form-select" name="category_id" aria-label="Default select example">
                                        @foreach ($categories as $category)
                                            <option {{ $card->category_id == $category->id ? 'selected' : '' }}
                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text category_id_error"></span>
                                </div>
                                <div class="form-group mt-3">
                                    <input class="form-control" name="image" type="file" id="image-input"
                                        onchange="previewImage()">
                                    <img id="output" src="" alt="preview Image"
                                        style="width: 100px; height:100px;">
                                    <span class="text-danger error-text image_error"></span>
                                </div>

                                <div class="form-group mt-3">
                                    <input type="text" name="price" value="{{ old('price', $card->price) }}"
                                        class="form-control" placeholder="Enter Price">
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
        $('#editCard').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            var headers = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            };

            var id = $("#cardId").val();
            $('.error-text').text('');

            $.ajax({
                type: "POST",
                url: "{{ route('card.update') }}",
                headers: headers,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Updated successfully.'
                    }).then(() => {
                        window.location.href = "{{ route('card.index') }}";
                    });
                    $('#editCard')[0].reset();
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





    function previewImage() {
        var input = document.getElementById('image-input');
        var preview = document.getElementById('output');
        var file = input.files[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
</script>
