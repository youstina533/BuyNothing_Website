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
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Dashboard - Buy Nothing</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .stat-card {
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
        .task-item {
            transition: background-color 0.2s ease;
        }
        .task-item:hover {
            background-color: rgba(13, 110, 253, 0.05);
        }
        .task-item.completed {
            background-color: rgba(25, 135, 84, 0.05);
        }
        .task-item.overdue {
            background-color: rgba(220, 53, 69, 0.05);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="Views/dashboard.php">
                <span class="ms-2 fw-bold text-primary">Buy Nothing</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="volunteer-dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="my_groups.php">My Groups</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="messages.php">Messages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="my_groups.php">Volunteer Groups</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <div class="dropdown me-3">
                        <button class="btn btn-link text-dark position-relative p-0" type="button" id="notificationsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell fa-lg"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <!-- Notification count will be loaded dynamically -->
                            </span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown" style="width: 300px;">
                            <li><h6 class="dropdown-header">Notifications</h6></li>
                            <li><hr class="dropdown-divider"></li>
                            <!-- Notification items will be loaded dynamically -->
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-center" href="#">See all notifications</a></li>
                        </ul>
                    </div>
                    
                    <div class="dropdown">
                        <button class="btn btn-link p-0 text-dark dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="Profile Picture">
                            <span class="d-none d-md-inline">
                                <!-- Username will be loaded dynamically -->
                            </span>
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

    <!-- Volunteer Dashboard Header -->
    <section class="bg-primary text-white py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="mb-2">Volunteer Dashboard</h1>
                    <p class="mb-0">Welcome back! Manage your volunteer activities and tasks</p>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <span class="badge bg-light text-primary me-2">Volunteer Status: Active</span>
                    <a href="my_groups.php" class="btn btn-light">
                        <i class="fas fa-users me-2"></i> My Volunteer Groups
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Volunteer Stats -->
    <section class="py-4">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3 col-sm-6">
                    <div class="card border-0 shadow-sm stat-card h-100">
                        <div class="card-body text-center">
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle mb-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-clock fa-2x"></i>
                            </div>
                            <h3 class="mb-1" id="volunteerHours">0</h3>
                            <p class="text-muted mb-0">Volunteer Hours</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card border-0 shadow-sm stat-card h-100">
                        <div class="card-body text-center">
                            <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success rounded-circle mb-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-tasks fa-2x"></i>
                            </div>
                            <h3 class="mb-1" id="completedTasks">0</h3>
                            <p class="text-muted mb-0">Completed Tasks</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card border-0 shadow-sm stat-card h-100">
                        <div class="card-body text-center">
                            <div class="d-inline-flex align-items-center justify-content-center bg-info bg-opacity-10 text-info rounded-circle mb-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                            <h3 class="mb-1" id="groupsSupported">0</h3>
                            <p class="text-muted mb-0">Groups Supported</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card border-0 shadow-sm stat-card h-100">
                        <div class="card-body text-center">
                            <div class="d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-10 text-warning rounded-circle mb-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-star fa-2x"></i>
                            </div>
                            <h3 class="mb-1" id="impactScore">0</h3>
                            <p class="text-muted mb-0">Impact Score</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Dashboard Content -->
    <section class="py-4">
        <div class="container">
            <div class="row g-4">
                <!-- Upcoming Tasks -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Upcoming Tasks</h5>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="taskFilterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    Filter
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="taskFilterDropdown">
                                    <li><a class="dropdown-item active" href="#">All Tasks</a></li>
                                    <li><a class="dropdown-item" href="#">Pending</a></li>
                                    <li><a class="dropdown-item" href="#">Completed</a></li>
                                    <li><a class="dropdown-item" href="#">Overdue</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush" id="tasksList">
                                <!-- Tasks will be loaded dynamically -->
                                <div class="text-center py-5">
                                    <i class="fas fa-tasks fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No tasks available</h5>
                                    <p>Your volunteer tasks will appear here</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white text-center">
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                                <i class="fas fa-plus me-2"></i> Add New Task
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Volunteer Groups -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush" id="volunteerGroupsList">
                                <!-- Volunteer groups will be loaded dynamically -->
                                <div class="text-center py-5">
                                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No volunteer groups</h5>
                                    <p>Join volunteer groups to see them here</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Activity -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Recent Activity</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush" id="recentActivityList">
                                <!-- Recent activity will be loaded dynamically -->
                                <div class="text-center py-5">
                                    <i class="fas fa-history fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No recent activity</h5>
                                    <p>Your volunteer activity will appear here</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Volunteer Opportunities -->
    <section class="py-4 bg-light">
        <div class="container">
           
            
            <div class="row g-4" id="volunteerOpportunitiesList">
                <!-- Volunteer opportunities will be loaded dynamically -->
                <div class="col-12 text-center py-5">
                    <i class="fas fa-hand-holding-heart fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No volunteer opportunities available</h4>
                    <p>Check back later for new opportunities</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Add Task Modal -->
    <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTaskModalLabel">Add New Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addTaskForm">
                        <div class="mb-3">
                            <label for="taskTitle" class="form-label">Task Title</label>
                            <input type="text" class="form-control" id="taskTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="taskDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="taskDescription" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="taskDueDate" class="form-label">Due Date</label>
                            <input type="date" class="form-control" id="taskDueDate" required>
                        </div>
                        <div class="mb-3">
                            <label for="taskPriority" class="form-label">Priority</label>
                            <select class="form-select" id="taskPriority" required>
                                <option value="low">Low</option>
                                <option value="medium" selected>Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="taskGroup" class="form-label">Related Group (Optional)</label>
                            <select class="form-select" id="taskGroup">
                                <option value="" selected>Select a group</option>
                                <!-- Group options will be loaded dynamically -->
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveTaskBtn">Save Task</button>
                </div>
            </div>
        </div>
    </div>

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
</body>
</html>
