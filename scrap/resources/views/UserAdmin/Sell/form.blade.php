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
            <div class="row">
                <div class="col-md-8 offset-md-2 mt-5">
                    <div class="card p-4 border border-3">
                        <div class="card-body">
                            <h4 class="text-center mb-5">Sell Scrap</h4>
                            <form id="sellscrap" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-4">
                                    <label for="file">Add Multiple Images (optional)</label>
                                    <input type="file" class="form-control" name="images[]">
                                </div>
                                <div class="row mb-4">
                                    <div class="form-group col-md-6">
                                        <input type="date" class="form-control" name="date">
                                     </div>
                                     <div class="form-group col-md-6">
                                        <input type="time" class="form-control" name="time">
                                     </div>
                                </div>
                                <div class="form-group">
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                      </select>
                                </div>
                                <div class="form-group mt-4 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<x-admin-header />
