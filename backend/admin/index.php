<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noble Driving Academy - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            border-radius: 0.5rem;
            margin: 0.25rem 0;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255,255,255,0.1);
        }
        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">Noble Driving Academy</h4>
                        <small class="text-white-50">Admin Panel</small>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" onclick="showDashboard()">
                                <i class="fas fa-tachometer-alt me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showRegistrations()">
                                <i class="fas fa-user-plus me-2"></i>
                                Registrations
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showContacts()">
                                <i class="fas fa-envelope me-2"></i>
                                Contact Forms
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showCourses()">
                                <i class="fas fa-graduation-cap me-2"></i>
                                Courses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showTestimonials()">
                                <i class="fas fa-star me-2"></i>
                                Testimonials
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2" id="page-title">Dashboard</h1>
                </div>

                <!-- Dashboard Content -->
                <div id="dashboard-content">
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card stats-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="card-title">Total Registrations</h6>
                                            <h3 id="total-registrations">0</h3>
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
                                            <h6 class="card-title">Pending Registrations</h6>
                                            <h3 id="pending-registrations">0</h3>
                                        </div>
                                        <i class="fas fa-clock fa-2x opacity-75"></i>
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
                                            <h3 id="total-contacts">0</h3>
                                        </div>
                                        <i class="fas fa-envelope fa-2x opacity-75"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card stats-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="card-title">New Contacts</h6>
                                            <h3 id="new-contacts">0</h3>
                                        </div>
                                        <i class="fas fa-bell fa-2x opacity-75"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Recent Registrations</h5>
                                </div>
                                <div class="card-body">
                                    <div id="recent-registrations">
                                        <div class="text-center">
                                            <div class="spinner-border" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Recent Contact Forms</h5>
                                </div>
                                <div class="card-body">
                                    <div id="recent-contacts">
                                        <div class="text-center">
                                            <div class="spinner-border" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Other content sections will be loaded here -->
                <div id="other-content" style="display: none;"></div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Load dashboard data on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadDashboardData();
        });

        function loadDashboardData() {
            // Load statistics
            fetch('../api/registration.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const stats = calculateStats(data.data);
                        document.getElementById('total-registrations').textContent = stats.total;
                        document.getElementById('pending-registrations').textContent = stats.pending;
                    }
                });

            fetch('../api/contact.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const stats = calculateContactStats(data.data);
                        document.getElementById('total-contacts').textContent = stats.total;
                        document.getElementById('new-contacts').textContent = stats.new;
                    }
                });

            // Load recent data
            loadRecentRegistrations();
            loadRecentContacts();
        }

        function calculateStats(registrations) {
            return {
                total: registrations.length,
                pending: registrations.filter(r => r.status === 'pending').length,
                approved: registrations.filter(r => r.status === 'approved').length,
                completed: registrations.filter(r => r.status === 'completed').length
            };
        }

        function calculateContactStats(contacts) {
            return {
                total: contacts.length,
                new: contacts.filter(c => c.status === 'new').length,
                contacted: contacts.filter(c => c.status === 'contacted').length,
                resolved: contacts.filter(c => c.status === 'resolved').length
            };
        }

        function loadRecentRegistrations() {
            fetch('../api/registration.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const recent = data.data.slice(0, 5);
                        const html = recent.map(reg => `
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <strong>${reg.first_name} ${reg.last_name}</strong><br>
                                    <small class="text-muted">${reg.course_name}</small>
                                </div>
                                <span class="badge bg-${getStatusColor(reg.status)}">${reg.status}</span>
                            </div>
                        `).join('');
                        document.getElementById('recent-registrations').innerHTML = html;
                    }
                });
        }

        function loadRecentContacts() {
            fetch('../api/contact.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const recent = data.data.slice(0, 5);
                        const html = recent.map(contact => `
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <strong>${contact.first_name} ${contact.last_name}</strong><br>
                                    <small class="text-muted">${contact.subject}</small>
                                </div>
                                <span class="badge bg-${getContactStatusColor(contact.status)}">${contact.status}</span>
                            </div>
                        `).join('');
                        document.getElementById('recent-contacts').innerHTML = html;
                    }
                });
        }

        function getStatusColor(status) {
            switch(status) {
                case 'pending': return 'warning';
                case 'approved': return 'success';
                case 'rejected': return 'danger';
                case 'completed': return 'info';
                default: return 'secondary';
            }
        }

        function getContactStatusColor(status) {
            switch(status) {
                case 'new': return 'primary';
                case 'contacted': return 'info';
                case 'resolved': return 'success';
                default: return 'secondary';
            }
        }

        function showDashboard() {
            document.getElementById('page-title').textContent = 'Dashboard';
            document.getElementById('dashboard-content').style.display = 'block';
            document.getElementById('other-content').style.display = 'none';
            loadDashboardData();
        }

        function showRegistrations() {
            document.getElementById('page-title').textContent = 'Registrations';
            document.getElementById('dashboard-content').style.display = 'none';
            document.getElementById('other-content').style.display = 'block';
            document.getElementById('other-content').innerHTML = '<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';
            
            // Load registrations table
            loadRegistrationsTable();
        }

        function showContacts() {
            document.getElementById('page-title').textContent = 'Contact Forms';
            document.getElementById('dashboard-content').style.display = 'none';
            document.getElementById('other-content').style.display = 'block';
            document.getElementById('other-content').innerHTML = '<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';
            
            // Load contacts table
            loadContactsTable();
        }

        function showCourses() {
            document.getElementById('page-title').textContent = 'Courses';
            document.getElementById('dashboard-content').style.display = 'none';
            document.getElementById('other-content').style.display = 'block';
            document.getElementById('other-content').innerHTML = '<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';
            
            // Load courses table
            loadCoursesTable();
        }

        function showTestimonials() {
            document.getElementById('page-title').textContent = 'Testimonials';
            document.getElementById('dashboard-content').style.display = 'none';
            document.getElementById('other-content').style.display = 'block';
            document.getElementById('other-content').innerHTML = '<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';
            
            // Load testimonials table
            loadTestimonialsTable();
        }

        function loadRegistrationsTable() {
            fetch('../api/registration.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const html = `
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5>All Registrations</h5>
                                    <button class="btn btn-primary btn-sm" onclick="exportRegistrations()">
                                        <i class="fas fa-download me-1"></i>Export
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Course</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                ${data.data.map(reg => `
                                                    <tr>
                                                        <td>${reg.first_name} ${reg.last_name}</td>
                                                        <td>${reg.email}</td>
                                                        <td>${reg.course_name}</td>
                                                        <td><span class="badge bg-${getStatusColor(reg.status)}">${reg.status}</span></td>
                                                        <td>${new Date(reg.created_at).toLocaleDateString()}</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-primary" onclick="viewRegistration(${reg.id})">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-success" onclick="updateRegistrationStatus(${reg.id}, 'approved')">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                `).join('')}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        `;
                        document.getElementById('other-content').innerHTML = html;
                    }
                });
        }

        function loadContactsTable() {
            fetch('../api/contact.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const html = `
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5>All Contact Forms</h5>
                                    <button class="btn btn-primary btn-sm" onclick="exportContacts()">
                                        <i class="fas fa-download me-1"></i>Export
                                    </button>
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
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                ${data.data.map(contact => `
                                                    <tr>
                                                        <td>${contact.first_name} ${contact.last_name}</td>
                                                        <td>${contact.email}</td>
                                                        <td>${contact.subject}</td>
                                                        <td><span class="badge bg-${getContactStatusColor(contact.status)}">${contact.status}</span></td>
                                                        <td>${new Date(contact.created_at).toLocaleDateString()}</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-primary" onclick="viewContact(${contact.id})">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-success" onclick="updateContactStatus(${contact.id}, 'contacted')">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                `).join('')}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        `;
                        document.getElementById('other-content').innerHTML = html;
                    }
                });
        }

        function loadCoursesTable() {
            fetch('../api/courses.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const html = `
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5>All Courses</h5>
                                    <button class="btn btn-primary btn-sm" onclick="addCourse()">
                                        <i class="fas fa-plus me-1"></i>Add Course
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Price</th>
                                                    <th>Duration</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                ${data.data.map(course => `
                                                    <tr>
                                                        <td>${course.name}</td>
                                                        <td>${course.description}</td>
                                                        <td>$${course.price}</td>
                                                        <td>${course.duration_hours} hours</td>
                                                        <td><span class="badge bg-${course.is_active ? 'success' : 'danger'}">${course.is_active ? 'Active' : 'Inactive'}</span></td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-primary" onclick="editCourse(${course.id})">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-danger" onclick="deleteCourse(${course.id})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                `).join('')}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        `;
                        document.getElementById('other-content').innerHTML = html;
                    }
                });
        }

        function loadTestimonialsTable() {
            fetch('../api/testimonials.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const html = `
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5>All Testimonials</h5>
                                    <button class="btn btn-primary btn-sm" onclick="addTestimonial()">
                                        <i class="fas fa-plus me-1"></i>Add Testimonial
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Student Name</th>
                                                    <th>Course</th>
                                                    <th>Rating</th>
                                                    <th>Testimonial</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                ${data.data.map(testimonial => `
                                                    <tr>
                                                        <td>${testimonial.student_name}</td>
                                                        <td>${testimonial.course_name}</td>
                                                        <td>${'★'.repeat(testimonial.rating)}</td>
                                                        <td>${testimonial.testimonial.substring(0, 50)}...</td>
                                                        <td><span class="badge bg-${testimonial.is_approved ? 'success' : 'warning'}">${testimonial.is_approved ? 'Approved' : 'Pending'}</span></td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-primary" onclick="editTestimonial(${testimonial.id})">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-success" onclick="approveTestimonial(${testimonial.id})">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                `).join('')}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        `;
                        document.getElementById('other-content').innerHTML = html;
                    }
                });
        }

        // Action functions
        function updateRegistrationStatus(id, status) {
            fetch('../api/registration.php', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    id: id,
                    status: status
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Registration status updated successfully');
                    loadRegistrationsTable();
                } else {
                    alert('Failed to update registration status');
                }
            });
        }

        function updateContactStatus(id, status) {
            // This would need to be implemented in the contact API
            alert('Contact status update functionality needs to be implemented');
        }

        function viewRegistration(id) {
            alert('View registration details for ID: ' + id);
        }

        function viewContact(id) {
            alert('View contact details for ID: ' + id);
        }

        function editCourse(id) {
            alert('Edit course with ID: ' + id);
        }

        function deleteCourse(id) {
            if (confirm('Are you sure you want to delete this course?')) {
                fetch('../api/courses.php', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id: id })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Course deleted successfully');
                        loadCoursesTable();
                    } else {
                        alert('Failed to delete course');
                    }
                });
            }
        }

        function addCourse() {
            alert('Add new course functionality');
        }

        function addTestimonial() {
            alert('Add new testimonial functionality');
        }

        function editTestimonial(id) {
            alert('Edit testimonial with ID: ' + id);
        }

        function approveTestimonial(id) {
            alert('Approve testimonial with ID: ' + id);
        }

        function exportRegistrations() {
            alert('Export registrations functionality');
        }

        function exportContacts() {
            alert('Export contacts functionality');
        }
    </script>
</body>
</html>
