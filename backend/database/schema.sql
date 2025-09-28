-- Noble Driving Academy Database Schema
-- Created for PHP Backend

CREATE DATABASE IF NOT EXISTS noble_driving_academy;
USE noble_driving_academy;

-- Users table for admin access
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin', 'instructor') DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Courses table
CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2),
    duration_hours INT,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Contact form submissions
CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(200),
    course_id INT,
    message TEXT NOT NULL,
    status ENUM('new', 'contacted', 'resolved') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

-- Registration form submissions
CREATE TABLE registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    middle_name VARCHAR(50),
    last_name VARCHAR(50) NOT NULL,
    address_line1 VARCHAR(200) NOT NULL,
    city VARCHAR(50) NOT NULL,
    state VARCHAR(50) NOT NULL,
    zip_code VARCHAR(10) NOT NULL,
    age_category ENUM('teen', 'adult') NOT NULL,
    school_name VARCHAR(100),
    phone VARCHAR(20),
    email VARCHAR(100) NOT NULL,
    course_id INT NOT NULL,
    comment TEXT,
    status ENUM('pending', 'approved', 'rejected', 'completed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

-- Testimonials table
CREATE TABLE testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(100) NOT NULL,
    course_name VARCHAR(100),
    rating INT CHECK (rating >= 1 AND rating <= 5),
    testimonial TEXT NOT NULL,
    is_approved BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Blog posts table
CREATE TABLE blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(200) UNIQUE NOT NULL,
    content TEXT NOT NULL,
    excerpt TEXT,
    featured_image VARCHAR(255),
    author VARCHAR(100),
    is_published BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert default courses
INSERT INTO courses (name, description, price, duration_hours) VALUES
('Teenage Behind the Wheel Training', 'Comprehensive behind-the-wheel training for teenagers', 299.99, 6),
('Teenage Classroom Instruction', 'Classroom-based driver education for teens', 199.99, 30),
('Private 1 ON 1 Driving', 'Personalized one-on-one driving instruction', 89.99, 1),
('Re-Examination Class', 'Preparation course for driving test re-examination', 149.99, 4),
('Adult Waiver Course', 'Adult driver education waiver course', 179.99, 8),
('Pickup And Drop Services', 'Convenient pickup and drop-off service', 25.00, 0);

-- Insert default admin user (password: admin123)
INSERT INTO users (username, email, password_hash, role) VALUES
('admin', 'admin@nobledrivingacademy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Insert sample testimonials
INSERT INTO testimonials (student_name, course_name, rating, testimonial, is_approved) VALUES
('Sarah Johnson', 'Teenage Behind the Wheel Training', 5, 'Excellent instruction! The instructor was patient and helped me pass my test on the first try.', TRUE),
('Mike Chen', 'Private 1 ON 1 Driving', 5, 'Great personalized attention. Highly recommend for anyone nervous about driving.', TRUE),
('Emily Rodriguez', 'Adult Waiver Course', 4, 'Very informative course. The instructor made complex traffic rules easy to understand.', TRUE);

-- Emails table for storing sent emails
CREATE TABLE emails (
    id INT AUTO_INCREMENT PRIMARY KEY,
    to_email VARCHAR(100) NOT NULL,
    from_email VARCHAR(100) NOT NULL,
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    type ENUM('contact', 'registration', 'notification', 'newsletter') DEFAULT 'contact',
    status ENUM('sent', 'failed', 'pending') DEFAULT 'pending',
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample blog posts
INSERT INTO blog_posts (title, slug, content, excerpt, author, is_published) VALUES
('10 Essential Driving Tips for New Drivers', '10-essential-driving-tips', 'Content about driving tips...', 'Learn the most important driving tips every new driver should know.', 'Noble Driving Academy', TRUE),
('Understanding Traffic Signs and Signals', 'understanding-traffic-signs', 'Content about traffic signs...', 'A comprehensive guide to traffic signs and signals for new drivers.', 'Noble Driving Academy', TRUE),
('Parallel Parking Made Easy', 'parallel-parking-made-easy', 'Content about parallel parking...', 'Master the art of parallel parking with these simple techniques.', 'Noble Driving Academy', TRUE);
