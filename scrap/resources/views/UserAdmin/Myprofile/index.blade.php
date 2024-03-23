<x-admin-header />
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">My Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section>

        <div class="container">
            <h3 class="text-center"><b>User Data</b></h3>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="card mb-4"  style="padding: 40px;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->name }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->email }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Mobile</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->mobile }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">City</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->city }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Pincode</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->pincode }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $user->address }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="{{ route('profile.edit')}}" class="btn btn-primary mt-3 float-right">Edit</a>
                                    <a href="{{ route('profile.editpassword' )}}" class="btn btn-primary mt-3">Change Password</a>
                                </div>
                            </div>
                            {{-- <div class="row mt-3">
                                <div class="col-sm-6">
                                    <a href="{{ route('profile.editpassword' )}}" class="btn btn-primary ">Change Password</a>
                                </div>                
                            </div>
                            --}}
                           
                        </div>
                    </div>
                </div>
                <div class="col-lg-2"></div>
            </div>
    </section>



</main><!-- End #main -->
<x-admin-footer />
<script>
 
  
</script>
