<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - PHP Project</title>
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
                    <a href="index.php" class="nav-link">Home</a>
                    <a href="register.php" class="nav-link">Register</a>
                    <a href="login.php" class="nav-link">Login</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="form-container">
                <h2>Logging Out...</h2>

                <?php
                session_start();
                require_once 'connect.php';

                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];
                    $session_token = $_SESSION['session_token'] ?? null;

                    // Remove session from database
                    if ($session_token) {
                        $stmt = $conn->prepare("DELETE FROM user_sessions WHERE session_token = ?");
                        $stmt->bind_param("s", $session_token);
                        $stmt->execute();
                    }

                    // Destroy session
                    session_unset();
                    session_destroy();

                    echo '<div class="message success">You have been successfully logged out.</div>';
                    echo '<p style="text-align: center; margin-top: 1rem;">Redirecting to home page...</p>';

                    // Redirect after 2 seconds
                    header("refresh:2;url=index.php");
                } else {
                    echo '<div class="message info">You are not currently logged in.</div>';
                    echo '<p style="text-align: center; margin-top: 1rem;"><a href="index.php">Return to Home</a></p>';
                }
                ?>

                <div style="text-align: center; margin-top: 2rem;">
                    <a href="index.php" class="btn btn-secondary">Return to Home</a>
                    <a href="login.php" class="btn btn-primary">Login Again</a>
                </div>
            </div>
        </div>
    </main>


    <script src="script.js"></script>
</body>
</html>
