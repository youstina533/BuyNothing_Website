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
    <title>Dashboard - Buy Nothing</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="public/css/styles.css">
    <style>
        .stat-card {
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
        .post-card {
            transition: all 0.2s ease;
        }
        .post-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
        }
        .group-card {
            transition: all 0.2s ease;
            height: 100%;
        }
        .group-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
        }
        .group-card .card-img-top {
            height: 120px;
            object-fit: cover;
        }
        .post-type-badge {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
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
                        <a class="nav-link active" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="my_groups.php">My Groups</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="volunteer.php">Volunteer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="messages.php">Messages</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <button class="btn btn-link p-0 text-dark dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo !empty($user['profile_image']) ? $user['profile_image'] : 'public/images/default-profile.jpg'; ?>" alt="Profile" class="rounded-circle me-2" width="32" height="32">
                            <span><?php echo htmlspecialchars($user['username']); ?></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="profile-setup.php"><i class="fas fa-user me-2"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="settings.php"><i class="fas fa-cog me-2"></i> Settings</a></li>
                            <li><a class="dropdown-item" href="saved-posts.php"><i class="fas fa-bookmark me-2"></i> Saved Posts</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-4">
        <!-- Welcome Section -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <img src="<?php echo !empty($user['profile_image']) ? $user['profile_image'] : 'public/images/default-profile.jpg'; ?>" alt="Profile" class="rounded-circle me-3" width="60" height="60">
                            <div>
                                <h2 class="mb-1">Welcome, <?php echo htmlspecialchars($user['first_name'] ? $user['first_name'] : $user['username']); ?>!</h2>
                                <p class="text-muted mb-0">
                                    <i class="fas fa-map-marker-alt me-1"></i> 
                                    <?php echo !empty($user['location']) ? htmlspecialchars($user['location']) : 'Location not set'; ?>
                                </p>
                            </div>
                        </div>
                        <p class="mb-0">What would you like to do today?</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex flex-column justify-content-center p-4">
                        <div class="d-grid gap-2">
                            <a href="create-post.php" class="btn btn-primary">
                                <i class="fas fa-plus-circle me-2"></i> Create a Post
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card border-0 shadow-sm stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                                <i class="fas fa-users fa-2x text-primary"></i>
                            </div>
                            <div>
                                <h3 class="mb-0"><?php echo count($groups); ?></h3>
                                <p class="text-muted mb-0">Groups Joined</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card border-0 shadow-sm stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                                <i class="fas fa-gift fa-2x text-success"></i>
                            </div>
                            <div>
                                <h3 class="mb-0">0</h3>
                                <p class="text-muted mb-0">Items Given</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                                <i class="fas fa-hand-holding-heart fa-2x text-warning"></i>
                            </div>
                            <div>
                                <h3 class="mb-0">0</h3>
                                <p class="text-muted mb-0">Items Received</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Recent Posts Section -->
            <div class="col-lg-8 mb-4 mb-lg-0">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Recent Posts</h5>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-primary active" id="allPostsBtn">All</button>
                            <button type="button" class="btn btn-outline-primary" id="givePostsBtn">Give</button>
                            <button type="button" class="btn btn-outline-primary" id="askPostsBtn">Ask</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if (empty($recentPosts)): ?>
                            <div class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="mb-0">No recent posts in your groups.</p>
                                <p class="text-muted">Join more groups to see posts from your community.</p>
                            </div>
                        <?php else: ?>
                            <div class="row g-3">
                                <?php foreach ($recentPosts as $post): ?>
                                    <div class="col-md-6 post-item" data-type="<?php echo $post['post_type']; ?>">
                                        <div class="card post-card h-100 border-0 shadow-sm position-relative">
                                            <?php if (!empty($post['image_url'])): ?>
                                                <img src="<?php echo $post['image_url']; ?>" class="card-img-top" alt="Post Image">
                                            <?php endif; ?>
                                            <span class="badge bg-<?php echo $post['post_type'] === 'give' ? 'success' : ($post['post_type'] === 'ask' ? 'primary' : 'warning'); ?> post-type-badge">
                                                <?php echo ucfirst($post['post_type']); ?>
                                            </span>
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo htmlspecialchars($post['title']); ?></h5>
                                                <p class="card-text small"><?php echo nl2br(htmlspecialchars(substr($post['description'], 0, 100) . (strlen($post['description']) > 100 ? '...' : ''))); ?></p>
                                                <div class="d-flex align-items-center mt-3">
                                                    <img src="<?php echo !empty($post['profile_image']) ? $post['profile_image'] : 'public/images/default-profile.jpg'; ?>" alt="Profile" class="rounded-circle me-2" width="32" height="32">
                                                    <div class="small">
                                                        <p class="mb-0 fw-bold"><?php echo htmlspecialchars($post['username']); ?></p>
                                                        <p class="text-muted mb-0"><?php echo date('M j, Y', strtotime($post['created_at'])); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer bg-white border-top-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <a href="#" class="btn btn-sm btn-outline-primary">View Details</a>
                                                    <button class="btn btn-sm btn-outline-secondary save-post-btn" data-post-id="<?php echo $post['post_id']; ?>">
                                                        <i class="far fa-bookmark"></i> Save
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- My Groups Section -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">My Groups</h5>
                        <a href="my_groups.php" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="card-body">
                        <?php if (empty($groups)): ?>
                            <div class="text-center py-4">
                                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                <p class="mb-0">You haven't joined any groups yet.</p>
                            </div>
                        <?php else: ?>
                            <div class="row g-3">
                                <?php foreach (array_slice($groups, 0, 4) as $group): ?>
                                    <div class="col-md-6">
                                        <div class="card group-card border-0 shadow-sm">
                                            <img src="public/images/group-cover.jpg" class="card-img-top" alt="Group Cover">
                                            <div class="card-body">
                                                <h6 class="card-title"><?php echo htmlspecialchars($group['name']); ?></h6>
                                                <p class="card-text small text-muted">
                                                    <i class="fas fa-map-marker-alt me-1"></i> <?php echo htmlspecialchars($group['location']); ?>
                                                </p>
                                                <a href="#" class="btn btn-sm btn-outline-primary w-100">View Group</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <?php if (count($groups) > 4): ?>
                                <div class="text-center mt-3">
                                    <a href="/my_groups.php" class="text-decoration-none">See all <?php echo count($groups); ?> groups</a>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Quick Links</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="create-post.php" class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="fas fa-plus-circle text-primary me-3"></i>
                                <span>Create a new post</span>
                            </a>
                            <a href="volunteer.php" class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="fas fa-hands-helping text-warning me-3"></i>
                                <span>Volunteer opportunities</span>
                            </a>
                            <a href="messages.php" class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="fas fa-envelope text-info me-3"></i>
                                <span>Check your messages</span>
                            </a>
                            <a href="saved-posts.php" class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="fas fa-bookmark text-danger me-3"></i>
                                <span>View saved posts</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
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