<!-- Footer Start -->
<div class="container-fluid custom-footer py-4">
    <div class="container">
        <div class="row align-items-center">

            <!-- Left Logo & Tagline -->
            <div class="col-lg-4 text-center text-lg-start mb-4 mb-lg-0">
                <img src="{{ asset('website/img/logo.png') }}" alt="Photography By Monali" class="footer-logo mb-3">
                <p class="footer-tagline">CAPTURING THE ESSENCE OF NEW LIFE</p>
                <p class="footer-services">
                    Maternity | Newborn | Kids | Family
                </p>
            </div>

            <!-- Center Address -->
            <div class="col-lg-5 text-center text-lg-start mb-4 mb-lg-0">
                <h5 class="footer-title">Photography by Monali</h5>
                <p class="footer-text">
                    302, Saffron building, Above Tanishq Showroom<br>
                    Opp. Rambaugh BRTS, Rambaugh, Maninagar<br>
                    Ahmedabad 380015
                </p>

                <p class="footer-text">
                    <i class="fab fa-whatsapp me-2"></i>
                    +91 63527 10112 / +91 74056 71700
                </p>
                 <p class="footer-follow mb-2">Follow us</p>
                <div class="mb-3">
                    <a href="#" class="footer-social"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="footer-social"><i class="fab fa-facebook-f"></i></a>
                </div>
                <img src="{{ asset('website/img/scann.png') }}" alt="QR Code" class="footer-qr">
            </div>

<!-- Right Quick Links -->
<div class="col-lg-3 text-lg-start align-self-start">
    <h5 class="footer-title">Quick Links</h5>
    <ul class="footer-links mt-2">
        <li><a href="#">About Us</a></li>
        <li><a href="#">Contact Us</a></li>
        <li><a href="#">Our Services</a></li>
        <li><a href="#">Terms & Conditions</a></li>
    </ul>
</div>

    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
               <!-- Footer Logo -->
<img src="{{ asset('website/img/logo.png') }}" alt="Photography By Monali" class="footer-logo">

<!-- Footer Bottom Logo -->

                <p class="mb-0">
                    © <span id="year"></span> Photography by Monali. All Rights Reserved.
                </p>
            </div>
        </div>
    </div>


<script>
    document.getElementById("year").innerHTML = new Date().getFullYear();
</script>



        </div>
    </div>
</div>
<!-- Footer End -->
<style>
    .footer-logo{
        height: auto;
        width: 150px;
        border-radius: 50%;
    }
    .custom-footer {
    background: #e7b894; /* SAME PEACH COLOR */
    color: #2b2b2b;
    font-family: 'Poppins', sans-serif;
}

.footer-logo {
    max-height: 300px;
}
.footer-bottom {
    background: #ddb08b; /* footer se thoda dark shade */
    padding: 12px 0;
    font-size: 14px;
    color: #3a2a1f;
    font-weight: 500;
    border-top: 1px solid rgba(0,0,0,0.1);
}

.footer-bottom p {
    letter-spacing: 0.5px;
}

.footer-tagline {
    font-weight: 600;
    letter-spacing: 1px;
    margin-bottom: 5px;
}

.footer-services {
    font-size: 15px;
}

.footer-title {
    font-weight: 600;
    margin-bottom: 10px;
}

.footer-text {
    font-size: 20px;
    line-height: 1.6;
}

.footer-follow {
    font-weight: 500;
}

.footer-social {
    color: #000;
    font-size: 18px;
    margin: 0 8px;
    text-decoration: none;
}

.footer-social:hover {
    color: #5a3e2b;
}

.footer-qr {
    max-width: 110px;
    margin-top: 10px;
}
.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 10px;
}

.footer-links a {
    color: #2b2b2b;
    text-decoration: none;
    font-size: 20px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.footer-links a:hover {
    color: #5a3e2b;
    padding-left: 5px;
}
/* Ensure all footer columns start from same top */
.custom-footer .row {
    align-items: flex-start !important;
}

/* Quick links spacing fix */
.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 10px;
}

.footer-links a {
    color: #2b2b2b;
    text-decoration: none;
    font-size: 16px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.footer-links a:hover {
    color: #5a3e2b;
    padding-left: 5px;
}

</style>

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('website/lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('website/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('website/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('website/lib/counterup/counterup.min.js') }}"></script>
<script src="{{ asset('website/lib/lightbox/js/lightbox.min.js') }}"></script>
<script src="{{ asset('website/lib/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('website/js/main.js') }}"></script>
</body>
</html>