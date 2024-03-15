<x-admin-header />
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Cards</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section>
        <div class="container">
            <div class="col-12 text-end">
                <a href="{{ route('card.create') }}" class="btn btn-primary ">Add</a>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <table id="users-table" class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th width="10px">
                                    Id
                                </th>
                                <th width="10px">
                                    Action
                                </th>
                                <th width="10px">
                                    Status
                                </th>
                                <th>
                                    Category Name
                                </th>
                                <th>
                                    Image
                                </th>
                                <th>
                                    Price
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
        var table = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('card.record') }}",
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
                    data: 'category_id',
                    name: 'category_id',
                },
                {
                    data: 'image',
                    name: 'image',
                },
                {
                    data: 'price',
                    name: 'price'
                }
            ]
        });

    });

    function cardStatusChange(scrapId) {
        console.log(scrapId);
        var checkbox = document.querySelector('input[data-id="' + scrapId + '"]');
        var status = checkbox.checked ? 1 : 0;
        var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        $.ajax({
            url: "{{ route('card.status') }}",
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: {
                id: scrapId,
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


    function deletefunction(deleteId) {
    console.log(deleteId);
        var id = deleteId;
        var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        $.ajax({
            url: "{{ route('card.delete') }}",
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
                    text: 'Card Deleted successfully.'
                }).then(() => {
                    window.location.href = "{{ route('card.index') }}";
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
