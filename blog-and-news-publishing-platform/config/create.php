<?php

$conn = new mysqli("localhost", "root", "", "");

$sql = "CREATE DATABASE IF NOT EXISTS blog_platform";

if($conn->query($sql) === TRUE)
{
    echo "Database created successfully.<br>";
}
else
{
    echo "Failed creating database.<br>";
}
$conn->close();


$conn = new mysqli("localhost", "root", "", "blog_platform");

if($conn->connect_error)
{
    die("Connection failed.");
}


$sql = "CREATE TABLE IF NOT EXISTS users (

    id INT AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(100) NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,

    status ENUM(
    'draft',
    'pending',
    'published',
    'rejected'
    ) DEFAULT 'draft',

    bio TEXT,
    profile_pic VARCHAR(255),

    social_links JSON,

    is_active TINYINT(1) DEFAULT 1,
    is_author_approved TINYINT(1) DEFAULT 0,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

)";

if($conn->query($sql) === TRUE)
{
    echo "users table created successfully.<br>";
}
else
{
    echo "Failed to create users table.<br>";
}


$sql = "CREATE TABLE IF NOT EXISTS categories (

    id INT AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(100) NOT NULL,
    slug VARCHAR(120) UNIQUE NOT NULL,

    description TEXT,

    created_by INT NULL,

    FOREIGN KEY (created_by)
    REFERENCES users(id)
    ON DELETE SET NULL

)";

if($conn->query($sql) === TRUE)
{
    echo "categories table created successfully.<br>";
}
else
{
    echo "Failed to create categories table.<br>";
}


$sql = "CREATE TABLE IF NOT EXISTS tags (

    id INT AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(100) NOT NULL,
    slug VARCHAR(120) UNIQUE NOT NULL,

    created_by INT NULL,

    usage_count INT DEFAULT 0,

    FOREIGN KEY (created_by)
    REFERENCES users(id)
    ON DELETE SET NULL

)";

if($conn->query($sql) === TRUE)
{
    echo "tags table created successfully.<br>";
}
else
{
    echo "Failed to create tags table.<br>";
}


$sql = "CREATE TABLE IF NOT EXISTS series (

    id INT AUTO_INCREMENT PRIMARY KEY,

    author_id INT NOT NULL,

    title VARCHAR(255) NOT NULL,
    description TEXT,

    cover_image_path VARCHAR(255),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (author_id)
    REFERENCES users(id)
    ON DELETE CASCADE

)";

if($conn->query($sql) === TRUE)
{
    echo "series table created successfully.<br>";
}
else
{
    echo "Failed to create series table.<br>";
}


$sql = "CREATE TABLE IF NOT EXISTS articles (

    id INT AUTO_INCREMENT PRIMARY KEY,

    author_id INT NOT NULL,
    editor_id INT NULL,

    category_id INT NOT NULL,
    series_id INT NULL,

    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,

    body LONGTEXT NOT NULL,
    excerpt TEXT,

    featured_image_path VARCHAR(255),

    status ENUM(
    'draft',
    'pending',
    'published',
    'rejected'
    ) DEFAULT 'draft',

    editor_feedback TEXT,

    scheduled_publish_at DATETIME NULL,
    published_at DATETIME NULL,

    view_count INT DEFAULT 0,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (author_id)
    REFERENCES users(id)
    ON DELETE CASCADE,

    FOREIGN KEY (editor_id)
    REFERENCES users(id)
    ON DELETE SET NULL,

    FOREIGN KEY (category_id)
    REFERENCES categories(id)
    ON DELETE CASCADE,

    FOREIGN KEY (series_id)
    REFERENCES series(id)
    ON DELETE SET NULL

)";

if($conn->query($sql) === TRUE)
{
    echo "articles table created successfully.<br>";
}
else
{
    echo "Failed to create articles table.<br>";
}


$sql = "CREATE TABLE IF NOT EXISTS article_tags (

    article_id INT,
    tag_id INT,

    PRIMARY KEY(article_id, tag_id),

    FOREIGN KEY (article_id)
    REFERENCES articles(id)
    ON DELETE CASCADE,

    FOREIGN KEY (tag_id)
    REFERENCES tags(id)
    ON DELETE CASCADE

)";

if($conn->query($sql) === TRUE)
{
    echo "article_tags table created successfully.<br>";
}
else
{
    echo "Failed to create article_tags table.<br>";
}


$sql = "CREATE TABLE IF NOT EXISTS article_revisions (

    id INT AUTO_INCREMENT PRIMARY KEY,

    article_id INT NOT NULL,
    author_id INT NOT NULL,

    body_snapshot LONGTEXT NOT NULL,

    saved_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (article_id)
    REFERENCES articles(id)
    ON DELETE CASCADE,

    FOREIGN KEY (author_id)
    REFERENCES users(id)
    ON DELETE CASCADE

)";

if($conn->query($sql) === TRUE)
{
    echo "article_revisions table created successfully.<br>";
}
else
{
    echo "Failed to create article_revisions table.<br>";
}


$sql = "CREATE TABLE IF NOT EXISTS likes (

    id INT AUTO_INCREMENT PRIMARY KEY,

    article_id INT NOT NULL,
    user_id INT NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    UNIQUE(article_id, user_id),

    FOREIGN KEY (article_id)
    REFERENCES articles(id)
    ON DELETE CASCADE,

    FOREIGN KEY (user_id)
    REFERENCES users(id)
    ON DELETE CASCADE

)";

if($conn->query($sql) === TRUE)
{
    echo "likes table created successfully.<br>";
}
else
{
    echo "Failed to create likes table.<br>";
}


$sql = "CREATE TABLE IF NOT EXISTS comments (

    id INT AUTO_INCREMENT PRIMARY KEY,

    article_id INT NOT NULL,
    user_id INT NOT NULL,

    body TEXT NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (article_id)
    REFERENCES articles(id)
    ON DELETE CASCADE,

    FOREIGN KEY (user_id)
    REFERENCES users(id)
    ON DELETE CASCADE

)";

if($conn->query($sql) === TRUE)
{
    echo "comments table created successfully.<br>";
}
else
{
    echo "Failed to create comments table.<br>";
}


$sql = "CREATE TABLE IF NOT EXISTS comment_reports (

    id INT AUTO_INCREMENT PRIMARY KEY,

    comment_id INT NOT NULL,
    reporter_id INT NOT NULL,

    reason TEXT NOT NULL,

    status ENUM('pending','resolved')
    DEFAULT 'pending',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (comment_id)
    REFERENCES comments(id)
    ON DELETE CASCADE,

    FOREIGN KEY (reporter_id)
    REFERENCES users(id)
    ON DELETE CASCADE

)";

if($conn->query($sql) === TRUE)
{
    echo "comment_reports table created successfully.<br>";
}
else
{
    echo "Failed to create comment_reports table.<br>";
}


$sql = "CREATE TABLE IF NOT EXISTS follows (

    id INT AUTO_INCREMENT PRIMARY KEY,

    follower_id INT NOT NULL,
    followed_author_id INT NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    UNIQUE(follower_id, followed_author_id),

    FOREIGN KEY (follower_id)
    REFERENCES users(id)
    ON DELETE CASCADE,

    FOREIGN KEY (followed_author_id)
    REFERENCES users(id)
    ON DELETE CASCADE

)";

if($conn->query($sql) === TRUE)
{
    echo "follows table created successfully.<br>";
}
else
{
    echo "Failed to create follows table.<br>";
}


$sql = "CREATE TABLE IF NOT EXISTS reading_lists (

    id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT NOT NULL,
    article_id INT NOT NULL,

    saved_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    UNIQUE(user_id, article_id),

    FOREIGN KEY (user_id)
    REFERENCES users(id)
    ON DELETE CASCADE,

    FOREIGN KEY (article_id)
    REFERENCES articles(id)
    ON DELETE CASCADE

)";

if($conn->query($sql) === TRUE)
{
    echo "reading_lists table created successfully.<br>";
}
else
{
    echo "Failed to create reading_lists table.<br>";
}


$sql = "CREATE TABLE IF NOT EXISTS reading_history (

    id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT NOT NULL,
    article_id INT NOT NULL,

    read_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id)
    REFERENCES users(id)
    ON DELETE CASCADE,

    FOREIGN KEY (article_id)
    REFERENCES articles(id)
    ON DELETE CASCADE

)";

if($conn->query($sql) === TRUE)
{
    echo "reading_history table created successfully.<br>";
}
else
{
    echo "Failed to create reading_history table.<br>";
}


$sql = "CREATE TABLE IF NOT EXISTS editorial_calendar (

    id INT AUTO_INCREMENT PRIMARY KEY,

    article_id INT NOT NULL,
    editor_id INT NOT NULL,

    scheduled_date DATETIME NOT NULL,

    note TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (article_id)
    REFERENCES articles(id)
    ON DELETE CASCADE,

    FOREIGN KEY (editor_id)
    REFERENCES users(id)
    ON DELETE CASCADE

)";

if($conn->query($sql) === TRUE)
{
    echo "editorial_calendar table created successfully.<br>";
}
else
{
    echo "Failed to create editorial_calendar table.<br>";
}


$sql = "CREATE TABLE IF NOT EXISTS author_applications (

    id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT NOT NULL,

    motivation TEXT NOT NULL,
    writing_sample LONGTEXT NOT NULL,

    status ENUM('pending','approved','rejected')
    DEFAULT 'pending',

    reviewed_by INT NULL,

    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id)
    REFERENCES users(id)
    ON DELETE CASCADE,

    FOREIGN KEY (reviewed_by)
    REFERENCES users(id)
    ON DELETE SET NULL

)";

if($conn->query($sql) === TRUE)
{
    echo "author_applications table created successfully.<br>";
}
else
{
    echo "Failed to create author_applications table.<br>";
}
$conn->close();

?>