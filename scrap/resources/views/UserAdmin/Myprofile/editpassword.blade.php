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
                            <h4 class="text-center">Edit Password</h4>
                            <form id="userpasswordedit">
                                @csrf
            
                                <input type="hidden" value="{{$userpassword->id}}" id="userpasswordId">
                                <div class="form-group mt-3">
                                    <input type="text" name="oldpassword" class="form-control"  
                                        placeholder="Enter Old Password">
                                    <span class="text-danger error-text oldpassword_error"></span>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" name="newpassword" class="form-control" value=""
                                        placeholder="New Password">
                                    <span class="text-danger error-text newpassword_error"></span>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" name="confirmpassword" class="form-control" value=""
                                        placeholder="Confirm Password">
                                    <span class="text-danger error-text confirmpassword_error"></span>
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
//    $(document).ready(function() {
//     $('#userpasswordedit').submit(function(e) {
//         e.preventDefault();
//         var formData = $(this).serialize(); // Serialize form data

//         // Include CSRF token in the headers
//         var headers = {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         };

//         var id = $("#userpasswordId").val();
//         $('.error-text').text('');

//         $.ajax({
//             type: "POST",
//             url: "{{ route('profile.update') }}",
//             headers: headers, // Include CSRF token
//             data: formData + '&id=' + id, // Include ID in serialized form data
//             success: function(response) {
//                 Swal.fire({
//                     icon: 'success',
//                     title: 'Success!',
//                     text: 'Password Updated successfully.'
//                 }).then(() => {
//                     window.location.href = "{{ route('profile.index') }}";
//                 });
//                 $('#userpasswordedit')[0].reset();
//             },
//             error: function(xhr, status, error) {
//                 if (xhr.status === 422) {
//                     var errors = xhr.responseJSON.errors;
//                     $.each(errors, function(key, value) {
//                         $('.' + key + '_error').text(value[0]);
//                     });
//                 } else {
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'Oops...',
//                         text: 'Something went wrong! Please try again later.'
//                     });
//                 }
//             }
//         });
//     });
// });



$(document).ready(function() {
    $('#userpasswordedit').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize(); // Serialize form data
        var id = $("#userpasswordId").val();
        $('.error-text').text('');

        $.ajax({
            type: "POST",
            url: "{{ route('profile.updatepassword') }}",
            data: formData + '&id=' + id, // Include ID in serialized form data
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Password Updated successfully.'
                }).then(() => {
                    window.location.href = "{{ route('profile.index') }}";
                });
                $('#userpasswordedit')[0].reset();
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