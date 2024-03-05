<x-frontend-header />
<div class="container">
    <div class="row">
        <div class="col-6 offset-md-3 mt-5">
            <form action="{{route('register')}}" method="post">
                @csrf
                <div class="card">
                    <h6 class="h5 card-title text-center">Register Here..</h6>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Enter Name">
                            @error('name')
                            <div class="alert alert-danger" style="margin-bottom: 0px;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <input type="email" name="email" class="form-control" placeholder="Enter Email">
                            @error('email')
                            <div class="alert alert-danger" style="margin-bottom: 0px;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <input type="password" name="password" class="form-control" placeholder="Enter Password">
                            @error('password')
                            <div class="alert alert-danger" style="margin-bottom: 0px;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <a href="{{route('login')}}" class="text-success nav-link mt-2">Allready have account</a>

                        <div class="form-group mt-3 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<x-frontend-footer />