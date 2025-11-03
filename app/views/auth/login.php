<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to TechStore</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <link rel="stylesheet" href="<?= base_url();?>public/css/login.css">
</head>
<body style="background-image: url('<?= base_url();?>public/resources/bg.jpg');">

    <div class="welcome-container" id="welcome-container">
        <div class="welcome-content">
            
            <div class="logo-container anim-fade-in">
                <i class="fas fa-laptop-code"></i>
            </div>
            
            <h1 class="anim-slide-up" style="animation-delay: 0.2s;">Welcome to TechStore</h1>
            <p class="anim-slide-up" style="animation-delay: 0.4s;">
                Your one-stop shop for the latest and greatest in technology.
                <br>
                Join us and discover the future of tech retail.
            </p>
            <div class="welcome-buttons anim-slide-up" style="animation-delay: 0.6s;">
                <button class="btn primary" id="show-login-btn">Login</button>
                <button class="btn secondary" id="show-register-btn">Register</button>
            </div>

        </div>
    </div>
    <div class="modal-wrapper hidden" id="modal-wrapper">
        <div class="container" id="container">
            <span class="close-btn" id="close-btn">&times;</span>

            <div class="form-container sign-up-container">
                <form id="regForm" method="POST" action="<?=site_url('auth/register');?>">
                    <h1>Create Account</h1>
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Username" />
                    </div>
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" />
                    </div>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" />
                    </div>
                    <button class="btn" style="margin-top: 20px;">Register</button>
                </form>
            </div>

            <div class="form-container sign-in-container">
                <form id="logForm" method="POST" action="<?=site_url('auth/login');?>">
                    <h1>Login</h1>
                    <div class="input-group">
                        <i class="fas fa-user-shield"></i>
                        <input type="text" placeholder="Email or Username" />
                    </div>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" />
                    </div>
                    <a href="<?=site_url('auth/password-reset');?>">Forgot your password?</a>
                    <button class="btn">Login</button>
                </form>
            </div>

            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Welcome Back!</h1>
                        <p>To keep connected with us please login with your personal info</p>
                        <button class="btn ghost" id="signIn">Login</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Hello, Techmate!</h1>
                        <p>Enter your personal details and start your journey with TechStore</p>
                        <button class="btn ghost" id="signUp">Register</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url();?>public/js/login.js"></script>
</body>
</html>