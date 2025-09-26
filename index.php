<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to PHP Project</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="nav-container">
                <div class="nav-logo">
                    <h1>PHP Project</h1>
                </div>
                <div class="nav-menu">
                    <a href="index.php" class="nav-link active">Home</a>
                    <a href="register.php" class="nav-link">Register</a>
                    <a href="login.php" class="nav-link">Login</a>
                    <?php
                    session_start();
                    if (isset($_SESSION['user_id'])) {
                        echo '<a href="profile.php" class="nav-link">Profile</a>';
                        echo '<a href="logout.php" class="nav-link">Logout</a>';
                    }
                    ?>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero">
            <div class="hero-content">
                <h1>Welcome to Our PHP Application</h1>
                <p>A modern web application built with PHP, MySQL, and featuring user authentication, profiles, and more.</p>
                <div class="hero-buttons">
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <a href="register.php" class="btn btn-primary">Get Started</a>
                        <a href="login.php" class="btn btn-secondary">Login</a>
                    <?php else: ?>
                        <a href="profile.php" class="btn btn-primary">View Profile</a>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="features">
            <div class="container">
                <h2>Features</h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <h3>User Registration</h3>
                        <p>Create an account with username, email, and secure password hashing.</p>
                    </div>
                    <div class="feature-card">
                        <h3>Secure Login</h3>
                        <p>Authenticate users with session management and secure password verification.</p>
                    </div>
                    <div class="feature-card">
                        <h3>User Profiles</h3>
                        <p>Manage your personal information and view your account details.</p>
                    </div>
                    <div class="feature-card">
                        <h3>Responsive Design</h3>
                        <p>Modern, mobile-friendly interface that works on all devices.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="about">
            <div class="container">
                <h2>About This Project</h2>
                <p>This is a demonstration of a complete LAMP stack application featuring:</p>
                <ul>
                    <li>Modern PHP development practices</li>
                    <li>Secure user authentication system</li>
                    <li>Database integration with MySQL</li>
                    <li>Clean, responsive web design</li>
                    <li>Session management</li>
                    <li>Error handling and custom 404 pages</li>
                </ul>
            </div>
        </section>
    </main>
    <script src="script.js"></script>
</body>
</html>
