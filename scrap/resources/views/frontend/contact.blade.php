<x-frontend-header />
<section>
    <div class="container" style="padding: 40px;">
        <div class="row">
            <div class="col-md-12 contact_main">
                <h3 class="mt-4 text-center contact_h3">Get in touch with us</h3>
                <p class="text-center">Please get in touch with us for any query !!!</p>
            </div>
        </div>
    </div>



    {{-- <div class="container-fluid"> --}}
        <div class="container mb-5">
            <div class="row contact_box">
                <div class="col-lg-6 mb-3 contact_box1 pt-5">
                   <div>
                    <h3 class="text-light">Contact Information</h3>
                    <p>
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
                </div>
                <div class="col-lg-6 mb-3 contact_box2">
                    <h3 class="mb-3">Send Enquiry</h3>
                    <form class="row g-3" method="POST" action="{{ route('contact.send') }}">
                        @csrf
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Name" name="name" required>
                        </div>
                        <div class="col-md-12">
                            <input type="email" class="form-control" placeholder="Email" name="email" required>
                        </div>
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Mobile No." name="mobile" required>
                        </div>
                        <div class="col-md-12">
                            <textarea name="message" class="form-control" placeholder="Message" required></textarea>
                        </div>
                        <div class="col-12 text-center mt-5 mb-5">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    {{-- </div> --}}


    <div class="container-fluid mb-5">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15080.72918901834!2d72.87535868586048!3d19.09965699035979!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c8773cb2f051%3A0x40576ac944236b34!2sSaki%20Naka%2C%20Mumbai%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1710746060826!5m2!1sen!2sin" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

</section>


<x-frontend-footer />