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
    <title>Account Settings - Buy Nothing</title>
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
                        <a class="nav-link" href="messages.php">Messages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="saved-posts.php">Saved</a>
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
                            <li><a class="dropdown-item active" href="Views/settings.php"><i class="fas fa-cog me-2"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="../index.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Settings Header -->
    <section class="bg-primary text-white py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="mb-2">Account Settings</h1>
                    <p class="mb-0">Manage your account preferences and settings</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Settings Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Settings Navigation -->
                <div class="col-lg-3 mb-4">
                    <div class="card border-0 shadow-sm sticky-lg-top" style="top: 100px;">
                        <div class="card-body p-0">
                            <nav class="nav flex-column">
                                <a class="nav-link active" href="#profile-settings" data-bs-toggle="tab" data-bs-target="#profile-settings">
                                    <i class="fas fa-user me-2"></i> Profile Settings
                                </a>
                                <a class="nav-link" href="#account-settings" data-bs-toggle="tab" data-bs-target="#account-settings">
                                    <i class="fas fa-user-shield me-2"></i> Account Security
                                </a>
                                <a class="nav-link" href="#notification-settings" data-bs-toggle="tab" data-bs-target="#notification-settings">
                                    <i class="fas fa-bell me-2"></i> Notifications
                                </a>
                                <a class="nav-link" href="#privacy-settings" data-bs-toggle="tab" data-bs-target="#privacy-settings">
                                    <i class="fas fa-lock me-2"></i> Privacy
                                </a>
                                <a class="nav-link" href="#location-settings" data-bs-toggle="tab" data-bs-target="#location-settings">
                                    <i class="fas fa-map-marker-alt me-2"></i> Location
                                </a>
                                <a class="nav-link" href="#language-settings" data-bs-toggle="tab" data-bs-target="#language-settings">
                                    <i class="fas fa-globe me-2"></i> Language & Region
                                </a>
                                <a class="nav-link" href="#accessibility-settings" data-bs-toggle="tab" data-bs-target="#accessibility-settings">
                                    <i class="fas fa-universal-access me-2"></i> Accessibility
                                </a>
                                <a class="nav-link text-danger" href="#delete-account" data-bs-toggle="tab" data-bs-target="#delete-account">
                                    <i class="fas fa-trash-alt me-2"></i> Delete Account
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
                
                <!-- Settings Content -->
                <div class="col-lg-9">
                    <div class="tab-content">
                        <!-- Profile Settings -->
                        <div class="tab-pane fade show active" id="profile-settings">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-white">
                                    <h5 class="mb-0">Profile Information</h5>
                                </div>
                                <div class="card-body">
                                    <form id="profileForm">
                                        <div class="mb-4 text-center">
                                            <div class="position-relative d-inline-block">
                                                <img src="https://via.placeholder.com/150" class="rounded-circle" alt="Profile Picture" width="150" height="150">
                                                <button type="button" class="btn btn-primary btn-sm position-absolute bottom-0 end-0 rounded-circle" style="width: 32px; height: 32px;">
                                                    <i class="fas fa-camera"></i>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-3">
                                            <div class="col-md-6 mb-3 mb-md-0">
                                                <label for="firstName" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="firstName" value="John">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="lastName" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="lastName" value="Doe">
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="displayName" class="form-label">Display Name</label>
                                            <input type="text" class="form-control" id="displayName" value="John Doe">
                                            <div class="form-text">This is how your name will appear to other members.</div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="bio" class="form-label">Bio</label>
                                            <textarea class="form-control" id="bio" rows="3">I'm passionate about sustainability and community building. Love gardening and DIY projects!</textarea>
                                            <div class="form-text">Tell others a bit about yourself (max 200 characters).</div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="interests" class="form-label">Interests</label>
                                            <select class="form-select" id="interests" multiple>
                                                <option selected>Gardening</option>
                                                <option selected>DIY</option>
                                                <option>Books</option>
                                                <option>Cooking</option>
                                                <option>Art & Crafts</option>
                                                <option>Electronics</option>
                                                <option>Furniture</option>
                                                <option>Clothing</option>
                                                <option>Sports Equipment</option>
                                                <option>Kids Items</option>
                                            </select>
                                            <div class="form-text">Select interests to help others know what items you might be interested in.</div>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Account Security -->
                        <div class="tab-pane fade" id="account-settings">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-white">
                                    <h5 class="mb-0">Account Information</h5>
                                </div>
                                <div class="card-body">
                                    <form id="accountForm">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input type="email" class="form-control" id="email" value="john.doe@example.com">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone Number (Optional)</label>
                                            <input type="tel" class="form-control" id="phone" value="+1 (555) 123-4567">
                                            <div class="form-text">Your phone number is only used for account security and is not shared with other members.</div>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-white">
                                    <h5 class="mb-0">Change Password</h5>
                                </div>
                                <div class="card-body">
                                    <form id="passwordForm">
                                        <div class="mb-3">
                                            <label for="currentPassword" class="form-label">Current Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="currentPassword">
                                                <button class="btn btn-outline-secondary" type="button" id="toggleCurrentPassword">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="newPassword" class="form-label">New Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="newPassword">
                                                <button class="btn btn-outline-secondary" type="button" id="toggleNewPassword">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                            <div class="form-text">Password must be at least 8 characters and include a mix of letters, numbers, and symbols.</div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="confirmPassword" class="form-label">Confirm New Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="confirmPassword">
                                                <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-white">
                                    <h5 class="mb-0">Two-Factor Authentication</h5>
                                </div>
                                <div class="card-body">
                                    <p>Two-factor authentication adds an extra layer of security to your account by requiring a verification code in addition to your password.</p>
                                    
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="enable2FA">
                                        <label class="form-check-label" for="enable2FA">Enable Two-Factor Authentication</label>
                                    </div>
                                    
                                    <div id="2faSetup" class="d-none">
                                        <p>To set up two-factor authentication:</p>
                                        <ol>
                                            <li>Download an authenticator app like Google Authenticator or Authy</li>
                                            <li>Scan the QR code below with your app</li>
                                            <li>Enter the verification code from your app</li>
                                        </ol>
                                        
                                        <div class="text-center mb-3">
                                            <img src="https://via.placeholder.com/200" alt="QR Code" class="img-fluid">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="verificationCode" class="form-label">Verification Code</label>
                                            <input type="text" class="form-control" id="verificationCode" placeholder="Enter 6-digit code">
                                        </div>
                                        
                                        <button type="button" class="btn btn-primary">Verify and Enable</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-white">
                                    <h5 class="mb-0">Connected Accounts</h5>
                                </div>
                                <div class="card-body">
                                    <p>Connect your social accounts for easier login and sharing.</p>
                                    
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fab fa-google fa-2x text-danger me-3"></i>
                                            <div>
                                                <h6 class="mb-0">Google</h6>
                                                <small class="text-muted">Not connected</small>
                                            </div>
                                        </div>
                                        <button class="btn btn-outline-primary btn-sm">Connect</button>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fab fa-facebook fa-2x text-primary me-3"></i>
                                            <div>
                                                <h6 class="mb-0">Facebook</h6>
                                                <small class="text-muted">Connected as John Doe</small>
                                            </div>
                                        </div>
                                        <button class="btn btn-outline-danger btn-sm">Disconnect</button>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <i class="fab fa-apple fa-2x me-3"></i>
                                            <div>
                                                <h6 class="mb-0">Apple</h6>
                                                <small class="text-muted">Not connected</small>
                                            </div>
                                        </div>
                                        <button class="btn btn-outline-primary btn-sm">Connect</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Notification Settings -->
                        <div class="tab-pane fade" id="notification-settings">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-white">
                                    <h5 class="mb-0">Notification Preferences</h5>
                                </div>
                                <div class="card-body">
                                    <form id="notificationForm">
                                        <h6 class="mb-3">Email Notifications</h6>
                                        
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" id="emailNewMessages" checked>
                                            <label class="form-check-label" for="emailNewMessages">New messages</label>
                                        </div>
                                        
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" id="emailPostComments" checked>
                                            <label class="form-check-label" for="emailPostComments">Comments on your posts</label>
                                        </div>
                                        
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" id="emailPostInterest" checked>
                                            <label class="form-check-label" for="emailPostInterest">Interest in your items</label>
                                        </div>
                                        
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" id="emailGroupUpdates" checked>
                                            <label class="form-check-label" for="emailGroupUpdates">Group updates and announcements</label>
                                        </div>
                                        
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" id="emailNewsletter" checked>
                                            <label class="form-check-label" for="emailNewsletter">Newsletter and platform updates</label>
                                        </div>
                                        
                                        <hr class="my-4">
                                        
                                        <h6 class="mb-3">Push Notifications</h6>
                                        
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" id="pushNewMessages" checked>
                                            <label class="form-check-label" for="pushNewMessages">New messages</label>
                                        </div>
                                        
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" id="pushPostComments" checked>
                                            <label class="form-check-label" for="pushPostComments">Comments on your posts</label>
                                        </div>
                                        
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" id="pushPostInterest" checked>
                                            <label class="form-check-label" for="pushPostInterest">Interest in your items</label>
                                        </div>
                                        
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" id="pushGroupUpdates">
                                            <label class="form-check-label" for="pushGroupUpdates">Group updates and announcements</label>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary">Save Preferences</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Privacy Settings -->
                        <div class="tab-pane fade" id="privacy-settings">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-white">
                                    <h5 class="mb-0">Privacy Settings</h5>
                                </div>
                                <div class="card-body">
                                    <form id="privacyForm">
                                        <h6 class="mb-3">Profile Visibility</h6>
                                        
                                        <div class="mb-3">
                                            <label for="profileVisibility" class="form-label">Who can see my profile?</label>
                                            <select class="form-select" id="profileVisibility">
                                                <option value="everyone">Everyone</option>
                                                <option value="group-members" selected>Group Members Only</option>
                                                <option value="connections">My Connections Only</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="activityVisibility" class="form-label">Who can see my activity?</label>
                                            <select class="form-select" id="activityVisibility">
                                                <option value="everyone">Everyone</option>
                                                <option value="group-members" selected>Group Members Only</option>
                                                <option value="connections">My Connections Only</option>
                                                <option value="nobody">Nobody</option>
                                            </select>
                                        </div>
                                        
                                        <hr class="my-4">
                                        
                                        <h6 class="mb-3">Contact Settings</h6>
                                        
                                        <div class="mb-3">
                                            <label for="messagePermission" class="form-label">Who can send me messages?</label>
                                            <select class="form-select" id="messagePermission">
                                                <option value="everyone">Everyone</option>
                                                <option value="group-members" selected>Group Members Only</option>
                                                <option value="connections">My Connections Only</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" id="showOnlineStatus" checked>
                                            <label class="form-check-label" for="showOnlineStatus">Show when I'm online</label>
                                        </div>
                                        
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" id="showReadReceipts" checked>
                                            <label class="form-check-label" for="showReadReceipts">Show read receipts in messages</label>
                                        </div>
                                        
                                        <hr class="my-4">
                                        
                                        <h6 class="mb-3">Data Settings</h6>
                                        
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" id="allowDataCollection" checked>
                                            <label class="form-check-label" for="allowDataCollection">Allow data collection for platform improvement</label>
                                        </div>
                                        
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" id="allowPersonalization" checked>
                                            <label class="form-check-label" for="allowPersonalization">Allow personalization based on my activity</label>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary">Save Privacy Settings</button>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-white">
                                    <h5 class="mb-0">Blocked Users</h5>
                                </div>
                                <div class="card-body">
                                    <p>You have blocked the following users. They cannot message you or see your posts.</p>
                                    
                                    <div class="list-group">
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="User">
                                                <div>
                                                    <h6 class="mb-0">Alex Johnson</h6>
                                                    <small class="text-muted">Blocked on June 12, 2023</small>
                                                </div>
                                            </div>
                                            <button class="btn btn-outline-primary btn-sm">Unblock</button>
                                        </div>
                                    </div>
                                    
                                    <p class="mt-3 mb-0 text-muted">If you unblock someone, they will be able to see your posts and message you again.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Location Settings -->
                        <div class="tab-pane fade" id="location-settings">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-white">
                                    <h5 class="mb-0">Location Settings</h5>
                                </div>
                                <div class="card-body">
                                    <form id="locationForm">
                                        <div class="mb-3">
                                            <label for="primaryLocation" class="form-label">Primary Location</label>
                                            <input type="text" class="form-control" id="primaryLocation" value="Downtown Cairo, Egypt">
                                            <div class="form-text">This is your main location for finding local groups.</div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="searchRadius" class="form-label">Search Radius: <span id="radiusValue">10 km</span></label>
                                            <input type="range" class="form-range" min="1" max="50" value="10" id="searchRadius">
                                            <div class="form-text">This determines how far you're willing to travel for items.</div>
                                        </div>
                                        
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" id="useCurrentLocation" checked>
                                            <label class="form-check-label" for="useCurrentLocation">Use my current location when browsing</label>
                                        </div>
                                        
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" id="showExactLocation">
                                            <label class="form-check-label" for="showExactLocation">Show my exact location to other members</label>
                                            <div class="form-text">If disabled, only your general neighborhood will be shown.</div>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary">Save Location Settings</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Language Settings -->
                        <div class="tab-pane fade" id="language-settings">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-white">
                                    <h5 class="mb-0">Language & Region</h5>
                                </div>
                                <div class="card-body">
                                    <form id="languageForm">
                                        <div class="mb-3">
                                            <label for="language" class="form-label">Language</label>
                                            <select class="form-select" id="language">
                                                <option value="en" selected>English</option>
                                                <option value="ar">العربية (Arabic)</option>
                                                <option value="es">Español (Spanish)</option>
                                                <option value="fr">Français (French)</option>
                                                <option value="de">Deutsch (German)</option>
                                                <option value="zh">中文 (Chinese)</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="region" class="form-label">Region</label>
                                            <select class="form-select" id="region">
                                                <option value="eg" selected>Egypt</option>
                                                <option value="us">United States</option>
                                                <option value="uk">United Kingdom</option>
                                                <option value="ca">Canada</option>
                                                <option value="au">Australia</option>
                                                <option value="in">India</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="timezone" class="form-label">Time Zone</label>
                                            <select class="form-select" id="timezone">
                                                <option value="Africa/Cairo" selected>(GMT+2:00) Cairo</option>
                                                <option value="America/New_York">(GMT-5:00) Eastern Time (US & Canada)</option>
                                                <option value="America/Chicago">(GMT-6:00) Central Time (US & Canada)</option>
                                                <option value="America/Denver">(GMT-7:00) Mountain Time (US & Canada)</option>
                                                <option value="America/Los_Angeles">(GMT-8:00) Pacific Time (US & Canada)</option>
                                                <option value="Europe/London">(GMT+0:00) London</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="dateFormat" class="form-label">Date Format</label>
                                            <select class="form-select" id="dateFormat">
                                                <option value="mdy" selected>MM/DD/YYYY</option>
                                                <option value="dmy">DD/MM/YYYY</option>
                                                <option value="ymd">YYYY/MM/DD</option>
                                            </select>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary">Save Language Settings</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Accessibility Settings -->
                        <div class="tab-pane fade" id="accessibility-settings">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-white">
                                    <h5 class="mb-0">Accessibility Settings</h5>
                                </div>
                                <div class="card-body">
                                    <form id="accessibilityForm">
                                        <div class="mb-3">
                                            <label for="fontSize" class="form-label">Text Size: <span id="fontSizeValue">Medium</span></label>
                                            <input type="range" class="form-range" min="1" max="5" value="3" id="fontSize">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="contrast" class="form-label">Contrast: <span id="contrastValue">Normal</span></label>
                                            <input type="range" class="form-range" min="1" max="3" value="1" id="contrast">
                                        </div>
                                        
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" id="reduceMotion">
                                            <label class="form-check-label" for="reduceMotion">Reduce motion</label>
                                        </div>
                                        
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" id="screenReader">
                                            <label class="form-check-label" for="screenReader">Optimize for screen readers</label>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary">Save Accessibility Settings</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Delete Account -->
                        <div class="tab-pane fade" id="delete-account">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-white">
                                    <h5 class="mb-0 text-danger">Delete Account</h5>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <strong>Warning:</strong> Deleting your account is permanent and cannot be undone.
                                    </div>
                                    
                                    <p>When you delete your account:</p>
                                    <ul>
                                        <li>Your profile and personal information will be permanently removed</li>
                                        <li>Your posts and comments will be anonymized</li>
                                        <li>You will lose access to all your groups and connections</li>
                                        <li>You will not be able to recover your account or data</li>
                                    </ul>
                                    
                                    <p>If you're having issues with the platform, consider <a href="customer-service.php">contacting support</a> before deleting your account.</p>
                                    
                                    <form id="deleteAccountForm">
                                        <div class="mb-3">
                                            <label for="deleteReason" class="form-label">Why are you deleting your account?</label>
                                            <select class="form-select" id="deleteReason" required>
                                                <option value="" selected disabled>Please select a reason</option>
                                                <option value="not-using">I'm not using the platform anymore</option>
                                                <option value="privacy">Privacy concerns</option>
                                                <option value="experience">Bad experience</option>
                                                <option value="alternative">Found an alternative platform</option>
                                                <option value="other">Other reason</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="deleteFeedback" class="form-label">Additional feedback (optional)</label>
                                            <textarea class="form-control" id="deleteFeedback" rows="3" placeholder="Please tell us more about why you're leaving..."></textarea>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="deletePassword" class="form-label">Enter your password to confirm</label>
                                            <input type="password" class="form-control" id="deletePassword" required>
                                        </div>
                                        
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="deleteConfirm" required>
                                            <label class="form-check-label" for="deleteConfirm">
                                                I understand that deleting my account is permanent and cannot be undone.
                                            </label>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-danger">Delete My Account</button>
                                    </form>
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
                        <li class="mb-2"><a href="dashboard.php" class="text-white text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="groups.php" class="text-white text-decoration-none">My Groups</a></li>
                        <li class="mb-2"><a href="messages.php" class="text-white text-decoration-none">Messages</a></li>
                        <li class="mb-2"><a href="saved-posts.php" class="text-white text-decoration-none">Saved Posts</a></li>
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
   
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            document.querySelectorAll('[id^="toggle"]').forEach(btn => {
                btn.addEventListener('click', function() {
                    const inputId = this.id.replace('toggle', '').charAt(0).toLowerCase() + this.id.replace('toggle', '').slice(1);
                    const passwordInput = document.getElementById(inputId);
                    if (passwordInput) {
                        if (passwordInput.type === 'password') {
                            passwordInput.type = 'text';
                            this.innerHTML = '<i class="fas fa-eye-slash"></i>';
                        } else {
                            passwordInput.type = 'password';
                            this.innerHTML = '<i class="fas fa-eye"></i>';
                        }
                    }
                });
            });
            
            // Two-factor authentication toggle
            const enable2FA = document.getElementById('enable2FA');
            const setup2FA = document.getElementById('2faSetup');
            
            if (enable2FA && setup2FA) {
                enable2FA.addEventListener('change', function() {
                    if (this.checked) {
                        setup2FA.classList.remove('d-none');
                    } else {
                        setup2FA.classList.add('d-none');
                    }
                });
            }
            
            // Range sliders with value display
            const searchRadius = document.getElementById('searchRadius');
            const radiusValue = document.getElementById('radiusValue');
            
            if (searchRadius && radiusValue) {
                searchRadius.addEventListener('input', function() {
                    radiusValue.textContent = `${this.value} km`;
                });
            }
            
            const fontSize = document.getElementById('fontSize');
            const fontSizeValue = document.getElementById('fontSizeValue');
            
            if (fontSize && fontSizeValue) {
                fontSize.addEventListener('input', function() {
                    const sizes = ['Very Small', 'Small', 'Medium', 'Large', 'Very Large'];
                    fontSizeValue.textContent = sizes[this.value - 1];
                });
            }
            
            const contrast = document.getElementById('contrast');
            const contrastValue = document.getElementById('contrastValue');
            
            if (contrast && contrastValue) {
                contrast.addEventListener('input', function() {
                    const levels = ['Normal', 'High', 'Very High'];
                    contrastValue.textContent = levels[this.value - 1];
                });
            }
            
            // Form submissions
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // In a real app, we would send the form data to a server
                    alert('Settings saved successfully!');
                });
            });
            
            // Special handling for delete account form
            const deleteAccountForm = document.getElementById('deleteAccountForm');
            if (deleteAccountForm) {
                deleteAccountForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    if (confirm('Are you absolutely sure you want to delete your account? This action cannot be undone.')) {
                        alert('Your account has been scheduled for deletion. You will receive a confirmation email shortly.');
                        window.location.href = 'index.php';
                    }
                });
            }
        });
    </script>
</body>
</html>
