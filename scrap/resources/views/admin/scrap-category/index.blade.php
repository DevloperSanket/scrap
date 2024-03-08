<x-admin-header />
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Scrap Categories</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section>
        <div class="container">
            <div class="col-12 text-end">
                <a href="{{ route('scrapcategory.create') }}" class="btn btn-primary ">Create</a>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-3">
                    <table id="datatable" class="table table-bordered data-table">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th> Scarp Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <tr>
                                <td>
                                    1
                                </td>
                                
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt=""
                                            style="width: 45px; height: 45px" class="rounded-circle" />
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1">John Doe</p>
                                            <p class="text-muted mb-0">john.doe@gmail.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-success rounded-pill d-inline">Active</span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm btn-rounded">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm btn-rounded">
                                        Delete
                                    </button>
                                </td>
                            </tr> --}}
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
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('scrapcategory.record') }}",
            columns: [{
                    render: function(data, type, row, meta) {
                        return i++;
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'name',
                    name: 'name'
                }
            ]
        });

    });

    // function statusChange(doctorId) {
    //     var checkbox = document.querySelector('input[data-id="' + doctorId + '"]');
    //     var status = checkbox.checked ? 1 : 0;
    //     var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
    //     $.ajax({
    //         url: "{{ route('doctor.status') }}",
    //         method: 'POST',
    //         headers: {
    //             'X-CSRF-TOKEN': csrfToken // Include CSRF token in headers
    //         },
    //         data: {
    //             id: doctorId,
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
