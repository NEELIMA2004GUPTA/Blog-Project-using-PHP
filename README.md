# Mini Blog in PHP
This is a **simple Mini Blog application** built using **PHP** with **MySQLi prepared statements**.  
It supports basic CRUD operations:
    - Add a new post (title & content)
    - List all posts
    - Edit a post
    - Delete a post
    - CSRF token protection for secure operations

# Features
- Lightweight and simple PHP application.
- Uses **prepared statements** to prevent SQL injection.
- CSRF protection on all form actions.
- Basic blog functionality for learning PHP and database integration.

# Project Structure
Blog/
│
├── db.php                              # Database connection + session + CSRF token setup
├── index.php                           # List all blog posts
├── add.php                             # Add new post
├── edit.php                            # Edit existing post
├── delete.php                          # Delete post

# Setup Instructions
1. **Clone or Download**
Download or clone this project into your local web server directory (`htdocs` for XAMPP):
cd xampp/htdocs
git clone

2. **Create Database**
Open phpMyAdmin or MySQL CLI and run:

CREATE DATABASE mini_blog_db ;
USE mini_blog_db;

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

3. **Start Server**
Run Apache and MySQL via XAMPP, then open in browser:
http://localhost/Blog/index.php

# Pages Overview 
Home Page
    - Lists all blog posts with Edit/Delete options.
Add Post
    - Simple form to add a new blog entry.
Edit Post
    - Update existing post title and content.

# Security
- Prepared statements prevent SQL injection attacks.
- CSRF tokens protect against cross-site request forgery.
- Output is escaped using htmlspecialchars() to prevent XSS attacks.


**HAPPY CODING**
