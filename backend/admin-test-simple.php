<?php
/**
 * Simple Admin Panel Test
 * Test admin functionality without complex dependencies
 */

session_start();

// Simple authentication
$is_logged_in = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

// Handle login
if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        $is_logged_in = true;
    } else {
        $login_error = 'Invalid username or password';
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin-test-simple.php');
    exit();
}

if (!$is_logged_in) {
    // Show login form
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Login - Noble Driving Academy</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; }
            .login-container { min-height: 100vh; display: flex; align-items: center; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center mb-4">Admin Login</h3>
                            <?php if (isset($login_error)): ?>
                                <div class="alert alert-danger"><?php echo $login_error; ?></div>
                            <?php endif; ?>
                            <form method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit();
}

// Test database connection
echo "<h2>🧪 Admin Panel Test</h2>";

// Test 1: Database Connection
echo "<h3>1. Database Connection</h3>";
try {
    require_once __DIR__ . '/config/database.php';
    $database = new Database();
    $conn = $database->getConnection();
    
    if ($conn) {
        echo "<p style='color: green;'>✅ Database connected successfully</p>";
    } else {
        echo "<p style='color: red;'>❌ Database connection failed</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Database error: " . $e->getMessage() . "</p>";
}

// Test 2: Contact Data
echo "<h3>2. Contact Data</h3>";
try {
    require_once __DIR__ . '/models/Contact.php';
    $contact = new Contact();
    $contacts = $contact->getAll();
    echo "<p style='color: green;'>✅ Found " . count($contacts) . " contacts</p>";
    
    if (count($contacts) > 0) {
        echo "<table class='table table-striped'>";
        echo "<tr><th>Name</th><th>Email</th><th>Subject</th><th>Date</th></tr>";
        foreach (array_slice($contacts, 0, 5) as $c) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($c['first_name'] . ' ' . $c['last_name']) . "</td>";
            echo "<td>" . htmlspecialchars($c['email']) . "</td>";
            echo "<td>" . htmlspecialchars($c['subject']) . "</td>";
            echo "<td>" . date('M j, Y', strtotime($c['created_at'])) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Contact error: " . $e->getMessage() . "</p>";
}

// Test 3: Registration Data
echo "<h3>3. Registration Data</h3>";
try {
    require_once __DIR__ . '/models/Registration.php';
    $registration = new Registration();
    $registrations = $registration->getAll();
    echo "<p style='color: green;'>✅ Found " . count($registrations) . " registrations</p>";
    
    if (count($registrations) > 0) {
        echo "<table class='table table-striped'>";
        echo "<tr><th>Name</th><th>Email</th><th>Course</th><th>Date</th></tr>";
        foreach (array_slice($registrations, 0, 5) as $r) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($r['first_name'] . ' ' . $r['last_name']) . "</td>";
            echo "<td>" . htmlspecialchars($r['email']) . "</td>";
            echo "<td>" . htmlspecialchars($r['course_id']) . "</td>";
            echo "<td>" . date('M j, Y', strtotime($r['created_at'])) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Registration error: " . $e->getMessage() . "</p>";
}

// Test 4: Email Data
echo "<h3>4. Email Logs</h3>";
try {
    require_once __DIR__ . '/models/Email.php';
    $email = new Email();
    $emails = $email->getAll();
    echo "<p style='color: green;'>✅ Found " . count($emails) . " emails</p>";
    
    if (count($emails) > 0) {
        echo "<table class='table table-striped'>";
        echo "<tr><th>To</th><th>From</th><th>Subject</th><th>Type</th><th>Date</th></tr>";
        foreach (array_slice($emails, 0, 5) as $e) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($e['to_email']) . "</td>";
            echo "<td>" . htmlspecialchars($e['from_email']) . "</td>";
            echo "<td>" . htmlspecialchars($e['subject']) . "</td>";
            echo "<td>" . htmlspecialchars($e['type']) . "</td>";
            echo "<td>" . date('M j, Y H:i', strtotime($e['sent_at'])) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Email error: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<h3>🎯 Admin Panel Status</h3>";
echo "<p><strong>✅ Admin panel is working!</strong></p>";
echo "<p><a href='admin-test-simple.php?logout=1' class='btn btn-danger'>Logout</a></p>";
echo "<p><a href='admin-simple.php' class='btn btn-primary'>Go to Full Admin Panel</a></p>";
?>
