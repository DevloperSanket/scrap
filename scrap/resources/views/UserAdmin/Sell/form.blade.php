<x-admin-header />
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Sell Scrap</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 mt-5">
                    <div class="card p-4 border border-3">
                        <div class="card-body">
                            <h4 class="text-center mb-5">Sell Scrap</h4>
                            <form id="sellscrap" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-4">
                                    <label for="file">Add Multiple Images (optional)</label>
                                    <input type="file" id="image-upload" class="form-control" accept="image/*"
                                        name="images[]">
                                        <div id="image-preview"></div>
                                </div>
                                <div class="row mb-4">
                                    <div class="form-group col-md-6">
                                        <input type="date" class="form-control" name="date">
                                        <span class="text-danger error-text date_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="time" class="form-control" name="time">
                                        <span class="text-danger error-text time_error"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select name="category" class="form-select">
                                        <option selected value="">Open this select menu</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
<x-admin-footer />

<script>
    $(document).ready(function() {
        $('#sellscrap').submit(function(e) {
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
                        text: 'Form submitted successfully.'
                    }).then(() => {
                        window.location.href = "{{ route('scrap.index') }}";
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

        $('#image-upload').change(function() {
            console.log("change");
            $('#image-preview').empty();
            for (var i = 0; i < this.files.length; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = $('<img>').addClass('preview-image').attr('src', e.target.result);
                    $('#image-preview').append(img);
                }
                reader.readAsDataURL(this.files[i]);
            }
        });
</script>
