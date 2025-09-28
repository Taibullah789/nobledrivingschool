<?php
/**
 * Simple Admin Panel
 * Works with PHP built-in server
 */

// Simple authentication (in production, use proper authentication)
session_start();
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
    header('Location: admin-simple.php');
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
                        <div class="card-header text-center">
                            <h3>Noble Driving Academy</h3>
                            <p class="mb-0">Admin Login</p>
                        </div>
                        <div class="card-body">
                            <?php if (isset($login_error)): ?>
                                <div class="alert alert-danger"><?php echo $login_error; ?></div>
                            <?php endif; ?>
                            <form method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                            </form>
                            <div class="mt-3 text-center">
                                <small class="text-muted">Default: admin / admin123</small>
                            </div>
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

// Get data from database
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/models/Contact.php';
require_once __DIR__ . '/models/Registration.php';
require_once __DIR__ . '/models/Email.php';

$contact = new Contact();
$registration = new Registration();
$email = new Email();

$contacts = $contact->getAll();
$registrations = $registration->getAll();
$emails = $email->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Noble Driving Academy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar { min-height: 100vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .sidebar .nav-link { color: rgba(255,255,255,0.8); border-radius: 0.5rem; margin: 0.25rem 0; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: white; background-color: rgba(255,255,255,0.1); }
        .stats-card { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">Noble Driving Academy</h4>
                        <small class="text-white-50">Admin Panel</small>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#dashboard">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#registrations">
                                <i class="fas fa-user-plus me-2"></i>Registrations (<?php echo count($registrations); ?>)
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contacts">
                                <i class="fas fa-envelope me-2"></i>Contact Forms (<?php echo count($contacts); ?>)
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#emails">
                                <i class="fas fa-mail-bulk me-2"></i>Email Logs (<?php echo count($emails); ?>)
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#export">
                                <i class="fas fa-download me-2"></i>Export Data
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin-simple.php?logout=1">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="card-title">Total Registrations</h6>
                                        <h3><?php echo count($registrations); ?></h3>
                                    </div>
                                    <i class="fas fa-user-plus fa-2x opacity-75"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="card-title">Contact Forms</h6>
                                        <h3><?php echo count($contacts); ?></h3>
                                    </div>
                                    <i class="fas fa-envelope fa-2x opacity-75"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Registrations -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Recent Registrations</h5>
                            </div>
                            <div class="card-body">
                                <?php if (empty($registrations)): ?>
                                    <p class="text-muted">No registrations yet.</p>
                                <?php else: ?>
                                    <?php foreach (array_slice($registrations, 0, 5) as $reg): ?>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div>
                                                <strong><?php echo htmlspecialchars($reg['first_name'] . ' ' . $reg['last_name']); ?></strong><br>
                                                <small class="text-muted"><?php echo htmlspecialchars($reg['email']); ?></small>
                                            </div>
                                            <span class="badge bg-<?php echo $reg['status'] === 'pending' ? 'warning' : 'success'; ?>">
                                                <?php echo ucfirst($reg['status']); ?>
                                            </span>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Recent Contact Forms</h5>
                            </div>
                            <div class="card-body">
                                <?php if (empty($contacts)): ?>
                                    <p class="text-muted">No contact forms yet.</p>
                                <?php else: ?>
                                    <?php foreach (array_slice($contacts, 0, 5) as $contact): ?>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div>
                                                <strong><?php echo htmlspecialchars($contact['first_name'] . ' ' . $contact['last_name']); ?></strong><br>
                                                <small class="text-muted"><?php echo htmlspecialchars($contact['subject']); ?></small>
                                            </div>
                                            <span class="badge bg-<?php echo $contact['status'] === 'new' ? 'primary' : 'success'; ?>">
                                                <?php echo ucfirst($contact['status']); ?>
                                            </span>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- All Data Tables -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>All Registrations</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Age</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($registrations as $reg): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($reg['first_name'] . ' ' . $reg['last_name']); ?></td>
                                                    <td><?php echo htmlspecialchars($reg['email']); ?></td>
                                                    <td><?php echo htmlspecialchars($reg['phone']); ?></td>
                                                    <td><?php echo htmlspecialchars($reg['age_category']); ?></td>
                                                    <td><span class="badge bg-<?php echo $reg['status'] === 'pending' ? 'warning' : 'success'; ?>"><?php echo ucfirst($reg['status']); ?></span></td>
                                                    <td><?php echo date('M j, Y', strtotime($reg['created_at'])); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>All Contact Forms</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Subject</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($contacts as $contact): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($contact['first_name'] . ' ' . $contact['last_name']); ?></td>
                                                    <td><?php echo htmlspecialchars($contact['email']); ?></td>
                                                    <td><?php echo htmlspecialchars($contact['subject']); ?></td>
                                                    <td><span class="badge bg-<?php echo $contact['status'] === 'new' ? 'primary' : 'success'; ?>"><?php echo ucfirst($contact['status']); ?></span></td>
                                                    <td><?php echo date('M j, Y', strtotime($contact['created_at'])); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Email Logs</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>To</th>
                                                <th>From</th>
                                                <th>Subject</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($emails as $email): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($email['to_email']); ?></td>
                                                    <td><?php echo htmlspecialchars($email['from_email']); ?></td>
                                                    <td><?php echo htmlspecialchars($email['subject']); ?></td>
                                                    <td><span class="badge bg-info"><?php echo ucfirst($email['type']); ?></span></td>
                                                    <td><span class="badge bg-<?php echo $email['status'] === 'sent' ? 'success' : ($email['status'] === 'failed' ? 'danger' : 'warning'); ?>"><?php echo ucfirst($email['status']); ?></span></td>
                                                    <td><?php echo date('M j, Y H:i', strtotime($email['sent_at'])); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Export Section -->
                <div class="row mt-4" id="export">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Export Data</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card border-primary">
                                            <div class="card-body text-center">
                                                <i class="fas fa-envelope fa-3x text-primary mb-3"></i>
                                                <h6>Export Contacts</h6>
                                                <p class="text-muted">Download all contact form submissions</p>
                                                <a href="admin-export.php?type=contacts&format=csv" class="btn btn-primary btn-sm me-2">
                                                    <i class="fas fa-file-csv me-1"></i>CSV
                                                </a>
                                                <a href="admin-export.php?type=contacts&format=json" class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-file-code me-1"></i>JSON
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card border-success">
                                            <div class="card-body text-center">
                                                <i class="fas fa-user-plus fa-3x text-success mb-3"></i>
                                                <h6>Export Registrations</h6>
                                                <p class="text-muted">Download all registration data</p>
                                                <a href="admin-export.php?type=registrations&format=csv" class="btn btn-success btn-sm me-2">
                                                    <i class="fas fa-file-csv me-1"></i>CSV
                                                </a>
                                                <a href="admin-export.php?type=registrations&format=json" class="btn btn-outline-success btn-sm">
                                                    <i class="fas fa-file-code me-1"></i>JSON
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card border-info">
                                            <div class="card-body text-center">
                                                <i class="fas fa-mail-bulk fa-3x text-info mb-3"></i>
                                                <h6>Export All Data</h6>
                                                <p class="text-muted">Download complete database</p>
                                                <a href="admin-export.php?type=all&format=csv" class="btn btn-info btn-sm me-2">
                                                    <i class="fas fa-file-csv me-1"></i>CSV
                                                </a>
                                                <a href="admin-export.php?type=all&format=json" class="btn btn-outline-info btn-sm">
                                                    <i class="fas fa-file-code me-1"></i>JSON
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
