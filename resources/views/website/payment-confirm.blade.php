<!DOCTYPE html>
<html>
<head>
    <title>Payment Success</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5 text-center">
    <div class="card shadow p-4 mx-auto" style="max-width:500px">

        <div class="success-icon">✔</div>
        <h4 class="mt-3">Payment Successful</h4>
        <p class="text-muted">Your booking is confirmed</p>

        <hr>

        <p><strong>Transaction ID:</strong> TXN123456</p>
        <p><strong>Amount Paid:</strong> ₹8,000</p>

        <div class="d-grid gap-2 mt-3">
            <a href="invoice.php" class="btn btn-primary">Download Invoice</a>
            <a href="mybookings.php" class="btn btn-outline-secondary">Go to My Bookings</a>
        </div>

    </div>
</div>

</body>
</html>
