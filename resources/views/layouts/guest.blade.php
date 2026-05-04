<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Figtree', sans-serif;
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
            position: relative;
            overflow: hidden;
        }

        /* Animated background particles */
        body::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(2px 2px at 20% 30%, rgba(255,255,255,0.3), transparent),
                radial-gradient(2px 2px at 40% 70%, rgba(255,255,255,0.2), transparent),
                radial-gradient(2px 2px at 60% 20%, rgba(255,255,255,0.3), transparent),
                radial-gradient(2px 2px at 80% 80%, rgba(255,255,255,0.2), transparent),
                radial-gradient(1px 1px at 10% 90%, rgba(255,255,255,0.15), transparent),
                radial-gradient(1px 1px at 90% 10%, rgba(255,255,255,0.15), transparent),
                radial-gradient(1px 1px at 50% 50%, rgba(255,255,255,0.1), transparent);
            background-size: 200px 200px;
            animation: twinkle 4s ease-in-out infinite alternate;
        }

        @keyframes twinkle {
            0% { opacity: 0.5; transform: scale(1); }
            100% { opacity: 1; transform: scale(1.05); }
        }

        /* Floating orbs */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.4;
            animation: float 8s ease-in-out infinite;
        }
        .orb-1 {
            width: 400px;
            height: 400px;
            background: #667eea;
            top: -100px;
            right: -100px;
            animation-delay: 0s;
        }
        .orb-2 {
            width: 350px;
            height: 350px;
            background: #764ba2;
            bottom: -80px;
            left: -80px;
            animation-delay: -3s;
        }
        .orb-3 {
            width: 200px;
            height: 200px;
            background: #f093fb;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: -6s;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(30px, -30px) scale(1.1); }
            50% { transform: translate(-20px, 20px) scale(0.9); }
            75% { transform: translate(20px, 30px) scale(1.05); }
        }

        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 440px;
            padding: 20px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 40px 35px;
            box-shadow:
                0 25px 60px rgba(0, 0, 0, 0.3),
                0 0 0 1px rgba(255, 255, 255, 0.1);
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }

        .login-header .avatar i {
            font-size: 36px;
            color: #fff;
        }

        .login-header h3 {
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 5px;
        }

        .login-header p {
            color: #6c757d;
            font-size: 14px;
            margin: 0;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 12px 16px;
            height: auto;
            font-size: 14px;
            transition: all 0.3s;
            background: #f8f9fa;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            background: #fff;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .input-group-text {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            background: #f8f9fa;
            color: #6c757d;
            transition: all 0.3s;
        }

        .input-group .form-control {
            border-left: 0;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .input-group .input-group-text {
            border-right: 0;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .input-group:focus-within .input-group-text {
            border-color: #667eea;
            background: #fff;
        }

        .form-label {
            font-weight: 600;
            font-size: 13px;
            color: #495057;
            margin-bottom: 6px;
        }

        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            font-size: 15px;
            color: #fff;
            width: 100%;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            color: #fff;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 60%);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .btn-login:hover::after {
            opacity: 1;
        }

        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }

        .forgot-link {
            color: #667eea;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .forgot-link:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 20px 0;
            color: #adb5bd;
            font-size: 12px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e9ecef;
        }

        .divider:not(:empty)::before {
            margin-right: 10px;
        }

        .divider:not(:empty)::after {
            margin-left: 10px;
        }

        .back-home {
            text-align: center;
            margin-top: 20px;
        }

        .back-home a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s;
        }

        .back-home a:hover {
            color: #fff;
        }

        .alert {
            border-radius: 12px;
            font-size: 13px;
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Floating orbs -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="avatar">
                    <i class="fas fa-lock"></i>
                </div>
                <h3>Welcome Back</h3>
                <p>Sign in to manage your portfolio</p>
            </div>

            {{ $slot }}
        </div>

        <div class="back-home">
            <a href="{{ route('home') }}">
                <i class="fas fa-arrow-left me-1"></i> Back to Homepage
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
