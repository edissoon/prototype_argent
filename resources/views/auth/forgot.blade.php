<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot Password - Argent Financial Management System</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='45' fill='%2322577A'/%3E%3Cpath d='M30 40 L50 25 L70 40 L50 55 Z' fill='%2357CC99'/%3E%3Cpath d='M35 50 L65 50 L65 75 L35 75 Z' fill='%2380ED99'/%3E%3Ctext x='50' y='82' text-anchor='middle' fill='white' font-family='sans-serif' font-size='12' font-weight='bold'%3EA%3C/text%3E%3C/svg%3E">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #22577A 0%, #38A3A5 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-container {
            display: flex;
            max-width: 1200px;
            width: 100%;
            min-height: 600px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 20px;
        }

        .auth-image {
            flex: 1;
            background: linear-gradient(45deg, rgba(34, 87, 122, 0.8), rgba(56, 163, 165, 0.8));
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: white;
            text-align: center;
            padding: 40px;
        }

        .image-content h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .image-content p {
            font-size: 1.2rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .recovery-icon {
            font-size: 4rem;
            margin-bottom: 2rem;
            opacity: 0.8;
        }

        .auth-form {
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .form-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .form-header h1 {
            color: #22577A;
            font-size: 2rem;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .form-header p {
            color: #57CC99;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            color: #22577A;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #80ED99;
            z-index: 1;
        }

        .form-control {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 2px solid #C7F9CC;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .form-control:focus {
            outline: none;
            border-color: #38A3A5;
            background: white;
            box-shadow: 0 0 0 3px rgba(56, 163, 165, 0.2);
        }

        .btn-primary {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #38A3A5 0%, #57CC99 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
            position: relative;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(56, 163, 165, 0.3);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .auth-links {
            text-align: center;
            color: #22577A;
            margin-top: 1rem;
        }

        .auth-links a {
            color: #38A3A5;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .auth-links a:hover {
            color: #57CC99;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .alert-danger {
            background: #ffe0e0;
            color: #b00020;
            border: 1px solid #ffb3b3;
        }

        .alert-success {
            background: #c7f9cc;
            color: #2f855a;
            border: 1px solid #80ED99;
        }

        .info-box {
            background: #e0f7f7;
            color: #22577A;
            border: 1px solid #C7F9CC;
            border-radius: 8px;
            padding: 10px 15px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .button-panels {
            display: flex;
            gap: 20px;
            margin-top: 1rem;
            flex-wrap: wrap;
        }

        .button-panel {
            flex: 1;
            background: #f8fafc;
            border: 2px solid #C7F9CC;
            border-radius: 12px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 56px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            font-size: 1rem;
            color: #22577A;
            user-select: none;
        }

        .button-panel:hover {
            border-color: #38A3A5;
            background: #e0f7f7;
            color: #38A3A5;
        }

        .button-panel:active {
            background: #c7f9cc;
            color: #22577A;
        }

        .button-panel button,
        .button-panel a {
            all: unset;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: inherit;
            font-weight: inherit;
            font-size: inherit;
            border-radius: 12px;
        }

        .button-panel button i,
        .button-panel a i {
            margin-right: 8px;
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .auth-container {
                flex-direction: column;
                margin: 10px;
                min-height: auto;
            }

            .auth-image {
                min-height: 200px;
                padding: 20px;
            }

            .image-content h2 {
                font-size: 1.8rem;
            }

            .image-content p {
                font-size: 1rem;
            }

            .auth-form {
                padding: 40px 30px;
            }

            .button-panels {
                flex-direction: column;
            }

            .button-panel {
                width: 100%;
                height: 48px;
            }
        }

        .loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .loading .btn-primary::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 2px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-image">
            <div class="image-content">
                <div class="recovery-icon">
                    <i class="fas fa-key" style="color: white; font-size: 100px;"></i>
                </div>
                <h2>Password Recovery</h2>
                <p>Don't worry! We'll help you get back on track securely and easily.</p>
            </div>
        </div>

        <div class="auth-form">
            <div class="form-header">
                <h1>Forgot Password?</h1>
                <p>Enter your email address to receive a reset link.</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('status') }}
                </div>
            @endif

            <div class="info-box">
                <i class="fas fa-info-circle"></i>
                We'll send a secure link to reset your password. Check your email after submitting this form.
            </div>

            <form method="POST" action="{{ route('forgot.post') }}" id="forgotForm">
                @csrf
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               class="form-control" 
                               placeholder="Enter your registered email"
                               value="{{ old('email') }}"
                               required 
                               autofocus>
                    </div>
                </div>

                <div class="button-panels">
                    <div class="button-panel">
                        <button type="submit" class="btn-primary" style="all: unset; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; cursor: pointer; color: white; background: linear-gradient(135deg, #38A3A5 0%, #57CC99 100%); border-radius: 12px; font-weight: 600; font-size: 1rem;">
                            <i class="fas fa-paper-plane" style="margin-right: 8px;"></i> Send Reset Link
                        </button>
                    </div>
                    <div class="button-panel">
                        <a href="{{ route('login') }}" class="back-to-login" style="all: unset; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #22577A; font-weight: 600; font-size: 1rem; border-radius: 12px;">
                            <i class="fas fa-arrow-left" style="margin-right: 8px;"></i> Back to Login
                        </a>
                    </div>
                </div>
            </form>

            <div class="auth-links">
                Remember your password?
                <a href="{{ route('login') }}">Sign in here</a>
                <br><br>
                Don't have an account?
                <a href="{{ route('register') }}">Create one</a>
            </div>
            
        </div>
    </div>

    <script>
        document.getElementById('forgotForm').addEventListener('submit', function () {
            this.classList.add('loading');
            const btn = this.querySelector('button[type="submit"]');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin" style="margin-right: 8px;"></i> Sending...';
        });

        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 8000);

        document.getElementById('email').addEventListener('input', function () {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            this.style.borderColor = this.value && !emailRegex.test(this.value)
                ? '#f56565'
                : '#e2e8f0';
        });
    </script>
</body>
</html>