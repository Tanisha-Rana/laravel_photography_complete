<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Login | Photography By Monali</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- BASE PATH -->
    <base href="/PHOTOGRAPHY/Admin Panel/">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Work+Sans:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('assets/images/backgrounds/studio.png');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Work Sans', sans-serif;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 45px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }
        .btn-primary {
            background-color: #E7B894;
            border: none;
            padding: 14px;
            font-weight: 600;
            color: #000;
            border-radius: 12px;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #d4a37a;
            transform: translateY(-2px);
            color: #000;
        }
        .form-control {
            padding: 12px 15px;
            border-radius: 12px;
            border: 1px solid #ddd;
            background-color: #fff;
        }
        .brand-text {
            font-family: 'Playfair Display', serif;
            color: #333;
            font-weight: 700;
        }
        .admin-badge {
            display: inline-block;
            padding: 5px 15px;
            background: #E7B894;
            color: #000;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            border-radius: 50px;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="text-center mb-4">
        <div class="admin-badge">Secure Admin Access</div>
        <img src="assets/images/image.png" style="width: 120px;" class="mb-3">
        <h3 class="brand-text">Admin Panel</h3>
        <p class="text-muted small">Photography By Monali</p>
    </div>

    <!--
        Admin login credentials are hidden for security.
        Gmail: admin@monali.com
        Password: admin123
    -->
    <form method="post" action="{{ url('admin_login') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label small fw-bold">Management Email</label>
            <input type="email" name="email" class="form-control" placeholder="admin@monali.com" required>
        </div>
        <div class="mb-4">
            <label class="form-label small fw-bold">Secret Password</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary w-100 mb-2">Authorize Login</button>
    </form>
    <div class="text-center mt-3">
        <a href="../website/index" class="text-decoration-none small text-muted">← Back to Website</a>
    </div>
</div>

</body>
</html>
