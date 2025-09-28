# 🚀 Noble Driving Academy - Production Deployment Guide

## 📋 Pre-Deployment Checklist

### ✅ Backend Requirements
- [ ] PHP 7.4+ with extensions: PDO, MySQL, OpenSSL, cURL
- [ ] MySQL 5.7+ or MariaDB 10.3+
- [ ] Web server (Apache/Nginx)
- [ ] SSL Certificate
- [ ] SMTP server for email notifications

### ✅ Frontend Requirements
- [ ] Node.js 16+ and npm
- [ ] Build tools (Vite)
- [ ] CDN for static assets (optional)

## 🔧 Production Setup

### 1. Server Configuration

#### Apache Configuration
```apache
# .htaccess for security
RewriteEngine On

# Security headers
Header always set X-Content-Type-Options nosniff
Header always set X-Frame-Options DENY
Header always set X-XSS-Protection "1; mode=block"
Header always set Referrer-Policy "strict-origin-when-cross-origin"

# Hide sensitive files
<Files "*.log">
    Order allow,deny
    Deny from all
</Files>

<Files "*.sql">
    Order allow,deny
    Deny from all
</Files>

# PHP settings
php_value upload_max_filesize 5M
php_value post_max_size 5M
php_value max_execution_time 30
php_value memory_limit 128M
```

#### Nginx Configuration
```nginx
server {
    listen 443 ssl http2;
    server_name yourdomain.com;
    
    ssl_certificate /path/to/certificate.crt;
    ssl_certificate_key /path/to/private.key;
    
    root /var/www/nobledriving;
    index index.php;
    
    # Security headers
    add_header X-Content-Type-Options nosniff;
    add_header X-Frame-Options DENY;
    add_header X-XSS-Protection "1; mode=block";
    
    # PHP handling
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
    }
    
    # Hide sensitive files
    location ~ \.(log|sql)$ {
        deny all;
    }
}
```

### 2. Database Setup

#### Create Production Database
```sql
CREATE DATABASE noble_driving_academy_prod;
CREATE USER 'noble_user'@'localhost' IDENTIFIED BY 'strong_password_here';
GRANT ALL PRIVILEGES ON noble_driving_academy_prod.* TO 'noble_user'@'localhost';
FLUSH PRIVILEGES;
```

#### Import Schema
```bash
mysql -u noble_user -p noble_driving_academy_prod < backend/database/schema.sql
```

### 3. Environment Configuration

#### Update config.php
```php
// Production database settings
define('DB_HOST', 'localhost');
define('DB_NAME', 'noble_driving_academy_prod');
define('DB_USERNAME', 'noble_user');
define('DB_PASSWORD', 'strong_password_here');

// Production email settings
define('FROM_EMAIL', 'noreply@yourdomain.com');
define('FROM_NAME', 'Noble Driving Academy');
define('SMTP_HOST', 'smtp.yourdomain.com');
define('SMTP_USERNAME', 'noreply@yourdomain.com');
define('SMTP_PASSWORD', 'smtp_password_here');

// Production URLs
define('BASE_URL', 'https://yourdomain.com');
define('ADMIN_URL', 'https://yourdomain.com/backend/admin-simple.php');
```

### 4. Frontend Build

#### Build for Production
```bash
# Install dependencies
npm install

# Build for production
npm run build

# The build files will be in the 'dist' directory
```

#### Deploy Frontend
```bash
# Copy build files to web root
cp -r dist/* /var/www/nobledriving/

# Set proper permissions
chown -R www-data:www-data /var/www/nobledriving/
chmod -R 755 /var/www/nobledriving/
```

### 5. Security Hardening

#### File Permissions
```bash
# Set secure permissions
find /var/www/nobledriving -type f -exec chmod 644 {} \;
find /var/www/nobledriving -type d -exec chmod 755 {} \;

# Protect sensitive directories
chmod 700 /var/www/nobledriving/backend/logs/
chmod 700 /var/www/nobledriving/backend/backups/
```

#### Firewall Configuration
```bash
# UFW (Ubuntu)
ufw allow 22/tcp
ufw allow 80/tcp
ufw allow 443/tcp
ufw enable

# iptables (CentOS/RHEL)
iptables -A INPUT -p tcp --dport 22 -j ACCEPT
iptables -A INPUT -p tcp --dport 80 -j ACCEPT
iptables -A INPUT -p tcp --dport 443 -j ACCEPT
```

### 6. Email Configuration

#### SMTP Settings
```php
// In config/email.php
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'your-email@gmail.com');
define('SMTP_PASSWORD', 'your-app-password');
define('SMTP_ENCRYPTION', 'tls');
```

#### Test Email Functionality
```bash
# Create test script
php -r "
require_once 'backend/config/email.php';
\$email = new EmailService();
\$result = \$email->sendEmail('test@example.com', 'Test Email', 'This is a test email');
echo \$result ? 'Email sent successfully' : 'Email failed';
"
```

### 7. Monitoring & Logging

#### Set up Log Rotation
```bash
# Create logrotate configuration
sudo nano /etc/logrotate.d/nobledriving

# Add this content:
/var/www/nobledriving/backend/logs/*.log {
    daily
    missingok
    rotate 30
    compress
    delaycompress
    notifempty
    create 644 www-data www-data
}
```

#### Performance Monitoring
```bash
# Install monitoring tools
sudo apt install htop iotop nethogs

# Monitor PHP-FPM
sudo systemctl status php7.4-fpm
sudo tail -f /var/log/php7.4-fpm.log
```

### 8. Backup Strategy

#### Automated Backups
```bash
# Create backup script
sudo nano /usr/local/bin/backup-nobledriving.sh

#!/bin/bash
DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="/var/backups/nobledriving"
DB_NAME="noble_driving_academy_prod"

# Create backup directory
mkdir -p $BACKUP_DIR

# Database backup
mysqldump -u noble_user -p$DB_PASSWORD $DB_NAME > $BACKUP_DIR/db_backup_$DATE.sql

# Files backup
tar -czf $BACKUP_DIR/files_backup_$DATE.tar.gz /var/www/nobledriving

# Keep only last 7 days
find $BACKUP_DIR -name "*.sql" -mtime +7 -delete
find $BACKUP_DIR -name "*.tar.gz" -mtime +7 -delete

# Make executable
chmod +x /usr/local/bin/backup-nobledriving.sh

# Add to crontab
crontab -e
# Add this line for daily backups at 2 AM:
0 2 * * * /usr/local/bin/backup-nobledriving.sh
```

### 9. SSL Certificate

#### Let's Encrypt (Free SSL)
```bash
# Install Certbot
sudo apt install certbot python3-certbot-apache

# Get certificate
sudo certbot --apache -d yourdomain.com

# Auto-renewal
sudo crontab -e
# Add this line:
0 12 * * * /usr/bin/certbot renew --quiet
```

### 10. Performance Optimization

#### PHP-FPM Optimization
```ini
; /etc/php/7.4/fpm/pool.d/www.conf
pm = dynamic
pm.max_children = 50
pm.start_servers = 5
pm.min_spare_servers = 5
pm.max_spare_servers = 35
pm.max_requests = 1000
```

#### MySQL Optimization
```ini
# /etc/mysql/mysql.conf.d/mysqld.cnf
[mysqld]
innodb_buffer_pool_size = 256M
query_cache_size = 32M
max_connections = 100
```

## 🚀 Deployment Commands

### Quick Deploy Script
```bash
#!/bin/bash
# deploy.sh

echo "🚀 Deploying Noble Driving Academy..."

# 1. Backup current version
echo "📦 Creating backup..."
tar -czf backup_$(date +%Y%m%d_%H%M%S).tar.gz /var/www/nobledriving

# 2. Pull latest code
echo "📥 Pulling latest code..."
cd /var/www/nobledriving
git pull origin main

# 3. Install dependencies
echo "📦 Installing dependencies..."
npm install
npm run build

# 4. Update database
echo "🗄️ Updating database..."
mysql -u noble_user -p noble_driving_academy_prod < backend/database/schema.sql

# 5. Set permissions
echo "🔐 Setting permissions..."
chown -R www-data:www-data /var/www/nobledriving
chmod -R 755 /var/www/nobledriving

# 6. Restart services
echo "🔄 Restarting services..."
sudo systemctl restart apache2
sudo systemctl restart php7.4-fpm

echo "✅ Deployment complete!"
```

## 🔍 Post-Deployment Testing

### 1. Test Forms
- [ ] Contact form submission
- [ ] Registration form submission
- [ ] Email notifications
- [ ] Admin panel access

### 2. Test Security
- [ ] SQL injection protection
- [ ] XSS protection
- [ ] CSRF protection
- [ ] Rate limiting

### 3. Test Performance
- [ ] Page load times
- [ ] Database queries
- [ ] Email delivery
- [ ] File uploads

## 📞 Support & Maintenance

### Regular Tasks
- [ ] Monitor logs daily
- [ ] Check backups weekly
- [ ] Update dependencies monthly
- [ ] Security patches as needed

### Emergency Contacts
- **Server Admin**: admin@yourdomain.com
- **Database Admin**: dbadmin@yourdomain.com
- **Security Team**: security@yourdomain.com

---

## 🎉 Your Noble Driving Academy is now production-ready!

**Admin Panel**: `https://yourdomain.com/backend/admin-simple.php`
**Username**: `admin`
**Password**: `admin123` (Change this immediately!)

**Next Steps**:
1. Change default admin password
2. Configure SMTP settings
3. Set up monitoring
4. Test all functionality
5. Go live! 🚀
