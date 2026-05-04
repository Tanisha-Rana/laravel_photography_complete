<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Status | Photography By Monali</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <div class="card shadow p-4 text-center" style="max-width:420px; width:100%;">

        <!-- Brand -->
        <img src="img/monali-logo.png" alt="Photography By Monali" style="width:110px;" class="mb-2">
        <h5 class="mb-3">Photography By Monali</h5>

        <!-- ✅ Success Message -->
        <div class="alert alert-success">
            🎉 Your booking request has been submitted successfully!
        </div>

        <!-- 🔔 OTP Sent Notification -->
        <div class="alert alert-info small">
            An OTP has been sent to your registered email / mobile number for verification.
        </div>

        <!-- 🔐 OTP Input -->
        <form>
            <input type="text" class="form-control mb-3" placeholder="Enter OTP" required>
<a href="payment.php" class="btn btn-sm btn-primary mt-2">
    Pay Now
</a>

        </form>

        <!-- ⏳ Waiting for Admin -->
        <div class="alert alert-warning small mb-0">
            ⏳ Waiting for admin confirmation.  
            You will be notified once your slot is confirmed or an alternative timing is suggested.
        </div>

    </div>
</div>

</body>
</html>
