<?php
define('ROOT_PATH', __DIR__ . '/../');
session_start();
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
    <title>Buy Nothing - Give, Share, Build Community</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/logo.png" alt="Buy Nothing Logo" height="40">
                <span class="ms-2 fw-bold text-primary">Buy Nothing</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Views/about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Views/rules.php">Rules</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Views/customer-service.php">Help</a>
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
                    <a href="views/login.php" class="btn btn-outline-primary me-2">Login</a>
                    <a href="Views/register.php" class="btn btn-primary">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h1 class="display-4 fw-bold mb-3">Give. Share. Build Community.</h1>
                    <p class="lead mb-4">Join the movement where neighbors share and give freely, reducing waste and building stronger communities.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="Views/register.php" class="btn btn-primary btn-lg">Join Now</a>
                        <a href="#how-it-works" class="btn btn-outline-secondary btn-lg">Learn More</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="https://via.placeholder.com/600x400" alt="Community Sharing" class="img-fluid rounded-3 shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-4 bg-primary text-white">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-3 mb-md-0">
                    <h2 class="fw-bold">5.2M+</h2>
                    <p class="mb-0">Community Members</p>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <h2 class="fw-bold">12.8M+</h2>
                    <p class="mb-0">Items Gifted</p>
                </div>
                <div class="col-md-4">
                    <h2 class="fw-bold">250K+</h2>
                    <p class="mb-0">Volunteers</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">How It Works</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon bg-primary bg-opacity-10 text-primary mx-auto mb-4">
                                <i class="fas fa-user-plus fa-2x"></i>
                            </div>
                            <h4>1. Join Your Local Group</h4>
                            <p class="text-muted">Create an account, set your location, and join your neighborhood group to connect with neighbors.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon bg-primary bg-opacity-10 text-primary mx-auto mb-4">
                                <i class="fas fa-hand-holding-heart fa-2x"></i>
                            </div>
                            <h4>2. Give or Ask</h4>
                            <p class="text-muted">Post items you want to give away or ask for something you need. No money changes hands.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon bg-primary bg-opacity-10 text-primary mx-auto mb-4">
                                <i class="fas fa-people-carry fa-2x"></i>
                            </div>
                            <h4>3. Connect & Share</h4>
                            <p class="text-muted">Comment on posts, arrange pickups, and build relationships with people in your community.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Groups -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Featured Groups</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="New York Group">
                        <div class="card-body">
                            <h5 class="card-title">New York City</h5>
                            <p class="card-text">Over 50,000 members sharing items across the five boroughs.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">50,234 members</small>
                                <a href="#" class="btn btn-sm btn-outline-primary">View Group</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="Cairo Group">
                        <div class="card-body">
                            <h5 class="card-title">Cairo</h5>
                            <p class="card-text">A thriving community of neighbors helping neighbors in Egypt's capital.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">35,789 members</small>
                                <a href="#" class="btn btn-sm btn-outline-primary">View Group</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="London Group">
                        <div class="card-body">
                            <h5 class="card-title">London</h5>
                            <p class="card-text">Connect with neighbors across London's diverse neighborhoods.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">42,156 members</small>
                                <a href="#" class="btn btn-sm btn-outline-primary">View Group</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="groups.html" class="btn btn-primary">Find Your Local Group</a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">What Our Community Says</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex mb-3">
                                <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="User">
                                <div>
                                    <h5 class="mb-0">Sarah Johnson</h5>
                                    <p class="text-muted mb-0">New York</p>
                                </div>
                            </div>
                            <p class="mb-0">"I was able to furnish my entire apartment through Buy Nothing! Not only did I save money, but I made amazing friends in my neighborhood."</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex mb-3">
                                <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="User">
                                <div>
                                    <h5 class="mb-0">Ahmed Hassan</h5>
                                    <p class="text-muted mb-0">Cairo</p>
                                </div>
                            </div>
                            <p class="mb-0">"I started a group in my neighborhood and it's amazing to see how it's brought people together. We've even organized community events!"</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex mb-3">
                                <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="User">
                                <div>
                                    <h5 class="mb-0">Emma Wilson</h5>
                                    <p class="text-muted mb-0">London</p>
                                </div>
                            </div>
                            <p class="mb-0">"As a volunteer, I've seen firsthand how this platform reduces waste and helps people in need. It's more than just giving things away."</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Our Partners</h2>
            <div class="row align-items-center text-center">
                <div class="col-6 col-md-2 mb-4 mb-md-0">
                    <img src="https://via.placeholder.com/150x60" alt="Partner 1" class="img-fluid">
                </div>
                <div class="col-6 col-md-2 mb-4 mb-md-0">
                    <img src="https://via.placeholder.com/150x60" alt="Partner 2" class="img-fluid">
                </div>
                <div class="col-6 col-md-2 mb-4 mb-md-0">
                    <img src="https://via.placeholder.com/150x60" alt="Partner 3" class="img-fluid">
                </div>
                <div class="col-6 col-md-2 mb-4 mb-md-0">
                    <img src="https://via.placeholder.com/150x60" alt="Partner 4" class="img-fluid">
                </div>
                <div class="col-6 col-md-2 mb-4 mb-md-0">
                    <img src="https://via.placeholder.com/150x60" alt="Partner 5" class="img-fluid">
                </div>
                <div class="col-6 col-md-2">
                    <img src="https://via.placeholder.com/150x60" alt="Partner 6" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="mb-4">Ready to join your local Buy Nothing community?</h2>
            <p class="lead mb-4">Sign up today and start giving, asking, and sharing with your neighbors.</p>
            <a href="Views/register.php" class="btn btn-light btn-lg px-4">Join Now</a>
        </div>
    </section>

    <!-- Footer -->
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
                        <li class="mb-2"><a href="index.php" class="text-white text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="Views/about.php" class="text-white text-decoration-none">About Us</a></li>
                        <li class="mb-2"><a href="groups.html" class="text-white text-decoration-none">Find Groups</a></li>
                        <li class="mb-2"><a href="Views/rules.php" class="text-white text-decoration-none">Rules</a></li>
                        <li><a href="Views/customer-service.php" class="text-white text-decoration-none">Help</a></li>
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
                    <p class="mb-0">&copy; 2023 Buy Nothing Project. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-white text-decoration-none me-3">Privacy Policy</a>
                    <a href="#" class="text-white text-decoration-none me-3">Terms of Service</a>
                    <a href="#" class="text-white text-decoration-none">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
