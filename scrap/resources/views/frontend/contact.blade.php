<x-frontend-header />
<section class="py-5">
    <div class="container" style="padding: 40px;">
        <div class="row">
            <div class="col-md-12 contact_main">
                <h3 class="mt-4 text-center contact_h3">Get in touch with us</h3>
                <p class="text-center">Please get in touch with us for any query !!!</p>
            </div>
        </div>
    </div>
    <!-- 
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
                        width="30px" alt="">
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
</div> -->



    <div class="container-fluid ">
        <div class="container ">
            <div class="row contact_box">
                <div class="col-lg-6 mb-3 contact_box1 pt-5">
                    <h3 class="text-light">Contact Details...</h3>
                    <p style="">
                        Fill Up the form For Your queries...
                    </p>
                    <hr>
                    <h4 class="mt-4 text-light">
                        <i class="fa fa-phone text-light" aria-hidden="true" style="margin-right:5px;"></i>
                        +91 983 3526 722
                    </h4>
                    <h4 class="mt-4 text-light">
                        <i class="fa fa-envelope text-light" aria-hidden="true" style="margin-right:5px;"></i>
                        Example@gmail.com
                    </h4>
                    <h4 class="mt-4 text-light ">
                        <i class="fa-solid fa-location-dot text-light" style="margin-right:5px;"></i><span class="text-light contact-area-text">
                            B 224, Pranik Chambers Sakinaka Junction , Mumbai- 400 072</span>
                    </h4>
                </div>
                <div class="col-lg-6 mb-3 contact_box2">
                    <h3 class="mb-3">Send Enquiry</h3>
                    <form class="row g-3">
                        <div class="col-md-12">
                            <!-- <label for="validationDefault01" class="form-label">Name</label> -->
                            <input type="text" class="form-control" placeholder="Name" id="validationDefault01" required>
                        </div>
                        <div class="col-md-12">
                            <!-- <label for="validationDefault02" class="form-label">Email</label> -->
                            <input type="text" class="form-control" placeholder="Email" id="validationDefault02" required>
                        </div>
                        <div class="col-md-12">
                            <!-- <label for="validationDefault02" class="form-label">Mobile</label> -->
                            <input type="text" class="form-control" placeholder="Mobile No." id="validationDefault02" required>
                        </div>
                        <div class="col-md-12">
                            <!-- <label for="validationDefault02" class="form-label">Message</label> -->
                            <textarea name="message" class="form-control" placeholder="Message" id="validationDefault02"></textarea>
                        </div>
                        <div class="col-12 text-center mt-5 mb-5">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>


<x-frontend-footer />