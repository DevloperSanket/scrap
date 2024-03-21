<x-frontend-header />
<section class="py-5">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 10px;">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold">Sell Scrap</p>
                                <form class="mx-1 mx-md-4" id="directSell" enctype="multipart/form-data">
                                    @csrf
                                    <div class="d-flex flex-row align-items-center mb-3">
                                        <div class="form-outline flex-fill">
                                            <input type="text" id="form3Example1c" class="form-control"
                                                name="name" placeholder="Enter Name" />
                                            <span class="text-danger error-text name_error"></span>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-3">
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="email" id="form3Example3c" class="form-control"
                                                name="email" placeholder="Enter Email">
                                            <span class="text-danger error-text email_error"></span>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-3">

                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="form3Example4c" class="form-control"
                                                name="number" placeholder="Enter Contact Number" />
                                            <span class="text-danger error-text number_error"></span>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-3">

                                        <div class="form-outline flex-fill mb-0">
                                            <input type="city" id="form3Example4c" class="form-control"
                                                name="city" placeholder="Enter City" />
                                            <span class="text-danger error-text city_error"></span>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-3">
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="form3Example4c" class="form-control"
                                                name="pincode" placeholder="Enter Pincode" />
                                            <span class="text-danger error-text pincode_error"></span>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-3">
                                        <div class="form-outline flex-fill">
                                            <select class="form-select" name="scraptype"
                                                aria-label="Default select example">
                                                <option selected disabled>Select Scrap Type</option>
                                                @foreach ($scrapcategory as $ScrapCategory)
                                                    <option value="{{ $ScrapCategory->id }}">{{ $ScrapCategory->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger error-text scraptype_error"></span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-outline">
                                                <input type="date" name="date" class="form-control" id="date"
                                                    placeholder="Select Date">
                                                <span class="text-danger error-text date_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-outline">
                                                <input type="time" name="time" class="form-control" id="time"
                                                    placeholder="Select Time">
                                                <span class="text-danger error-text time_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-3">
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label mt-3" for="form3Example4cd">Select Scrap Images
                                                (Optional) </label>
                                            <input type="file" id="image-upload-directsell" class="form-control"
                                                name="images[]" placeholder="Enter Pincode" accept="image/*"
                                               ><div id="image-preview-directsell"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-3">
                                        <div class="form-outline flex-fill mb-0">
                                            <textarea name="address" class="form-control" placeholder="Enter Address"></textarea>
                                            <span class="text-danger error-text address_error"></span>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center mx-4">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </form>

                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                <img src="{{ asset('frontend/theam/assets/images/logo/scrap2.jpg') }}" class="img-fluid"
                                    alt="Sample image" style="height: 400px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<x-frontend-footer />
<script type="text/javascript">


    $(document).ready(function() {
        $('#directSell').submit(function(e) {
            e.preventDefault();
            $('.error-text').text('');

            var formData = new FormData(this); 
            $.ajax({
                type: "POST",
                url: "{{ route('directsell.store') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // console.log(response);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Form submitted successfully.'
                    }).then(() => {
                        window.location.href = "{{ route('sell.index') }}";
                    });
                    $('#directSell')[0].reset();
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


    $('#image-upload-directsell').change(function() {
            console.log("change");
            $('#image-preview-directsell').empty();
            for (var i = 0; i < this.files.length; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = $('<img>').addClass('preview-image').attr('src', e.target.result);
                    $('#image-preview-directsell').append(img);
                }
                reader.readAsDataURL(this.files[i]);
            }
        });
</script>
