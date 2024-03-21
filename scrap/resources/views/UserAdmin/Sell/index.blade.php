<x-admin-header />
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Sell Scrap</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section>
        <div class="container">
            <div class="col-12 text-end">
                <a href="{{ route('scrap.create') }}" class="btn btn-primary ">Sell Scrap</a>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <table id="scrap-table" class="table table-bordered data-table">
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
                                <th width="10px">
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
                    ...
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
            ajax: "{{ route('scrap.getdata') }}",
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

    });

    function showData(imageUrl) {
        var assetUrl = "{{ asset('') }}" + imageUrl; // Concatenating imageUrl with asset root
        $('#exampleModal .modal-body').html('<img class="col-3" src="' + assetUrl + '" class="img-fluid">');
        $('#exampleModal').modal('show');
    }
</script>
