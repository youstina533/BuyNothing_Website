
<?php
define('ROOT_PATH', dirname(__DIR__) . '/');
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: " . ROOT_PATH . "views/dashboard.php");
    exit();
}
if (isset($_GET['logout'])) {
    require_once ROOT_PATH . 'controllers/LogoutController.php';
    (new LogoutController())->logout();
}
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'register':
            require_once ROOT_PATH . 'controllers/UserController.php';
            (new UserController())->register($_POST['username'], $_POST['email'], $_POST['password']);
            break;
        case 'login':
            require_once ROOT_PATH . 'controllers/UserController.php';
            (new UserController())->login($_POST['email'], $_POST['password']);
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Buy Nothing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <span class="ms-2 fw-bold text-primary">Buy Nothing</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rules.php">Rules</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customer-service.php">Help</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <div class="dropdown me-2">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-globe"></i> English
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                            <li><a class="dropdown-item active" href="#">English</a></li>
                            <li><a class="dropdown-item" href="#">العربية</a></li>
                            <li><a class="dropdown-item" href="#">Español</a></li>
                            <li><a class="dropdown-item" href="#">Français</a></li>
                        </ul>
                    </div>
                    <a href="login.php" class="btn btn-outline-primary me-2">Login</a>
                    <a href="register.php" class="btn btn-primary">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 p-md-5">
                            <h2 class="text-center mb-4">Welcome Back</h2>
                            <p class="text-center text-muted mb-4">Log in to your Buy Nothing account</p>
                                </div>
                        
                            <div class="d-grid gap-2 mb-4">
                                <button class="btn btn-outline-primary" type="button">
                                    <i class="fab fa-google me-2"></i> Continue with Google
                                </button>
                                <button class="btn btn-outline-primary" type="button">
                                    <i class="fab fa-facebook-f me-2"></i> Continue with Facebook
                                </button>
                            </div>
                            <div class="text-center mb-4">
                                <span class="divider-text bg-light px-3">OR</span>
                            </div>
                            <form id="loginForm" action="dashboard.php" method="POST" action="dashboard.php">
                                <div class="mb-3">
                                    <label for="loginEmail" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="loginEmail" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="loginPassword" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="loginPassword" name="password" required>
                                        <button class="btn btn-outline-secondary" type="button" id="toggleLoginPassword">
                                            <i class="far fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                                        <label class="form-check-label" for="rememberMe">
                                            Remember me
                                        </label>
                                    </div>
                                    <a href="#" class="text-decoration-none">Forgot password?</a>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary py-2">Log In</button>
                                </div>
                            </form>
                            <div class="text-center mt-4">
                                <p class="mb-0">Don't have an account? <a href="register.php">Sign Up</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h5 class="mb-3">Buy Nothing</h5>
                    <p class="mb-3">A global movement where people give and receive freely, reducing waste and building community.</p>
                    <div class="social-icons">
                        <a href="#" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-6">
                    <h5 class="mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="../index.php" class="text-white text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="about.php" class="text-white text-decoration-none">About Us</a></li>
    
                        <li class="mb-2"><a href="rules.php" class="text-white text-decoration-none">Rules</a></li>
                        <li><a href="customer-service.php" class="text-white text-decoration-none">Help</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-3 col-6">
                    <h5 class="mb-3">Resources</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Blog</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Volunteer</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Community Events</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Local Resources</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5 class="mb-3">Stay Connected</h5>
                    <p>Subscribe to our newsletter for updates and news.</p>
                    <form class="mb-3">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Your email" aria-label="Your email" required>
                            <button class="btn btn-primary" type="submit">Subscribe</button>
                        </div>
                    </form>
                    <p class="mb-0"><i class="fas fa-phone me-2"></i> Customer Service: +1 (555) 123-4567</p>
                    <p><i class="fas fa-envelope me-2"></i> support@buynothing.org</p>
                </div>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-md-6 mb-3 mb-md-0">
                    <p class="mb-0">© 2023 Buy Nothing Project. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-white text-decoration-none me-3">Privacy Policy</a>
                    <a href="#" class="text-white text-decoration-none me-3">Terms of Service</a>
                    <a href="#" class="text-white text-decoration-none">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   
</body>
</html>