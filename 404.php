<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found - PHP Project</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .error-container {
            text-align: center;
            padding: 4rem 0;
        }

        .error-code {
            font-size: 8rem;
            color: #e74c3c;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .error-title {
            font-size: 2rem;
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .error-message {
            font-size: 1.2rem;
            color: #7f8c8d;
            margin-bottom: 2rem;
        }

        .error-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .helpful-links {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid #ecf0f1;
        }

        .helpful-links h3 {
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .helpful-links ul {
            list-style: none;
            display: flex;
            gap: 2rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .helpful-links a {
            color: #3498db;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .helpful-links a:hover {
            background-color: #ecf0f1;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="nav-container">
                <div class="nav-logo">
                    <h1>PHP Project</h1>
                </div>
                <div class="nav-menu">
                    <a href="index.php" class="nav-link">Home</a>
                    <a href="register.php" class="nav-link">Register</a>
                    <a href="login.php" class="nav-link">Login</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="error-container">
                <div class="error-code">404</div>
                <h1 class="error-title">Page Not Found</h1>
                <p class="error-message">Sorry, the page you are looking for doesn't exist or has been moved.</p>

                <div class="error-actions">
                    <a href="index.php" class="btn btn-primary">Go Home</a>
                    <a href="javascript:history.back()" class="btn btn-secondary">Go Back</a>
                </div>

                <div class="helpful-links">
                    <h3>Popular Pages</h3>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="register.php">Register</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="profile.php">Profile</a></li>
                    </ul>
                </div>

                <div style="margin-top: 3rem; color: #7f8c8d;">
                    <p><strong>Technical Details:</strong></p>
                    <p>Requested URL: <?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?></p>
                    <p>Server: <?php echo htmlspecialchars($_SERVER['SERVER_SOFTWARE']); ?></p>
                    <p>Date/Time: <?php echo date('Y-m-d H:i:s T'); ?></p>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 PHP Project. All rights reserved.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
