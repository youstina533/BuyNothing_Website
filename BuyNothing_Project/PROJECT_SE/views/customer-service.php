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
    <title>Help & Support - Buy Nothing</title>
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
                        <a class="nav-link" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rules.php">Rules</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="customer-service.php">Help</a>
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
                        <a href="register.php" class="btn btn-primary">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Help Header -->
    <section class="bg-primary text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h1 class="display-4 fw-bold mb-3">How Can We Help?</h1>
                    <p class="lead mb-4">Find answers to common questions or contact our support team.</p>
                    <div class="search-box bg-white p-2 rounded shadow-sm">
                        <form id="helpSearchForm" class="d-flex">
                            <input type="text" class="form-control border-0 me-2" id="helpSearch" placeholder="Search for help topics...">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="https://via.placeholder.com/600x400" alt="Customer Support" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Help Categories -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center">
                        <div class="card-body p-4">
                            <div class="feature-icon bg-primary bg-opacity-10 text-primary mx-auto mb-4">
                                <i class="fas fa-user-plus fa-2x"></i>
                            </div>
                            <h4>Account & Registration</h4>
                            <p class="text-muted mb-3">Help with creating an account, logging in, and profile settings.</p>
                            <a href="#account" class="btn btn-outline-primary">View Topics</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center">
                        <div class="card-body p-4">
                            <div class="feature-icon bg-primary bg-opacity-10 text-primary mx-auto mb-4">
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                            <h4>Groups & Community</h4>
                            <p class="text-muted mb-3">Information about joining groups, posting, and community guidelines.</p>
                            <a href="#groups" class="btn btn-outline-primary">View Topics</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center">
                        <div class="card-body p-4">
                            <div class="feature-icon bg-primary bg-opacity-10 text-primary mx-auto mb-4">
                                <i class="fas fa-shield-alt fa-2x"></i>
                            </div>
                            <h4>Safety & Privacy</h4>
                            <p class="text-muted mb-3">Learn about our safety features, privacy settings, and reporting issues.</p>
                            <a href="#safety" class="btn btn-outline-primary">View Topics</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center">
                        <div class="card-body p-4">
                            <div class="feature-icon bg-primary bg-opacity-10 text-primary mx-auto mb-4">
                                <i class="fas fa-gift fa-2x"></i>
                            </div>
                            <h4>Giving & Receiving</h4>
                            <p class="text-muted mb-3">Tips for successful gifting, asking, and arranging pickups.</p>
                            <a href="#giving" class="btn btn-outline-primary">View Topics</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center">
                        <div class="card-body p-4">
                            <div class="feature-icon bg-primary bg-opacity-10 text-primary mx-auto mb-4">
                                <i class="fas fa-mobile-alt fa-2x"></i>
                            </div>
                            <h4>Technical Support</h4>
                            <p class="text-muted mb-3">Help with website issues, notifications, and device compatibility.</p>
                            <a href="#technical" class="btn btn-outline-primary">View Topics</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center">
                        <div class="card-body p-4">
                            <div class="feature-icon bg-primary bg-opacity-10 text-primary mx-auto mb-4">
                                <i class="fas fa-hands-helping fa-2x"></i>
                            </div>
                            <h4>Volunteering</h4>
                            <p class="text-muted mb-3">Information about becoming a volunteer, admin, or community builder.</p>
                            <a href="#volunteering" class="btn btn-outline-primary">View Topics</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Sections -->
    <section class="py-5 bg-light">
        <div class="container">
            <!-- Account & Registration -->
            <div id="account" class="mb-5">
                <h2 class="mb-4">Account & Registration</h2>
                <div class="accordion" id="accountAccordion">
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header" id="accountHeading1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accountCollapse1" aria-expanded="true" aria-controls="accountCollapse1">
                                How do I create an account?
                            </button>
                        </h2>
                        <div id="accountCollapse1" class="accordion-collapse collapse show" aria-labelledby="accountHeading1" data-bs-parent="#accountAccordion">
                            <div class="accordion-body">
                                <p>Creating an account on Buy Nothing is simple:</p>
                                <ol>
                                    <li>Click the "Sign Up" button in the top right corner of the page</li>
                                    <li>Enter your email address and create a password</li>
                                    <li>Verify your email address by clicking the link sent to your inbox</li>
                                    <li>Complete your profile with your name, location, and a profile picture</li>
                                    <li>Set your location to find groups in your area</li>
                                </ol>
                                <p>You can also sign up using your Google or Facebook account for a faster registration process.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header" id="accountHeading2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accountCollapse2" aria-expanded="false" aria-controls="accountCollapse2">
                                I forgot my password. How do I reset it?
                            </button>
                        </h2>
                        <div id="accountCollapse2" class="accordion-collapse collapse" aria-labelledby="accountHeading2" data-bs-parent="#accountAccordion">
                            <div class="accordion-body">
                                <p>If you've forgotten your password, follow these steps to reset it:</p>
                                <ol>
                                    <li>Click the "Login" button in the top right corner</li>
                                    <li>Click the "Forgot Password?" link below the login form</li>
                                    <li>Enter the email address associated with your account</li>
                                    <li>Check your email for a password reset link</li>
                                    <li>Click the link and follow the instructions to create a new password</li>
                                </ol>
                                <p>If you don't receive the reset email within a few minutes, check your spam folder or try again.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header" id="accountHeading3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accountCollapse3" aria-expanded="false" aria-controls="accountCollapse3">
                                How do I update my profile information?
                            </button>
                        </h2>
                        <div id="accountCollapse3" class="accordion-collapse collapse" aria-labelledby="accountHeading3" data-bs-parent="#accountAccordion">
                            <div class="accordion-body">
                                <p>To update your profile information:</p>
                                <ol>
                                    <li>Click on your profile picture in the top right corner</li>
                                    <li>Select "My Profile" from the dropdown menu</li>
                                    <li>Click the "Edit Profile" button</li>
                                    <li>Update your information as needed</li>
                                    <li>Click "Save Changes" to apply your updates</li>
                                </ol>
                                <p>You can update your name, profile picture, bio, and contact preferences. Note that changing your location may affect which groups you can join.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Groups & Community -->
            <div id="groups" class="mb-5">
                <h2 class="mb-4">Groups & Community</h2>
                <div class="accordion" id="groupsAccordion">
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header" id="groupsHeading1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#groupsCollapse1" aria-expanded="true" aria-controls="groupsCollapse1">
                                How do I find and join a group in my area?
                            </button>
                        </h2>
                        <div id="groupsCollapse1" class="accordion-collapse collapse show" aria-labelledby="groupsHeading1" data-bs-parent="#groupsAccordion">
                            <div class="accordion-body">
                                <p>To find and join a group in your area:</p>
                                <ol>
                                    <li>Click on "Find Groups" in the navigation menu</li>
                                    <li>Enter your location (city, neighborhood, or zip code)</li>
                                    <li>Browse the list of groups near you</li>
                                    <li>Click on a group to view more details</li>
                                    <li>Click the "Join Group" button to request membership</li>
                                </ol>
                                <p>Group admins will review your request, which usually takes 1-3 days. You'll receive a notification when your request is approved.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header" id="groupsHeading2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#groupsCollapse2" aria-expanded="false" aria-controls="groupsCollapse2">
                                How do I create a post in my group?
                            </button>
                        </h2>
                        <div id="groupsCollapse2" class="accordion-collapse collapse" aria-labelledby="groupsHeading2" data-bs-parent="#groupsAccordion">
                            <div class="accordion-body">
                                <p>To create a post in your group:</p>
                                <ol>
                                    <li>Go to your group's page or click "Create Post" from the dashboard</li>
                                    <li>Select the type of post (Give, Ask, Lend, or Event)</li>
                                    <li>Add a title and description for your post</li>
                                    <li>Upload photos if applicable</li>
                                    <li>Select your exchange method (pickup, delivery, etc.)</li>
                                    <li>Click "Post" to publish</li>
                                </ol>
                                <p>Be clear about the condition of items, pickup arrangements, and any other relevant details to help your neighbors.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header" id="groupsHeading3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#groupsCollapse3" aria-expanded="false" aria-controls="groupsCollapse3">
                                What if there's no group in my area?
                            </button>
                        </h2>
                        <div id="groupsCollapse3" class="accordion-collapse collapse" aria-labelledby="groupsHeading3" data-bs-parent="#groupsAccordion">
                            <div class="accordion-body">
                                <p>If there's no group in your area, you can start one! Here's how:</p>
                                <ol>
                                    <li>Click on "Find Groups" in the navigation menu</li>
                                    <li>Search for your location</li>
                                    <li>If no groups are found, you'll see a "Start a Group" button</li>
                                    <li>Fill out the form with details about your proposed group</li>
                                    <li>Agree to serve as an admin for the new group</li>
                                    <li>Submit your request</li>
                                </ol>
                                <p>Our team will review your request and provide guidance on setting up and growing your new community. Starting a group is a wonderful way to build connections in your neighborhood!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- More FAQ sections would follow the same pattern -->
        </div>
    </section>

    <!-- Contact Support Section -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="mb-4">Still Need Help?</h2>
                    <p class="lead mb-4">If you couldn't find the answer to your question, our support team is here to help.</p>
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <form id="supportForm">
                                <div class="mb-3">
                                    <label for="supportName" class="form-label">Your Name</label>
                                    <input type="text" class="form-control" id="supportName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="supportEmail" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="supportEmail" required>
                                </div>
                                <div class="mb-3">
                                    <label for="supportTopic" class="form-label">Topic</label>
                                    <select class="form-select" id="supportTopic" required>
                                        <option value="" selected disabled>Select a topic</option>
                                        <option value="account">Account & Registration</option>
                                        <option value="groups">Groups & Community</option>
                                        <option value="safety">Safety & Privacy</option>
                                        <option value="giving">Giving & Receiving</option>
                                        <option value="technical">Technical Support</option>
                                        <option value="volunteering">Volunteering</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="supportMessage" class="form-label">Message</label>
                                    <textarea class="form-control" id="supportMessage" rows="5" required></textarea>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="supportTerms" required>
                                    <label class="form-check-label" for="supportTerms">
                                        I agree to the <a href="#">Privacy Policy</a> and consent to the processing of my data.
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit Request</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <h4 class="mb-4">Other Ways to Get Help</h4>
                            
                            <div class="d-flex mb-4">
                                <div class="me-3 text-primary">
                                    <i class="fas fa-comments fa-2x"></i>
                                </div>
                                <div>
                                    <h5>Community Forum</h5>
                                    <p class="mb-0">Connect with other members and find answers in our community forum.</p>
                                    <a href="#" class="btn btn-link p-0">Visit Forum <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                            
                            <div class="d-flex mb-4">
                                <div class="me-3 text-primary">
                                    <i class="fas fa-book fa-2x"></i>
                                </div>
                                <div>
                                    <h5>Knowledge Base</h5>
                                    <p class="mb-0">Browse our comprehensive guides and tutorials.</p>
                                    <a href="#" class="btn btn-link p-0">Explore Guides <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                            
                            <div class="d-flex mb-4">
                                <div class="me-3 text-primary">
                                    <i class="fas fa-envelope fa-2x"></i>
                                </div>
                                <div>
                                    <h5>Email Support</h5>
                                    <p class="mb-0">Email our support team directly for assistance.</p>
                                    <a href="mailto:support@buynothing.org" class="btn btn-link p-0">support@buynothing.org <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                            
                            <div class="d-flex">
                                <div class="me-3 text-primary">
                                    <i class="fas fa-phone fa-2x"></i>
                                </div>
                                <div>
                                    <h5>Phone Support</h5>
                                    <p class="mb-0">Available Monday-Friday, 9am-5pm ET.</p>
                                    <a href="tel:+15551234567" class="btn btn-link p-0">+1 (555) 123-4567 <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>