<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Account | Photography By Monali</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('website/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Work+Sans:wght@400;500&display=swap" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset("website/img/studio.png") }}');
            background-size: cover;
            background-position: center;
            font-family: 'Work Sans', sans-serif;
        }
        .register-card {
            border: none;
            border-radius: 20px;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }
        .btn-primary {
            background-color: #E7B894;
            border-color: #E7B894;
            color: #000;
            font-weight: 600;
            padding: 12px;
            border-radius: 10px;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #d4a37a;
            border-color: #d4a37a;
            transform: translateY(-2px);
        }
        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #ddd;
        }
        .brand-text {
            font-family: 'Playfair Display', serif;
            color: #333;
            font-weight: 600;
        }
    </style>
</head>

<body>
    @include('sweetalert::alert')

<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <div class="card register-card p-5 text-center" style="max-width:480px; width:100%;">

        <img src="{{ asset('website/img/logo.png') }}" style="width:140px;" class="mx-auto mb-3">
        <h3 class="brand-text mb-3">Join Us</h3>
        <p class="text-muted mb-4">Capture your beautiful moments with us</p>

       <form method="POST" action="/signup/verify">
    @csrf

    <div class="mb-3 text-start">
        <label>Full Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3 text-start">
        <label>Email</label>
        <input type="email" name="email" id="reg_email" class="form-control" required>
    </div>

    <div class="mb-3 text-start">
        <label>Phone</label>
        <input type="text" name="phone" id="reg_phone" class="form-control" required>
    </div>


    <div class="mb-3 text-start">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">
        Verify & Create Account
    </button>
</form>
        <p class="mt-2 mb-0">
            Already have an account? <button onclick="window.location='{{ url('login') }}'" class="btn btn-link fw-bold p-0 text-decoration-none" style="color: #E7B894;">Login Now</button>
        </p>

    </div>
</div>


<script>
function sendSignupOtp() {
    let phone = document.getElementById('reg_phone').value;

    if (!phone) {
        Swal.fire('Error', 'Enter phone first', 'error');
        return;
    }

    fetch('/signup/send-otp', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ phone: phone })
    })
    .then(res => res.json())
    .then(data => {
        Swal.fire('Success', 'OTP Sent Successfully', 'success');
    });
}
</script>
</body>
</html>
