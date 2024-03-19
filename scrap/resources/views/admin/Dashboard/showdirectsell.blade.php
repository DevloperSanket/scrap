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
                                <th width="10px">
                                    Status
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
                // {
                //     data: 'action',
                //     name: 'action',
                //     orderable: true,
                //     searchable: true
                // },
                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'number',
                    name: 'number'
                },
                {
                    data: 'city',
                    name: 'city'
                },
                {
                    data: 'pincode',
                    name: 'pincode',
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'time',
                    name: 'time'
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
</script>
