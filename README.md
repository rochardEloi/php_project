# PHP Project Documentation

## Project Overview

This is a comprehensive PHP web application built using the LAMP (Linux, Apache, MySQL, PHP) stack. The application features user authentication, registration, profile management, and demonstrates modern PHP development practices with security considerations.

## Features

- **User Registration & Authentication**: Secure user registration with password hashing and session management
- **User Profiles**: Personal profile pages with editable information
- **Session Management**: Secure session handling with database-backed sessions
- **Custom 404 Page**: User-friendly error handling
- **Responsive Design**: Mobile-friendly interface
- **Security Features**: Input validation, XSS protection, CSRF protection
- **Database Integration**: MySQL database with proper schema design

## Technology Stack

- **Operating System**: Windows 10/11
- **Web Server**: Apache 2.4 (via XAMPP)
- **Database**: MySQL 8.0
- **Programming Language**: PHP 8.1+
- **Frontend**: HTML5, CSS3, JavaScript

## Installation & Setup

### Prerequisites

1. **XAMPP Installation**:
   - Download and install XAMPP from [apachefriends.org](https://www.apachefriends.org/)
   - Ensure Apache and MySQL services are running

2. **Database Setup**:
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a new database named `php_project`
   - Run the SQL commands from `database_setup.sql`

### File Structure

```
htdocs/
├── index.php           # Home page
├── register.php        # User registration
├── login.php          # User login
├── profile.php        # User profile management
├── logout.php         # Logout functionality
├── phptest.php        # PHP testing page
├── 404.php           # Custom 404 error page
├── connect.php       # Database connection
├── styles.css        # CSS styling
├── script.js         # JavaScript functionality
├── .htaccess         # Apache configuration
└── database_setup.sql # Database schema
```

## Configuration

### Database Connection

Edit `connect.php` to modify database connection settings:

```php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php_project";
```

### Session Configuration

Session settings are configured in `.htaccess`:

```apache
php_value session.cookie_httponly 1
php_value session.cookie_secure 0
php_value session.use_only_cookies 1
```

## Security Features

### Password Security
- Passwords are hashed using `password_hash()` with bcrypt
- Minimum password length of 8 characters
- Password strength validation

### Input Validation
- All user inputs are sanitized using `htmlspecialchars()`
- Email validation using `FILTER_VALIDATE_EMAIL`
- SQL injection prevention with prepared statements

### Session Security
- Session tokens stored in database
- HTTPOnly cookies for session management
- Session expiration handling

### Headers Security
- X-Content-Type-Options: nosniff
- X-Frame-Options: DENY
- X-XSS-Protection: 1; mode=block

## Page Descriptions

### Index Page (`index.php`)
- Public landing page
- Features overview
- Navigation menu
- Responsive hero section

### Registration Page (`register.php`)
- User account creation
- Form validation
- Password strength indicator
- Duplicate username/email checking

### Login Page (`login.php`)
- User authentication
- Session creation
- Remember me functionality
- Error handling

### Profile Page (`profile.php`)
- User information display
- Profile editing capabilities
- Account management
- Session validation

### PHP Test Page (`phptest.php`)
- PHP version information
- Database connectivity testing
- File system operations
- Security demonstrations

### 404 Error Page (`404.php`)
- Custom error handling
- User-friendly error messages
- Navigation links
- Technical error details

## Database Schema

### Users Table
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### User Sessions Table
```sql
CREATE TABLE user_sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    session_token VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    expires_at TIMESTAMP NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

## Usage Instructions

### User Registration
1. Navigate to `/register.php`
2. Fill in required information
3. Password must be at least 8 characters
4. Email must be valid format
5. Username must be unique

### User Login
1. Navigate to `/login.php`
2. Enter username and password
3. Session will be created automatically
4. Redirected to home page

### Profile Management
1. Login to access profile page
2. Update personal information
3. Changes are saved immediately
4. Session data is updated

### Testing Features
1. Visit `/phptest.php` for comprehensive testing
2. View PHP configuration
3. Test database operations
4. Check file system functionality

## Troubleshooting

### Common Issues

1. **Database Connection Error**:
   - Ensure MySQL service is running
   - Check database credentials in `connect.php`
   - Verify database exists

2. **Session Issues**:
   - Clear browser cookies
   - Check session save path permissions
   - Verify PHP session configuration

3. **404 Errors**:
   - Check file permissions
   - Verify .htaccess configuration
   - Ensure files are in correct directory

4. **CSS/JS Not Loading**:
   - Check file paths in HTML
   - Verify file permissions
   - Clear browser cache

### Debug Mode

Enable error reporting by adding to `connect.php`:

```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

## Performance Considerations

- Static assets are cached for 1 month
- Text compression enabled
- Database queries optimized with prepared statements
- Session management with expiration

## Security Best Practices Implemented

1. **Input Sanitization**: All user inputs are sanitized
2. **Password Hashing**: bcrypt hashing with salt
3. **Session Security**: HTTPOnly cookies, secure tokens
4. **SQL Injection Prevention**: Prepared statements
5. **XSS Protection**: Output escaping
6. **CSRF Protection**: Session-based validation
7. **File Upload Security**: Restricted file types and sizes

## Future Enhancements

- Email verification system
- Password reset functionality
- User roles and permissions
- File upload capabilities
- API endpoints
- Unit testing
- Documentation generation

## Support

For issues and questions:
1. Check the troubleshooting section
2. Review PHP error logs
3. Test database connectivity
4. Verify file permissions

## License

This project is created for educational purposes as part of a web development course.

---

**Author**: [Your Name]
**Date**: [Submission Date]
**Course**: Web Development/PHP Programming
