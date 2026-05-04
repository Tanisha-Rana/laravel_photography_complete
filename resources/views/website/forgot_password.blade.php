<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password | Photography By Monali</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link href="{{ asset('website/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset("website/img/studio.png") }}');
            background-size: cover;
            background-position: center;
        }
        .card {
            border-radius: 20px;
            background: rgba(255,255,255,0.9);
        }
        .btn-primary {
            background-color: #E7B894;
            border: none;
            color: black;
        }
    </style>
</head>

<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <div class="card p-5" style="max-width:450px; width:100%;">

        <h3 class="text-center mb-3">Forgot Password</h3>
        <p class="text-center text-muted mb-4">Reset your password using OTP</p>

        <form method="POST" action="/forgot/reset">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" id="fp_email" class="form-control" required>
            </div>

            <!-- Send OTP -->
            <button type="button" onclick="sendForgotOtp()" class="btn btn-outline-dark w-100 mb-3">
                Send OTP
            </button>

            <!-- OTP -->
            <div class="mb-3">
                <label>Enter OTP</label>
                <input type="text" name="otp" class="form-control" required>
            </div>

            <!-- New Password -->
            <div class="mb-3">
                <label>New Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-primary w-100">
                Reset Password
            </button>
        </form>

        <p class="text-center mt-3">
            <a href="{{ url('login') }}">Back to Login</a>
        </p>

    </div>
</div>

<script>
function sendForgotOtp() {
    let email = document.getElementById('fp_email').value;

    if (!email) {
        Swal.fire('Error', 'Please enter email first', 'error');
        return;
    }

    fetch('/forgot/send-otp', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ email: email })
    })
    .then(res => res.json())
.then(data => {
    console.log(data); // 👈 ye add karo
   Swal.fire('OTP', 'Your OTP is: ' + data.otp, 'info');
});
}
</script>

</body>
</html>