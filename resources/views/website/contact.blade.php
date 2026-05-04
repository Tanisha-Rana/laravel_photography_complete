@extends('website.layout.structure')

@section('content')
<!-- Contact Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="text-center wow fadeIn" data-wow-delay="0.1s">
            <h1 class="font-dancing-script text-primary">Contact</h1>
            <h1 class="mb-5">Have Any Query? Contact Us</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center mb-5">
                <h4 class="mb-3">Our Location</h4>
                <p class="text-muted">302, Saffron building, Opp. Rambaugh BRTS, Maninagar, Ahmedabad</p>
                <img src="{{ asset('website/img/logo.png') }}" alt="Contact Info" width="100px" class="img-fluid shadow-sm" style="max-width: 200px; border-radius: 10px;">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="wow fadeIn" data-wow-delay="0.3s">
                    <form method="post" action="{{ url('/contact') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Your Email" required>
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" name="subject" class="form-control" id="subject" placeholder="Subject" required>
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" name="message" placeholder="Leave a message here" id="message"
                                        style="height: 150px" required></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3 ms-0" name="contact_submit" type="submit">SEND MESSAGE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection