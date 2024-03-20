<x-admin-header />
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">All Direct Sells</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section>
        <div class="container">
            <div class="col-12">
                <h3>All Direct Sell Enquiry</h3>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <table id="directsell-table" class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th width="10px">
                                    Id
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Category
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Mobile
                                </th>
                                <th>
                                    City
                                </th>
                                <th>
                                    Pincode
                                </th>
                                <th>
                                    Scrap Type
                                </th>
                                <th>
                                    Date
                                </th>
                                <th>
                                    Time
                                </th>
                                <th>
                                    Address
                                </th>
                                <th>
                                    Image
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">View Image</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="" id="modalImage" class="img-fluid" alt="Image">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


    </section>
</main>
<x-admin-footer />
<script type="text/javascript">
    $(function() {
        var i = 1;
        var table = $('#directsell-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('dashboard-directselltable') }}",
            columns: [{
                    render: function(data, type, row, meta) {
                        return i++;
                    }
                },
                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'scraptype',
                    name: 'scraptype',
                },
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'email',
                    name: 'email',
                },
                {
                    data: 'number',
                    name: 'number',
                },
                {
                    data: 'city',
                    name: 'city',
                },
                {
                    data: 'pincode',
                    name: 'pincode',
                },
                 {
                    data: 'scraptype',
                    name: 'scraptype',
                 },
                {
                    data: 'date',
                    name: 'date',
                },
                {
                    data: 'time',
                    name: 'time',
                },
                {
                    data: 'address',
                    name: 'address',
                },
                {
                    data: 'image',
                    name: 'image'
                }
            ]
        });

    });

    // function ScrapStatusChange(userId) {
    //     var checkbox = document.querySelector('input[data-id="' + userId + '"]');
    //     var status = checkbox.checked ? 1 : 0;
    //     var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
    //     $.ajax({
    //         url: "{{ route('statusChange') }}",
    //         method: 'POST',
    //         headers: {
    //             'X-CSRF-TOKEN': csrfToken
    //         },
    //         data: {
    //             id: userId,
    //             status: status
    //         },
    //         success: function(response) {
    //             Swal.fire({
    //                 icon: 'success',
    //                 title: 'Success!',
    //                 text: 'Status update successfully.'
    //             });
    //         },
    //         error: function(xhr, status, error) {
    //             if (xhr.status === 422) {
    //                 var errors = xhr.responseJSON.errors;
    //                 $.each(errors, function(key, value) {
    //                     $('.' + key + '_error').text(value[0]);
    //                 });
    //             } else {
    //                 Swal.fire({
    //                     icon: 'error',
    //                     title: 'Oops...',
    //                     text: 'Something went wrong! Please try again later.'
    //                 });
    //             }
    //         }
    //     });
    // }


    function ScrapStatusChange(userid, status) {
        // console.log(userid);
    // var select = document.querySelector('select[data-id="' + userid + '"]');
    // var status = select.value;
    // console.log(status);
    var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
    $.ajax({
        url: "{{ route('directsellstatusChange') }}",
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        data: {
            id: userid,
            status: status
        },
        success: function(response) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Status update successfully.'
            });
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
}


  

    $(document).ready(function() {
        $('.view-image').click(function() {
            var imageUrl = $(this).data('image');
            $('#exampleModal .modal-body').html('<img src="' + imageUrl + '" class="img-fluid" alt="Image">');
        });
    });



function imagemodelfunction(image_url) {
    // console.log(image_url);
    var imageUrl = $('.view-image[data-image="' + id + '"]').data('image');
    $('#modalImage').attr('src', imageUrl);
    $('#exampleModal').modal('show');
}

</script>
