<x-admin-header />
<main id="main" class="main">
    <div class="pagetitle">
        <h1>All Direct Sells Requests</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">All Direct Sells</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section>


        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <div>
                        <select id='status' class="form-select" style="width: 200px">
                            <option value="" selected>Select</option>
                            <option value="1">Pending</option>
                            <option value="2">Accepted</option>
                            <option value="3">Completed</option>
                        </select>
                        <table id="directsell-table" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="10px">Id</th>
                                    <th style="padding-right: 80px;">Status</th>
                                    <th style="padding-right: 80px;">Driver</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>City</th>
                                    <th>Pincode</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Address</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Table body content goes here -->
                            </tbody>
                        </table>
                    </div>

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

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Scrap Images</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
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
        var table = $('#directsell-table').DataTable({
            responsive: true,
            ajax: {
                url: "{{ route('dashboard-directselltable') }}",
                data: function(d) {
                    status = $('#status').val();
                    if (status) {
                        d.status = status;
                    }
                }
            },
            fixedColumns: true,
            paging: true,
            scrollCollapse: true,
            scrollX: true,
            scrollY: 300,
            columns: [{
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'driver',
                    name: 'driver',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'category',
                    name: 'category',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'name',
                    name: 'name',
                    searchable: true
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
                    data: 'date',
                    name: 'date',
                    render: function(data, type, row) {
                    var date = new Date(data);
                    var day = date.getDate();
                    var month = date.getMonth() + 1;
                    var year = date.getFullYear().toString().substr(-2); 
                    return (day < 10 ? '0' + day : day) + '/' + (month < 10 ? '0' + month : month) + '/' + year;
                  }
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
        $('#status').change(function() {
            table.ajax.reload();
        });
    });



    function ScrapStatusChange(userid, status) {
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


    function DriverStatusChange(userid, driver, driverId) {
        var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

        // Show confirmation dialog
        Swal.fire({
            title: "Are you sure you want to go with this driver?",
            showDenyButton: true,
            confirmButtonText: "Yes",
        }).then((result) => {
            if (result.isConfirmed) {
                // User confirmed, perform the driver change
                $.ajax({
                    url: "{{ route('directselldriverChange') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        id: userid,
                        driver: driver
                    },
                    success: function(response) {
                        Swal.fire("Driver Changed!", "", "success");
                        location.reload();
                    },
                    error: function(xhr, driver, error) {
                        if (xhr.driver === 422) {
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
            } else if (result.isDenied) {
                // User denied, revert the selection
                $("#" + driverId).val('').change(); // Reset dropdown to default
                Swal.fire("Driver Not Changed", "", "info");
                location.reload();
            }
        });
    }

    function showData(imageUrl) {
        var assetUrl = "{{ asset('') }}" + imageUrl; // Concatenating imageUrl with asset root
        $('#exampleModal .modal-body').html('<img class="col-3" src="' + assetUrl + '" class="img-fluid">');
        $('#exampleModal').modal('show');
    }



    $(document).ready(function() {
        $('.view-image').click(function() {
            var imageUrl = $(this).data('image');
            $('#exampleModal .modal-body').html('<img src="' + imageUrl +
                '" class="img-fluid" alt="Image">');
        });
    });



    function imagemodelfunction(image_url) {
        var imageUrl = $('.view-image[data-image="' + id + '"]').data('image');
        $('#modalImage').attr('src', imageUrl);
        $('#exampleModal').modal('show');
    }
</script>
