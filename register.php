<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - PHP Project</title>
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
                    <a href="register.php" class="nav-link active">Register</a>
                    <a href="login.php" class="nav-link">Login</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="form-container">
                <h2>Create Account</h2>

                <?php
                session_start();
                require_once 'connect.php';

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $username = trim($_POST['username']);
                    $email = trim($_POST['email']);
                    $password = $_POST['password'];
                    $confirm_password = $_POST['confirm_password'];
                    $first_name = trim($_POST['first_name']);
                    $last_name = trim($_POST['last_name']);

                    $errors = [];

                    // Validation
                    if (empty($username)) $errors[] = "Username is required";
                    if (empty($email)) $errors[] = "Email is required";
                    if (empty($password)) $errors[] = "Password is required";
                    if (empty($first_name)) $errors[] = "First name is required";
                    if (empty($last_name)) $errors[] = "Last name is required";

                    if ($password !== $confirm_password) {
                        $errors[] = "Passwords do not match";
                    }

                    if (strlen($password) < 8) {
                        $errors[] = "Password must be at least 8 characters long";
                    }

                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errors[] = "Invalid email format";
                    }

                    // Check if username or email already exists
                    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
                    $stmt->bind_param("ss", $username, $email);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $errors[] = "Username or email already exists";
                    }

                    if (empty($errors)) {
                        // Hash password
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                        // Insert user
                        $stmt = $conn->prepare("INSERT INTO users (username, email, password, first_name, last_name) VALUES (?, ?, ?, ?, ?)");
                        $stmt->bind_param("sssss", $username, $email, $hashed_password, $first_name, $last_name);

                        if ($stmt->execute()) {
                            echo '<div class="message success">Registration successful! <a href="login.php">Login here</a></div>';
                        } else {
                            echo '<div class="message error">Registration failed. Please try again.</div>';
                        }
                    } else {
                        foreach ($errors as $error) {
                            echo '<div class="message error">' . htmlspecialchars($error) . '</div>';
                        }
                    }
                }
                ?>

                <form method="POST" action="">
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input type="text" id="first_name" name="first_name" required
                               value="<?php echo isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" id="last_name" name="last_name" required
                               value="<?php echo isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required
                               value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required
                               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                        <div class="password-strength"></div>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                        <div class="password-match"></div>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%;">Register</button>
                </form>

                <p style="text-align: center; margin-top: 1rem;">
                    Already have an account? <a href="login.php">Login here</a>
                </p>
            </div>
        </div>
    </main>


    <script src="script.js"></script>
</body>
</html>
