-- Users Table
CREATE TABLE users (
    user_id INT IDENTITY(1,1) PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    bio TEXT,
    location VARCHAR(255),
    latitude DECIMAL(9, 6),
    longitude DECIMAL(9, 6),
    profile_image VARCHAR(255),
    is_admin BIT DEFAULT 0,
    is_volunteer BIT DEFAULT 0,
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE()
);

-- User Interests Table
CREATE TABLE user_interests (
    interest_id INT IDENTITY(1,1) PRIMARY KEY,
    user_id INT NOT NULL,
    interest_name VARCHAR(50) NOT NULL,
    created_at DATETIME DEFAULT GETDATE(),
    CONSTRAINT FK_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    CONSTRAINT UQ_user_interest UNIQUE (user_id, interest_name)
);


-- Groups Table
CREATE TABLE groups (
    group_id INT IDENTITY(1,1) PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    location VARCHAR(255) NOT NULL,
    latitude DECIMAL(9, 6) NOT NULL,
    longitude DECIMAL(9, 6) NOT NULL,
    cover_image VARCHAR(255),
    rules TEXT,
    approval_required BIT DEFAULT 1,
    post_approval BIT DEFAULT 0,
    is_private BIT DEFAULT 0,
    created_by INT NOT NULL,
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE(),
    CONSTRAINT FK_created_by FOREIGN KEY (created_by) REFERENCES users(user_id)
);



-- Group Memberships Table
CREATE TABLE group_memberships (
    membership_id INT IDENTITY(1,1) PRIMARY KEY,
    user_id INT NOT NULL,
    group_id INT NOT NULL,
    is_admin BIT DEFAULT 0,
    status VARCHAR(20) DEFAULT 'pending',
    join_reason TEXT,
    joined_at DATETIME DEFAULT GETDATE(),
    CONSTRAINT FK_user_group FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    CONSTRAINT FK_group_user FOREIGN KEY (group_id) REFERENCES groups(group_id) ON DELETE CASCADE,
    CONSTRAINT UQ_user_group UNIQUE (user_id, group_id),
    CONSTRAINT CHK_status CHECK (status IN ('pending', 'approved', 'rejected'))
);


-- Posts Table
CREATE TABLE posts (
    post_id INT IDENTITY(1,1) PRIMARY KEY,
    user_id INT NOT NULL,
    group_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    post_type VARCHAR(20) NOT NULL,
    category VARCHAR(50),
    item_condition VARCHAR(50),
    pickup_details TEXT,
    status VARCHAR(20) DEFAULT 'active',
    expiration_date DATE,
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE(),
    CONSTRAINT FK_post_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    CONSTRAINT FK_post_group FOREIGN KEY (group_id) REFERENCES groups(group_id) ON DELETE CASCADE,
    CONSTRAINT CHK_posts_post_type CHECK (post_type IN ('give', 'ask', 'gratitude')),
    CONSTRAINT CHK_posts_status CHECK (status IN ('active', 'pending', 'completed', 'expired'))
);

-- Indexes
CREATE INDEX idx_post_status ON posts(status);
CREATE INDEX idx_post_type ON posts(post_type);



-- Post Images Table
CREATE TABLE post_images (
    image_id INT IDENTITY(1,1) PRIMARY KEY,
    post_id INT NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    image_order INT DEFAULT 0,
    created_at DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (post_id) REFERENCES posts(post_id) ON DELETE CASCADE
);


-- Post Responses Table
CREATE TABLE post_responses (
    response_id INT IDENTITY(1,1) PRIMARY KEY,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    message TEXT NOT NULL,
    status VARCHAR(20) DEFAULT 'pending',
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE(),
    CONSTRAINT FK_response_post FOREIGN KEY (post_id) REFERENCES posts(post_id) ON DELETE CASCADE,
    CONSTRAINT FK_response_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE NO ACTION,
    CONSTRAINT CHK_post_responses_status CHECK (status IN ('pending', 'accepted', 'rejected'))
);

CREATE INDEX idx_post_responses_status ON post_responses(status);



-- Saved Posts Table
CREATE TABLE saved_posts (
    saved_id INT IDENTITY(1,1) PRIMARY KEY,
    user_id INT NOT NULL,
    post_id INT NOT NULL,
    created_at DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE NO ACTION,
    FOREIGN KEY (post_id) REFERENCES posts(post_id) ON DELETE CASCADE,
    CONSTRAINT UQ_saved_user_post UNIQUE (user_id, post_id)
);



-- Conversations Table
CREATE TABLE conversations (
    conversation_id INT IDENTITY(1,1) PRIMARY KEY,
    title VARCHAR(100),
    last_message_at DATETIME DEFAULT GETDATE(),
    created_at DATETIME DEFAULT GETDATE()
);


-- Conversation Participants Table
CREATE TABLE conversation_participants (
    participant_id INT IDENTITY(1,1) PRIMARY KEY,
    conversation_id INT NOT NULL,
    user_id INT NOT NULL,
    last_read_at DATETIME DEFAULT GETDATE(),
    created_at DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (conversation_id) REFERENCES conversations(conversation_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    CONSTRAINT UQ_conversation_user UNIQUE (conversation_id, user_id)
);


-- Messages Table
CREATE TABLE messages (
    message_id INT IDENTITY(1,1) PRIMARY KEY,
    conversation_id INT NOT NULL,
    sender_id INT NOT NULL,
    message TEXT NOT NULL,
    created_at DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (conversation_id) REFERENCES conversations(conversation_id) ON DELETE CASCADE,
    FOREIGN KEY (sender_id) REFERENCES users(user_id) ON DELETE CASCADE
);


-- Volunteer Applications Table
CREATE TABLE volunteer_applications (
    application_id INT IDENTITY(1,1) PRIMARY KEY,
    user_id INT NOT NULL,
    motivation TEXT NOT NULL,
    experience TEXT,
    availability TEXT,
    status VARCHAR(20) DEFAULT 'pending',
    reviewed_by INT NULL,
    review_notes TEXT,
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (reviewed_by) REFERENCES users(user_id) ON DELETE NO ACTION,
    CONSTRAINT CHK_volunteer_status CHECK (status IN ('pending', 'approved', 'rejected'))
);

-- Notifications Table
CREATE TABLE notifications (
    notification_id INT IDENTITY(1,1) PRIMARY KEY,
    user_id INT NOT NULL,
    type VARCHAR(50) NOT NULL,
    content TEXT NOT NULL,
    related_id INT,
    related_type VARCHAR(50),
    is_read BIT DEFAULT 0,
    created_at DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Create index for 'is_read' column
CREATE INDEX idx_is_read ON notifications(is_read);


-- User Settings Table
CREATE TABLE user_settings (
    setting_id INT IDENTITY(1,1) PRIMARY KEY,
    user_id INT NOT NULL,
    email_new_messages BIT DEFAULT 1,
    email_new_posts BIT DEFAULT 1,
    email_group_invites BIT DEFAULT 1,
    email_post_responses BIT DEFAULT 1,
    app_new_messages BIT DEFAULT 1,
    app_new_posts BIT DEFAULT 1,
    app_group_invites BIT DEFAULT 1,
    app_post_responses BIT DEFAULT 1,
    profile_visibility VARCHAR(20) DEFAULT 'everyone',
    location_visibility VARCHAR(20) DEFAULT 'group_members',
    message_permission VARCHAR(20) DEFAULT 'group_members',
    created_at DATETIME DEFAULT GETDATE(),
    updated_at DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    CONSTRAINT CHK_profile_visibility CHECK (profile_visibility IN ('everyone', 'group_members', 'connections')),
    CONSTRAINT CHK_location_visibility CHECK (location_visibility IN ('everyone', 'group_members', 'connections', 'nobody')),
    CONSTRAINT CHK_message_permission CHECK (message_permission IN ('everyone', 'group_members', 'connections')),
    CONSTRAINT UQ_user_settings UNIQUE (user_id)
);
