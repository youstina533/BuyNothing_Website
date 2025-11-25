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
        case 'volunteer':
            require_once ROOT_PATH . 'controllers/VolunteerController.php';
            (new VolunteerController())->apply($_SESSION['user_id'], $_POST['motivation'], $_POST['experience'], $_POST['availability']);
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer - Buy Nothing</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
</head>
<body>
    <!-- Navigation -->
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
                        <a class="nav-link" href="dashboard.php">Home</a>
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
                    <!-- User dropdown for logged in users -->
                    <div class="dropdown d-none" id="user-dropdown">
                        <button class="btn btn-link p-0 text-dark dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="Profile Picture">
                            <span class="d-none d-md-inline" id="username-display">User</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href=".php"><i class="fas fa-user me-2"></i> My Profile</a></li>
                            <li><a class="dropdown-item" href="settings.php"><i class="fas fa-cog me-2"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#" id="logout-btn"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                    <!-- Login/Register buttons for guests -->
                    <div id="auth-buttons">
                        <a href="login.php" class="btn btn-outline-primary me-2">Login</a>
                        <a href="register.phpl" class="btn btn-primary">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-primary text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h1 class="display-4 fw-bold mb-3">Volunteer With Us</h1>
                    <p class="lead mb-4">Join our team of dedicated volunteers and help build stronger, more connected communities.</p>
                    <a href="#volunteer-form" class="btn btn-light btn-lg">Apply Now</a>
                </div>
                <div class="col-lg-6">
                    <img src="https://via.placeholder.com/600x400" alt="Volunteers" class="img-fluid rounded-3 shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Why Volunteer Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="mb-4">Why Volunteer?</h2>
                    <p class="lead mb-5">Volunteering with Buy Nothing is a rewarding way to make a difference in your community while developing new skills and connections.</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon bg-primary bg-opacity-10 text-primary mx-auto mb-4">
                                <i class="fas fa-hands-helping fa-2x"></i>
                            </div>
                            <h4>Make a Difference</h4>
                            <p class="text-muted">Help build stronger communities and reduce waste by facilitating local sharing and connections.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon bg-primary bg-opacity-10 text-primary mx-auto mb-4">
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                            <h4>Build Connections</h4>
                            <p class="text-muted">Meet like-minded people and develop meaningful relationships with neighbors and community members.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon bg-primary bg-opacity-10 text-primary mx-auto mb-4">
                                <i class="fas fa-graduation-cap fa-2x"></i>
                            </div>
                            <h4>Develop Skills</h4>
                            <p class="text-muted">Gain valuable experience in community management, conflict resolution, and digital communication.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Volunteer Roles Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="mb-5">Volunteer Roles</h2>
                </div>
            </div>
            <div class="row g-4">
                <!-- Role 1 -->
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="role-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                    <i class="fas fa-user-shield"></i>
                                </div>
                                <h4 class="mb-0">Group Admin</h4>
                            </div>
                            <p>Group Admins are the heart of our community. They manage local Buy Nothing groups, approve new members, moderate posts, and help resolve conflicts.</p>
                            <h6>Responsibilities:</h6>
                            <ul class="mb-3">
                                <li>Review and approve membership requests</li>
                                <li>Moderate posts and comments</li>
                                <li>Answer member questions</li>
                                <li>Enforce community guidelines</li>
                                <li>Foster a positive community atmosphere</li>
                            </ul>
                            <h6>Time Commitment:</h6>
                            <p class="mb-0">3-5 hours per week</p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <a href="#volunteer-form" class="btn btn-outline-primary w-100">Apply for this Role</a>
                        </div>
                    </div>
                </div>
                
                <!-- Role 2 -->
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="role-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                    <i class="fas fa-hands"></i>
                                </div>
                                <h4 class="mb-0">Community Builder</h4>
                            </div>
                            <p>Community Builders help grow and strengthen Buy Nothing communities by organizing events, creating resources, and supporting new members.</p>
                            <h6>Responsibilities:</h6>
                            <ul class="mb-3">
                                <li>Organize community events and meetups</li>
                                <li>Create resources and guides for members</li>
                                <li>Welcome and support new members</li>
                                <li>Promote community engagement</li>
                                <li>Share success stories and best practices</li>
                            </ul>
                            <h6>Time Commitment:</h6>
                            <p class="mb-0">2-4 hours per week</p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <a href="#volunteer-form" class="btn btn-outline-primary w-100">Apply for this Role</a>
                        </div>
                    </div>
                </div>
                
                <!-- Role 3 -->
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="role-icon bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                    <i class="fas fa-headset"></i>
                                </div>
                                <h4 class="mb-0">Support Volunteer</h4>
                            </div>
                            <p>Support Volunteers help members navigate the platform, answer questions, and provide assistance with technical issues or community guidelines.</p>
                            <h6>Responsibilities:</h6>
                            <ul class="mb-3">
                                <li>Answer member questions and concerns</li>
                                <li>Provide technical support</li>
                                <li>Help with account issues</li>
                                <li>Explain community guidelines</li>
                                <li>Escalate complex issues to staff</li>
                            </ul>
                            <h6>Time Commitment:</h6>
                            <p class="mb-0">2-3 hours per week</p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <a href="#volunteer-form" class="btn btn-outline-primary w-100">Apply for this Role</a>
                        </div>
                    </div>
                </div>
                
                <!-- Role 4 -->
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="role-icon bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                    <i class="fas fa-language"></i>
                                </div>
                                <h4 class="mb-0">Translation Volunteer</h4>
                            </div>
                            <p>Translation Volunteers help make Buy Nothing accessible to more communities by translating content, guidelines, and communications into different languages.</p>
                            <h6>Responsibilities:</h6>
                            <ul class="mb-3">
                                <li>Translate platform content</li>
                                <li>Translate community guidelines</li>
                                <li>Help with multilingual support</li>
                                <li>Review translations for accuracy</li>
                                <li>Provide cultural context for translations</li>
                            </ul>
                            <h6>Time Commitment:</h6>
                            <p class="mb-0">Flexible, 1-3 hours per week</p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <a href="#volunteer-form" class="btn btn-outline-primary w-100">Apply for this Role</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Volunteer Stories Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="mb-5">Volunteer Stories</h2>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://via.placeholder.com/80" class="rounded-circle me-3" alt="Volunteer">
                                <div>
                                    <h5 class="mb-0">Fatima Khalid</h5>
                                    <p class="text-muted mb-0">Group Admin, Cairo</p>
                                </div>
                            </div>
                            <p class="mb-0">"I started volunteering as a Group Admin two years ago, and it's been one of the most rewarding experiences of my life. Watching my community grow and connect through sharing has been incredible. I've made lifelong friends and learned so much about community building and conflict resolution."</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://via.placeholder.com/80" class="rounded-circle me-3" alt="Volunteer">
                                <div>
                                    <h5 class="mb-0">Ahmed Ibrahim</h5>
                                    <p class="text-muted mb-0">Community Builder, Alexandria</p>
                                </div>
                            </div>
                            <p class="mb-0">"As a Community Builder, I've organized monthly meetups for our Buy Nothing group. Seeing neighbors who met through our platform become friends in real life is so fulfilling. Volunteering has given me valuable leadership skills and a deep connection to my community that I never had before."</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Volunteer Application Form -->
    <section id="volunteer-form" class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 p-md-5">
                            <h2 class="text-center mb-4">Volunteer Application</h2>
                            <p class="text-center text-muted mb-4">Join our team of dedicated volunteers and help build stronger communities.</p>
                            
                            <form id="volunteerForm">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="firstName" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" id="phone">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="location" class="form-label">Location (City, Country)</label>
                                        <input type="text" class="form-control" id="location" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="volunteerRole" class="form-label">Preferred Volunteer Role</label>
                                        <select class="form-select" id="volunteerRole" required>
                                            <option value="" selected disabled>Select a role</option>
                                            <option value="group-admin">Group Admin</option>
                                            <option value="community-builder">Community Builder</option>
                                            <option value="support-volunteer">Support Volunteer</option>
                                            <option value="translation-volunteer">Translation Volunteer</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="languages" class="form-label">Languages Spoken (if applying for Translation Volunteer)</label>
                                        <input type="text" class="form-control" id="languages" placeholder="e.g., English, Arabic, French">
                                    </div>
                                    <div class="col-12">
                                        <label for="availability" class="form-label">Availability (hours per week)</label>
                                        <select class="form-select" id="availability" required>
                                            <option value="" selected disabled>Select availability</option>
                                            <option value="1-2">1-2 hours</option>
                                            <option value="3-5">3-5 hours</option>
                                            <option value="6-10">6-10 hours</option>
                                            <option value="10+">10+ hours</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="experience" class="form-label">Relevant Experience</label>
                                        <textarea class="form-control" id="experience" rows="3" placeholder="Tell us about any relevant experience you have..."></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="motivation" class="form-label">Why do you want to volunteer with Buy Nothing?</label>
                                        <textarea class="form-control" id="motivation" rows="3" required></textarea>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                                            <label class="form-check-label" for="agreeTerms">
                                                I agree to the <a href="#">Volunteer Guidelines</a> and <a href="#">Privacy Policy</a>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-primary w-100 py-2">Submit Application</button>
                                    </div>
                                </div>
                            </form>
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
                        <li class="mb-2"><a href="dashboard.php" class="text-white text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="my_groups.php" class="text-white text-decoration-none">My Groups</a></li>
                        <li class="mb-2"><a href="messages.php" class="text-white text-decoration-none">Messages</a></li>
                        <li><a href="rules.php" class="text-white text-decoration-none">Rules</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-3 col-6">
                    <h5 class="mb-3">Resources</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Blog</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                        <li class="mb-2"><a href="volunteer.php" class="text-white text-decoration-none">Volunteer</a></li>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>