<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - User Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f9;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-card {
            background: #fff;
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            width: 100%;
            max-width: 420px;
            overflow: hidden;
        }

        .login-header {
            padding: 2rem 2rem 1rem;
            text-align: center;
            border-bottom: 1px solid #e3e6f0;
        }

        .login-header h2 {
            font-weight: 700;
            color: #4e73df;
            margin-bottom: 0.5rem;
            font-size: 1.5rem;
        }
        
        .login-header p {
            color: #858796;
            font-size: 0.9rem;
            margin: 0;
        }

        .login-body {
            padding: 2rem;
        }

        .form-label {
            font-weight: 600;
            color: #4a5568;
            font-size: 0.85rem;
        }

        .form-control {
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.15);
        }

        .btn-login {
            background-color: #4e73df;
            border: none;
            border-radius: 0.5rem;
            padding: 0.75rem;
            font-weight: 700;
            font-size: 1rem;
            color: white;
            transition: all 0.3s;
            width: 100%;
            margin-top: 1rem;
        }

        .btn-login:hover {
            background-color: #2e59d9;
            color: white;
        }

        .error-toast {
            background: #fff5f5;
            border-left: 4px solid #e74a3b;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 0.5rem;
            color: #c53030;
            font-size: 0.85rem;
        }

        .input-group-text {
            background-color: #f8f9fc;
            border-color: #d1d5db;
            color: #b7b9cc;
            border-radius: 0.5rem 0 0 0.5rem;
        }
        
        .form-control.with-icon {
            border-radius: 0 0.5rem 0.5rem 0;
        }
        
        .login-footer {
            padding: 1rem 2rem 2rem;
            text-align: center;
            font-size: 0.85rem;
            color: #b7b9cc;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <div class="mb-3">
                <i class="fas fa-users-cog fa-2x text-primary"></i>
            </div>
            <h2>User Management System</h2>
            <p>Welcome back! Please enter your credentials.</p>
        </div>
        <div class="login-body">
            @if ($errors->any())
                <div class="error-toast">
                    <ul class="mb-0 list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li><i class="fas fa-exclamation-circle me-2"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" id="email" name="email" class="form-control with-icon @error('email') is-invalid @enderror" 
                               value="{{ old('email') }}" placeholder="Enter email" required autofocus>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" id="password" name="password" class="form-control with-icon" 
                               placeholder="Enter password" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-login">
                    Login
                </button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
