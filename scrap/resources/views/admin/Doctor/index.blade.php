<x-admin-header />
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All Data</div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="col d-flex justify-content-end">
        <a href="{{ route('doctor.create') }}" class="btn btn-sm btn-info mt-2 text-end">Create New</a>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-3">
            <table id="users-table" class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>
                            Id
                        </th>
                        <th>
                            Action
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Name
                        </th>

                        <th>
                            Email
                        </th>
                        <th>
                            Contact
                        </th>
                        <th>
                            Address
                        </th>
                        <th>
                            City
                        </th>
                        <th>
                            Pincode
                        </th>
                        <th>
                            Description
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<x-admin-footer />

<script type="text/javascript">
    $(function() {
        var i = 1;
        var table = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.data') }}",
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
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'contact',
                    name: 'contact'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'city',
                    name: 'city'
                },
                {
                    data: 'pincode',
                    name: 'pincode'
                },
                {
                    data: 'description',
                    name: 'description'
                }

            ]
        });

    });

    function statusChange(doctorId) {
        var checkbox = document.querySelector('input[data-id="' + doctorId + '"]');
        var status = checkbox.checked ? 1 : 0;
        var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        $.ajax({
            url: "{{ route('doctor.status') }}",
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken // Include CSRF token in headers
            },
            data: {
                id: doctorId,
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
</script>
