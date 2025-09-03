<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register - Argent Financial Management System</title>
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='45' fill='%2322577A'/%3E%3Cpath d='M30 40 L50 25 L70 40 L50 55 Z' fill='%2357CC99'/%3E%3Cpath d='M35 50 L65 50 L65 75 L35 75 Z' fill='%2380ED99'/%3E%3Ctext x='50' y='82' text-anchor='middle' fill='white' font-family='sans-serif' font-size='12' font-weight='bold'%3EA%3C/text%3E%3C/svg%3E"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
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
      padding: 40px 10px; /* increased top and bottom padding */
    }

    .auth-container {
      display: flex;
      max-width: 900px;
      width: 100%;
      min-height: 480px;
      background: #ffffff;
      border-radius: 20px;
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      margin: 40px auto; /* increased vertical margin */
    }

    .auth-image {
      flex: 1;
      background: linear-gradient(45deg, rgba(34, 87, 122, 0.9), rgba(56, 163, 165, 0.9));
      background-size: cover;
      background-position: center;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      color: white;
      text-align: center;
      padding: 30px;
    }

    .image-content h2 {
      font-size: 1.6rem;
      margin-bottom: 0.6rem;
      font-weight: 700;
    }

    .image-content p {
      font-size: 0.9rem;
      opacity: 0.9;
      line-height: 1.4;
      max-width: 280px;
      margin: 0 auto;
    }

    .giving-icon {
      font-size: 2.5rem;
      margin-bottom: 1.2rem;
      opacity: 0.8;
    }

    .auth-form {
      flex: 1;
      padding: 30px 35px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      overflow-y: auto;
    }

    .form-header {
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .form-header h1 {
      color: #22577A;
      font-size: 1.5rem;
      margin-bottom: 0.5rem;
      font-weight: 700;
    }

    .form-group,
    .form-row {
      margin-bottom: 1rem;
    }

    .form-row {
      display: flex;
      gap: 0.8rem;
      flex-wrap: wrap;
    }

    .form-group label {
      display: block;
      color: #22577A;
      font-weight: 600;
      margin-bottom: 0.4rem;
      font-size: 0.8rem;
    }

    .input-group {
      position: relative;
    }

    .input-group i {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #80ED99;
      z-index: 1;
      font-size: 0.9rem;
    }

    .form-control {
      width: 100%;
      padding: 8px 8px 8px 36px;
      border: 2px solid #C7F9CC;
      border-radius: 12px;
      font-size: 0.8rem;
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
      padding: 10px;
      background: linear-gradient(135deg, #38A3A5 0%, #57CC99 100%);
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      margin: 0.2rem 0 0.5rem 0;
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
      font-size: 0.85rem;
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

    .password-strength {
      margin-top: 0.4rem;
      font-size: 0.8rem;
      color: #22577A;
    }
    .strength-bar {
      width: 100%;
      height: 6px;
      background: #e2e8f0;
      border-radius: 4px;
      margin-top: 4px;
      overflow: hidden;
    }
    .strength-fill {
      height: 100%;
      width: 0%;
      transition: width 0.3s ease;
      border-radius: 4px;
    }
    .strength-weak {
      width: 20%;
      background-color: #f56565;
    }
    .strength-fair {
      width: 40%;
      background-color: #ed8936;
    }
    .strength-good {
      width: 70%;
      background-color: #48bb78;
    }
    .strength-strong {
      width: 100%;
      background-color: #2f855a;
    }

    @media (max-width: 768px) {
      .auth-container {
        flex-direction: column;
        margin: 20px auto;
        min-height: auto;
        max-width: 100%;
      }

      .auth-image {
        min-height: 180px;
        padding: 20px;
      }

      .auth-form {
        padding: 30px 20px;
      }

      .form-row {
        flex-direction: column;
        gap: 0;
      }

      .image-content p {
        max-width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="auth-container">
    <div class="auth-image">
      <div class="image-content">
        <div class="giving-icon">
          <a href="{{ route('landing') }}">
            <i class="fas fa-church" style="color: white; font-size: 80px;"></i>
          </a>
        </div>
        <h2>Join Our Community</h2>
        <p>Become part of our church family and participate in our mission of giving, caring, and spreading love throughout our community.</p>
      </div>
    </div>
    <div class="auth-form">
      <!-- Error Messages -->
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul style="list-style: none; padding: 0; margin: 0;">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('register.post') }}" id="registerForm">
        @csrf
        <div class="form-header">
          <h1>Create Account</h1>
        </div>
        <div class="form-group">
          <label for="name">Full Name</label>
          <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" 
                   id="name" 
                   name="name" 
                   class="form-control" 
                   placeholder="Enter your full name"
                   value="{{ old('name') }}"
                   required 
                   autofocus/>
          </div>
        </div>

        <div class="form-group">
          <label for="email">Email Address</label>
          <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" 
                   id="email" 
                   name="email" 
                   class="form-control" 
                   placeholder="Enter your email address"
                   value="{{ old('email') }}"
                   required/>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="phone">Phone Number</label>
            <div class="input-group">
              <i class="fas fa-phone"></i>
              <input type="tel" 
                     id="phone" 
                     name="phone" 
                     class="form-control" 
                     placeholder="Enter phone number"
                     value="{{ old('phone') }}"
                     required/>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="address">Address</label>
          <div class="input-group">
            <i class="fas fa-map-marker-alt"></i>
            <input type="text" 
                   id="address" 
                   name="address" 
                   class="form-control" 
                   placeholder="Enter your complete address"
                   value="{{ old('address') }}"
                   required/>
          </div>
        </div>
        
        <div class="form-group">
          <label for="profile-ministry">Ministry Involvement</label>
          <select id="profile-ministry" name="ministry" class="form-control" required>
            <option value="youth" {{ old('ministry') == 'youth' ? 'selected' : '' }}>Youth Ministry</option>
            <option value="worship" {{ old('ministry') == 'worship' ? 'selected' : '' }}>Worship Team</option>
            <option value="children" {{ old('ministry') == 'children' ? 'selected' : '' }}>Children's Ministry</option>
            <option value="none" {{ old('ministry') == 'none' ? 'selected' : '' }}>None</option>
          </select>
        </div>

        <div class="form-row">
          <div class="form-group" style="flex:1;">
            <label for="password">Password</label>
            <div class="input-group">
              <i class="fas fa-lock"></i>
              <input type="password" 
                     id="password" 
                     name="password" 
                     class="form-control" 
                     placeholder="Create a password"
                     required
                     minlength="8"/>
            </div>
            <div class="password-strength">
              <span id="strength-text">Password strength</span>
              <div class="strength-bar">
                <div class="strength-fill" id="strength-fill"></div>
              </div>
            </div>
          </div>

          <div class="form-group" style="flex:1;">
            <label for="password_confirmation">Confirm Password</label>
            <div class="input-group">
              <i class="fas fa-lock"></i>
              <input type="password" 
                     id="password_confirmation" 
                     name="password_confirmation" 
                     class="form-control" 
                     placeholder="Confirm your password"
                     required/>
            </div>
          </div>
        </div>

        <button type="submit" class="btn-primary" id="submitBtn">
          Create Account
        </button>
        <button 
          type="button" 
          class="btn-primary" 
          onclick="window.location='{{ route('landing') }}'">
          Cancel
        </button>
      </form>

      <div class="auth-links">
        Already have an account? 
        <a href="{{ route('login') }}">Sign in here</a>
      </div>
    </div>
  </div>

  <script>
    // Password strength checker
    const passwordInput = document.getElementById('password');
    const strengthFill = document.getElementById('strength-fill');
    const strengthText = document.getElementById('strength-text');

    passwordInput.addEventListener('input', function() {
      const password = this.value;
      const strength = calculatePasswordStrength(password);
      
      strengthFill.className = 'strength-fill strength-' + strength.level;
      strengthText.textContent = strength.text;
    });

    function calculatePasswordStrength(password) {
      let score = 0;
      
      if (password.length >= 8) score++;
      if (password.match(/[a-z]/)) score++;
      if (password.match(/[A-Z]/)) score++;
      if (password.match(/[0-9]/)) score++;
      if (password.match(/[^a-zA-Z0-9]/)) score++;
      
      switch(score) {
        case 0:
        case 1:
          return { level: 'weak', text: 'Weak password' };
        case 2:
          return { level: 'fair', text: 'Fair password' };
        case 3:
        case 4:
          return { level: 'good', text: 'Good password' };
        case 5:
          return { level: 'strong', text: 'Strong password' };
        default:
          return { level: 'weak', text: 'Password strength' };
      }
    }

    // Form validation
    const form = document.getElementById('registerForm');
    const submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', function(e) {
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('password_confirmation').value;

      if (password !== confirmPassword) {
        e.preventDefault();
        alert('Passwords do not match!');
        return;
      }

      // Add loading state
      this.classList.add('loading');
      submitBtn.textContent = 'Creating Account...';
    });

    // Real-time password confirmation validation
    document.getElementById('password_confirmation').addEventListener('input', function() {
      const password = document.getElementById('password').value;
      const confirmPassword = this.value;
      
      if (confirmPassword && password !== confirmPassword) {
        this.style.borderColor = '#f56565';
      } else {
        this.style.borderColor = '#e2e8f0';
      }
    });

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
      const alerts = document.querySelectorAll('.alert');
      alerts.forEach(function(alert) {
        alert.style.transition = 'opacity 0.5s ease';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 500);
      });
    }, 5000);

    // Phone number formatting
    document.getElementById('phone').addEventListener('input', function() {
      let value = this.value.replace(/\D/g, '');
      if (value.length >= 10) {
        value = value.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
      }
      this.value = value;
    });
  </script>
</body>
</html>