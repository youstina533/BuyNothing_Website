<?php
define('ROOT_PATH', __DIR__ . '/../');
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: " . ROOT_PATH . "views/login.php");
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
        case 'comment':
            require_once ROOT_PATH . 'controllers/CommentController.php';
            (new CommentController())->add($_POST['post_id'], $_SESSION['user_id'], $_POST['message']);
            break;
        case 'post':
            require_once ROOT_PATH . 'controllers/PostController.php';
            (new PostController())->create($_SESSION['user_id'], $_POST['group_id'], $_POST['title'], $_POST['description'], $_POST['post_type']);
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Groups - Buy Nothing</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">
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
                        <a class="nav-link active" href="my_groups.php">My Groups</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="messages.php">Messages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rules.php">Rules</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <div class="dropdown me-3">
                        <button class="btn btn-link text-dark position-relative p-0" type="button" id="notificationsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell fa-lg"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                3
                            </span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown" style="width: 300px;">
                            <li><h6 class="dropdown-header">Notifications</h6></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center py-2" href="#">
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="User">
                                    <div>
                                        <p class="mb-0"><strong>Sarah</strong> commented on your post</p>
                                        <small class="text-muted">2 hours ago</small>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center py-2" href="#">
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="User">
                                    <div>
                                        <p class="mb-0"><strong>Ahmed</strong> is interested in your item</p>
                                        <small class="text-muted">5 hours ago</small>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center py-2" href="#">
                                    <div class="bg-primary text-white rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0">You were added to <strong>Downtown Group</strong></p>
                                        <small class="text-muted">1 day ago</small>
                                    </div>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-center" href="#">See all notifications</a></li>
                        </ul>
                    </div>
                    
                    <div class="dropdown">
                        <button class="btn btn-link p-0 text-dark dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="Profile Picture">
                            <span class="d-none d-md-inline">John Doe</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="profile-setup.php"><i class="fas fa-user me-2"></i> My Profile</a></li>
                            <li><a class="dropdown-item" href="settings.php"><i class="fas fa-cog me-2"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="../index.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- My Groups Header -->
    <section class="bg-primary text-white py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-2">My Groups</h1>
                    <p class="mb-0">Manage your Buy Nothing groups and communities</p>
                </div>
            </div>
        </div>
    </section>

    <!-- My Groups Content -->
    <section class="py-5">
        <div class="container">
            <!-- Group Tabs -->
            <ul class="nav nav-pills mb-4" id="groupTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="joined-tab" data-bs-toggle="tab" data-bs-target="#joined" type="button" role="tab" aria-controls="joined" aria-selected="true">
                        <i class="fas fa-users me-2"></i> Joined Groups (3)
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin" type="button" role="tab" aria-controls="admin" aria-selected="false">
                        <i class="fas fa-user-shield me-2"></i> Admin Groups (1)
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab" aria-controls="pending" aria-selected="false">
                        <i class="fas fa-clock me-2"></i> Pending Requests (2)
                    </button>
                </li>
            </ul>
            
            <!-- Tab Content -->
            <div class="tab-content" id="groupTabsContent">
                <!-- Joined Groups Tab -->
                <div class="tab-pane fade show active" id="joined" role="tabpanel" aria-labelledby="joined-tab">
                    <div class="row g-4">
                        <!-- Group 1 -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="https://via.placeholder.com/60" class="rounded-circle me-3" alt="Group Image">
                                        <div>
                                            <h5 class="mb-0">Downtown Cairo</h5>
                                            <span class="badge bg-success me-1">Active</span>
                                            <small class="text-muted">3,245 members</small>
                                        </div>
                                    </div>
                                    <p class="card-text">A vibrant community of neighbors sharing items and services in downtown Cairo.</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                        <span>2.3 km away</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <a href="#" class="btn btn-primary">View Group</a>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-secondary" type="button" id="group1Options" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="group1Options">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-bell-slash me-2"></i> Mute Notifications</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-flag me-2"></i> Report Group</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-sign-out-alt me-2"></i> Leave Group</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Group 2 -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="https://via.placeholder.com/60" class="rounded-circle me-3" alt="Group Image">
                                        <div>
                                            <h5 class="mb-0">Maadi Community</h5>
                                            <span class="badge bg-success me-1">Active</span>
                                            <small class="text-muted">1,876 members</small>
                                        </div>
                                    </div>
                                    <p class="card-text">A friendly community of neighbors in Maadi sharing items and reducing waste together.</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                        <span>5.7 km away</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <a href="#" class="btn btn-primary">View Group</a>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-secondary" type="button" id="group2Options" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="group2Options">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-bell-slash me-2"></i> Mute Notifications</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-flag me-2"></i> Report Group</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-sign-out-alt me-2"></i> Leave Group</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Group 3 -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="https://via.placeholder.com/60" class="rounded-circle me-3" alt="Group Image">
                                        <div>
                                            <h5 class="mb-0">New Cairo</h5>
                                            <span class="badge bg-success me-1">Active</span>
                                            <small class="text-muted">2,543 members</small>
                                        </div>
                                    </div>
                                    <p class="card-text">Connect with neighbors in New Cairo to share resources and build community.</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                        <span>8.2 km away</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <a href="#" class="btn btn-primary">View Group</a>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-secondary" type="button" id="group3Options" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="group3Options">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-bell-slash me-2"></i> Mute Notifications</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-flag me-2"></i> Report Group</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-sign-out-alt me-2"></i> Leave Group</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Admin Groups Tab -->
                <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                    <div class="row g-4">
                        <!-- Admin Group -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="https://via.placeholder.com/60" class="rounded-circle me-3" alt="Group Image">
                                        <div>
                                            <h5 class="mb-0">Downtown Cairo</h5>
                                            <span class="badge bg-success me-1">Active</span>
                                            <small class="text-muted">3,245 members</small>
                                        </div>
                                    </div>
                                    <p class="card-text">A vibrant community of neighbors sharing items and services in downtown Cairo.</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-user-shield text-primary me-2"></i>
                                        <span>You are an admin</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <a href="#" class="btn btn-primary">Manage Group</a>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-secondary" type="button" id="adminGroupOptions" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminGroupOptions">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-users me-2"></i> Member Requests (5)</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-flag me-2"></i> Reported Posts (2)</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Group Settings</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-user-minus me-2"></i> Step Down as Admin</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Admin Stats Card -->
                        <div class="col-md-6 col-lg-8">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-header bg-white">
                                    <h5 class="mb-0">Admin Dashboard</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-4">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="text-center">
                                                <div class="stat-icon bg-primary bg-opacity-10 text-primary mx-auto mb-2">
                                                    <i class="fas fa-users"></i>
                                                </div>
                                                <h3 class="mb-0">3,245</h3>
                                                <p class="text-muted">Total Members</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="text-center">
                                                <div class="stat-icon bg-success bg-opacity-10 text-success mx-auto mb-2">
                                                    <i class="fas fa-gift"></i>
                                                </div>
                                                <h3 class="mb-0">1,876</h3>
                                                <p class="text-muted">Total Posts</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="text-center">
                                                <div class="stat-icon bg-info bg-opacity-10 text-info mx-auto mb-2">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                                <h3 class="mb-0">124</h3>
                                                <p class="text-muted">New Members (30 days)</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <hr class="my-4">
                                    
                                    <h6 class="mb-3">Admin Tasks</h6>
                                    <div class="list-group">
                                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <span><i class="fas fa-user-check me-2 text-success"></i> Approve member requests</span>
                                            <span class="badge bg-primary rounded-pill">5</span>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <span><i class="fas fa-flag me-2 text-danger"></i> Review reported posts</span>
                                            <span class="badge bg-primary rounded-pill">2</span>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <i class="fas fa-bullhorn me-2 text-warning"></i> Create group announcement
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <i class="fas fa-cog me-2 text-secondary"></i> Update group settings
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pending Requests Tab -->
                <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                    <div class="row g-4">
                        <!-- Pending Group 1 -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="https://via.placeholder.com/60" class="rounded-circle me-3" alt="Group Image">
                                        <div>
                                            <h5 class="mb-0">Heliopolis Community</h5>
                                            <span class="badge bg-success me-1">Active</span>
                                            <small class="text-muted">1,987 members</small>
                                        </div>
                                    </div>
                                    <p class="card-text">Join neighbors in Heliopolis to share items and build a stronger community.</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                        <span>6.8 km away</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-clock text-warning me-2"></i>
                                        <span>Request sent on June 15, 2023</span>
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-outline-secondary" disabled>
                                            <i class="fas fa-hourglass-half me-2"></i> Pending Approval
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pending Group 2 -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="https://via.placeholder.com/60" class="rounded-circle me-3" alt="Group Image">
                                        <div>
                                            <h5 class="mb-0">Zamalek Neighbors</h5>
                                            <span class="badge bg-success me-1">Active</span>
                                            <small class="text-muted">1,456 members</small>
                                        </div>
                                    </div>
                                    <p class="card-text">A community of neighbors in Zamalek sharing items and services locally.</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                        <span>4.1 km away</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-clock text-warning me-2"></i>
                                        <span>Request sent on June 18, 2023</span>
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-outline-secondary" disabled>
                                            <i class="fas fa-hourglass-half me-2"></i> Pending Approval
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pending Info Card -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm bg-light">
                                <div class="card-body p-4">
                                    <div class="d-flex">
                                        <div class="me-3 text-primary">
                                            <i class="fas fa-info-circle fa-2x"></i>
                                        </div>
                                        <div>
                                            <h5>About Pending Requests</h5>
                                            <p class="mb-0">Group admins review all membership requests to ensure members live within the group's geographic boundaries. This process usually takes 1-3 days. You'll receive a notification when your request is approved.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Find More Groups Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="mb-4">Find More Groups Near You</h2>
                    <p class="lead mb-4">Join additional Buy Nothing groups to connect with more neighbors and find more items.</p>
                    <div class="mb-4">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Enter your location" aria-label="Location">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search me-2"></i> Search
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="https://via.placeholder.com/600x400" alt="Find Groups" class="img-fluid rounded shadow">
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

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- 
</body>
</html>