<x-admin-header />
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">All Registered Sells</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section>
        <div class="container">
            <div class="col-12">
                <h3>All Registered Sell Enquiry</h3>
            </div>
        </div>


        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <div style="max-height: 400px; overflow-y: auto;">
                        <table id="scrap-table" class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th width="10px">
                                        Id
                                    </th>
                                    <th style="padding-right: 40px;">
                                        Status
                                    </th>
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
    
    
                                </tr>
                            </thead>
                            <tbody>
    
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
        {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        </div> --}}
    </section>
</main>
<x-admin-footer />
<script type="text/javascript">
$(function() {
        var i = 1;
        var table = $('#scrap-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('dashboard-registeredselltable') }}",
            columns: [{
                    render: function(data, type, row, meta) {
                        return i++;
                    }
                },
                // {
                //     orderable: true,
                //     searchable: true
                // },
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
                },
                {
                    data: 'time',
                    name: 'time'
                },
                {
                    data: 'image',
                    name: 'image'
                }
            ]
        });

    });

    function showData(imageUrl) {
        var assetUrl = "{{ asset('') }}" + imageUrl; // Concatenating imageUrl with asset root
        $('#exampleModal .modal-body').html('<img class="col-3" src="' + assetUrl + '" class="img-fluid">');
        $('#exampleModal').modal('show');
    }


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


    function DriverStatusChange(userid, driver) {
        var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
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

                Swal.fire({
                    title: "Are you sure,you want to go with this driver?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        Swal.fire("Driver Changed!", "", "success");
                    } else if (result.isDenied) {
                        Swal.fire("Driver Not Changed", "", "info");
                    }
                });
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
    }


</script>
