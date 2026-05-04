<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Photographer Login | Photography By Monali</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
            font-family: 'Inter', sans-serif;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-card {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 420px;
            padding: 40px;
            border: 1px solid rgba(0,0,0,0.05);
        }
        .brand-logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            display: block;
            border-radius: 20px;
            object-fit: contain;
        }
        .login-title {
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 8px;
            text-align: center;
        }
        .login-subtitle {
            color: #666;
            text-align: center;
            font-size: 14px;
            margin-bottom: 30px;
        }
        .form-label {
            font-weight: 600;
            font-size: 13px;
            color: #444;
            margin-bottom: 8px;
        }
        .form-control {
            border-radius: 12px;
            padding: 12px 16px;
            border: 1px solid #e0e0e0;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(231, 184, 148, 0.15);
            border-color: #E7B894;
        }
        .btn-login {
            background: #E7B894;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            color: #000;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            background: #d4a37a;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(231, 184, 148, 0.3);
        }
        .alert-custom {
            border-radius: 12px;
            font-size: 14px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    @include('sweetalert::alert')

    <div class="login-container">
        <div class="login-card">
            <img src="{{ url('website/img/logo.png') }}" alt="Logo" class="brand-logo">
            <h3 class="login-title">Photographer Portal</h3>
            <p class="login-subtitle">Sign in to manage your shoots and gallery</p>

            @if(Session::has('fail'))
                <div class="alert alert-danger alert-custom">
                    {{ Session::get('fail') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-custom">
                    <ul class="mb-0 list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('photographer/login') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="john@monali.com" required value="{{ old('email') }}">
                    <span class="text-danger small">@error('email') {{ $message }} @enderror</span>
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    <span class="text-danger small">@error('password') {{ $message }} @enderror</span>
                </div>

                <button type="submit" class="btn btn-login">Login to Dashboard</button>
            </form>

            <div class="text-center mt-4">
                <a href="{{ url('/') }}" class="text-muted text-decoration-none small">← Back to Website</a>
            </div>
        </div>
    </div>

</body>
</html>