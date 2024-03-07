<x-frontend-header />
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mt-4">Get in touch with us</h3>
        </div>
    </div>
</div>

<div class="container mt-5 border-bottom">
    <div class="row">
        <div class="col-md-4 text-center mb-3">
            <div class="contact-card">
                <div class="card-body">
                    <img class="rounded" src="{{ asset('frontend/theam/assets/images/contact/call.png') }}"
                        width="30px" alt="">
                    <h4 class="mt-4">
                        Call
                    </h4>
                    <span class="text-success mt-3">+91 983 3526 722</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center mb-3">
            <div class="">
                <div class="card-body">
                    <img class="rounded" src="{{ asset('frontend/theam/assets/images/contact/mail.png') }}"
                        width="35px" alt="">
                    <h4 class="mt-3">
                        Email
                    </h4>
                    <span class="text-success mt-3">Example@gmail.com</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="">
                <div class="card-body">
                    <img class="rounded" src="{{ asset('frontend/theam/assets/images/contact/location1.png') }}"
                        width="35px" alt="">
                    <h4 class="mt-3">
                        Address
                    </h4>
                    <span class="text-success mt-3">
                        B 224, Pranik Chambers Sakinaka Junction , Mumbai- 400 072
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container mb-5 border-bottom ">
    <div class="col-12 mt-5">
        <h3>Send Enquiry</h3>
    </div>
    <div class="col-md-12 mt-4">
        <form class="row g-3">
            <div class="col-md-6">
                <label for="validationDefault01" class="form-label">Name</label>
                <input type="text" class="form-control" id="validationDefault01" required>
            </div>
            <div class="col-md-6">
                <label for="validationDefault02" class="form-label">Email</label>
                <input type="text" class="form-control" id="validationDefault02" required>
            </div>
            <div class="col-md-6">
                <label for="validationDefault02" class="form-label">Mobile</label>
                <input type="text" class="form-control" id="validationDefault02" required>
            </div>
            <div class="col-md-6">
                <label for="validationDefault02" class="form-label">Message</label>
                <textarea name="message" class="form-control" id="validationDefault02"></textarea>
            </div>
            <div class="col-12 text-center mt-5 mb-5">
                <button class="btn btn-success" type="submit">Submit form</button>
            </div>
        </form>
    </div>

</div>


<x-frontend-footer />
