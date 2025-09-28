<?php
/**
 * Noble Driving Academy Backend API
 * Main entry point for the backend system
 */

require_once 'config/config.php';

// Simple API documentation endpoint
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '/backend/' || $_SERVER['REQUEST_URI'] === '/backend/index.php') {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Noble Driving Academy - Backend API</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .hero {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 4rem 0;
            }
            .api-endpoint {
                background: #f8f9fa;
                border-left: 4px solid #007bff;
                padding: 1rem;
                margin: 0.5rem 0;
            }
            .method {
                display: inline-block;
                padding: 0.25rem 0.5rem;
                border-radius: 0.25rem;
                font-size: 0.75rem;
                font-weight: bold;
                margin-right: 0.5rem;
            }
            .method.get { background: #28a745; color: white; }
            .method.post { background: #007bff; color: white; }
            .method.put { background: #ffc107; color: black; }
            .method.delete { background: #dc3545; color: white; }
        </style>
    </head>
    <body>
        <div class="hero">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <h1 class="display-4">Noble Driving Academy</h1>
                        <p class="lead">Backend API System</p>
                        <p>Welcome to the Noble Driving Academy backend API. This system provides endpoints for managing contacts, registrations, courses, and testimonials.</p>
                    </div>
                    <div class="col-lg-4 text-end">
                        <a href="admin/" class="btn btn-light btn-lg">
                            <i class="fas fa-cog"></i> Admin Panel
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container my-5">
            <div class="row">
                <div class="col-lg-8">
                    <h2>API Endpoints</h2>
                    
                    <div class="api-endpoint">
                        <span class="method post">POST</span>
                        <strong>/api/contact.php</strong>
                        <p class="mb-0">Submit contact form data</p>
                    </div>

                    <div class="api-endpoint">
                        <span class="method get">GET</span>
                        <strong>/api/contact.php</strong>
                        <p class="mb-0">Retrieve all contact submissions (admin)</p>
                    </div>

                    <div class="api-endpoint">
                        <span class="method post">POST</span>
                        <strong>/api/registration.php</strong>
                        <p class="mb-0">Submit registration form data</p>
                    </div>

                    <div class="api-endpoint">
                        <span class="method get">GET</span>
                        <strong>/api/registration.php</strong>
                        <p class="mb-0">Retrieve all registrations (admin)</p>
                    </div>

                    <div class="api-endpoint">
                        <span class="method put">PUT</span>
                        <strong>/api/registration.php</strong>
                        <p class="mb-0">Update registration status</p>
                    </div>

                    <div class="api-endpoint">
                        <span class="method get">GET</span>
                        <strong>/api/courses.php</strong>
                        <p class="mb-0">Retrieve all available courses</p>
                    </div>

                    <div class="api-endpoint">
                        <span class="method post">POST</span>
                        <strong>/api/courses.php</strong>
                        <p class="mb-0">Create new course (admin)</p>
                    </div>

                    <div class="api-endpoint">
                        <span class="method get">GET</span>
                        <strong>/api/testimonials.php</strong>
                        <p class="mb-0">Retrieve approved testimonials</p>
                    </div>

                    <div class="api-endpoint">
                        <span class="method post">POST</span>
                        <strong>/api/testimonials.php</strong>
                        <p class="mb-0">Submit new testimonial</p>
                    </div>

                    <h3 class="mt-5">Quick Setup</h3>
                    <div class="alert alert-info">
                        <h5>Database Setup</h5>
                        <p>Run the database installation script to set up your database:</p>
                        <a href="setup/install.php" class="btn btn-primary">Run Database Setup</a>
                    </div>

                    <div class="alert alert-warning">
                        <h5>Configuration</h5>
                        <p>Make sure to update your database credentials in <code>config/database.php</code> and email settings in <code>config/config.php</code>.</p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>System Status</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            try {
                                $database = new Database();
                                $conn = $database->getConnection();
                                if ($conn) {
                                    echo '<div class="alert alert-success">';
                                    echo '<i class="fas fa-check-circle"></i> Database Connected';
                                    echo '</div>';
                                } else {
                                    echo '<div class="alert alert-danger">';
                                    echo '<i class="fas fa-times-circle"></i> Database Connection Failed';
                                    echo '</div>';
                                }
                            } catch (Exception $e) {
                                echo '<div class="alert alert-danger">';
                                echo '<i class="fas fa-times-circle"></i> Database Error: ' . $e->getMessage();
                                echo '</div>';
                            }
                            ?>
                            
                            <h6>Quick Links</h6>
                            <ul class="list-unstyled">
                                <li><a href="admin/">Admin Panel</a></li>
                                <li><a href="setup/install.php">Database Setup</a></li>
                                <li><a href="README.md">Documentation</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h5>API Information</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Version:</strong> 1.0.0</p>
                            <p><strong>PHP Version:</strong> <?php echo PHP_VERSION; ?></p>
                            <p><strong>Server:</strong> <?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown'; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="bg-dark text-white py-4 mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Noble Driving Academy</h5>
                        <p>Professional driving instruction and education services.</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <p>&copy; 2024 Noble Driving Academy. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    </body>
    </html>
    <?php
    exit();
}

// If not accessing the main page, return 404
sendError('API endpoint not found', 404);
?>
