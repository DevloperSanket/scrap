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
                                    {{-- <input type="file" name="image" id="fileUpload" class="form-control"> --}}
                                    {{-- <div id="image-holder"> </div> --}}
                                    <input class="form-control" name="image" type="file" id="image-input" onchange="previewImage()">
                                    <img id="output" src="" alt="preview Image" style="width: 100px; height:100px;">
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



    // function for image preview
    // $("#fileUpload").on('change', function() {

    //     if (typeof(FileReader) != "undefined") {

    //         var image_holder = $("#image-holder");
    //         image_holder.empty();

    //         var reader = new FileReader();
    //         reader.onload = function(e) {
    //             $("<img />", {
    //                 "src": e.target.result,
    //         
    //                 "class": "thumb-image",
    //                 "style": "height:90px;width:110px;margin-top: 14px;"
    //             }).appendTo(image_holder);

    //         }
    //         image_holder.show();
    //         reader.readAsDataURL($(this)[0].files[0]);
    //     } else {
    //         alert("This browser does not support FileReader.");
    //     }
    // });


function previewImage(){
 var input = document.getElementById('image-input');
 var preview = document.getElementById('output');
 var file = input.files[0];
 var reader = new FileReader();
 reader.onload = function(e){
  preview.src = e.target.result;
 };
 reader.readAsDataURL(file);
}
</script>
