<x-admin-header />
<main id="main" class="main">
    <div class="pagetitle">
        <h1>All Registered Sells Requests</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">All Registered Sells</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section>


        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <div style="max-height: 400px; overflow-y: auto;">
                        <select id='status' class="form-select" style="width: 200px">
                            <option value="" selected>Select</option>
                            <option value="1">Pending</option>
                            <option value="2">Accepted</option>
                            <option value="3">Completed</option>
                        </select>
                        <table id="scrap-table" class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th width="10px">
                                        Id
                                    </th>
                                    <th style="padding-right: 90px;">
                                        Status
                                    </th style="padding-right: 90px;">
                                    <th>
                                        Driver
                                    </th>
                                    <th>
                                        Category
                                    </th>
                                    <th>
                                        Collection Date
                                    </th>
                                    <th>
                                        Collection Time
                                    </th>
                                    <th>
                                        Scrap Images
                                    </th>
                                    <th>
                                        Details
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- image model  --}}
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

        {{-- Details Model --}}
        <div class="modal fade" id="Detailsmodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">View Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card mb-4"  style="padding: 40px;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Name</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0" id="name"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Email</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0" id="email"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Mobile</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0" id="mobile"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">City</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0" id="city"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Pincode</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0" id="pincode"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Address</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0" id="address"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        var table = $('#scrap-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: "{{ route('dashboard-registeredselltable') }}",
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
                },
                {
                    data: 'driver',
                    name: 'driver',
                },
                {
                    data: 'category',
                    name: 'category',
                },
                {
                    data: 'date',
                    name: 'date',
                    render: function(data, type, row) {
                        var date = new Date(data);
                        var day = date.getDate();
                        var month = date.getMonth() + 1;
                        var year = date.getFullYear().toString().substr(-2);
                        return (day < 10 ? '0' + day : day) + '/' + (month < 10 ? '0' + month :
                            month) + '/' + year;
                    }
                },
                {
                    data: 'time',
                    name: 'time'
                },
                {
                    data: 'image',
                    name: 'image'
                },
                {
                    data: 'details',
                    name: 'details',

                }
            ]
        });
        $('#status').change(function() {
            table.ajax.reload();
        });
    });


    ///// image model show /////
    function showData(imageUrl) {
        var assetUrl = "{{ asset('') }}" + imageUrl;
        $('#exampleModal .modal-body').html('<img class="col-3" src="' + assetUrl + '" class="img-fluid">');
        $('#exampleModal').modal('show');
    }


    //// scrap status change //////
    function ScrapStatusChange(userid, status) {
        var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        $.ajax({
            url: "{{ route('registeredsellstatusChange') }}",
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
            title: "Are you sure you want to go with this driver ?",
            showDenyButton: true,
            confirmButtonText: "Yes",
        }).then((result) => {
            if (result.isConfirmed) {
                // User confirmed, perform the driver change
                $.ajax({
                    url: "{{ route('registeredselldriverChange') }}",
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

    function UserDetails(details) {
    console.log("User details:", details);
    $('#name').text(details.name);
    $('#email').text(details.email);
    $('#mobile').text(details.mobile);
    $('#city').text(details.city);
    $('#pincode').text(details.pincode);
    $('#address').text(details.address);

    $('#Detailsmodel').modal('show');
}

</script>
