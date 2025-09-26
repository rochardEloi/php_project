<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PHP Project</title>
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
                    <a href="login.php" class="nav-link active">Login</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="form-container">
                <h2>Login to Your Account</h2>

                <?php
                session_start();
                require_once 'connect.php';

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $username = trim($_POST['username']);
                    $password = $_POST['password'];

                    $errors = [];

                    if (empty($username)) $errors[] = "Username is required";
                    if (empty($password)) $errors[] = "Password is required";

                    if (empty($errors)) {
                        // Get user from database
                        $stmt = $conn->prepare("SELECT id, username, password, first_name, last_name FROM users WHERE username = ?");
                        $stmt->bind_param("s", $username);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows === 1) {
                            $user = $result->fetch_assoc();

                            if (password_verify($password, $user['password'])) {
                                // Login successful
                                $_SESSION['user_id'] = $user['id'];
                                $_SESSION['username'] = $user['username'];
                                $_SESSION['first_name'] = $user['first_name'];
                                $_SESSION['last_name'] = $user['last_name'];

                                // Generate session token
                                $session_token = bin2hex(random_bytes(32));
                                $_SESSION['session_token'] = $session_token;

                                // Store session in database
                                $stmt = $conn->prepare("INSERT INTO user_sessions (user_id, session_token, expires_at) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 24 HOUR))");
                                $stmt->bind_param("is", $user['id'], $session_token);
                                $stmt->execute();

                                echo '<div class="message success">Login successful! Redirecting...</div>';
                                header("refresh:2;url=index.php");
                                exit();
                            } else {
                                $errors[] = "Invalid username or password";
                            }
                        } else {
                            $errors[] = "Invalid username or password";
                        }
                    }

                    foreach ($errors as $error) {
                        echo '<div class="message error">' . htmlspecialchars($error) . '</div>';
                    }
                }
                ?>

                <form method="POST" action="">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required
                               value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
                </form>

                <p style="text-align: center; margin-top: 1rem;">
                    Don't have an account? <a href="register.php">Register here</a>
                </p>
            </div>
        </div>
    </main>


    <script src="script.js"></script>
</body>
</html>


