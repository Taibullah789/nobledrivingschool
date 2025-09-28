# Noble Driving Academy - PHP Backend

A comprehensive PHP backend system for the Noble Driving Academy website, featuring contact forms, registration management, course administration, and more.

## 🚀 Features

- **Contact Form Management**: Handle contact form submissions with email notifications
- **Registration System**: Complete student registration and course enrollment
- **Course Management**: Add, edit, and manage driving courses
- **Testimonial System**: Manage student testimonials and reviews
- **Admin Panel**: Beautiful, responsive admin dashboard
- **Email Notifications**: Automated email alerts for form submissions
- **RESTful API**: Clean API endpoints for frontend integration

## 📁 Project Structure

```
backend/
├── api/                    # API endpoints
│   ├── contact.php         # Contact form API
│   ├── registration.php    # Registration API
│   ├── courses.php         # Courses API
│   └── testimonials.php    # Testimonials API
├── config/                 # Configuration files
│   ├── config.php          # Application configuration
│   └── database.php        # Database connection
├── models/                 # Data models
│   ├── Contact.php         # Contact model
│   └── Registration.php    # Registration model
├── admin/                  # Admin panel
│   └── index.php           # Admin dashboard
├── database/               # Database files
│   └── schema.sql          # Database schema
├── setup/                  # Setup scripts
│   └── install.php         # Database installation
└── README.md              # This file
```

## 🛠️ Installation

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher (or MariaDB 10.2+)
- Web server (Apache/Nginx)
- PDO MySQL extension

### Step 1: Database Setup

1. Create a MySQL database:
   ```sql
   CREATE DATABASE noble_driving_academy;
   ```

2. Update database credentials in `config/database.php`:
   ```php
   private $host = 'localhost';
   private $db_name = 'noble_driving_academy';
   private $username = 'your_username';
   private $password = 'your_password';
   ```

3. Run the installation script:
   ```
   http://your-domain.com/backend/setup/install.php
   ```

### Step 2: Configuration

1. Update email settings in `config/config.php`:
   ```php
   define('SMTP_HOST', 'smtp.gmail.com');
   define('SMTP_PORT', 587);
   define('SMTP_USERNAME', 'your-email@gmail.com');
   define('SMTP_PASSWORD', 'your-app-password');
   define('FROM_EMAIL', 'info@nobledrivingacademy.com');
   ```

2. Change default admin credentials:
   - Default username: `admin`
   - Default password: `admin123`
   - **Important**: Change these immediately after setup!

### Step 3: Frontend Integration

Update your React frontend to use the new API endpoints:

#### Contact Form Integration

```javascript
const handleSubmit = async (e) => {
  e.preventDefault();
  
  try {
    const response = await fetch('http://your-domain.com/backend/api/contact.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(formData)
    });
    
    const result = await response.json();
    
    if (result.success) {
      // Handle success
      console.log('Contact form submitted successfully');
    } else {
      // Handle error
      console.error('Error:', result.error);
    }
  } catch (error) {
    console.error('Network error:', error);
  }
};
```

#### Registration Form Integration

```javascript
const handleSubmit = async (e) => {
  e.preventDefault();
  
  try {
    const response = await fetch('http://your-domain.com/backend/api/registration.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(formData)
    });
    
    const result = await response.json();
    
    if (result.success) {
      // Handle success
      console.log('Registration submitted successfully');
    } else {
      // Handle error
      console.error('Error:', result.error);
    }
  } catch (error) {
    console.error('Network error:', error);
  }
};
```

## 📊 Database Schema

### Tables Created

- **users**: Admin and instructor accounts
- **courses**: Available driving courses
- **contacts**: Contact form submissions
- **registrations**: Student registrations
- **testimonials**: Student testimonials
- **blog_posts**: Blog content management

### Sample Data

The installation script includes:
- 6 default courses
- 1 admin user
- 3 sample testimonials
- 3 sample blog posts

## 🔧 API Endpoints

### Contact API (`/api/contact.php`)

- **POST**: Submit contact form
- **GET**: Retrieve all contacts (admin)

### Registration API (`/api/registration.php`)

- **POST**: Submit registration form
- **GET**: Retrieve all registrations (admin)
- **PUT**: Update registration status

### Courses API (`/api/courses.php`)

- **GET**: Retrieve all courses
- **POST**: Create new course (admin)
- **PUT**: Update course (admin)
- **DELETE**: Delete course (admin)

### Testimonials API (`/api/testimonials.php`)

- **GET**: Retrieve approved testimonials
- **POST**: Submit new testimonial
- **PUT**: Update testimonial (admin)
- **DELETE**: Delete testimonial (admin)

## 🎛️ Admin Panel

Access the admin panel at: `http://your-domain.com/backend/admin/`

### Features

- **Dashboard**: Overview of registrations, contacts, and statistics
- **Registration Management**: View, approve, and manage student registrations
- **Contact Management**: Handle contact form submissions
- **Course Management**: Add, edit, and manage courses
- **Testimonial Management**: Approve and manage testimonials

### Default Login

- **Username**: admin
- **Password**: admin123

## 📧 Email Configuration

The system sends email notifications for:
- New contact form submissions
- New registration submissions
- Status updates

Configure SMTP settings in `config/config.php` for email functionality.

## 🔒 Security Features

- Input sanitization and validation
- SQL injection prevention with prepared statements
- CORS headers for frontend integration
- Error handling and logging

## 🚀 Deployment

### Production Checklist

1. ✅ Change default admin credentials
2. ✅ Update database credentials
3. ✅ Configure email settings
4. ✅ Set up SSL certificate
5. ✅ Configure web server security
6. ✅ Enable error logging
7. ✅ Set up database backups

### Web Server Configuration

#### Apache (.htaccess)
```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^api/(.*)$ api/$1 [L]
```

#### Nginx
```nginx
location /backend/api/ {
    try_files $uri $uri/ /backend/api/index.php?$query_string;
}
```

## 🐛 Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Check database credentials
   - Ensure MySQL service is running
   - Verify database exists

2. **Email Not Working**
   - Check SMTP configuration
   - Verify email credentials
   - Check firewall settings

3. **CORS Issues**
   - Update CORS headers in config.php
   - Check frontend API URLs

4. **Permission Errors**
   - Set proper file permissions
   - Check web server user permissions

## 📝 API Documentation

### Contact Form Submission

```json
POST /api/contact.php
{
  "firstName": "John",
  "lastName": "Doe",
  "email": "john@example.com",
  "subject": "Inquiry",
  "course": "Teenage Behind the Wheel Training",
  "message": "I would like to know more about your courses."
}
```

### Registration Form Submission

```json
POST /api/registration.php
{
  "firstName": "Jane",
  "lastName": "Smith",
  "email": "jane@example.com",
  "addressLine1": "123 Main St",
  "city": "Alexandria",
  "state": "VA",
  "zipCode": "22312",
  "age": "teen",
  "course": "teen-behind-wheel",
  "phone": "703-123-4567"
}
```

## 🤝 Support

For technical support or questions about the backend system, please contact the development team or refer to the documentation.

## 📄 License

This project is proprietary software for Noble Driving Academy. All rights reserved.

---

**Noble Driving Academy Backend System**  
Version 1.0.0  
Last Updated: 2024
