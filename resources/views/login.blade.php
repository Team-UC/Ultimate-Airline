<?php
// Start the session to manage user login state and display errors.
session_start();

// If the user is already logged in, redirect them to the welcome page.
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: welcome.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ultimate Airlines</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('https://images.unsplash.com/photo-1500930287589-c4f419f40d24?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
        }
        .login-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 1rem;
        }
        .login-card {
            background-color: rgba(17, 24, 39, 0.85); /* Dark background with opacity */
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1.5rem; /* More rounded corners */
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .form-control {
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            border-radius: 0.75rem;
        }
        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .form-control::placeholder {
            color: #a0aec0;
        }
        .btn-primary {
            border-radius: 0.75rem;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
            <div class="card login-card text-white p-4">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="https://ultimatecoder.in/images/logo.png" alt="Ultimate Airlines Logo" style="height: 60px;">
                        <h2 class="mt-3 mb-2">Welcome Back!</h2>
                        <p class="text-white-50">Please enter your credentials to log in.</p>
                    </div>

                    <?php
                    // Display an error message if the login failed
                    if (isset($_GET['error'])) {
                        echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($_GET['error']) . '</div>';
                    }
                    ?>

                  <form action="{{ route('login.submit') }}" method="POST">
                     @csrf <!-- IMPORTANT: This adds CSRF protection, required by Laravel -->
                     <div class="mb-3">
                     <label for="email" class="form-label">Email address</label>
                     <input type="email" class="form-control p-3" id="email" name="email" placeholder="name@example.com" required>
                     </div>
                     <div class="mb-3">
                     <label for="password" class="form-label">Password</label>
                     <input type="password" class="form-control p-3" id="password" name="password" placeholder="Enter your password" required>
                     </div>
                     <div class="d-flex justify-content-between align-items-center mb-4">
                     <a href="#" class="text-decoration-none text-primary">Forgot password?</a>
                     </div>
                     <div class="d-grid">
                     <button type="submit" class="btn btn-primary btn-lg p-3">Log In</button>
                     </div>
                     </form>

                    <div class="text-center mt-4">
                        <p class="text-white-50">Don't have an account? <a href="#" class="text-primary fw-bold text-decoration-none">Sign Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>