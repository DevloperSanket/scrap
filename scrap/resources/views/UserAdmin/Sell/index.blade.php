<x-admin-header />
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Scraps</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">All Scrap</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section>
        <div class="container">
            <div class="col-12 text-end">
                <a href="{{ route('scrap.create') }}" class="btn btn-primary ">Add Scrap</a>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <select id='status' class="form-select" style="width: 200px">
                        <option value="" selected>Select</option>
                        <option value="1">Pending</option>
                        <option value="2">In Proccess</option>
                        <option value="3">Completed</option>
                    </select>
                    <table id="scrap-table" class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th width="10px">
                                    Id
                                </th>
                                <th style="padding-right: 80px;">
                                    Action
                                </th>
                                <th style="padding-right: 80px;">
                                    Status
                                </th>
                                <th style="padding-right: 80px;">
                                    Assigned Driver
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
    </section>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Scrap Images</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</main><!-- End #main -->
<x-admin-footer />
<script>
    $(function() {
        var i = 1;
        var table = $('#scrap-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: "{{ route('scrap.getdata') }}",
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
                    name: 'image',
                }
            ]
        });
        $('#status').change(function() {
            table.ajax.reload();
        });
    });


    function showData(imageUrl) {
        var assetUrl = "{{ asset('') }}" + imageUrl;
        console.log(assetUrl);
        $('#exampleModal .modal-body').html('<img class="col-3" src="' + assetUrl + '" class="img-fluid">');
        $('#exampleModal').modal('show');
    }



    function deletefunction(deleteId) {
        console.log(deleteId);
        var id = deleteId;
        var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        $.ajax({
            url: "{{ route('scrap.delete') }}",
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: {
                id: id,
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Scrap Deleted successfully.'
                }).then(() => {
                    window.location.href = "{{ route('scrap.index') }}";
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
</script>
