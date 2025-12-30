/**
 * Main JavaScript file for Buy Nothing Platform
 */

document.addEventListener('DOMContentLoaded', function() {
    // Check if user is logged in
    const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
    if (isLoggedIn) {
        document.querySelectorAll('#auth-buttons').forEach(el => el.classList.add('d-none'));
        document.querySelectorAll('#user-dropdown').forEach(el => el.classList.remove('d-none'));
        document.querySelectorAll('#username-display').forEach(el => {
            el.textContent = localStorage.getItem('username') || 'User';
        });
    }
    
    // Logout functionality
    document.querySelectorAll('#logout-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            localStorage.removeItem('isLoggedIn');
            localStorage.removeItem('username');
            window.location.href = 'index.html';
        });
    });
    
    // Toggle password visibility
    document.querySelectorAll('[id^="toggle"]').forEach(btn => {
        btn.addEventListener('click', function() {
            const inputId = this.id.replace('toggle', '').toLowerCase();
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
    
    // Form validation
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });
    
    // Tooltips initialization
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Popovers initialization
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    const popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            e.preventDefault();
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Language switcher
    document.querySelectorAll('.dropdown-item[href="#"]').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const language = this.textContent.trim();
            
            // In a real app, we would change the language here
            alert(`Language changed to ${language}`);
            
            // Update active state
            document.querySelectorAll('.dropdown-item').forEach(el => {
                el.classList.remove('active');
            });
            this.classList.add('active');
        });
    });
    
    // Save post functionality
    document.querySelectorAll('.save-post-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const postId = this.getAttribute('data-post-id');
            
            if (isLoggedIn) {
                // In a real app, we would save the post to the user's saved posts
                this.innerHTML = '<i class="fas fa-bookmark"></i>';
                this.classList.add('text-primary');
                alert(`Post #${postId} saved to your bookmarks!`);
            } else {
                alert('Please log in to save posts');
                window.location.href = 'login.html';
            }
        });
    });
    
    // Report post functionality
    document.querySelectorAll('.report-post-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const postId = this.getAttribute('data-post-id');
            
            if (isLoggedIn) {
                // In a real app, we would show a report form
                alert(`Thank you for reporting post #${postId}. Our moderators will review it.`);
            } else {
                alert('Please log in to report posts');
                window.location.href = 'login.html';
            }
        });
    });
});

/**
 * Animate counting for statistics
 * @param {string} id - Element ID
 * @param {number} start - Start value
 * @param {number} end - End value
 * @param {number} duration - Animation duration in milliseconds
 */
function animateValue(id, start, end, duration) {
    const obj = document.getElementById(id);
    if (!obj) return;
    
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        obj.innerHTML = Math.floor(progress * (end - start) + start).toLocaleString();
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

/**
 * Join a group
 * @param {number} groupId - Group ID
 */
function joinGroup(groupId) {
    const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
    
    if (isLoggedIn) {
        alert(`You've successfully joined group #${groupId}! You'll now be redirected to the group page.`);
        // In a real app, we would redirect to the group page
    } else {
        alert('Please log in or register to join a group');
        window.location.href = 'login.html';
    }
}

/**
 * Create a new post
 * @param {string} type - Post type (GIVE, ASK, SERVICE)
 */
function createPost(type) {
    const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
    
    if (isLoggedIn) {
        window.location.href = `create-post.html?type=${type}`;
    } else {
        alert('Please log in or register to create a post');
        window.location.href = 'login.html';
    }
}

/**
 * Comment on a post
 * @param {number} postId - Post ID
 */
function commentOnPost(postId) {
    const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
    
    if (isLoggedIn) {
        // In a real app, we would show a comment form or redirect to the post detail page
        alert(`You're commenting on post #${postId}`);
    } else {
        alert('Please log in or register to comment on posts');
        window.location.href = 'login.html';
    }
}

/**
 * Start a chat with a user
 * @param {number} userId - User ID
 */
function startChat(userId) {
    const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
    
    if (isLoggedIn) {
        window.location.href = `messages.html?user=${userId}`;
    } else {
        alert('Please log in or register to message other users');
        window.location.href = 'login.html';
    }
}