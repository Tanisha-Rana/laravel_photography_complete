@extends('website.layout.structure')

@section('content')
<!-- About Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.2s">
                <img class="img-fluid mb-3" src="{{ asset('website/img/gallery/about.png') }}" alt="">
                <div class="d-flex align-items-center bg-light">
                    <div class="btn-square flex-shrink-0 bg-primary" style="width: 100px; height: 100px;">
                        <i class="fa fa-phone fa-2x text-dark"></i>
                    </div>
                    <div class="px-3">
                        <h3>+0123456789</h3>
                        <span>Call us direct 24/7 for get a free consultation</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <h1 class="font-dancing-script text-primary">About Me</h1>

                <p class="mb-4">I am Monali a wife, mom, photographer &
                    a professional baby snuggler.
                    We enjoy working with a team of proffesiona
                    that share our exceptional talent, vision & love
                    for the arts. whether it is an executive busines
                    portrait, large corporate event, intimate family
                    portrait, or a once in a lifetime event such a
                    a wedding day. Our team will aim to exceed
                    your expectations.</p>
                                    <h1 class="font-dancing-script text-primary">INVESTING IN BABY PHOTOGRAPHY</h1>

                 
 Babies grow up quickly, and those first few weeks are truly magical and worth capturing
 in a newbomn photography session. Timeless images preserve every tiny feature,
 and capture how you want to remember them long after they've outgrown your arms.
 The investment in Baby photography becomes a beautiful reminder of the emotion that
 surrounds the arrival of your newborn, and you will never regret doing them.
                <div class="row g-3 mb-5">
                    <div class="col-sm-6">
                        <div class="bg-light text-center p-4">
                            <i class="fas fa-calendar-alt fa-4x text-primary"></i>
                            <h1 class="display-5" data-toggle="counter-up">07</h1>
                            <p class="text-dark text-uppercase mb-0">Years experience</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="bg-light text-center p-4">
                            <i class="fas fa-users fa-4x text-primary"></i>
                            <h1 class="display-5" data-toggle="counter-up">999</h1>
                            <p class="text-dark text-uppercase mb-0">Happy Customers</p>
                        </div>
                    </div>
                </div>
                <a class="btn btn-primary text-uppercase px-5 py-3" href="">Read More</a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->
@endsection